<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use App\Models\OrganisationPersonnel;
use PDF;
use App\Models\User;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use DateTime;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;

class OrganisationsController extends Controller
{
    public function index()
    {
        return view('organisation.index');
    }

    public function add(Request $request)
    {
        $cleared = OrganisationPersonnel::where('status', 'cleared')->get()->count();

        if ($cleared >= 30000) {
            return redirect()->route('org.dashboard')->with('error', '30000 Application Limit has been reached');
        } else {
            $this->validate($request, [
                'entity' => 'required',
                'category' => 'required|in:Government,Media,Utilities,Manufacturing,Medical,Telecom,Construction,Food Processors,Agriculture,Fuel Stations,Private Security,Delivery Services,Financial Institutions,Emergency Services,Airline Operators,Restaurants,Hotels,Cleaning and Garbage Services,Tours and Travel,Supermarkets,Garages,Insurance,Clearing Agents,Education Services,NGOs(Non-Government Organisation)',
                'name_of_applicant' => 'required',
                'title' => 'required',
                'phone_no' => 'required',
                'address' => 'required',
                'created_by' => 'required',
                'email' => 'required',
            ]);

            $email = User::all()->contains('email', $request->email);

            if ($email) {
                return back()->with('error', 'Credentails for already exist, please check email');
            } else {

                $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890#$%');
                $password = substr($random, 0, 8);
                // dd($request->created_by);
                Organisation::create([
                    'entity' => $request->entity,
                    'category' => $request->category,
                    'name_of_applicant' => $request->name_of_applicant,
                    'title' => $request->title,
                    'phone_no' => $request->phone_no,
                    'address' => $request->address,
                    'total_no_of_workers' => 0,
                    'created_by' => auth()->user()->id,
                    'email' => $request->email,
                    'password' => Hash::make($password),
                ]);

                User::create([
                    'name' => $request->name_of_applicant,
                    'role_id' => Role::IS_ORG,
                    'email' => $request->email,
                    'district' => 'kampala',
                    'password' => Hash::make($password),
                ]);


                // $organisation = Organisation::orderBy('created_at', 'desc')->first();

                return redirect()->route('org.dashboard')->with('success', 'Organisation Added, password is ' . $password . '');
            }
        }
    }

    public function orgPersonnel(Organisation $organisation)
    {
        return view('organisation.addPersonnel', ['organisation' => $organisation]);
    }

    public function addPersonnel(Request $request, Organisation $organisation)
    {
        $this->validate($request, [
            'organisation_id' => 'required',
            'name' => 'required',
            'title' => 'required',
            'vehicle_no' => 'required',
            'type_of_vehicle' => 'required|in:Saloon,SUV,Bus,Omni-bus,Pick-up,Station Wagon',
            'nin' => 'required',
            'phone_no' => 'required',
        ]);

        $workers = Organisation::findOrFail($request->organisation_id)->total_no_of_workers;
        $personnelCount = OrganisationPersonnel::where('organisation_id', $request->organisation_id)->get()->count();
        $plateExists = OrganisationPersonnel::all()->contains('vehicle_no', strtoupper(str_replace(' ', '', $request->vehicle_no)));

        if ($plateExists) {
            return redirect()->route('organisation.personnel', $organisation)->with('error', ' Number Plate has already been registered');
        } else {
            if ($personnelCount == ($workers * 0.1)) {
                if ($organisation->category == 'Medical' || $organisation->category == 'Works Special') {
                    OrganisationPersonnel::create([
                        'organisation_id' => $request->organisation_id,
                        'name' => $request->name,
                        'title' => $request->title,
                        'vehicle_no' => str_replace(' ', '', $request->vehicle_no),
                        'type_of_vehicle' => $request->type_of_vehicle,
                        'nin' => $request->nin,
                        'phone_no' => $request->phone_no,
                        'validity' => 42,
                        'occupants' => 3,
                    ]);

                    return redirect('/organisation/personnel/' . $request->organisation_id)->with('success', 'Personnel Added');
                } else {
                    return redirect()->route('organisation.personnel', $organisation)->with('error', 'You have reached the 10% limit for your organisation');
                }
            } else {
                OrganisationPersonnel::create([
                    'organisation_id' => $request->organisation_id,
                    'name' => $request->name,
                    'title' => $request->title,
                    'vehicle_no' => str_replace(' ', '', $request->vehicle_no),
                    'type_of_vehicle' => $request->type_of_vehicle,
                    'nin' => $request->nin,
                    'phone_no' => $request->phone_no,
                    'occupants' => 3,
                ]);

                $org_uuid = Organisation::findOrFail($request->organisation_id)->uuid;

                return redirect('/organisation/personnel/' . $org_uuid)->with('success', 'Personnel Added');
            }
        }
    }

    /**
     * edit personnel organisation personnel details
     */
    public function editPersonnel(OrganisationPersonnel $data)
    {
        $organisationPersonnel = OrganisationPersonnel::findOrFail($data->id);
        return view('organisation.editPersonnel', ['organisationPersonnel' => $organisationPersonnel]);
    }

    /**
     * update personnel data in the db
     */
    public function updatePersonnel(OrganisationPersonnel $data, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'vehicle_no' => 'required',
            'title' => 'required',
            'nin' => 'required',
            'phone_no' => 'required',
            'validity' => 'required',
            'occupants' => 'required',
            'type_of_vehicle' => 'required|in:Saloon,SUV,Bus,Omni-bus,Pick-up,Station Wagon',
        ]);

        $data->name = $request->name;
        $data->title = $request->title;
        $data->type_of_vehicle = $request->type_of_vehicle;
        $data->nin = $request->nin;
        $data->phone_no = $request->phone_no;
        $data->validity = $request->validity;
        $data->occupants = $request->occupants;
        $data->vehicle_no = strtoupper(str_replace(' ', '', $request->vehicle_no));
        $data->save();

        $organisation = Organisation::findOrFail($data->organisation_id);

        return redirect()->route('organisation.personnel', $organisation);
    }

    /**
     * delete then selected organisation personnel record
     */
    public function deletePersonnel(Request $request, OrganisationPersonnel $data)
    {
        $ids = $request->ids;
        OrganisationPersonnel::whereIn('id', $ids)->delete();

        return response()->json(['success' => 'Personnel have been deleted successfully']);
    }

    public function addWorkers(Request $request, Organisation $organisation)
    {
        $this->validate($request, [
            'total_no_of_workers' => 'required|integer|min:0',
        ]);
        $organisation->total_no_of_workers = $request->total_no_of_workers;
        $organisation->save();

        return redirect()->route('organisation.personnel', $organisation)->with('success', 'Number of Workers in Organisation added');
    }

    public function preview(OrganisationPersonnel $person)
    {
        $organisationPersonnel = OrganisationPersonnel::findOrFail($person->id);

        $expiryDate  = Carbon::parse($organisationPersonnel->date_of_approval)->addDays($organisationPersonnel->validity);
        $lastDate = Carbon::createFromDate(2021, 7, 30);

        if ($expiryDate->greaterThan($lastDate)) {
            $finalDate = $lastDate->format('d/m/Y');
        } else {
            $finalDate = $expiryDate->format('d/m/Y');
        }

        return view('organisation.results', ['organisationPersonnel' => $organisationPersonnel, 'finalDate' => $finalDate]);
    }

    public function generatePDF(OrganisationPersonnel $person)
    {
        $expiryDate  = Carbon::parse($person->date_of_approval)->addDays($person->validity);
        $lastDate = Carbon::createFromDate(2021, 7, 30);

        if ($expiryDate->greaterThan($lastDate)) {
            $finalDate = $lastDate->format('d/m/Y');
        } else {
            $finalDate = $expiryDate->format('d/m/Y');
        }
        // share data to view
        $organisationPersonnel = OrganisationPersonnel::findOrFail($person->id);
        view()->share('organisationPersonnel', $organisationPersonnel);
        view()->share('finalDate', $finalDate);

        $pdf = PDF::loadView('organisation.pdfView', [$organisationPersonnel, $expiryDate]);
        return $pdf->stream();
    }

    public function approveApplication(Request $request, OrganisationPersonnel $data)
    {
        $cleared = OrganisationPersonnel::where('status', 'cleared')->get()->count();

        if ($cleared >= 30000) {
            return redirect()->route('org.dashboard')->with('error', '30000 Application Limit has been reached');
        } else {
            $data->status = 'cleared';
            $data->date_of_approval = date('Y-m-d');
            $data->users_id = auth()->user()->id;

            $category = Organisation::findOrFail($request->organisation_id)->category;

            if ($category == 'Medical' || $category == 'Works Special') {
                $data->validity = 42;
            }

            $data->save();

            return redirect()->route('organisation.personnel', $request->organisation_id);
        }
    }

    public function rejectApplication(Request $request, OrganisationPersonnel $data)
    {
        $data->status = 'rejected';
        $data->date_of_approval = date('Y-m-d');
        $data->reason_for_rejection = $request->reason_for_rejection;
        $data->users_id = auth()->user()->id;
        $data->save();

        return redirect()->route('organisation.personnel', $request->organisation_id);
    }

    public function rejectAll(Request $request, Organisation $data)
    {
        $ids = $request->ids;

        foreach ($ids as $id) {
            $application = OrganisationPersonnel::findOrFail($id);
            $status = $application->status;

            // if the application isn't already rejected, reject it
            // else leave it the way it is
            if ($status !== 'rejected') {
                $application->status = 'rejected';
                $application->date_of_approval = date('Y-m-d');
                $application->users_id = auth()->user()->id;
                $application->validity = 42;
                $application->save();
            } else {
                $application->date_of_approval = $application->date_of_approval;
                $application->status = $application->status;
                $application->users_id = $application->users_id;
                $application->validity = $application->validity;
                $application->save();
            }
        }

        return response()->json(['success' => 'Personnel reject successfully']);
    }

    public function approveAll(Request $request, Organisation $data)
    {
        $cleared = OrganisationPersonnel::where('status', 'cleared')->get()->count();

        if ($cleared >= 30000) {
            return response()->json(['success' => '30000 Application Limit has been reached']);
        } else {
            if ($request->org_category == 'Medical' || $request->org_category == 'Works Special') {
                $ids = $request->ids;

                foreach ($ids as $id) {
                    $application = OrganisationPersonnel::findOrFail($id);
                    $status = $application->status;

                    // if the application isn't already cleared, clear it
                    // else leave it the way it is
                    if ($status !== 'cleared') {
                        $application->status = 'cleared';
                        $application->date_of_approval = date('Y-m-d');
                        $application->users_id = auth()->user()->id;
                        $application->validity = 42;
                        $application->save();
                    } else {
                        $application->date_of_approval = $application->date_of_approval;
                        $application->status = $application->status;
                        $application->users_id = $application->users_id;
                        $application->validity = $application->validity;
                        $application->save();
                    }
                }

                return response()->json(['success' => 'Personnel approved successfully']);
            } else {
                $ids = $request->ids;

                foreach ($ids as $id) {
                    $application = OrganisationPersonnel::findOrFail($id);
                    $status = $application->status;

                    if ($status !== 'cleared') {
                        $application->status = 'cleared';
                        $application->date_of_approval = date('Y-m-d');
                        $application->users_id = auth()->user()->id;
                        $application->save();
                    } else {
                        $application->date_of_approval = $application->date_of_approval;
                        $application->status = $application->status;
                        $application->users_id = $application->users_id;
                        $application->save();
                    }
                }
                return response()->json(['success' => 'Personnel approved successfully']);
            }
        }
    }

    public function revertApplication(Request $request, OrganisationPersonnel $data)
    {
        $data->status = 'pending';
        $data->save();

        return redirect()->route('organisation.personnel', $request->organisation_id);
    }

    public function revertAll(Request $request, Organisation $data)
    {
        $ids = $request->ids;
        OrganisationPersonnel::whereIn('id', $ids)->update([
            'status' => 'pending',
        ]);

        return response()->json(['success' => 'Personnel status reverted successfully']);
    }
}
