<?php

use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ['id' => '12345',
            'first_name' => 'Super', 
            'last_name' => 'Admin',  
            'date_of_birth' => '24/01/1985', 
            'email' => 'admin@techie.com', 
            'user_type' => 'SuperAdmin', 
            'password' => \Hash::make('password'),
            'created_at' => date('Y-m-d H:i:s', (time())),
            'updated_at' => date('Y-m-d H:i:s', (time()))]
        ]);
    }
}
