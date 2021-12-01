<?php

namespace App\Http\Controllers;

use App\Models\OrganisationPersonnel;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class ActionsController extends Controller
{
    public function actions()
    {
        if (!Gate::any(['can-revert', 'add-organisation', 'can-approve'])) {
            return redirect()->route('org.dashboard');
        }

        return view('actions');
    }

    // deletes all motorcycles in the db
    public function deleteAllMotorcycles(Request $request)
    {
        $motorCycles = OrganisationPersonnel::where('type_of_vehicle', 'Motor cycle')->get();

        foreach ($motorCycles as $vehicle) {
            $vehicle->delete();
        }

        return back();
    }
}
