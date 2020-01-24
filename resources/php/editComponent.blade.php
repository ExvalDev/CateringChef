<?php
    if(isset($_POST["component_id"]))
    {
        $output = '';
        $output .= '<fieldset><h2>Name</h2>';
        $connect = mysqli_connect("127.0.0.1", "root", "", "cateringchef");
        $query = "SELECT C.name AS nameComponent, C.amount AS amountComponent  FROM components C WHERE C.id='".$_POST["component_id"]."'";
        $result = mysqli_query($connect, $query);
        while($row = mysqli_fetch_array($result))
        {
            $output .= '<div class="form-group">
                            <div class="col">
                                <input type="text" class="form-control" name="editname" value="'.$row["nameComponent"].'" required>
                            </div>
                        </div>';
            $output .= '<div class="form-group row">
                            <div class="col p-0">
                                <input type="number" class="form-control" name="amount" value="'.$row["amountComponent"].'" required>
                            </div>'; 
        }
        $output .= '<div class="col p-0">
                        <select class="form-control" name="db_unit_id" required>';
        $unitComponent= '';
        $query = "SELECT C.db_unit_id AS unitComponent FROM components C WHERE C.id ='".$_POST["component_id"]."'";
        $result = mysqli_query($connect, $query);
        while($row = mysqli_fetch_array($result))
        {
            $unitComponent = $row['unitComponent'];
        }
        $db_units = [];
        $query = "SELECT id AS unit_id, name AS unit_name FROM db_units";
        $result = mysqli_query($connect, $query);
        while($row = mysqli_fetch_array($result))
        {
            array_push($db_units, [$row['unit_id'],$row['unit_name']]);
            
        }
        foreach ($db_units as $unit)
        {
            if ($unit[0] == $unitComponent)
            {
                $output .= '<option value="'.$unit[0].'" selected>'.$unit[1].'</option>';
            }
            else 
            {
                $output .= '<option value="'.$unit[0].'">'.$unit[1].'</option>';
            }
        }
        $output .= '</fieldset>';
        $output .= '
        <fieldset>
            <h2>Zutaten</h2>
            <div class="form-container">
                <div class="dynamic-stuff" id="dynamic-stuff">';
                    $ingredientsComponent = []; 
                    $query = "SELECT I.id AS ingredientId, CI.amount AS ingredientAmount FROM ingredients I, components_ingredients CI WHERE I.id = CI.ingredient_id AND CI.component_id ='".$_POST["component_id"]."'";
                    $result = mysqli_query($connect, $query);
                    while($row = mysqli_fetch_array($result))
                    {
                        array_push($ingredientsComponent, [$row['ingredientId'], $row['ingredientAmount']]);
                    }
                    $ingredients = [];
                    $query = "SELECT I.id AS ingredientId, I.name AS ingredientName, U.name AS ingredientUnit FROM ingredients I, db_units U WHERE I.db_unit_id = U.id";
                    $result = mysqli_query($connect, $query);
                    while($row = mysqli_fetch_array($result))
                    {
                        array_push($ingredients, [$row['ingredientId'],$row['ingredientName'], $row['ingredientUnit']]);
                    }
                    $count = 0;
                    foreach ($ingredientsComponent as $ingredientComponent)
                    {
                        if ($count == 0)
                        {
                            $output .= '
                                        <div class="form-group dynamic-element" style="display:none">
                                            <div class="row">
                                            <div class="input-group">
                                                <select id="selectIngredient" name="ingredients[]" class="form-control selectIngredient" onchange="changeUnit()" required>';
                                                foreach ($ingredients as $ingredient)
                                                {
                                                    if ($ingredient[0] == $ingredientComponent[0])
                                                    {
                                                        $output .= '<option value="'.$ingredient[0].'" data-cc-unit="'.$ingredient[2].'" selected>'.$ingredient[1].'</option>';
                                                    }
                                                    else 
                                                    {
                                                        $output .= '<option value="'.$ingredient[0].'" data-cc-unit="'.$ingredient[2].'">'.$ingredient[1].'</option>';
                                                    }
                                                }
                                                $output .= '
                                                </select>
                                                <input type="number" class="form-control" name="amounts[]" placeholder="Menge">
                                                <div class="input-group-append">
                                                    <span class="input-group-text unitIngredient" id="unitIngredient">Einheit</span>
                                                </div>
                                                <div class=""><p class="delete">x</p></div>
                                            </div>
                                        </div>
                                    </div>';  
                                    $count++;
                        }
                        else 
                        {
                            $output .= '
                            <div class="form-group dynamic-element">
                                <div class="row">
                                    <div class="input-group">
                                        <select id="selectIngredient"'.$count.' name="ingredients[]" class="form-control selectIngredient" onchange="changeUnit()" required>';
                                        foreach ($ingredients as $ingredient)
                                        {
                                            if ($ingredient[0] == $ingredientComponent[0])
                                            {
                                                $output .= '<option value="'.$ingredient[0].'" data-cc-unit="'.$ingredient[2].'" selected>'.$ingredient[1].'</option>';
                                            }
                                            else 
                                            {
                                                $output .= '<option value="'.$ingredient[0].'" data-cc-unit="'.$ingredient[2].'">'.$ingredient[1].'</option>';
                                            }
                                        }
                                        $output .= '
                                        </select>
                                        <input type="number" class="form-control" name="amounts[]" placeholder="Menge">
                                        <div class="input-group-append">
                                            <span class="input-group-text unitIngredient" id="unitIngredient">Einheit</span>
                                        </div>
                                        <div class=""><p class="delete">x</p></div>
                                    </div>
                                </div>
                            </div>';
                        $count++;   
                        }
                    }
                $output = '
                </div>'; 
                $output = '           
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="add-one">+ Hinzufügen</p>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>';
        $query = "SELECT C.recipe AS recipeComponent FROM components C WHERE C.id='".$_POST["component_id"]."'";
        $result = mysqli_query($connect, $query);
        while($row = mysqli_fetch_array($result))
        {
            $output .= '<fieldset><h2>Rezept</h2><textarea name="recipe" cols="50" rows="5" class="mb-2" form="addComponentForm">'.$row['recipeComponent'].'</textarea></fieldset>';  
        } 
                        
        echo $output;
    }
?>