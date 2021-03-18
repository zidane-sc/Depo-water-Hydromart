<?php

use Illuminate\Database\Seeder;

class SensorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         
        // $tstamp = now();
            $tstamp = date('Y-m-d H:i:s');
        
            $tstamp = date('Y-m-d H:i:s');
            $ph = [
                'id' => '1',
                'sensor_name' => 'ph',
                'sensor_display' => 'pH',
                'sensor_status' => 1,
                'unit' => 'pH',
                'created_at' => $tstamp,
            ];

            $tss = [
                'id' => '2',
                'sensor_name' => 'tss',
                'sensor_display' => 'TSS',
                'sensor_status' => 1,
                'unit' => 'mg/l',
                'created_at' => $tstamp,
            ];

            $amonia = [
                'id' => '3',
                'sensor_name' => 'amonia',
                'sensor_display' => 'Amonia',
                'sensor_status' => 1,
                'unit' => 'mg/l',
                'created_at' => $tstamp,
            ];

            $cod = [
                'id' => '4',
                'sensor_name' => 'cod',
                'sensor_display' => 'COD',
                'sensor_status' => 1,
                'unit' => 'mg/l',
                'created_at' => $tstamp,
            ];

            $flowMeter = [
                'id' => '5',
                'sensor_name' => 'flow_meter',
            'sensor_display' => 'Flow Meter',
                'sensor_status' => 1,
                'unit' => 'm3/h',
                'created_at' => $tstamp,
            ];
            DB::table('sensors')->insert($ph);
            DB::table('sensors')->insert($tss);
            DB::table('sensors')->insert($amonia);
            DB::table('sensors')->insert($cod);
            DB::table('sensors')->insert($flowMeter);
     
        
    }

}
