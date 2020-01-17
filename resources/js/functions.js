//Search Ingredient
$(document).ready(function()
{
    $("#SearchIngredient").on("keyup", function() 
    {
        // Declare variables
        var filter, ul, li, span, i, txtValue;
        filter = $(this).val().toLowerCase();
        ul = document.getElementById("ListIngredient");
        li = ul.getElementsByTagName('li');
        

        // Loop through all list items, and hide those who don't match the search query
        for (i = 0; i < li.length; i++) 
        {
            span = li[i].getElementsByTagName("span")[0];
            txtValue = span.innerText;
            if (txtValue.toLowerCase().indexOf(filter) > -1) 
            {
                li[i].style.display = "";
            } 
            else 
            {
                li[i].setAttribute('style', 'display: none !important');
            }
        }
    });
});

//Search Component
$(document).ready(function()
{
    $("#SearchComponent").on("keyup", function() 
    {
        // Declare variables
        var filter, ul, li, span, i, txtValue;
        filter = $(this).val().toLowerCase();
        ul = document.getElementById("ListComponent");
        li = ul.getElementsByTagName('li');
        

        // Loop through all list items, and hide those who don't match the search query
        for (i = 0; i < li.length; i++) 
        {
            span = li[i].getElementsByTagName("span")[0];
            txtValue = span.innerText;
            if (txtValue.toLowerCase().indexOf(filter) > -1) 
            {
                li[i].style.display = "";
            } 
            else 
            {
                li[i].setAttribute('style', 'display: none !important');
            }
        }
    });
});

//Search Meal
$(document).ready(function()
{
    $("#SearchMeal").on("keyup", function() 
    {
        // Declare variables
        var filter, ul, li, span, i, txtValue;
        filter = $(this).val().toLowerCase();
        ul = document.getElementById("ListMeal");
        li = ul.getElementsByTagName('li');
        

        // Loop through all list items, and hide those who don't match the search query
        for (i = 0; i < li.length; i++) 
        {
            span = li[i].getElementsByTagName("span")[0];
            txtValue = span.innerText;
            if (txtValue.toLowerCase().indexOf(filter) > -1) 
            {
                li[i].style.display = "";
            } 
            else 
            {
                li[i].setAttribute('style', 'display: none !important');
            }
        }
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

//Edit Ingredient
$(document).ready(function(){
    $('.editIngredientButton').click(function(){
         var ingredient_id = $(this).attr("id");
         $.ajax({
              url:"http://127.0.0.1:8000/php/editIngredient.blade.php",
              method:"post",
              data:{ingredient_id:ingredient_id},
              success:function(data)
              {
                $('#editIngredientForm').attr('action', '/ingredient/'+ingredient_id);
                $('#editIngredient').html(data);
                $('#editIngredientModal').modal("show");
              }
         });
    });
});

//Show Component
$(document).ready(function(){
    $('.showComponentButton').click(function(){
         var component_id = $(this).attr("id");
         $.ajax({
              url:"http://127.0.0.1:8000/php/showComponent.blade.php",
              method:"post",
              data:{component_id:component_id},
              success:function(data){
                   $('#showComponent').html(data);
                   $('#showComponentModal').modal("show");
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