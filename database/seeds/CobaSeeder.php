<?php

use Illuminate\Database\Seeder;

class CobaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
    	// insert data ke table
        DB::table('coba')->insert([
        	'nama' => 'Joni'
        ]);

    }
}
