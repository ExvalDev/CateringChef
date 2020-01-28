<?php
    if(isset($_POST["meal_id"]))
    {
        $output = '';
        $connect = mysqli_connect("127.0.0.1", "root", "", "cateringchef");
        //Page I
        $output .= '
        <div class="container p-0">
            <ul id="progressbar">
                <li class="active">Allgemein</li>
                <li>Komponente</li>
                <li>Rezept</li>
            </ul>
            <fieldset class="fieldsetEditMeal">
                <h2>Allgemein</h2>
                <div class="form-row">
                    <div class="form-group col-12">';
                    $query = "SELECT name AS nameMeal FROM meals WHERE id='".$_POST["meal_id"]."'";
                    $result = mysqli_query($connect, $query);
                    while($row = mysqli_fetch_array($result))
                    {
                        $output .= '<input type="text" class="form-control" name="name" value="'.$row['nameMeal'].'" placeholder="Name">';
                    }
                    $output .= '
                    </div>
                </div>
                <input type="button" name="next" class="next btn btn-primary float-right mt-3" value="Weiter">
            </fieldset>';
            //Page II
            $output .= '
            <fieldset class="fieldsetEditdMeal">
                <div class="d-flex">
                    <h2>Komponente</h2>
                    <p class="btn py-0 px-2 btn-primary shadow-none ml-auto edit-component"><i class="fas fa-plus"></i></p>
                </div>
                <div class="form-container mb-3">
                    <div class="dynamic-component-edit-area" id="dynamic-component-edit-area">
                        <div class="form-row mt-2 dynamic-component-edit" style="display:none">
                            <div class="input-group col-12">
                                <select id="selectComponentEdit" name="components[]" class="form-control col-5 selectComponentEdit" onchange="changeUnitEditMeal()" required>
                                    <option disabled selected hidden> Komponente wählen</option>';
                                    $components = [];
                                    $query = 'SELECT C.id AS idComponent, C.name AS nameComponent, C.db_unit_id AS unitComponent, U.name AS nameUnit FROM components C, db_units U WHERE C.db_unit_id = U.id';
                                    $result = mysqli_query($connect, $query);
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        array_push($components, [$row['idComponent'], $row['nameComponent'], $row['unitComponent'], $row['nameUnit']]);
                                    }
                                    foreach ($components as $component)
                                    {
                                        $output .= '<option value="'.$component[0].'" data-cc-unit="'.$component[3].'">'.$component[1].'</option>';
                                    }
                                $output .= '
                                </select>
                                <input type="number" min="0" class="form-control col-3" name="amounts[]" placeholder="Menge">
                                <span class="form-control unitComponentEdit col-3" id="unitComponentEdit">Einheit</span>
                                <div class="input-group-append d-flex col-1 px-0">
                                    <button class="btn btn-outline-danger flex-fill delete-component-edit" type="button"> x </button>
                                </div>
                            </div>
                        </div>';
                        $components_meal = [];
                        $query = 'SELECT C.id AS idComponent, CM.amount AS amountComponent, U.name AS nameUnit FROM components_meals CM, db_units U, components C WHERE C.id = CM.component_id AND C.db_unit_id = U.id AND CM.meal_id="'.$_POST["meal_id"].'"';
                        $result = mysqli_query($connect, $query);
                        while($row = mysqli_fetch_array($result))
                        {
                            array_push($components_meal, [$row['idComponent'], $row['amountComponent'], $row['nameUnit']]);
                        }
                        $count = 1;
                        foreach($components_meal as $component_meal)
                        {
                            $output .='
                            <div class="form-row mt-2 dynamic-component-edit" style="display:block">
                                <div class="input-group col-12">
                                    <select id="selectComponentEdit'.$count.'" name="components[]" class="form-control col-5 selectComponentEdit" onchange="changeUnitEditComponent('.$count.')" required>';
                                    foreach($components as $component)
                                    {
                                        if($component[0] == $component_meal[0])
                                        {
                                            $output .= '<option value="'.$component[0].'" data-cc-unit="'.$component[3].'" selected>'.$component[1].'</option>';
                                        }
                                        else 
                                        {
                                            $output .= '<option value="'.$component[0].'" data-cc-unit="'.$component[3].'">'.$component[1].'</option>';
                                        }
                                    }
                                    $output .='
                                    </select>
                                    <input type="number" min="0" class="form-control col-3" name="amounts[]" value="'.$component_meal[1].'">
                                    <span class="form-control unitComponentEdit col-3" id="unitComponentEdit'.$count.'">'.$component_meal[2].'</span>
                                    <div class="input-group-append d-flex col-1 px-0">
                                        <button class="btn btn-outline-danger flex-fill delete-component-edit" type="button"> x </button>
                                    </div>
                                </div>
                            </div>';
                            $count++;
                        }
                    $output .= '
                    </div>
                </div>
                <input type="button" name="previous" class="previous btn btn-secondary" value="Zurück" />
                <input type="button" name="next" class="next btn btn-primary float-right" value="Weiter" />
            </fieldset>';
            //Page III
            $output .='
            <fieldset class="fieldsetEditMeal">
                <h2>Rezept</h2>
                <textarea name="recipe" cols="50" rows="5" class="mb-2 form-control" form="editMealForm">';
                $query = 'SELECT recipe FROM meals M WHERE M.id="'.$_POST["meal_id"].'"';
                $result = mysqli_query($connect, $query);
                while($row = mysqli_fetch_array($result))
                {   
                    $output .= $row['recipe'];
                }
                $output .= '
                </textarea>
                <input type="button" name="previous" class="previous btn btn-secondary" value="Zurück" />
                <button type="submit" class="btn btn-primary float-right">
                    Speichern
                </button>
            </fieldset>
        </div>';
        echo $output;
    }
?>
<script>
    var url = "/js/functions.js";
    $.getScript(url);
</script>