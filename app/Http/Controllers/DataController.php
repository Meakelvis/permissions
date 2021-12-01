<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Data;
use App\Models\Occupant;
use Illuminate\Support\Facades\Hash;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use PDF;

class DataController extends Controller
{
    public function index()
    {
        $data = Data::orderBy('created_at', 'desc')->get();

        // display form to enter the data
        return view('data.index', ['data' => $data]);
    }

    public function cleared()
    {
        $cleared = Data::where('status', 'cleared')->orderBy('created_at', 'desc')->get();

        return view('data.cleared', ['cleared' => $cleared]);
    }

    public function rejected()
    {
        $rejected = Data::where('status', 'rejected')->orderBy('created_at', 'desc')->get();

        return view('data.rejected', ['rejected' => $rejected]);
    }

    public function pending()
    {
        $pending = Data::where('status', 'pending')->orderBy('created_at', 'desc')->get();

        return view('data.pending', ['pending' => $pending]);
    }

    public function add()
    {
        return view('data.add');
    }

    public function store(Request $request)
    {
        // validate user input
        $this->validate($request, [
            'applicant_name' => 'required',
            'title' => 'required',
            'date' => 'required',
            'address' => 'required',
            'purpose' => 'required|in:Burial,Farmer,Medical,Contractor,Government',
            'from' => 'required',
            'to' => 'required',
            'valid_from' => 'required',
            'valid_to' => 'required',
        ]);

        // store data to db
        Data::create([
            'applicant_name' => $request->applicant_name,
            'title' => $request->title,
            'date_of_application' => $request->date,
            'address' => $request->address,
            'purpose_of_travel' => $request->purpose,
            'no_of_vehicles' => 2,
            'from' => $request->from,
            'to' => $request->to,
            'valid_from' => $request->valid_from,
            'valid_to' => $request->valid_to,
            'user_id' => auth()->user()->id,
            'status' => 'pending', // set application status to pending on creation
        ]);

        // $qrcode = QrCode::size(250)->generate($request->applicant_name);

        // retrieve the most recent application from the db
        $data = Data::orderBy('created_at', 'desc')->first();

        // to the results page to preview the data
        return redirect()->route('data.results', [$data])->with('success', 'New Application Created');
    }

    public function preview(Data $data)
    {
        // dd($data->applicant_name);
        // get occupant data based on the applicant name
        $occupants = Occupant::where('applicant_name', $data->applicant_name)->orderBy('created_at', 'desc')->get();
        // dd($occupants);

        return view('data.results', ['data' => $data, 'occupants' => $occupants]);
    }

    public function generatePDF(Data $data)
    {
        $occupants = Occupant::where('applicant_name', $data->applicant_name)->orderBy('created_at', 'desc')->get();
        $valid_from = \Carbon\Carbon::parse($data->valid_from);
        $valid_to = \Carbon\Carbon::parse($data->valid_to);
        $validity = $valid_from->diffInDays($valid_to, false);

        // share data to view
        view()->share('data', $data);
        view()->share('occupants', $occupants);
        view()->share('validity', $validity);
        // view()->share(['data' => $data, 'occupants' => $occupants]);
        $pdf = PDF::loadView('data.pdfView', [$data, $occupants]);
        // $pdf = PDF::loadHTML('<h1>Test</h1>');

        // download PDF file with download method
        // return $pdf->setPaper('a4', 'potrait')->download('application.pdf');
        // preview pdf before downloading it
        return $pdf->stream();
    }

    public function approveApplication(Request $request, Data $data)
    {
        $data->status = 'cleared';
        $data->save();

        return redirect()->route('special.index');
    }

    public function rejectApplication(Request $request, Data $data)
    {
        $data->status = 'rejected';
        $data->save();

        return redirect()->route('special.index');
    }
}
