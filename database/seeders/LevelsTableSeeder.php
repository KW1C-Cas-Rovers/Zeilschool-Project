<?php

    namespace Database\Seeders;

    use App\Models\Level;
    use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    use Illuminate\Database\Seeder;

    class LevelsTableSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         */
        public function run(): void
        {
            $levels = [
                'beginner',
                'gevorderd',
                'expert',
            ];

            foreach ($levels as $level) {
                Level::create([
                    'name' => $level,
                ]);
            }
        }
    }
