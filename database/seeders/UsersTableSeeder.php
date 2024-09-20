<?php

    namespace Database\Seeders;

    use App\Models\User;
//    use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    use Illuminate\Database\Seeder;

    class UsersTableSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         */
        public function run(): void
        {
            User::factory()->create([
                'name' => 'Jan Willem',
                'email' => 'janwillem@deblauwezeilen.nl',
                'address' => 'Zuidplein 1, 3000 DR Leuven',
                'phone' => '0612345678'
            ])->assignRole('Super Admin');

            User::factory()->create([
                'name' => 'Debbie Zwaluw',
                'email' => 'debbiezwaluw@deblauwezeilen.nl',
                'address' => 'Zuidplein 44, 3000 DR Leuven',
                'phone' => '0687654321'
            ])->assignRole('Administrator');

            User::factory()->create([
                'name' => 'Henk Raadsel',
                'email' => 'henkraadsel@deblauwezeilen.nl',
                'address' => 'WoelehZebbie 2, 8999 LA Mars',
                'phone' => '0677777777'
            ])->assignRole('Instructor');

            User::factory()->create([
                'name' => 'Jara Mans',
                'email' => 'jaramans@gmail.nl',
                'address' => 'Heereweg 34A, 1871 EJ Noord Holland',
                'phone' => '0644553876'
            ])->assignRole('Student');

            User::factory(249)->create()->each(function($user) {
                $user->assignRole('Student');
            });
        }
    }
