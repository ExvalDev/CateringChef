<?php
    if(isset($_POST["component_id"]))
    {
        $output = '';
        $output .= '<div class="container"><div class="progress my-2"><div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div></div><fieldset><h2>Name</h2>';
        $connect = mysqli_connect("127.0.0.1", "root", "", "cateringchef");
        $query = "SELECT C.name AS nameComponent, C.amount AS amountComponent  FROM components C WHERE C.id='".$_POST["component_id"]."'";
        $result = mysqli_query($connect, $query);
        while($row = mysqli_fetch_array($result))
        {
            $output .= '<div class="form-group"><div class="col"><input type="text" class="form-control" name="editname" value="'.$row["nameComponent"].'" required></div></div>';
            $output .= '<div class="form-group row"><div class="col p-0"><input type="number" class="form-control" name="amount" value="'.$row["amountComponent"].'" required></div>'; 
        }
        $output .= '<div class="col p-0"><select class="form-control" name="db_unit_id" required><option disabled selected>Einheit</option>';
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
        $output .= '</select></div></div><input type="button" name="next" class="next btn btn-primary" value="Weiter"></fieldset>';
        $ingredientsComponent = []; 
        $query = "SELECT I.id AS ingredientId, CI.amount AS ingredientAmount FROM ingredients I, components_ingredients CI WHERE I.id = CI.ingredient_id AND CI.component_id ='".$_POST["component_id"]."'";
        $result = mysqli_query($connect, $query);
        while($row = mysqli_fetch_array($result))
        {
            array_push($ingredientsComponent, [$row['ingredientId'], $row['ingredientAmount']]);
        }
        $ingredients = [];
        $query = "SELECT id AS ingredientId, name AS ingredientName FROM ingredients";
        $result = mysqli_query($connect, $query);
        while($row = mysqli_fetch_array($result))
        {
            array_push($ingredients, [$row['ingredientId'],$row['ingredientName']]);
        }
        $output .= '<fieldset><h2>Zutaten</h2>';
        foreach ($ingredientsComponent as $ingredientComponent)
        {
            $output .= '<div id="itemRows" class="form-group mb-2"><div class="input-group my-2"><select class="form-control" name="fieldAddIngredient" required>';
            foreach ($ingredients as $ingredient)
            {
                if ($ingredient[0] == $ingredientComponent[0])
                {
                    $output .= '<option value="'.$ingredient[0].'" selected>'.$ingredient[1].'</option>';
                }
                else 
                {
                    $output .= '<option value="'.$ingredient[0].'">'.$ingredient[1].'</option>';
                }
            }
            $output .= '</select><div class="input-group-append">';
            $output .= '<input type="number" class="form-control rounded-0" name="fieldAddAmount" value="'.$ingredientComponent[1].'" required>';
            $output .= '<div class="input-group-append"><span class="input-group-text rounded-0">Einheit</span></div></div><div class="input-group-append">';
            $output .= '<button class="btn p-0 btn-primary shadow-none" onclick="addRow(this.form);"><h2 class="mdi mdi-plus m-0"></h2></button></div></div></div>';     
        } 
        $output .= '<input type="button" name="previous" class="previous btn btn-secondary" value="Zurück" /><input type="button" name="next" class="next btn btn-primary" value="Weiter" /></fieldset>';        
        echo $output;
    }