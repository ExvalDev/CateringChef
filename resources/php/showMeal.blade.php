<?php
    if(isset($_POST["meal_id"]))
    {
        $output = '';
        $connect = mysqli_connect("127.0.0.1", "root", "", "cateringchef");
        $query = "SELECT name AS nameMeal FROM meals WHERE id='".$_POST["meal_id"]."'";
        $result = mysqli_query($connect, $query);
        $output .= '<div class="table-responsive"><table class="table table-hover mt-3">';
        while($row = mysqli_fetch_array($result))
        {
            $output .= '
                <tr>
                        <td width="30%"><label>Zutat</label></td>
                        <td width="70%">'.$row["nameMeal"].'</td>
                </tr>
                ';
        }
        $components_array = [];
        $query = "SELECT C.Name AS nameComponent FROM components C,  components_meals CM, meals M WHERE C.id = CM.component_id AND CM.meal_id = M.id AND M.id ='".$_POST["meal_id"]."'";
        $result = mysqli_query($connect, $query);
        while($row = mysqli_fetch_array($result))
        {
            array_push($components_array, $row['nameComponent']);
        }
        $count = 1;
        foreach ($components_array AS $component)
        {
            $output .= '<tr><td width="30%"><label>Komponente '.$count.'</label></td><td width="70%">'.$component.'<td></tr>';
            $count++;
        }
        $query = "SELECT recipe AS recipeMeal FROM meals WHERE id='".$_POST["meal_id"]."'";
        $result = mysqli_query($connect, $query);
        while($row = mysqli_fetch_array($result))
        {
            $output .= '
                <tr>
                        <td width="30%"><label>Rezept</label></td>
                        <td width="70%">'.$row["recipeMeal"].'</td>
                </tr>
                ';
        }
        $output .= "</table></div>";
        echo $output;
    }
?>