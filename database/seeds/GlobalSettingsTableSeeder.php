<?php

use Illuminate\Database\Seeder;

class GlobalSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gs = [
            'id' => '1',
            'websocket_host' => 'http://localhost',
            'websocket_port' => '1010',
            'websocket_pool_interval' => 1000,
            'db_host' => 'http://localhost',
            'db_log_interval' => 60,
        ];
        DB::table('global_settings')->insert($gs);
    }
}
