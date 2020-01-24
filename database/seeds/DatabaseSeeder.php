<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Factories
        factory(App\User::class, 50)->create();
        factory(App\Supplier::class, 15)->create();
        factory(App\Customer::class, 20)->create();

        //Create Allergene
        $allergenes = ["Milch", "Weizen", "Krebstiere", "Eier", "Fisch", "Erdnuesse", "Soja", "Schalenobst", "Sellerie", "Senf", "Sesamsamen", "Schwefeldioxide und Sulfide", "Lupinen"];
        
        foreach($allergenes as $allergene)
        {
            DB::table('allergenes')->insert([
                'name' => $allergene,
            ]);
        }

        //Create DB Unit
        $db_units = ['g', 'ml', 'Stück'];

        foreach($db_units as $db_unit)
        {
            DB::table('db_units')->insert([
                'name' => $db_unit,
            ]);
        }

        //Create Show Unit
        $show_units = [['g', 'g' ,1], ['Kg', 'g', 1000], ['ml', 'ml', 1], ['L', 'ml', 1000], ['Stück', 'Stück', 1]];

        foreach($show_units as $show_unit)
        {
            DB::table('show_units')->insert([
                'name' => $show_unit[0],
                'db_unit_id' => DB::table('db_units')->where('name', $show_unit[1])->value('id'),
                'factor' => $show_unit[2],
            ]);
        }


        //Create Ingredient
        for($i = 1; $i <= 200; $i++)
        {
            DB::table('ingredients')->insert([
                'name' => 'Zutat '.$i,
                'supplier_id' => rand(1, 15),
                'db_unit_id' => (rand(1,3)),
            ]);
            
            $count = (rand(0,4));

            for($j = 1; $j <= $count; $j++)
            {
                DB::table('allergenes_ingredients')->insert([
                    'ingredient_id' => $i,
                    'allergene_id' => (rand(1,13)),
                ]);
            }
        }

        //Create Component
        for($i = 1; $i <= 100; $i++)
        {
            DB::table('components')->insert([
                'name' => 'Komponent '.$i,
                'amount' => (rand(100,200)),
                'recipe' => 'Rezept '.$i,
                'db_unit_id' => (rand(1,3)),
            ]);
            
            $count = (rand(4,7));

            for($j = 1; $j <= $count; $j++)
            {
                DB::table('components_ingredients')->insert([
                    'component_id' => $i,
                    'ingredient_id' => (rand(1,30)),
                    'amount' => (rand(100,200)),
                ]);
            }
        }

        //Create Meal
        for($i = 1; $i <= 70; $i++)
        {
            DB::table('meals')->insert([
                'name' => 'Speise '.$i,
                'recipe' => 'Rezept '.$i,
            ]);
            
            $count = (rand(4,7));

            for($j = 1; $j <= $count; $j++)
            {
                DB::table('components_meals')->insert([
                    'meal_id' => $i,
                    'component_id' => (rand(1,30)),
                    'amount' => (rand(100,200)),
                ]);
            }
        }

        /**
         * Method to generate random date between two dates
         * @param $sStartDate
         * @param $sEndDate
         * @param string $sFormat
         * @return bool|string
         */
        function randomDate($sStartDate, $sEndDate, $sFormat = 'Y-m-d H:i:s')
        {
            // Convert the supplied date to timestamp
            $fMin = strtotime($sStartDate);
            $fMax = strtotime($sEndDate);

            // Generate a random number from the start and end dates
            $fVal = mt_rand($fMin, $fMax);

            // Convert back to the specified date format
            return date($sFormat, $fVal);
        }

        //Create Menu
        $count = 1;
        for($i = 13; $i <= 24; $i++)
        {
            DB::table('menus')->insert([
                'row' => 1,
                'date' => '2020-01-'.$i,
            ]);

            DB::table('menus')->insert([
                'row' => 2,
                'date' => '2020-01-'.$i,
            ]);

            DB::table('meals_menus')->insert([
                'meal_id' => rand(1,30),
                'menu_id' => $count,
            ]);
            $count++;

            DB::table('meals_menus')->insert([
                'meal_id' => rand(1,30),
                'menu_id' => $count,
            ]);
            $count++;
        }

        //Create Dev - User
        DB::table('users')->insert([
            'firstname' => 'admin',
            'surname' => 'admin',
            'email' => 'admin@admin.de',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);
    }
}
