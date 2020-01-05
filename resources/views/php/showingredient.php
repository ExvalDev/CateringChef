<?php
include "../core/head.php";

if(isset($_POST["ingredient_id"]))
{
     $output = '';
     $allergene_array = [];
     $connect = mysqli_connect("localhost", "root", "", "cateringchef");
     $query ="SELECT ingredients.name AS name, suppliers.name AS supplier, db_units.name AS unit FROM ingredients, suppliers, db_units WHERE ingredients.id = '".$_POST["ingredient_id"]."' AND ingredients.supplier_id = suppliers.id AND ingredients.db_unit_id = db_units.id";
     $result = mysqli_query($connect, $query);
     $output .= '<div class="table-responsive"><table class="table table-hover mt-3">';
     while($row = mysqli_fetch_array($result))
     {
          $output .= '
               <tr>
                    <td width="30%"><label>Zutat</label></td>
                    <td width="70%">'.$row["name"].'</td>
               </tr>
               <tr>
                    <td width="30%"><label>Lieferant</label></td>
                    <td width="70%">'.$row["supplier"].'</td>
               </tr>
               <tr>
                    <td width="30%"><label>Einheit</label></td>
                    <td width="70%">'.$row["unit"].'</td>
               </tr>
               ';
     }
     $output .= "</table></div>";
     echo $output;
}
 ?>
