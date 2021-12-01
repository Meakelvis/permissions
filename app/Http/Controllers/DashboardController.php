<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Data;
use App\Models\Organisation;
use App\Models\OrganisationPersonnel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        if (!Gate::any(['can-revert', 'add-organisation', 'can-approve'])) {
            return redirect()->route('org.dashboard');
        } else {
            $people = OrganisationPersonnel::all();
            $today = Carbon::today();

            foreach ($people as $person) {
                // addition of the date of approval plus validity period to get the expiry date
                $expiryDate = Carbon::parse($person->date_of_approval)->addDays($person->validity);
                // check if the expiry date is the same as today
                // $expiryReached = $expiryDate == $today ? true : false;
                $expiryReached = $expiryDate->equalTo($today);

                // when the expiry is reached, renew its status if its cleared, else leave it the same
                if ($person->status == 'cleared' && $expiryDate->equalTo($today)) {
                    $person->status = 'cleared';
                    $person->date_of_approval = date('Y-m-d');
                    $person->save();
                }
            }

            // status statistics
            $cleared = OrganisationPersonnel::where('status', 'cleared')->count();
            $rejected = OrganisationPersonnel::where('status', 'rejected')->count();
            $pending = OrganisationPersonnel::where('status', 'pending')->count();
            $total = OrganisationPersonnel::all()->count();

            // category statistics
            $government = Organisation::where('category', 'Government')->count();
            $media = Organisation::where('category', 'Media')->count();
            $utilities = Organisation::where('category', 'Utilities')->count();
            $manufacturing = Organisation::where('category', 'Manufacturing')->count();
            $medical = Organisation::where('category', 'Medical')->count();
            $telecom = Organisation::where('category', 'Telecom')->count();
            $construction = Organisation::where('category', 'Construction')->count();
            $foodProcessors = Organisation::where('category', 'Food Processors')->count();
            $agriculture = Organisation::where('category', 'Agriculture')->count();
            $fuelStations = Organisation::where('category', 'Fuel Stations')->count();
            $privateSecurity = Organisation::where('category', 'Private Security')->count();
            $deliveryServices = Organisation::where('category', 'Delivery Services')->count();
            $financialInstitutions = Organisation::where('category', 'Financial Institutions')->count();
            $emergencyServices = Organisation::where('category', 'Emergency Services')->count();
            $airlineOperators = Organisation::where('category', 'Airline Operators')->count();
            $restaurants = Organisation::where('category', 'Restaurants')->count();
            $hotels = Organisation::where('category', 'Hotels')->count();
            $cleaning = Organisation::where('category', 'Cleaning and Garbage Services')->count();
            $tours = Organisation::where('category', 'Tours and Travel')->count();
            $supermarkets = Organisation::where('category', 'Supermarkets')->count();
            $garages = Organisation::where('category', 'Garages')->count();
            $insurance = Organisation::where('category', 'Insurance')->count();
            $clearingAgents = Organisation::where('category', 'Clearing Agents')->count();
            $educationServices = Organisation::where('category', 'Education Services')->count();
            $ngos = Organisation::where('category', 'NGOs(Non-Government Organisation)')->count();

            return view(
                'dashboard.admin',
                [
                    'cleared' => $cleared,
                    'rejected' => $rejected,
                    'pending' => $pending,
                    'total' => $total,
                    'government' => $government,
                    'media' => $media,
                    'utilities' => $utilities,
                    'manufacturing' => $manufacturing,
                    'medical' => $medical,
                    'telecom' => $telecom,
                    'construction' => $construction,
                    'foodProcessors' => $foodProcessors,
                    'agriculture' => $agriculture,
                    'fuelStations' => $fuelStations,
                    'privateSecurity' => $privateSecurity,
                    'deliveryServices' => $deliveryServices,
                    'financialInstitutions' => $financialInstitutions,
                    'emergencyServices' => $emergencyServices,
                    'airlineOperators' => $airlineOperators,
                    'restaurants' => $restaurants,
                    'hotels' => $hotels,
                    'cleaning' => $cleaning,
                    'tours' => $tours,
                    'supermarkets' => $supermarkets,
                    'garages' => $garages,
                    'insurance' => $insurance,
                    'clearingAgents' => $clearingAgents,
                    'educationServices' => $educationServices,
                    'ngos' => $ngos,
                ]
            );
        }
    }
}
