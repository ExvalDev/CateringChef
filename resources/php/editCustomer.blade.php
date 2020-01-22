<?php
    if(isset($_POST["customer_id"]))
    {
        $output = '';
        $connect = mysqli_connect("127.0.0.1", "root", "", "cateringchef");
        $query = "SELECT name, street, house_number, postcode, place, adults, childrens  FROM customers WHERE id='".$_POST["customer_id"]."'";
        $result = mysqli_query($connect, $query);
        while($row = mysqli_fetch_array($result))
        {
            $output = <<<EOT
                    <div class="form-row">
                        <div class="form-group col-12">
                            <input type="text" class="form-control" name="name" value=" {$row['name']} " placeholder="Name" autofocus required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="input-group col-12">
                            <input type="text" class="col-8 form-control" name="street" value="{$row['street']}" placeholder="Straße" required> 
                            <input type="number" class="col-4 form-control rounded-right" name="house_number" value="{$row['house_number']}" placeholder="Nr." required>    
                        </div>
                    </div>
                    <div class="form-row mt-3">
                        <div class="input-group col-12">
                            <input type="number" class="col-5 form-control" name="postcode" value="{$row['postcode']}" placeholder="PLZ" required>
                            <input type="text" class="col-7 form-control rounded-right" name="place" value="{$row['place']}" placeholder="Ort" required>
                        </div>
                    </div>
                    <div class="form-row mt-3">
                        <div class="input-group col-12">  
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend2"><i class="fas fa-male"></i></span>
                            </div>
                            <input type="number" class="form-control" name="adults" value="{$row['adults']}" placeholder="Erwachsene" required>                           
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend2"><i class="fas fa-child"></i></span>
                            </div>
                            <input type="number" class="form-control" name="childrens" value="{$row['childrens']}" placeholder="Kinder" required>                            
                        </div>
                    </div>
                    EOT;

           }
        echo $output;
    }    
?>