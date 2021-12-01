<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use App\Models\OrganisationPersonnel;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class OrganisationDashboardController extends Controller
{
    public function index()
    {
        $organisation = Organisation::where('email', auth()->user()->email)->get();

        $allOrganisations = Organisation::orderBy('created_at', 'desc')->get();

        return view('dashboard.organisation', ['organisation' => $organisation, 'allOrganisations' => $allOrganisations]);
    }

    public function showOrganisationPersonnel(Organisation $organisation)
    {
        /**
         * !!! AUTO RENEWAL BEFORE DISPLAYING THE PERSONNEL
         * first update the status of individuals that are cleared in an organisation
         * when the permit expiry has reached
         * 
         * then show the organisation statistics
         */
        $people = OrganisationPersonnel::where('organisation_id', $organisation->id)->get();
        $today = date('d/m/Y');

        foreach ($people as $person) {
            // addition of the date of approval plus validity period to get the expiry date
            $expiryDate = \Carbon\Carbon::parse($person->date_of_approval)->addDays($person->validity)->format('d/m/Y');
            // check if the expiry date is the same as today
            $expiryReached = $expiryDate == $today ? true : false;

            // when the expiry is reached, renew its status if its cleared, else leave it the same
            if ($person->status == 'cleared' && $expiryReached) {
                $person->status = 'cleared';
                $person->date_of_approval = date('Y-m-d');
                $person->save();
            }
        }

        $cleared = OrganisationPersonnel::where('organisation_id', $organisation->id)->where('status', 'cleared')->count();
        $rejected = OrganisationPersonnel::where('organisation_id', $organisation->id)->where('status', 'rejected')->count();
        $pending = OrganisationPersonnel::where('organisation_id', $organisation->id)->where('status', 'pending')->count();
        $submitted = OrganisationPersonnel::where('organisation_id', $organisation->id)->count();

        if (auth()->user()->role_id == Role::IS_ORG && $organisation->total_no_of_workers == 0) {
            return view('organisation.addWorkers', ['organisation' => $organisation]);
        } else {
            $personnel = OrganisationPersonnel::where('organisation_id', $organisation->id)->get();
            return view(
                'organisation.orgpersonnel',
                [
                    'personnel' => $personnel,
                    'organisation' => $organisation,
                    'cleared' => $cleared,
                    'rejected' => $rejected,
                    'submitted' => $submitted,
                    'pending' => $pending,
                ]
            );
        }
    }

    /**
     * delete the organisation credentials as well as the organisation records
     */
    public function deleteOrganisation(Request $request, Organisation $organisation)
    {
        $credentials = User::where('email', $organisation->email)->first();
        $credentials->delete();
        $organisation->delete();

        return redirect()->route('org.dashboard');
    }

    public function exportCsv(Request $request)
    {
        $fileName = 'org.csv';
        $allOrganisations = Organisation::orderBy('category', 'asc')->get();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Organisation', 'Category', 'Cleared', 'Rejected', 'Pending', 'Total Applications');

        $callback = function () use ($allOrganisations, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($allOrganisations as $organisation) {
                $row['Organisation'] = $organisation->entity;
                $row['Category'] = $organisation->category;
                $row['Cleared'] = OrganisationPersonnel::where('organisation_id', $organisation->id)->where('status', 'cleared')->count();
                $row['Rejected'] = OrganisationPersonnel::where('organisation_id', $organisation->id)->where('status', 'rejected')->count();
                $row['Pending'] = OrganisationPersonnel::where('organisation_id', $organisation->id)->where('status', 'pending')->count();
                $row['Total Applications'] = OrganisationPersonnel::where('organisation_id', $organisation->id)->count();

                fputcsv($file, array($row['Organisation'], $row['Category'], $row['Cleared'], $row['Rejected'], $row['Pending'], $row['Total Applications']));
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
