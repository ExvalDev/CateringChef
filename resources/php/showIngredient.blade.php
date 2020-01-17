<?php
    if(isset($_POST["ingredient_id"]))
    {
        $output = '';
        $allergene_array = [];
        $connect = mysqli_connect("127.0.0.1", "root", "", "cateringchef");
        $query = "SELECT I.name AS nameIngredient, S.name AS nameSupplier FROM ingredients I, suppliers S WHERE I.supplier_id = S.id AND I.id='".$_POST["ingredient_id"]."'";
        $result = mysqli_query($connect, $query);
        $output .= '<div class="table-responsive"><table class="table table-hover mt-3">';
        while($row = mysqli_fetch_array($result))
        {
            $output .= '
                <tr>
                        <td width="30%"><label>Zutat</label></td>
                        <td width="70%">'.$row["nameIngredient"].'</td>
                </tr>
                <tr>
                        <td width="30%"><label>Lieferant</label></td>
                        <td width="70%">'.$row["nameSupplier"].'</td>
                </tr>
                ';
        }
        $query = "SELECT A.Name AS nameAllergene FROM allergenes A, ingredients I, allergenes_ingredients AI WHERE A.id = AI.allergene_id AND AI.ingredient_id = I.id AND I.id ='".$_POST["ingredient_id"]."'";
        $result = mysqli_query($connect, $query);
        while($row = mysqli_fetch_array($result))
        {
            array_push($allergene_array, $row['nameAllergene']);
        }
        $output .= '<tr><td width="30%"><label>Allergene</label></td><td width="70%">';
        $allergene = "";
        if (!empty($allergene_array))
        {
            foreach ($allergene_array as $value)
            {
                $allergene .= $value.", ";
            } 
            $allergene = substr($allergene, 0, -2);
        }
        else 
        {
            $allergene = "Keine Allergene";
        }
        $output .= $allergene;
        $output .= '</td></tr>';
        $output .= "</table></div>";
        echo $output;
    }
 ?>