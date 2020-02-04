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
        //factory(App\User::class, 50)->create();
        //factory(App\Customer::class, 20)->create();

        //Create Supplier
        $suppliers = [['METRO Neu-Ulm', 89231, 'Neu-Ulm','Borsigstraße',8],['Obstbau Köpf GbR',89174,'Altheim','Bismarckstraße',27],['Metzgerei Mack',89518,'Heidenheim an der Brenz','Griegstraße',1]];
        foreach($suppliers as $supplier)
        {
            DB::table('suppliers')->insert([
                'name' => $supplier[0],
                'postcode' => $supplier[1],
                'place' => $supplier[2],
                'street' => $supplier[3],
                'house_number' => $supplier[4],
            ]);
        }

        //Create Allergene
        $allergenes = ["Milch", "Weizen", "Krebstiere", "Eier", "Fisch", "Erdnüsse", "Soja", "Schalenfrüchte", "Sellerie", "Senf", "Sesamsamen", "Schwefeldioxide und Sulfide", "Lupinen", "Weichtiere"];
        
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
        $ingredients= [['Couscous',1,1], ['Zitronensaft',1,2], ['Wasser(Leitung)',null,2],['Knoblauch',2,1],['Paprika',2,1],['Gurke',2,1],['Tomate',2,1],['Zwiebel',2,1],['Salz',1,1],['Pfeffer',1,1],['Schafskäse',1,1],['Knollensellerie',2,1],['Karotte',2,1],['Olivenöl',1,2],['Tomatenmark',1,1],['Schmand',1,1],['Milch',1,2],['Ei',1,3],['Margarine',1,1],['Suppenknochen vom Rind',1,1],['Suppengrün',1,1],['Petersilie',1,1],['Öl',1,2],['Hackfleisch',3,1],['Passierte Tomaten',1,1],['Oregano',1,1],['Spaghetti',1,1],['Mehl',1,1],['Sahne',1,2],['Emmentaler gerieben',1,1],['Risottoreis',1,1],['Gemüsefond',1,2],['Weißwein',1,2],['Butter',1,1],['Zucker',1,1],['Backpulver',1,1],['Apfel',2,1],['Zimt',1,1],['Puddingpulver Vanille',1,1],['Schlagsahne',1,2],['Erdbeere',2,1],['Sahnesteif',1,1],['Backkakao',1,1],['Schokolade',1,1],['Marshmallows',1,1],['Parmesan',1,1]];
        foreach ($ingredients as $ingredient)
        {
            DB::table('ingredients')->insert([
                'name' => $ingredient[0],
                'supplier_id' => $ingredient[1],
                'db_unit_id' => $ingredient[2],
            ]);
            
        }

        $ingredients_allergenes= [[1,2],[10,10],[11,1],[12,9],[16,1],[17,1],[18,4],[19,1],[21,9],[24,12],[27,4],[27,2],[27,7],[28,2],[29,1],[30,1],[32,9],[33,12],[34,1],[36,12],[40,1],[42,1],[43,6],[44,6],[46,1],];
        foreach ($ingredients_allergenes as $ingredient_allergene)
        {
            DB::table('allergenes_ingredients')->insert([
                'ingredient_id' => $ingredient_allergene[0],
                'allergene_id' => $ingredient_allergene[1],
            ]);
        }

        //Create Component
        $components = [['Couscous',75,'1. Couscous mit Zitronensaft und kochendem Wasser vermischen 2. Ca. 5 Minuten quellen lassen 3. Feingewürfelten Knoblauch mit unterrühren.',1],['Salatgemüse',300,'1. Paprika, Gurke, Tomate und Zwiebeln klein würfeln 2. Schafskäse grob zerkrümeln 3. Mit Salz und Pfeffer würzen',1],['Tomatencremesuppe',400,'1. Gemüse waschen und grob zerkleinern 2. Olivenöl in Topf erhitzen und Gemüse 10 Minuten dünsten 3. Tomatenmark unterrühren, mit Wasser und Schmand ablöschen und bei mittlerer Hitze ca. 30 Minuten köcheln lassen 4. Suppe mit dem Pürierstab pürieren',2],['Mehlklöse',30,'1. Milch, Salz, Pfeffer und Fett zum Kochen bringen. 2. Mehl unter ständigem Rühren zufügen, bis sich der Teig als großer Kloß vom Boden löst. 3. Dann das Ei unterrühren. 4. Mit 2 Teelöffeln kleine Klößchen abstechen und in wenig kochendem Salzwasser 10 Minuten ziehen lassen. 5. Mit der Schaumkelle herausnehmen.',1],['Suppenbrühe(Rind)',300,'1.Suppenknochen mit dem Öl in einem großen Topf auf niedriger Temperatur anbraten. 2. Das geschnittene Gemüse zu den Knochen in den Topf geben und für ca. 5Minuten anrösten Knochen und Gemüse mit Wasser vorischtig ablöschen, feingehackte Petersilie und Salz hinzugeben 3. Zum Kochen bringen',2],
        ['Bolognese-Soße',300,'1. Hackfleisch, Zwiebeln und Knoblauch in Öl leicht anbraten. 2. Passierte Tomaten, Salz, Tomatenmark, Pfeffer und Oregano hinzufügen. 3. Alle Zutaten ca. 10 min. köcheln lassen. ',2],['Spaghetti',125,'1. 1 Liter Wasser zum kochen bringen. 2. Salz hinzufügen. 3. Nudeln hinzufügen und ca. 8 minuten kochen lassen, bis diese aldente sind. 4. Nudeln abgießen',1],['Spätzle',275,'1. Mehl, Eier, Wasser und Salz in eine Schüssel geben und so lange umrühren, bis der Teig Blasen wirft. 2. Wasser kochen. 3. Salz hinzufügen. 4. Mithilfe des Spätzlebretts und dem Schaber die Spätzle in den Topf schaben. 5. Sobald die Spätzle an der Wasseroberfläche schwimmen diese aus dem Wasser sieben. ',1],['Käsemasse',180,'1. Die Zwiebeln glasig anschwitzen und mit Sahne ablöschen. 2. Mit Salz und Pfeffer abschmecken. 3. Käse zugeben',1],['Meeresfrüchterisotto',420,'1. Zwiebel schneiden und in Öl anschwitzen. 2. Risottoreis hinzgeben und glasig anschwitzen. Im Anschluss mit Weißwein ablöschen. 3. Aufkochen lassen und den Reis so lange kochen, bis der Wein  verdampft ist. 4. Gemüsefond zugeben und ca. 10 min kochen lassen. 5. Meeresfrüchte hinzugeben und gesamtes Gericht nochmal 10 min kochen lassen. 6. 15g Parmesan unterrühren und kurz ziehen lassen.',1],['Pfannkuchen',350,'1. Eier, Zucker, Backpulver, Milch und Mehl miteinander vermengen.  2. Öl in der Pfanne erhitzen. 3. Eine Schöpfkelle Teig in die Pfanne geben und auf beiden Seiten goldbraun backen.',1],['Apfelmuß',200,'1. Äpfel schälen und vierteln. 2. Wasser in einem Topf zum Kochen bringen. 3. Äpfel, Zucker und Zimt in den Topf geben und 20 Minuten köcheln lassen. 4. Anschließend Masse pürrieren.',1],
        ['Vanillepudding',140,'1. Puddingpulver mit Zucker vermischen und mit 1 EL von der Milch glatt rühren. 2. Übrige Milch mit Schlagsahne aufkochen. 3. Vom Herd nehmen und das angerührte Pulver mit einem Schneebesen einrühren. Den Pudding unter Rühren mind. 1 Min. kochen. 4. In einer Form auskühlen lassen.',1],['Erdbeersoße',67,'1. Erdbeeren pürieren und mit Sahnesteif verrühren. 2. Kalt stellen. ',1],['Tassenkuchen',330,'1. Alle Zutaten verrühren und in eine Tasse geben.  2. Tasse für zwei bis drei Minuten in die Mikrowelle (800 Watt) stellen. ',1],['Schokoglasur',30,'1. Schokolade schmelzen. ',1]];
        foreach ($components as $component) {
            DB::table('components')->insert([
                'name' => $component[0],
                'amount' => $component[1],
                'recipe' => $component[2],
                'db_unit_id' => $component[3],
            ]);
        
        }
        $component_ingredients = [[1,1,70],[1,2,10],[1,3,200],[1,4,20],[2,5,40],[2,6,40],[2,7,40],[2,8,20],[2,9,5],[2,10,5],[2,11,50],[3,7,150],[3,12,25],[3,13,60],[3,8,50],[3,4,15],[3,14,3],[3,15,10],[3,16,30],[3,3,40],[4,17,20],[4,9,3],[4,10,2],[4,18,1],[4,19,5],[5,20,130],[5,21,100],[5,3,400],[5,9,3],[5,8,60],[5,22,15],[5,23,2],[6,24,125],[6,8,80],[6,4,15],[6,23,10],[6,25,100],[6,15,50],[6,9,5],[6,10,5],[6,26,10],[7,27,125],[7,9,10],[8,28,125],[8,18,4],[8,3,50],[8,9,0.5],[9,29,100],[9,30,50],[9,8,30],[9,9,1],[9,10,1],[10,31,100],[10,32,200],[10,33,25],[10,8,50],[10,23,30],[10,34,10],[10,46,30],[11,18,2],[11,35,30],[11,17,200],[11,28,100],[11,36,5],[11,23,30],[12,37,250],[12,35,15],[12,38,10],[12,3,20],[13,39,10],[13,35,10],[13,17,100],[13,40,25],[14,41,65],[14,42,5],[15,18,2],[15,28,60],[15,35,90],[15,23,60],[15,17,30],[15,36,5],[15,43,30],[16,44,30],[16,45,15]];
        foreach ($component_ingredients as $component_ingredient)
            {
                DB::table('components_ingredients')->insert([
                    'component_id' => $component_ingredient[0],
                    'ingredient_id' => $component_ingredient[1],
                    'amount' => $component_ingredient[2],
                ]);
            }
        

        //Create Meal
        $meals = [['Couscoussalat','Couscous zu Gemüse unterrühren'],['Tomatencremesuppe','servieren'],['Mehlklösesuppe','1. Mehlköse in kochende Suppenbrühe hinzugeben 2. 20 Minuten köcheln lassen 3. klare Suppenbrühe mit einem Sieb in einen anderen Topf abgießen'],['Käsespätzle','1. Die Spätzle unter die Käsemasse heben. 2. Auf niedriger Stufe kurz ziehen lassen.'],['Meeresfrüchterisotto','1. Meeresfrüchterisotto auf den Teller geben und den restlichen Parmesan darüberstreuen'],['Pfannkuchen','1. Pfannkuchen auf den Teller geben. 2. Apfelmuß darüber geben.'],['Pudding','1. Pudding auf Teller stürzen. 2. Erdbeersoße darüber geben.'],['Tassenkuchen','1. Glasur über den Kuchen geben. 2. Mit Marshmallows verzieren.'],['Spaghetti Bolognese','1. Nudeln in den Teller geben. 2. Bolognese Soße darüber geben.']];
        foreach ($meals as $meal) {
            DB::table('meals')->insert([
                'name' => $meal[0],
                'recipe' => $meal[1],
            ]);
        }
        $component_meals = [[1,1,75],[1,2,300],[2,3,400],[3,4,30],[3,5,300],[4,8,275],[4,9,180],[5,10,420],[6,11,350],[6,12,200],[7,13,140],[7,14,67],[8,15,330],[8,16,30],[9,6,300],[9,7,125]];
        foreach($component_meals as $component_meal)
            {
                DB::table('components_meals')->insert([
                    'meal_id' => $component_meal[0],
                    'component_id' => $component_meal[1],
                    'amount' => $component_meal[2],
                ]);
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
                'meal_id' => rand(1,9),
                'menu_id' => $count,
            ]);
            $count++;

            DB::table('meals_menus')->insert([
                'meal_id' => rand(1,9),
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
