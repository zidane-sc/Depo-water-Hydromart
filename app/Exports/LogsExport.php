<?php

namespace App\Exports;

use App\Log;
use App\LogValue;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DateTime;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class LogsExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    private $date_from;
    private $date_to;
    function __construct($dateFrom, $dateTo)
    {
        $this->date_from = $dateFrom;
        $this->date_to = $dateTo;
    }

    public function view(): View
    {
        $tags = [ 'ultrasonic_sensor11', 'ultrasonic_sensor12', 'liter_permenit1', 'flow_litre1'];
        $jsecond = '00';
        $jminute = '00';
        $jhour   = '00';
        $date_now = $this->date_from . ' ' . $jhour . ':' . $jminute . ':' . $jsecond;
        $dateSelectAfter = new DateTime($date_now);
        $date_from = $dateSelectAfter->modify('-1 days')->format('Y-m-d H:i:s');
        $date_to = $dateSelectAfter->modify('+1 days')->format('Y-m-d H:i:s');

        foreach ($tags as $tag) {
            $dataLogs[$tag] = DB::table('log_values')
                    ->select(DB::raw("
                        created_at AS datetime,
                        tag_name,
                        value
                    "))
                    ->where("tag_name", $tag)
                    ->whereBetween('created_at', [$date_from, $date_to])
                    ->limit(100000)
                    ->get();
        }

        return view('exports.log_values', [
            'data' => $dataLogs
        ]);
    }

    public function collection()
    {
        
        // $backup = LogValue::whereBetween('created_at', [$date_from, $date_to])->limit(100000)->get();
        $backup = LogValue::whereBetween('created_at', [$date_from, $date_to])->limit(10)->get();
        return $backup;
    }
    public function headings(): array
    {
        return ["adwadadwad", "device_name", "tag_name", "id", "project_id", "value", "created_at", "updated_at", "updated_at"];
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }
}
