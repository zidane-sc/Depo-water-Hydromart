<?php

namespace App\Http\Controllers;
use App\Log;
use Illuminate\Http\Request;
use App\Exports\LogsExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class BackupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('privilege:DatabaseBackup', ['only' => 'backup']);
        // $this->middleware('privilege:DatabaseReset', ['only' => 'reset']);
    }

    public function backup(Request $request)
    {
        if($request->type == 'CSV'){
            return Excel::download(new LogsExport($request->date_from, $request->date_to), "backup_logs_{$request->date_from}_{$request->date_to}.csv");
        }elseif($request->type == 'EXCEL'){
            return Excel::download(new LogsExport($request->date_from, $request->date_to), "backup_logs_{$request->date_from}_{$request->date_to}.xlsx");
        }elseif($request->type == 'PDF'){
            $backup = Log::where('tstamp', '>=', $request->date_from . ' 00:00:00')->where('tstamp', '<=', $request->date_to . ' 23:59:59')->get();
            $pdf = PDF::loadView('pdf.database', ['backup'=> $backup])->setPaper('letter', 'landscape');
            return $pdf->download("backup_logs_{$request->date_from}_{$request->date_to}.pdf");
        }
    }

    public function reset()
    {
        try {
            $device = Log::truncate();
            return response()->json(['status' => '200', 'msg' => 'success']);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => '403', 'msg' => $th->getMessage()]);
        }
    }
}
