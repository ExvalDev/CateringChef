<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $allergenes = ["Milch", "Weizen", "Krebstiere", "Eier", "Fisch", "Erdnuesse", "Soja", "Schalenobst", "Sellerie", "Senf", "Sesamsamen", "Schwefeldioxide und Sulfide", "Lupinen"];
        
        foreach($allergenes as $allergene)
        {
            DB::table('allergenes')->insert([
                'name' => $allergene,
            ]);
        }

        for($i = 1; $i <= 30; $i++)
        {
            DB::table('suppliers')->insert([
                'name' => 'Lieferant '.$i,
                'postcode' => rand(10000,99999),
                'place' => 'Place'.$i,
                'street' => 'Street',
                'house_number' => rand(1,100),
            ]);
        } 


        for($i = 1; $i <= 30; $i++)
        {
            DB::table('ingredients')->insert([
                'name' => 'Zutat '.$i,
                'supplier_id' => rand(0, 29),
                'unit' => Str::random(10),
            ]);
            
            $count = (rand(0,4));

            for($j = 1; $j <= $count; $j++)
            {
                DB::table('allergene_ingredient')->insert([
                    'ingredient_id' => $i,
                    'allergene_id' => (rand(1,13)),
                ]);
            }
        }

        DB::table('users')->insert([
            'firstname' => 'admin',
            'surname' => 'admin',
            'email' => 'admin@admin.de',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);
        
        factory(App\User::class, 50)->create();
    }
}
