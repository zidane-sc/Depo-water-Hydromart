<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LogsExport;

class DbBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:backup';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will backup the database';
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->process = new Process(sprintf(
            'PGPASSWORD="%s" pg_dump -U %s -h localhost %s >> %s',
            env('DB_PASSWORD'),
            env('DB_USERNAME'),
            env('DB_DATABASE'),
            storage_path(sprintf('app/backups/backup_%s.sql', now()->format('Ymd')))
        ));
    }
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // try {
        //     $this->info('The backup has been started');
        //     $this->process->mustRun();
        //     $this->info('The backup has been proceed successfully.');
        // } catch (ProcessFailedException $exception) {
        //     logger()->error('Backup exception', compact('exception'));
        //     $this->error('The backup process has been failed.'. $exception->getMessage());
        // }

        // return Excel::create(new LogsExport(date('Y-m-d'), date('Y-m-d')), "backup_logs_{date('Y-m-d')}_{date('Y-m-d')}.csv")
        //     ->store('xls', storage_path('excel/exports'));
        // config(['backup_luar' => [
        //     'driver' => 'local',
        //     'root' =>'D:',
        // ]]);
        $this->addNewDisk('new_random');
        return Excel::store(new LogsExport(date('Y-m-d'), date('Y-m-d')), "backup_logs_" . date('Y_m_d_H_i_s') . ".xlsx", 'new_random');
    }

    private function addNewDisk(string $diskName)
    {
        $lastData = \App\GlobalSetting::orderBy('id', 'desc')->first();
        // Config::set('filesystems.disks', $config);

        if ($lastData->path_backup == null) {
            $storage = storage_path('app/backup_csv');
        } else {
            $storage = $lastData->path_backup;
        }
        config(['filesystems.disks.' . $diskName => [
            'driver' => 'local',
            'root' =>  $storage,
        ]]);
    }
}
