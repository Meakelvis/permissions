<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use Illuminate\Http\Request;

class OrgCategoriesController extends Controller
{
    /**
     * ALl organisations grouped into their categories
     */

    public function government()
    {
        $organisations = Organisation::where('category', 'Government')->get();

        return view('categories.government', ['organisations' => $organisations]);
    }

    public function media()
    {
        $organisations = Organisation::where('category', 'Media')->get();

        return view('categories.media', ['organisations' => $organisations]);
    }

    public function utilities()
    {
        $organisations = Organisation::where('category', 'Utilities')->get();

        return view('categories.utilities', ['organisations' => $organisations]);
    }

    public function manufacturing()
    {
        $organisations = Organisation::where('category', 'Manufacturing')->get();

        return view('categories.manufacturing', ['organisations' => $organisations]);
    }

    public function medical()
    {
        $organisations = Organisation::where('category', 'Medical')->get();

        return view('categories.medical', ['organisations' => $organisations]);
    }

    public function telecom()
    {
        $organisations = Organisation::where('category', 'Telecom')->get();

        return view('categories.telecom', ['organisations' => $organisations]);
    }

    public function construction()
    {
        $organisations = Organisation::where('category', 'Construction')->get();

        return view('categories.construction', ['organisations' => $organisations]);
    }

    public function foodProcessors()
    {
        $organisations = Organisation::where('category', 'Food Processors')->get();

        return view('categories.foodProcessors', ['organisations' => $organisations]);
    }

    public function agriculture()
    {
        $organisations = Organisation::where('category', 'Agriculture')->get();

        return view('categories.agriculture', ['organisations' => $organisations]);
    }

    public function fuelStations()
    {
        $organisations = Organisation::where('category', 'Fuel Stations')->get();

        return view('categories.fuelStations', ['organisations' => $organisations]);
    }

    public function privateSecurity()
    {
        $organisations = Organisation::where('category', 'Private Security')->get();

        return view('categories.privateSecurity', ['organisations' => $organisations]);
    }

    public function deliveryServices()
    {
        $organisations = Organisation::where('category', 'Delivery Services')->get();

        return view('categories.deliveryServices', ['organisations' => $organisations]);
    }

    public function financialInstitutions()
    {
        $organisations = Organisation::where('category', 'Financial Institutions')->get();

        return view('categories.financialInstitutions', ['organisations' => $organisations]);
    }

    public function emergencyServices()
    {
        $organisations = Organisation::where('category', 'Emergency Services')->get();

        return view('categories.emergencyServices', ['organisations' => $organisations]);
    }

    public function airlineOperators()
    {
        $organisations = Organisation::where('category', 'Airline Operators')->get();

        return view('categories.airlineOperators', ['organisations' => $organisations]);
    }

    public function restaurants()
    {
        $organisations = Organisation::where('category', 'Restaurants')->get();

        return view('categories.restaurants', ['organisations' => $organisations]);
    }

    public function hotels()
    {
        $organisations = Organisation::where('category', 'Hotels')->get();

        return view('categories.hotels', ['organisations' => $organisations]);
    }

    public function cleaning()
    {
        $organisations = Organisation::where('category', 'Cleaning and Garbage Services')->get();

        return view('categories.cleaning', ['organisations' => $organisations]);
    }

    public function tours()
    {
        $organisations = Organisation::where('category', 'Tours and Travel')->get();

        return view('categories.tours', ['organisations' => $organisations]);
    }

    public function supermarkets()
    {
        $organisations = Organisation::where('category', 'Supermarkets')->get();

        return view('categories.supermarkets', ['organisations' => $organisations]);
    }

    public function garages()
    {
        $organisations = Organisation::where('category', 'Garages')->get();

        return view('categories.garages', ['organisations' => $organisations]);
    }

    public function insurance()
    {
        $organisations = Organisation::where('category', 'Insurance')->get();

        return view('categories.insurance', ['organisations' => $organisations]);
    }

    public function clearingAgents()
    {
        $organisations = Organisation::where('category', 'Clearing Agents')->get();

        return view('categories.clearingAgents', ['organisations' => $organisations]);
    }

    public function educationServices()
    {
        $organisations = Organisation::where('category', 'Education Services')->get();

        return view('categories.educationServices', ['organisations' => $organisations]);
    }

    public function ngos()
    {
        $organisations = Organisation::where('category', 'NGOs(Non-Government Organisation)')->get();

        return view('categories.ngos', ['organisations' => $organisations]);
    }
}
