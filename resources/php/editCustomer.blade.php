<?php
    if(isset($_POST["customer_id"]))
    {
        $output = '';
        $connect = mysqli_connect("127.0.0.1", "root", "", "cateringchef");
        $query = "SELECT name, street, house_number, postcode, place, adults, childrens  FROM customers WHERE id='".$_POST["customer_id"]."'";
        $result = mysqli_query($connect, $query);
        while($row = mysqli_fetch_array($result))
        {
            $output .= '<div class="form-group"><div class="col"><input type="text" class="form-control" name="name" value="'.$row["name"].'" required></div></div>';
            $output .= '<div class="form-group"><div class="col"><div class="input-group"><input type="text" class="form-control rounded-left " name="street" value="'.$row['street'].'" required>';
            $output .= '<div class="input-group-appends"><input type="number" class="form-control rounded-right" name="house_number" value="'.$row['house_number'].'" required></div></div></div></div>';
            $output .= '<div class="form-group"><div class="col"><div class="input-group"><input type="number" class="form-control rounded-left" name="postcode" value="'.$row['postcode'].'" required>';
            $output .= '<div class="input-group-append"><input type="text" class="form-control rounded-right" name="place" value="'.$row['place'].'" required></div></div></div></div>';
            $output .= '<div class="form-group"><div class="col"><div class="input-group"><input type="number" class="form-control rounded-left" name="adults" value="'.$row['adults'].'" required>';
            $output .=  ' <div class="input-group-append"><input type="number" class="form-control rounded-right" name="childrens" value="'.$row['childrens'].'" required></div></div></div></div>';
        }
        echo $output;
    }    
?>