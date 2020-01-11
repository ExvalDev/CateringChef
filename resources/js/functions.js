//Search Ingredient
$(document).ready(function()
{
    $("#SearchIngredient").on("keyup", function() 
    {
        var value = $(this).val().toLowerCase();
        $("#ListIngredient li span").filter(function() 
        {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
});

//Show Ingredient
$(document).ready(function(){
    $('.showIngredientButton').click(function(){
         var ingredient_id = $(this).attr("id");
         $.ajax({
              url:"http://127.0.0.1:8000/php/showIngredient.blade.php",
              method:"post",
              data:{ingredient_id:ingredient_id},
              success:function(data){
                   $('#showIngredient').html(data);
                   $('#showIngredientModal').modal("show");
              }
         });
    });
});

//Progress Bar
$(document).ready(function(){
    var current = 1,current_step,next_step,steps;
	steps = $("fieldset").length;
	$(".next").click(function(){
		current_step = $(this).parent();
		next_step = $(this).parent().next();
		next_step.show();
		current_step.hide();
		setProgressBar(++current);
	});
	$(".previous").click(function(){
		current_step = $(this).parent();
		next_step = $(this).parent().prev();
		next_step.show();
		current_step.hide();
		setProgressBar(--current);
	});
	setProgressBar(current);
	// Change progress bar action
	function setProgressBar(curStep){
		var percent = parseFloat(100 / steps) * curStep;
        percent = percent.toFixed();
		$(".progress-bar")
			.css("width",percent+"%");
	}
});