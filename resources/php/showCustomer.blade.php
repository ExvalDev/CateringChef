<?php
    if(isset($_POST["customer_id"]))
    {
        $output = '';
        $output .= '<div class="table-responsive"><table class="table table-hover mt-3">';
        $connect = mysqli_connect("127.0.0.1", "root", "", "cateringchef");
        $query = "SELECT name, street, house_number, postcode, place, adults, childrens  FROM customers WHERE id='".$_POST["customer_id"]."'";
        $result = mysqli_query($connect, $query);
        while($row = mysqli_fetch_array($result))
        {
            $output .= '
                <tr>
                        <td width="30%"><label>Name</label></td>
                        <td width="70%">'.$row["name"].'</td>
                </tr>
                <tr>
                        <td width="30%"><label>Straße</label></td>
                        <td width="70%">'.$row["street"]." ".$row["house_number"].'</td>
                </tr>
                <tr>
                        <td width="30%"><label>Ort</label></td>
                        <td width="70%">'.$row["postcode"]." ".$row["place"].'</td>
                </tr>
                <tr>
                        <td width="30%"><label>Erwachsene</label></td>
                        <td width="70%">'.$row["adults"].'</td>
                </tr>
                <tr>
                        <td width="30%"><label>Kinder</label></td>
                        <td width="70%">'.$row["childrens"].'</td>
                </tr>
                ';
        }
        echo $output;
    }
?>