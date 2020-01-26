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
                        <td width="30%"><label>Speise</label></td>
                        <td width="30%">'.$row["nameMeal"].'</td>
                        <td width="40%" class="float-left"></td>
                </tr>
                ';
        }
        $components_meal = [];
        $query = "SELECT C.Name AS nameComponent, CM.amount AS amountComponent, U.name AS unitComponent FROM components C,  components_meals CM, meals M, db_units U WHERE C.id = CM.component_id AND CM.meal_id = M.id AND C.db_unit_id = U.id AND M.id ='".$_POST["meal_id"]."'";
        $result = mysqli_query($connect, $query);
        while($row = mysqli_fetch_array($result))
        {
            array_push($components_meal, [$row['nameComponent'], $row['amountComponent'], $row['unitComponent']]);
        }
        $count = 1;
        foreach ($components_meal AS $component)
        {
            $output .= '<tr>
                            <td><label>Komponente '.$count.'</label></td>
                            <td>'.$component[0].'</td>
                            <td>'.$component[1].' '.$component[2].'</td>
                        </tr>';
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