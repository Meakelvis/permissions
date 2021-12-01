<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;
use App\Models\Mda;
use App\Models\MdaPersonnel;

class MdasController extends Controller
{
    public function index()
    {
        $mdas = Mda::orderBy('created_at', 'desc')->get();
        return view('mda.index', ['mdas' => $mdas]);
    }

    public function add()
    {
        return view('mda.addMda');
    }

    public function store(Request $request)
    {
        // dd($request->category);

        $this->validate($request, [
            "entity" => "required",
            "category" => "required",
            "applicant_on_behalf" => "required",
            "title" => "required",
            "phone" => "required",
            "address" => "required",
            "purpose" => "required",
            "no_of_workers" => "required",
        ]);

        Mda::create([
            "entity" => $request->entity,
            "category" => $request->category,
            "title" => $request->title,
            "applicant_on_behalf" => $request->applicant_on_behalf,
            "phone" => $request->phone,
            "address" => $request->address,
            "purpose" => $request->purpose,
            "no_of_workers" => $request->no_of_workers,
        ]);

        $mda = Mda::orderBy('created_at', 'desc')->first();

        return redirect()->route('mda.mdaPersonnel', [$mda])->with('success', 'Organisation Added');
    }

    public function addMdaPersonnel(Mda $mda)
    {
        // dd($mda->purpose);
        return view('mda.mdaPersonnel', ['mda' => $mda]);
    }

    public function storeMdaPersonnel(Request $request)
    {
        // get data from request
        $data = $request->all();
        // add data to db
        MdaPersonnel::create([
            'mda_id' => $request->mda_id,
            'name' => $request->name,
            'title' => $request->title,
            'vehicle_no' => $request->vehicle_no,
            'nin' => $request->nin,
        ]);

        $responseData = [
            'mda_id' =>  $data['mda_id'],
            'name' =>  $data['name'],
            'title' =>  $data['title'],
            'vehicle_no' =>  $data['vehicle_no'],
            'nin' =>  $data['nin'],
            'message' => 'Personnel added successfully'
        ];
        // return success message with status code 200
        return response()->json($responseData, 200);
    }

    public function getMdaPersonnel(Request $request)
    {
        $personnel = MdaPersonnel::where('mda_id', $request->mda_id)->orderBy('created_at', 'desc')->get();

        return response()->json($personnel, 200);
    }

    public function displayMdaPersonnel(Mda $mda)
    {
        $mdas = MdaPersonnel::where('mda_id', $mda->id)->orderBy('created_at', 'desc')->get();
        return view('mda.mdaPreview', ['mdas' => $mdas]);
    }

    public function personnelPreview(MdaPersonnel $mdaPersonnel)
    {
        // $mda = MdaPersonnel::where('id', $mdaPersonnel->id);

        return view('mda.mdaPersonnelPreview', ['mdaPersonnel' => $mdaPersonnel]);
    }

    public function generatePDF(MdaPersonnel $mdaPersonnel)
    {
        // $mda = MdaPersonnel::where('id', $mdaPersonnel->id);
        // view()->share('mda', $mda);
        $pdf = PDF::loadView('mda.mdaPdf', [$mdaPersonnel]);
        // $pdf = PDF::loadHTML('<h1>Test</h1>');

        // download PDF file with download method
        // return $pdf->setPaper('a4', 'potrait')->download('application.pdf');
        // preview pdf before downloading it
        return $pdf->stream();
    }


    public function results()
    {
        // return view('mda.results', ['data' => $data]);
    }
}
