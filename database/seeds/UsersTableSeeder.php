<?php

use Illuminate\Database\Seeder;
use App\User;


class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        
        DB::statement("SET foreign_key_checks = 0");
        DB::table('users')->truncate();
        DB::statement("SET foreign_key_checks = 1");
        
        
        // Create company users
        User::create([
                    'first_name' => 'Dan',
                    'last_name' => 'Emery',
                    'email' => 'dan@e3creative.co.uk',
                    'password' => 'testtest',
                    'phone' => '01612234456',
                    'address_line1' => '23 Cool street'
        ]);
    }
    
    

}
