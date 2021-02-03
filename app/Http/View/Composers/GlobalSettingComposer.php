<?php

namespace App\Http\View\Composers;

use App\GlobalSetting;
use Illuminate\View\View;

class GlobalSettingComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $global_setting;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(GlobalSetting $global_setting)
    {
        // Dependencies automatically resolved by service container...
        $this->global_setting = $global_setting;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $lastData = \App\GlobalSetting::orderBy('id', 'desc')->first();
        $global_setting = (object) array(
            'id' => isset($lastData->id) ? $lastData->id : 0,
            'host_ip' => isset($lastData->host_ip) ? $lastData->host_ip : null,
            'websocket_host' => isset($lastData->websocket_host) ? $lastData->websocket_host : null,
            'websocket_port' => isset($lastData->websocket_host) ? $lastData->websocket_port : null,
            'websocket_pool_interval' => isset($lastData->websocket_pool_interval) ? $lastData->websocket_pool_interval : null,
            'path_backup' => isset($lastData->path_backup) ? $lastData->path_backup : null,
            'plant_name' => isset($lastData->plant_name) ? $lastData->plant_name : null,
            'location' => isset($lastData->location) ? $lastData->location : null,
            'logo' => isset($lastData->logo) ? $lastData->logo : null,
            'db_log_interval' => isset($lastData->db_log_interval) ? $lastData->db_log_interval : null,

            'schedule_second' => isset($lastData->schedule_second) ? $lastData->schedule_second : null,
            'schedule_minute' => isset($lastData->schedule_minute) ? $lastData->schedule_minute : null,
            'schedule_hour' => isset($lastData->schedule_hour) ? $lastData->schedule_hour : null,
            'schedule_day_of_month' => isset($lastData->schedule_day_of_month) ? $lastData->schedule_day_of_month : null,
            'schedule_month' => isset($lastData->schedule_month) ? $lastData->schedule_month : null,
            'schedule_day_of_week' => isset($lastData->schedule_day_of_week) ? $lastData->schedule_day_of_week : null,

        );
        $view->with('global_setting', $global_setting);
    }
}
