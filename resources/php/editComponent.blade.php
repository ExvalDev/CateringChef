<?php
    if(isset($_POST["component_id"]))
    {
        $connect = mysqli_connect("127.0.0.1", "root", "", "cateringchef");
        //Page I
        $output = '
        <div class="container p-0">
            <ul id="progressbar">
                <li class="active">Allgemein</li>
                <li>Zutaten</li>
                <li>Rezept</li>
            </ul>
            <fieldset class="fieldsetComponent">
                <h2>Allgemein</h2>
                <div class="form-row">
                    <div class="form-group col-12">';
                        $query = 'SELECT C.name AS nameComponent FROM components C WHERE C.id ="'.$_POST["component_id"].'"';
                        $result = mysqli_query($connect, $query);
                        while($row = mysqli_fetch_array($result))
                        {
                            $output .= '<input type="text" class="form-control" name="name" value="'.$row['nameComponent'].'">';
                        }
        $output .= '</div>
                </div>
                <div class="form-row">            
                    <div class="input-group col-12">';
                    $query = 'SELECT C.amount AS amountComponent , U.name AS unitComponent FROM components C, db_units U WHERE C.db_unit_id = U.id AND C.id ="'.$_POST["component_id"].'"';
                    $result = mysqli_query($connect, $query);
                    while($row = mysqli_fetch_array($result))
                    {
                        $output .= '<input type="number" class="form-control" name="amount" value="'.$row['amountComponent'].'">';
                    }
                    $units = [];
                    $query = 'SELECT id, name FROM db_units';
                    $result = mysqli_query($connect, $query);
                    while($row = mysqli_fetch_array($result))
                    {
                        array_push($units, [$row['id'], $row['name']]);
                    }
                    $unit_component = '';
                    $query = 'SELECT C.db_unit_id AS unitComponent FROM components C, db_units U WHERE C.db_unit_id = U.id AND C.id ="'.$_POST["component_id"].'"';
                    $result = mysqli_query($connect, $query);
                    while($row = mysqli_fetch_array($result))
                    {
                        $unit_component = $row['unitComponent'];
                    }
                    $output .= '
                    <select class="form-control" name="db_unit_id">';
                    foreach($units as $unit)
                    {
                        if($unit[0] == $unit_component)
                        {
                           $output .= '<option value="'.$unit[0].'" selected>'.$unit[1].'</option>';
                        }
                        else 
                        {
                            $output .= '<option value="'.$unit[0].'">'.$unit[1].'</option>';
                        }
                    }
                    $output .='
                    </select>
                    </div>
                </div>
                <input type="button" name="next" class="next btn btn-primary float-right mt-3" value="Weiter">
            </fieldset>';
            //Page II
            $output .= '
            <fieldset class="fieldsetComponent">
                <div class="d-flex">
                    <h2>Zutaten</h2>
                    <p class="btn py-0 px-2 btn-primary shadow-none ml-auto add-one-edit"><i class="fas fa-plus"></i></p>
                </div>
                <div class="form-container mb-3">
                    <div class="dynamic-stuff-edit" id="dynamic-stuff-edit">
                        <div class="form-row mt-2 dynamic-element-edit" style="display:none">
                            <div class="input-group col-12">
                                <select id="selectIngredient" name="ingredients[]" class="form-control col-5 selectIngredient" onchange="changeUnit()" required>';
                                $ingredients = [];
                                $query = 'SELECT I.id AS idIngredient, I.name AS nameIngredient, I.db_unit_id AS unitIngredient, U.name AS nameUnit FROM ingredients I, db_units U WHERE I.db_unit_id = U.id';
                                $result = mysqli_query($connect, $query);
                                while($row = mysqli_fetch_array($result))
                                {
                                    array_push($ingredients, [$row['idIngredient'], $row['nameIngredient'], $row['unitIngredient'], $row['nameUnit']]);
                                }
                                foreach($ingredients as $ingredient)
                                {
                                    $output .= '<option value="'.$ingredient[0].'" data-cc-unit="'.$ingredient[3].'">'.$ingredient[1].'</option>';
                                }
                                $output .='
                                </select>
                                <input type="number" class="form-control col-3" name="amounts[]" placeholder="Menge">
                                <span class="form-control unitIngredient col-3" id="unitIngredient">Einheit</span>
                                <div class="input-group-append d-flex col-1 px-0">
                                    <button class="btn btn-outline-danger flex-fill delete-edit" type="button"> x </button>
                                </div>
                            </div>
                        </div>';
                        $ingredients_component = [];
                        $query = 'SELECT I.id AS idIngredient, CI.amount AS amountIngredient, U.name AS nameUnit FROM components_ingredients CI, db_units U, ingredients I WHERE I.id = CI.ingredient_id AND I.db_unit_id = U.id AND CI.component_id="'.$_POST["component_id"].'"';
                        $result = mysqli_query($connect, $query);
                        while($row = mysqli_fetch_array($result))
                        {
                            array_push($ingredients_component, [$row['idIngredient'], $row['amountIngredient'], $row['nameUnit']]);
                        }
                        $count = 1;
                        foreach($ingredients_component as $ingredient_component)
                        {
                            $output .='
                            <div class="form-row mt-2 dynamic-element-edit" style="display:block">
                                <div class="input-group col-12">
                                    <select id="selectIngredient'.$count.'" name="ingredients[]" class="form-control col-5 selectIngredient" onchange="changeUnit('.$count.')" required>';
                                    foreach($ingredients as $ingredient)
                                    {
                                        if($ingredient[0] == $ingredient_component[0])
                                        {
                                            $output .= '<option value="'.$ingredient[0].'" data-cc-unit="'.$ingredient[3].'" selected>'.$ingredient[1].'</option>';
                                        }
                                        else 
                                        {
                                            $output .= '<option value="'.$ingredient[0].'" data-cc-unit="'.$ingredient[3].'">'.$ingredient[1].'</option>';
                                        }
                                    }
                                    $output .='
                                    </select>
                                    <input type="number" class="form-control col-3" name="amounts[]" value="'.$ingredient_component[1].'">
                                    <span class="form-control unitIngredient col-3" id="unitIngredient'.$count.'">'.$ingredient_component[2].'</span>
                                    <div class="input-group-append d-flex col-1 px-0">
                                        <button class="btn btn-outline-danger flex-fill delete-edit" type="button"> x </button>
                                    </div>
                                </div>
                            </div>';
                            $count++;
                        }
                    $output .= '
                    </div>
                </div>
                <input type="button" name="previous" class="previous btn btn-secondary" value="Zurück" />
                <input type="button" name="next" class="next btn btn-primary float-right" value="Weiter" />
            </fieldset>';
            //Page III
            $output .='
            <fieldset class="fieldsetComponent">
                <h2>Rezept</h2>
                <textarea name="recipe" cols="50" rows="5" class="mb-2 form-control" form="addComponentForm">';
                $query = 'SELECT recipe FROM components C WHERE C.id="'.$_POST["component_id"].'"';
                $result = mysqli_query($connect, $query);
                while($row = mysqli_fetch_array($result))
                {   
                    $output .= $row['recipe'];
                }
                $output .= '
                </textarea>
                <input type="button" name="previous" class="previous btn btn-secondary" value="Zurück" />
                <button type="submit" class="btn btn-primary float-right">
                    Speichern
                </button>
            </fieldset>
        </div>';
        echo $output;
    }
?>
<script>
    var url = "/js/functions.js";
    $.getScript(url);
</script>