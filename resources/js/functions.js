$(document).ready(function(){
    $("#SearchIngredient").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#ListIngredient li").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});

