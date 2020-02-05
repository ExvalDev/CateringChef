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
                $('#editSupplierIngredient').val(ingredient.supplier.name);
            }
            document.getElementById("editUnit"+ingredient.db_unit_id).selected = true;
            $('#editIngredientModal').modal('show');
        })
    });
});

//Delete Ingredient
$(document).ready(function(){
    $('.deleteIngredientButton').click(function(){
        var ingredient_id = $(this).attr("id");
        $('#deleteIngredientForm').attr('action', '/ingredient/'+ingredient_id);
        $('#deleteIngredientModal').modal("show");
    });
});

//------------------------------- Components -------------------------------

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
            let ingredientsHTML ="";
            ingredients.forEach(ingredient =>{
                ingredientsHTML += `<span> ${ingredient[0]}</span> <span> ${ingredient[1]} ${ingredient[2]}</span> <br>`
            });
            $('#showIngredientsComponent').html(ingredientsHTML);
            $('#showRecipeComponent').text(component.recipe);
            $('#showComponentModal').modal('show');
        })
    });
});