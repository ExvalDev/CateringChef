//------------------------------- Ingredient -------------------------------

//Show Ingredient
$(function () {
    $('.showIngredientButton').click(function(){
        let ingredientId = $(this).attr("id");
        $.get('ingredient/'+ ingredientId, function (ingredient) {
            $('#showNameIngredient').text(ingredient.name);
            if(ingredient.supplier != null)
            {
                $('#showSupplierIngredient').text(ingredient.supplier.name);
            }
            else
            {
                $('#showSupplierIngredient').text('Kein Lieferant');
            }
            $('#showUnitIngredient').text(ingredient.db_unit);
            let allergenes = "";
            for(var i = 0; i < ingredient.allergenes.length; i++) {
                allergenes += ingredient.allergenes[i].name + ", ";
            }
            if (allergenes != "")
            {
                $('#showAllergenesIngredient').text(allergenes.substr(0, allergenes.length-2)); 
            }
            else
            {
                $('#showAllergenesIngredient').text('Keine Allergene');
            }
            $('#showIngredientModal').modal('show');
        })
    });
});

//Edit Ingredient
$(function () {
    $('.editIngredientButton').click(function(){
        let ingredientId = $(this).attr("id");
        $.get('ingredient/'+ ingredientId +'/edit', function (ingredient) {
            $('#editIngredientForm').attr('action', '/ingredient/'+ingredientId);
            $('#editNameIngredient').val(ingredient.name);
            ingredient.allergenes.forEach(allergene =>{
                document.getElementById("edit"+allergene.name).checked = true;
            });
            if(ingredient.supplier != null)
            {
                document.getElementById("editSupplierIngredient"+ingredient.supplier_id).selected = true;
            }
            document.getElementById("editUnitIngredient"+ingredient.db_unit_id).selected = true;
            $('#editIngredientModal').modal('show');
        })
    });
});

//Delete Ingredient
$(document).ready(function(){
    $('.deleteIngredientButton').click(function(){
        let ingredientId = $(this).attr("id");
        $.get('ingredient/'+ ingredientId, function (ingredient) {
            $('#deleteIngredientForm').attr('action', '/ingredient/'+ingredientId);
            $('#deleteNameIngredient').text(ingredient.name);
            $('#deleteIngredientModal').modal("show");
        });
        
    });
});

//------------------------------- Component -------------------------------

//Add Component (ADD Ingredient -> Add Component Dynamic Form)
$('.add-ingredient').click(function(){
    var row = $('.dynamic-ingredient').first().clone();
    row.appendTo('.dynamic-ingredient-area').show();
    attach_delete_add_ingredient();
    var parent = document.getElementById("dynamic-ingredient-area");
    var count = parent.getElementsByClassName("dynamic-ingredient").length-1;
    $('.selectIngredientAdd').last().attr('id', 'selectIngredientAdd'+count);
    $('.selectIngredientAdd').last().attr('onchange', 'changeUnitAddIngredient('+count+')');
    $('.unitIngredientAdd').last().attr('id', 'unitIngredientAdd'+count);
});//Clone the hidden element and shows it
  
function attach_delete_add_ingredient(){
    $('.delete-dynamic-ingredient').off();
    $('.delete-dynamic-ingredient').click(function(){
        $(this).closest('.dynamic-ingredient').remove();
    });
}//Attach functionality to delete buttons

//Show Component
$(function () {
    $('.showComponentButton').click(function(){
        let componentId = $(this).attr("id");
        $.get('component/'+ componentId, function (component) {
            $('#showNameComponent').text(component.name);
            $('#showAmountComponent').text(component.amount);
            $('#showUnitComponent').text(component.db_unit);
            let ingredients = []; 
            for(var i = 0; i < component.ingredients.length; i++) {
                ingredients.push([component.ingredients[i].name, component.ingredients[i].pivot.amount, component.ingredients[i].db_unit])
            }
            let ingredientsHTML ="<table class='table table-striped table-sm mt-2'>";
            ingredients.forEach(ingredient =>{
                ingredientsHTML += `<tr><td> ${ingredient[1]} ${ingredient[2]}</td><td> ${ingredient[0]}</td></tr>`
            });
            ingredientsHTML += "</table>";
            $('#showIngredientsComponent').html(ingredientsHTML);
            $('#showRecipeComponent').text(component.recipe);
            $('#showComponentModal').modal('show');
        })
    });
});

//Edit Component
$(function () 
{
    $('.editComponentButton').click(function()
    {
        let componentId = $(this).attr("id");
        $.get('component/'+ componentId+'/edit', function (component) 
        {
            $('#editComponentForm').attr('action', '/component/'+componentId);
            $('#editNameComponent').val(component.name);
            $('#editAmountComponent').val(component.amount);
            document.getElementById("editUnitComponent"+component.db_unit_id).selected = true;
            var allIngredientsArray = new Array();
            $.get('ingredient', function (allIngredients) 
            {
                allIngredients.forEach(allIngredient =>{
                    allIngredientsArray.push(allIngredient);
                });
                console.log(allIngredientsArray);
                let count = 1;
                var editIngredientsHTML = "";
                component.ingredients.forEach(ingredient =>
                {
                    editIngredientsHTML += `
                    <div class="form-row mt-2 dynamic-ingredient-edit" style="display:block">
                        <div class="input-group col-12">
                            <select id="selectIngredientEdit${count}" name="editIngredients[]" class="form-control col-5 selectIngredientEdit" onchange="changeUnitEditIngredient(${count})" required>
                    `;
                    allIngredientsArray.forEach(allIngredientArray =>
                    {
                        if(ingredient.id == allIngredientArray.id)
                        {
                            editIngredientsHTML += `<option id="editIngredientComponent${allIngredientArray.id}" value="${allIngredientArray.id}" data-cc-unit="${allIngredientArray.db_unit}" selected>${allIngredientArray.name}</option>`;
                        } 
                        else
                        {
                            editIngredientsHTML += `<option id="editIngredientComponent${allIngredientArray.id}" value="${allIngredientArray.id}" data-cc-unit="${allIngredientArray.db_unit}">${allIngredientArray.name}</option>`;
                        }
                    });
                    editIngredientsHTML += `
                            </select>
                            <input type="number" min="0" class="form-control col-3" name="editAmounts[]" value="${ingredient.pivot.amount}">
                            <span class="form-control unitIngredientEdit col-3" id="unitIngredientEdit${count}">${ingredient.db_unit}</span>
                            <div class="input-group-append d-flex col-1 px-0">
                                <button class="btn btn-outline-danger flex-fill delete-dynamic-ingredient-edit" type="button"> x </button>
                            </div>
                        </div>
                    </div>
                    `;
                    count++;
                });
                $('#editIngredientDynamicElement').html(editIngredientsHTML);   
                $('#editRecipeComponent').text(component.recipe);
                $('#editComponentModal').modal('show');
            });
        })
    });
});

//Add Ingredient -> Edit Component Dynamic Form
$('.edit-ingredient').click(function(){
    var row = $('.dynamic-ingredient-edit').first().clone();
    row.appendTo('.dynamic-ingredient-edit-area').show();
    attach_delete_edit_ingredient();
    var parent = document.getElementById("dynamic-ingredient-edit-area");
    var count = parent.getElementsByClassName("dynamic-ingredient-edit").length-1;
    $('.selectIngredientEdit').last().attr('id', 'selectIngredientEdit'+count);
    $('.selectIngredientEdit').last().attr('onchange', 'changeUnitEditIngredient('+count+')');
    $('.unitIngredientEdit').last().attr('id', 'unitIngredientEdit'+count);
});//Clone the hidden element and shows it
  
function attach_delete_edit_ingredient(){
    $('.delete-dynamic-ingredient-edit').click(function(){
        $(this).closest('.dynamic-ingredient-edit').remove();
    });
}//Attach functionality to delete buttons

//Delete Component
$(document).ready(function(){
    $('.deleteComponentButton').click(function(){
        let componentId = $(this).attr("id");
        $.get('component/'+ componentId, function (component) {
            $('#deleteComponentForm').attr('action', '/component/'+componentId);
            $('#deleteNameComponent').text(component.name);
            $('#deleteComponentModal').modal("show");
        });
        
    });
});

//------------------------------- Meal -------------------------------

//ADD Meal -> Dynamic Form
$('.add-component').click(function(){
    var row = $('.dynamic-component').first().clone();
    row.appendTo('.dynamic-component-area').show();
    attach_delete_add_component();
    var parent = document.getElementById("dynamic-component-area");
    var count = parent.getElementsByClassName("dynamic-component").length-1;
    $('.selectComponentAdd').last().attr('id', 'selectComponentAdd'+count);
    $('.selectComponentAdd').last().attr('onchange', 'changeUnitAddComponent('+count+')');
    $('.unitComponentAdd').last().attr('id', 'unitComponentAdd'+count);
});//Clone the hidden element and shows it

//ADD Meal -> Main Course Checkbox
$("#mainCourse").on('change', function() {
    if ($(this).is(':checked')) {
      $(this).attr('value', 'true');
    } else {
      $(this).attr('value', 'false');
    }
});

//ADD Meal -> Dessert Course Checkbox
$("#dessertCourse").on('change', function() {
    if ($(this).is(':checked')) {
      $(this).attr('value', 'true');
    } else {
      $(this).attr('value', 'false');
    }
});

  
function attach_delete_add_component(){
    $('.delete-dynamic-component').off();
    $('.delete-dynamic-component').click(function(){
        $(this).closest('.dynamic-component').remove();
    });
}//Attach functionality to delete buttons

//Show Meal
$(function () {
    $('.showMealButton').click(function(){
        let mealId = $(this).attr("id");
        $.get('meal/'+ mealId, function (meal) {
            $('#showNameMeal').text(meal.name);
            let course = "";
            if(meal.main == 1)
            {
                course += "Hauptgericht, ";
            }
            if(meal.dessert == 1)
            {
                course += "Dessert, ";
            }
            $('#showCourseMeal').text("("+course.substr(0, course.length-2)+")"); 
            let components = []; 
            for(var i = 0; i < meal.components.length; i++) {
                components.push([meal.components[i].name, meal.components[i].pivot.amount, meal.components[i].db_unit])
            }
            let componentsHTML ="<table class='table table-striped table-sm mt-2'>";
            components.forEach(component =>{
                componentsHTML += `<tr><td> ${component[1]} ${component[2]}</td><td> ${component[0]}</td></tr>`
            });
            componentsHTML += "</table>";
            $('#showComponentsMeal').html(componentsHTML);
            $('#showRecipeMeal').text(meal.recipe);
            $('#showMealModal').modal('show');
        })
    });
});

//Edit Meal
$(function () 
{
    $('.editMealButton').click(function()
    {
        let mealId = $(this).attr("id");
        $.get('meal/'+ mealId+'/edit', function (meal) 
        {
            $('#editMealForm').attr('action', '/meal/'+mealId);
            $('#editNameMeal').val(meal.name);
            if(meal.main == 1)
            {
                document.getElementById("editMainCourse").checked = true;
                $('#editMainCourse').attr('value', 'true');
            }
            if(meal.dessert == 1)
            {
                document.getElementById("editDessertCourse").checked = true;
                $('#editDessertCourse').attr('value', 'true');
            }
            var allComponentsArray = new Array();
            $.get('component', function (allComponents) 
            {
                allComponents.forEach(allComponent =>{
                    allComponentsArray.push(allComponent);
                });
                let count = 1;
                var editComponentsHTML = "";
                meal.components.forEach(component =>
                {
                    editComponentsHTML += `
                    <div class="form-row mt-2 dynamic-component-edit" style="display:block">
                        <div class="input-group col-12">
                            <select id="selectComponentEdit${count}" name="editComponents[]" class="form-control col-5 selectComponentEdit" onchange="changeUnitEditComponent(${count})" required>
                    `;
                    allComponentsArray.forEach(allComponentArray =>
                    {
                        if(component.id == allComponentArray.id)
                        {
                            editComponentsHTML += `<option id="editIngredientComponent${allComponentArray.id}" value="${allComponentArray.id}" data-cc-unit="${allComponentArray.db_unit}" selected>${allComponentArray.name}</option>`;
                        } 
                        else
                        {
                            editComponentsHTML += `<option id="editIngredientComponent${allComponentArray.id}" value="${allComponentArray.id}" data-cc-unit="${allComponentArray.db_unit}">${allComponentArray.name}</option>`;
                        }
                    });
                    editComponentsHTML += `
                            </select>
                            <input type="number" min="0" class="form-control col-3" name="editAmounts[]" value="${component.pivot.amount}">
                            <span class="form-control unitComponentEdit col-3" id="unitComponentEdit${count}">${component.db_unit}</span>
                            <div class="input-group-append d-flex col-1 px-0">
                                <button class="btn btn-outline-danger flex-fill delete-dynamic-component-edit" type="button"> x </button>
                            </div>
                        </div>
                    </div>
                    `;
                    count++;
                });
                $('#editComponentDynamicElement').html(editComponentsHTML);   
                $('#editRecipeMeal').text(meal.recipe);
                $('#editMealModal').modal('show');
            });
        })
    });
});

//ADD Meal -> Main Course Checkbox
$("#editMainCourse").on('change', function() {
    if ($(this).is(':checked')) {
      $(this).attr('value', 'true');
    } else {
      $(this).attr('value', 'false');
    }
});

//ADD Meal -> Dessert Course Checkbox
$("#editDessertCourse").on('change', function() {
    if ($(this).is(':checked')) {
      $(this).attr('value', 'true');
    } else {
      $(this).attr('value', 'false');
    }
});

//Edit Meal -> Dynamic Form
$('.edit-component').click(function(){
    var row = $('.dynamic-component-edit').first().clone();
    row.appendTo('.dynamic-component-edit-area').show();
    attach_delete_edit_component();
    var parent = document.getElementById("dynamic-component-edit-area");
    var count = parent.getElementsByClassName("dynamic-component-edit").length-1;
    $('.selectComponentEdit').last().attr('id', 'selectComponentEdit'+count);
    $('.selectComponentEdit').last().attr('onchange', 'changeUnitEditComponent('+count+')');
    $('.unitComponentEdit').last().attr('id', 'unitComponentEdit'+count);
});//Clone the hidden element and shows it
  
function attach_delete_edit_component(){
    $('.delete-dynamic-component-edit').click(function(){
        $(this).closest('.dynamic-component-edit').remove();
    });
}//Attach functionality to delete buttons

//Delete Meal
$(document).ready(function(){
    $('.deleteMealButton').click(function(){
        let mealId = $(this).attr("id");
        $.get('meal/'+ mealId, function (meal) {
        $('#deleteMealForm').attr('action', '/meal/'+mealId);
        $('#deleteNameMeal').text(meal.name);
        $('#deleteMealModal').modal("show");
        });
    });
});

//------------------------------- Progress Bar -------------------------------

//Progress Bar
$(document).ready(function(){
    //Hide the Elements
    var firstComponentEdit = $(".fieldsetComponent");
    firstComponentEdit.next().hide();
    firstComponentEdit.next().next().hide();
    var firstMealAdd = $(".fieldsetAddMeal");
    firstMealAdd.next().hide();
    firstMealAdd.next().next().hide();
    var firstMealEdit = $(".fieldsetEditMeal");
    firstMealEdit.next().hide();
    firstMealEdit.next().next().hide();
    var current = 1,current_step,next_step,steps;
	steps = $("fieldset").length;
	$(".next").click(function(){
		current_step = $(this).parent();
		next_step = $(this).parent().next();
		next_step.show();
        current_step.hide();
        //activate next step on progressbar using the index of next_fs
        $("#progressbar li").eq($("fieldset").index(next_step)).addClass("active");
	});
	$(".previous").click(function(){
		current_step = $(this).parent();
		next_step = $(this).parent().prev();
		next_step.show();
		current_step.hide();
		//de-activate current step on progressbar
        $("#progressbar li").eq($("fieldset").index(current_step)).removeClass("active");
	});
});