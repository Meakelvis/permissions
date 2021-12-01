<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Occupant;

class OccupantsController extends Controller
{
    public function getOccupants(Request $request)
    {
        // get the most recent record whose applicant name is sent in the request
        $occupant = Occupant::where('applicant_name', $request->applicantName)->orderBy('created_at', 'desc')->get();
        // $occupant = Occupant::where('applicant_name', $request->applicantName)->orderBy('created_at', 'desc')->first();
        // return record as response
        return response()->json($occupant, 200);
    }

    public function add(Request $request)
    {
        // get data from request
        $data = $request->all();
        // add data to db
        Occupant::create([
            'applicant_name' => $request->applicantName,
            'occupant_name' => $request->occupantName,
            'motor_vehicle_no' => $request->motorVehicleNo,
            'driver_name' => $request->driverName,
        ]);

        $responseData = [
            'applicant_name' => $data['applicantName'],
            'occupant_name' => $data['occupantName'],
            'motor_vehicle_no' => $data['motorVehicleNo'],
            'driver_name' => $data['driverName'],
            'message' => 'Occupant added successfully'
        ];
        // return success message with status code 200
        return response()->json($responseData, 200);
    }
}
