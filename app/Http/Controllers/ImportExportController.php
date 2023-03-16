<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Exports\ExportUsers;
use App\Imports\ImportUsers;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use PDF;

class ImportExportController extends Controller
{
    public function index(Request $request)
    {
        $title = "Import Export";

        return view('import', compact('title'));
    }
    public function import(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required',
        ]);
        
        if ($validator->fails()) {
            toastr()->error(json_encode($validator->errors()->all()));
            return Redirect::to(route('import.export'));
        }

        Excel::import(new ImportUsers, request()->file('file'));

        toastr()->success('You have successfully Upload File');
        return redirect(route('import.export'));
    }
    public function export(Request $request)
    {
        return Excel::download(new ExportUsers, 'users.xlsx');
    }

    public function pdf(Request $request)
    {
        $pdf = PDF::loadView(new ExportUsers, 'users.pdf');

        return $pdf->download('techsolutionstuff.pdf');
    }

}
