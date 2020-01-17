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
                        <td width="70%">'.$row["nameComponent"].'</td>
                </tr>';
        }
        $query = "SELECT I.Name AS nameIngredient, CI.amount AS amountIngredient FROM ingredients I, components C,  components_ingredients CI WHERE I.id = CI.ingredient_id AND CI.component_id = C.id AND C.id ='".$_POST["component_id"]."'";
        $result = mysqli_query($connect, $query);
        while($row = mysqli_fetch_array($result))
        {
            array_push($ingredients_array, [$row['nameIngredient'], $row[amountIngredient]]);
        }
        $count = 1;
        foreach ($ingredients_array AS $ingredient)
        {
            $output .= '<tr><td width="30%"><label>Zutat '.$count.'</label></td><td width="70%">'.$ingredient[0].'<td><td>'.$ingredient[1].'</td></tr>';
            $count++;
        }
        $query = "SELECT C.recipe AS recipeComponent FROM components C WHERE C.id='".$_POST["component_id"]."'";
        $result = mysqli_query($connect, $query);
        while($row = mysqli_fetch_array($result))
        {
            $output .= '
                <tr>
                        <td width="30%"><label>Rezept</label></td>
                        <td width="70%">'.$row["recipeComponent"].'</td>
                </tr>';
        }
        $output .= "</table></div>";
        echo $output;
    }
 ?>