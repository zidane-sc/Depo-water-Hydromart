<?php

namespace App\Exports;

use App\Log;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DateTime;

class LogsExport implements FromCollection, WithCustomCsvSettings, WithHeadings
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
    public function collection()
    {
        $lastData = \App\GlobalSetting::orderBy('id', 'desc')->first();
        $jsecond = $lastData->schedule_second ?: '00';
        $jminute = $lastData->schedule_minute ?: '00';
        $jhour   = $lastData->schedule_hour ?: '00';
        $date_now = $this->date_from . ' ' . $jhour . ':' . $jminute . ':' . $jsecond;
        $dateSelectAfter = new DateTime($date_now);
        $date_from = $dateSelectAfter->modify('-1 days')->format('Y-m-d H:i:s');
        $date_to = $dateSelectAfter->modify('+1 days')->format('Y-m-d H:i:s');
        $backup = Log::where('tstamp', '>=', $date_from)->where('tstamp', '<=', $date_to)->get();
        return $backup;
    }
    public function headings(): array
    {
        return ["id", "tstamp", "ph", "tss", "amonia", "cod", "flow_meter", "controller_name"];
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }
}
