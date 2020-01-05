//Search Ingredient
$(document).ready(function(){
    $("#SearchIngredient").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#ListIngredient li").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});

//Show Ingredient
$(document).ready(function() {
    $('.showingredientbutton').on('click', function() {
        $('#showingredientmodal').modal('show');
    });
}); 
