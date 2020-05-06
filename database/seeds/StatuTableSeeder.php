<?php

use App\Statu;
use Illuminate\Database\Seeder;

class StatuTableSeeder extends Seeder
{
    public function data()
    {
        $array = array(
            'Activa',
            'Cancelada',
            'Finalizada',          
        );

        return $array;
    }
    
    public function run()
    {
        $data = self::data();

        foreach ($data as $value) {
            Statu::create([
                'name' => $value
            ]);
        }
    }
}
