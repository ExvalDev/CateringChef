<?php
    if(isset($_POST["component_id"]))
    {
        $output = '';
        $ingredients_array = [];
        $connect = mysqli_connect("127.0.0.1", "root", "", "cateringchef");
        $query = "SELECT C.name AS nameComponent FROM components C WHERE C.id='".$_POST["component_id"]."'";
        $result = mysqli_query($connect, $query);
        $output .= '<div class="table-responsive"><table class="table table-hover mt-3">';
        while($row = mysqli_fetch_array($result))
        {
            $output .= '
                <tr>
                        <td width="30%"><label>Komponent</label></td>
                        <td width="30%">'.$row["nameComponent"].'</td>
                        <td width="40%" class="float-left"></td>
                </tr>';
        }
        $query = "SELECT I.Name AS nameIngredient, CI.amount AS amountIngredient , U.name AS unitIngredient FROM ingredients I, components C,  components_ingredients CI, db_units U WHERE I.id = CI.ingredient_id AND CI.component_id = C.id AND I.db_unit_id = U.id AND C.id ='".$_POST["component_id"]."'";
        $result = mysqli_query($connect, $query);
        while($row = mysqli_fetch_array($result))
        {
            array_push($ingredients_array, [$row['nameIngredient'], $row['amountIngredient'], $row['unitIngredient']]);
        }
        $count = 1;
        foreach ($ingredients_array AS $ingredient)
        {
            $output .= '<tr>
                            <td><label>Zutat '.$count.'</label></td>
                            <td><label>'.$ingredient[0].'</label></td>
                            <td>'.$ingredient[1].' '.$ingredient[2].'</td>
                        </tr>';
            $count++;
        }
        $query = "SELECT C.recipe AS recipeComponent FROM components C WHERE C.id='".$_POST["component_id"]."'";
        $result = mysqli_query($connect, $query);
        while($row = mysqli_fetch_array($result))
        {
            $output .= '
                <tr>
                        <td><label>Rezept</label></td>
                        <td>'.$row["recipeComponent"].'</td>
                        <td></td>
                        
                </tr>';
        }
        $output .= "</table></div>";
        echo $output;
    }
 ?>