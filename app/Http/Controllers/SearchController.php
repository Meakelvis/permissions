<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\OrganisationPersonnel;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $results = OrganisationPersonnel::where('vehicle_no', strtoupper(str_replace(' ', '', $request->search)))->get()->first();

        if (!$results) {
            return back()->with('error', 'Sorry, the number plate does not exist');
        } else {
            return redirect()->route('results', $results);
        }
    }
}
