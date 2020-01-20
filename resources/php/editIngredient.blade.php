<?php
    if(isset($_POST["ingredient_id"]))
    {
        $output = '';
        $connect = mysqli_connect("127.0.0.1", "root", "", "cateringchef");
        $query = "SELECT I.name AS nameIngredient FROM ingredients I WHERE I.id='".$_POST["ingredient_id"]."'";
        $result = mysqli_query($connect, $query);
        while($row = mysqli_fetch_array($result))
        {
            $output .= '<div class="form-group"><div class="col"><input type="text" class="form-control" name="editname" value="'.$row["nameIngredient"].'" required></div></div>';
        }
        $allergenes_ingredients = [];
        $query = "SELECT allergene_id FROM allergenes_ingredients WHERE ingredient_id='".$_POST["ingredient_id"]."'";
        $result = mysqli_query($connect, $query);
        while($row = mysqli_fetch_array($result))
        {
            array_push($allergenes_ingredients, $row['allergene_id']);
        }
        $output .= '<div class="form-group"><div class="col"><div class="form-check allergene p-0">';
        $allergenes = [];
        $query = "SELECT id, name FROM allergenes";
        $result = mysqli_query($connect, $query);
        while($row = mysqli_fetch_array($result))
        {
            array_push($allergenes, [$row['id'], $row['name']]);
        }

        foreach ($allergenes as $allergene)
        {
            if (in_array($allergene[0], $allergenes_ingredients))
            {
            
                $output .= '<input class="form-check-input" id="edit'.$allergene[1].'" type="checkbox" name="editallergene[]" value="'.$allergene[0].'" checked>';
                $output .= '<label class="form-check-label" for="edit'.$allergene[1].'">'.$allergene[1].'</label>';
            }
            else 
            {
                $output .= '<input class="form-check-input" id="edit'.$allergene[1].'" type="checkbox" name="editallergene[]" value="'.$allergene[0].'">';
                $output .= '<label class="form-check-label" for="edit'.$allergene[1].'">'.$allergene[1].'</label>';
            }
            
        }
        $output .= '</div></div></div>';
        $output .= '<div class="form-group"><div class="col">';
        $supplier_ingredient = '';
        $query = "SELECT S.name AS supplier_name FROM suppliers S, ingredients I WHERE I.supplier_id = S.id AND I.id='".$_POST["ingredient_id"]."'";
        $result = mysqli_query($connect, $query);
        while($row = mysqli_fetch_array($result))
        {
            $supplier_ingredient = $row['supplier_name'];
        }
        $output .= '<input list="suppliers" class="form-control" name="editsupplier_name" value="'.$supplier_ingredient.'" placeholder="Lieferant" autocomplete="on">';
        $query = "SELECT name FROM suppliers";
        $result = mysqli_query($connect, $query);
        $output .= '<datalist id="suppliers">';
        while($row = mysqli_fetch_array($result))
        {
            $output .= '<option value="'.$row['name'].'">';
        }
        $output .= '</datalist></div></div>';
        $output .= '<div class="form-group"><div class="col">';
        $output .= '<select class="form-control" name="editdb_unit_id" required>';
        $unit_ingredient = '';
        $query = "SELECT I.db_unit_id AS unit_ingredient FROM ingredients I WHERE I.id ='".$_POST["ingredient_id"]."'";
        $result = mysqli_query($connect, $query);
        while($row = mysqli_fetch_array($result))
        {
            $unit_ingredient = $row['unit_ingredient'];
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
            if ($unit[0] == $unit_ingredient)
            {
                $output .= '<option value="'.$unit[0].'" selected>'.$unit[1].'</option>';
            }
            else 
            {
                $output .= '<option value="'.$unit[0].'">'.$unit[1].'</option>';
            }
        }
        $output .= '</select></div></div>';   
        echo $output;
    }