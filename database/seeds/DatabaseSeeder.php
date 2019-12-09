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
        
        factory(App\User::class, 50)->create();
    }
}
