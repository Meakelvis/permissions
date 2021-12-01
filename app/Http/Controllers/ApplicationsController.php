<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Vehicle;
use Carbon\Carbon;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ApplicationsController extends Controller
{
    public function index()
    {
        $applications = Application::all();


        foreach ($applications as $application) {
            $valid_to = Application::findOrFail($application->id)->valid_to;
            $expiry = Carbon::parse($valid_to)->addDays(1);
            $today = Carbon::today();

            if ($expiry->equalTo($today)) {
                $application->status = 'expired';
                $application->save();
            }
        }

        $cleared = Application::where('status', 'cleared')->get()->count();
        $rejected = Application::where('status', 'rejected')->get()->count();
        $pending = Application::where('status', 'pending')->get()->count();
        $expired = Application::where('status', 'expired')->get()->count();
        $total = Application::all()->count();
        return view('applications.index', [
            'cleared' => $cleared,
            'rejected' => $rejected,
            'pending' => $pending,
            'expired' => $expired,
            'total' => $total,
        ]);
    }

    public function cleared()
    {
        $cleared = Application::where('status', 'cleared')->orderBy('updated_at', 'desc')->get();

        return view('applications.cleared', ['cleared' => $cleared]);
    }

    public function rejected()
    {
        $rejected = Application::where('status', 'rejected')->orderBy('updated_at', 'desc')->get();

        return view('applications.rejected', ['rejected' => $rejected]);
    }

    public function pending()
    {
        $pending = Application::where('status', 'pending')->orderBy('updated_at', 'desc')->get();

        return view('applications.pending', ['pending' => $pending]);
    }

    public function expired()
    {
        $expired = Application::where('status', 'expired')->orderBy('updated_at', 'desc')->get();

        return view('applications.expired', ['expired' => $expired]);
    }

    public function add()
    {
        return view('applications.addApplication');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'applicant_name' => 'required',
            'from' => 'required',
            'title' => 'required',
            'to' => 'required',
            'date' => 'required',
            'purpose' => 'required|in:Burial,Farmer,Medical,Contractor,Government',
            'valid_from' => 'required',
            'valid_to' => 'required',
            'phone_number' => 'required'
        ]);

        $to = strtolower($request->to);

        if (str_contains($to, 'kampala') || str_contains($to, 'gkma') || str_contains($to, 'metropolitan')) {
            return redirect()->route('applications')->with('error', 'Journey within Kampala Metropolitan area is not allowed.');
        }

        Application::create([
            'name' => $request->applicant_name,
            'from' => $request->from,
            'to' => $request->to,
            'title' => $request->title,
            'date_of_application' => $request->date,
            'purpose' => $request->purpose,
            'valid_from' => $request->valid_from,
            'valid_to' => $request->valid_to,
            'created_by' => auth()->user()->id,
            'phone_number' => $request->phone_number,
        ]);

        $application = Application::orderBy('created_at', 'desc')->first();

        return redirect()->route('applications.addVehicles', $application)->with('success', 'Application added successfully');
    }

    public function addVehicles(Application $application)
    {
        // dd($application->name);
        return view('applications.addVehicles', ['application' => $application]);
    }

    public function storeVehicles(Request $request, Application $application)
    {
        $vehicles = $request->input('vehicles', []);
        $driverNames = $request->input('driverNames', []);
        $occupants = $request->input('occupants', []);

        for ($vehicle = 0; $vehicle < count($vehicles); $vehicle++) {
            if ($vehicles[$vehicle] != '') {
                Vehicle::create([
                    'application_id' => $application->id,
                    'vehicle_no' =>  strtoupper(str_replace(' ', '', $vehicles[$vehicle])),
                    'driver_name' => $driverNames[$vehicle],
                    'no_of_occupants' => $occupants[$vehicle]
                ]);
            }
        }

        return redirect()->route('applications.results', $application)->with('success', 'Vehicles added successfully');;
    }

    public function results(Application $application)
    {
        // dd($application->name);
        $vehicles = Vehicle::where('application_id', $application->id)->get();

        return view('applications.results', ['vehicles' => $vehicles, 'application' => $application]);
    }

    public function generatePDF(Application $application)
    {
        $vehicles = Vehicle::where('application_id', $application->id)->orderBy('created_at', 'desc')->get();
        $valid_from = \Carbon\Carbon::parse($application->valid_from);
        $valid_to = \Carbon\Carbon::parse($application->valid_to);
        $validity = $valid_from->diffInDays($valid_to, false);

        // share data to view
        view()->share('application', $application);
        view()->share('vehicles', $vehicles);
        view()->share('validity', $validity);

        $pdf = PDF::loadView('applications.pdfView', [$application, $vehicles, $validity]);
        // $pdf = PDF::loadHTML('<h1>Test</h1>');

        // download PDF file with download method
        // return $pdf->setPaper('a4', 'potrait')->download('application.pdf');
        // preview pdf before downloading it
        return $pdf->stream();
    }

    public function approveApplication(Request $request, Application $application)
    {
        $application->status = 'cleared';
        $application->users_id = auth()->user()->id;
        $application->date_of_approval = date('Y-m-d');
        $application->save();

        return redirect()->route('applications');
    }

    public function approveAll(Request $request)
    {
        $ids = $request->ids;

        Application::whereIn('id', $ids)->update([
            'status' => 'cleared',
            'users_id' => auth()->user()->id,
            'date_of_approval' => date('Y-m-d')
        ]);

        return response()->json(['success' => 'Applications approved successfully']);
    }

    public function rejectApplication(Request $request, Application $application)
    {
        $application->status = 'rejected';
        $application->users_id = auth()->user()->id;
        $application->date_of_approval = date('Y-m-d');
        $application->save();

        return redirect()->route('applications');
    }

    public function rejectAll(Request $request)
    {
        $ids = $request->ids;

        Application::whereIn('id', $ids)->update([
            'status' => 'rejected',
            'users_id' => auth()->user()->id,
            'date_of_approval' => date('Y-m-d')
        ]);

        return response()->json(['success' => 'Applications rejected successfully']);
    }

    public function revertAll(Request $request)
    {
        $ids = $request->ids;

        Application::whereIn('id', $ids)->update([
            'status' => 'pending',
            'users_id' => auth()->user()->id,
            'date_of_approval' => date('Y-m-d')
        ]);

        return response()->json(['success' => 'Applications reverted successfully']);
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;

        Application::whereIn('id', $ids)->delete();

        return response()->json(['success' => 'Applications deleteed successfully']);
    }

    public function editApplication(Application $application)
    {
        $application = Application::findOrFail($application->id);
        return view('applications.editApplication', ['application' => $application]);
    }

    public function updateApplication(Application $application, Request $request)
    {
        $this->validate($request, [
            'applicant_name' => 'required',
            'from' => 'required',
            'title' => 'required',
            'to' => 'required',
            'date' => 'required',
            'purpose' => 'required|in:Burial,Farmer,Medical,Contractor,Government',
            'valid_from' => 'required',
            'valid_to' => 'required',
            'phone_number' => 'required'
        ]);

        Application::where('id', $application->id)->update([
            'name' => $request->applicant_name,
            'from' => $request->from,
            'to' => $request->to,
            'title' => $request->title,
            'date_of_application' => $request->date,
            'purpose' => $request->purpose,
            'valid_from' => $request->valid_from,
            'valid_to' => $request->valid_to,
            'phone_number' => $request->phone_number,
            'created_by' => auth()->user()->id,
        ]);

        return redirect()->route('applications.results', $application)->with('success', 'Application Editted successfully');
    }

    public function editVehicle(Vehicle $vehicle)
    {
        $vehicle = Vehicle::findOrFail($vehicle->id);
        return view('applications.editVehicle', ['vehicle' => $vehicle]);
    }

    public function updateVehicle(Vehicle $vehicle, Request $request)
    {
        $this->validate($request, [
            'vehicleNo' => 'required',
            'driverName' => 'required',
            'occupants' => 'required',
        ]);

        Vehicle::where('id', $vehicle->id)->update([
            'vehicle_no' => strtoupper(str_replace(' ', '', $request->vehicleNo)),
            'driver_name' => $request->driverName,
            'no_of_occupants' => $request->occupants,
        ]);

        $application = Application::findOrFail($vehicle->application_id);

        return redirect()->route('applications.results', $application)->with('success', 'Vehicle Editted successfully');
    }

    public function deleteVehicle(Vehicle $vehicle, Request $request)
    {
        $vehicle->delete();

        return back()->with('success', 'Vehicle ' . $vehicle->vehicle_no . ' deleted successfully');
    }
}
