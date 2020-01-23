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

//Search Customers
$(document).ready(function()
{
    $("#SearchCustomer").on("keyup", function() 
    {
        // Declare variables
        var filter, tableBody, tRow, Item, i, txtValue;
        filter = $(this).val().toLowerCase();
        tableBody = document.getElementById("TableCustomer");
        tRow = tableBody.getElementsByTagName('tr');
        
        // Loop through all list items, and hide those who don't match the search query
        for (i = 0; i < tRow.length; i++) 
        {
            Item = tRow[i].getElementsByClassName('searchItem')[0];
            txtValue = Item.innerText;
            if (txtValue.toLowerCase().indexOf(filter) > -1) 
            {
                tRow[i].style.display = "";
            } 
            else 
            {
                tRow[i].setAttribute('style', 'display: none !important');
            }
        }
    });
});

//Search Customers
$(document).ready(function()
{
    $("#SearchSupplier").on("keyup", function() 
    {
        // Declare variables
        var filter, tableBody, tRow, Item, i, txtValue;
        filter = $(this).val().toLowerCase();
        tableBody = document.getElementById("TableSupplier");
        tRow = tableBody.getElementsByTagName('tr');
        
        // Loop through all list items, and hide those who don't match the search query
        for (i = 0; i < tRow.length; i++) 
        {
            Item = tRow[i].getElementsByClassName('searchItem')[0];
            txtValue = Item.innerText;
            if (txtValue.toLowerCase().indexOf(filter) > -1) 
            {
                tRow[i].style.display = "";
            } 
            else 
            {
                tRow[i].setAttribute('style', 'display: none !important');
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

//Delete Ingredient
$(document).ready(function(){
    $('.deleteIngredientButton').click(function(){
        var ingredient_id = $(this).attr("id");
        $('#deleteIngredientForm').attr('action', '/ingredient/'+ingredient_id);
        $('#deleteIngredientModal').modal("show");
    });
});

//ADD Component -> Dynamic Form
let count = 0;
$('.add-one').click(function(){
    var row = $('.dynamic-element').first().clone();
    count++;
    $('[id^=selectIngredient]').last().attr('id', 'selectIngredient'+count);
    $('[id^=unitIngredient]').last().attr('id', 'unitIngredient'+count);
    row.appendTo('.dynamic-stuff').show();
    attach_delete();
  });//Clone the hidden element and shows it
  
  function attach_delete(){
    $('.delete').off();
    $('.delete').click(function(){
      $(this).closest('.form-group').remove();
    });
  }//Attach functionality to delete buttons

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

//Edit Component
$(document).ready(function(){
    $('.editComponentButton').click(function(){
         var component_id = $(this).attr("id");
         $.ajax({
              url:"http://127.0.0.1:8000/php/editComponent.blade.php",
              method:"post",
              data:{component_id:component_id},
              success:function(data)
              {
                $('#editComponentForm').attr('action', '/component/'+component_id);
                $('#editComponent').html(data);
                $('#editComponentModal').modal("show");
              }
         });
    });
});

//Delete Ingredient
$(document).ready(function(){
    $('.deleteComponentButton').click(function(){
        var component_id = $(this).attr("id");
        $('#deleteComponentForm').attr('action', '/component/'+component_id);
        $('#deleteComponentModal').modal("show");
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



//Show Meal
$(document).ready(function(){
    $('.showMealButton').click(function(){
         var meal_id = $(this).attr("id");
         $.ajax({
              url:"http://127.0.0.1:8000/php/showMeal.blade.php",
              method:"post",
              data:{meal_id:meal_id},
              success:function(data){
                   $('#showMeal').html(data);
                   $('#showMealModal').modal("show");
              }
         });
    });
});

//Delete Meal
$(document).ready(function(){
    $('.deleteMealButton').click(function(){
        var meal_id = $(this).attr("id");
        $('#deleteMealForm').attr('action', '/meal/'+meal_id);
        $('#deleteMealModal').modal("show");
    });
});

//Show Coustomer
$(document).ready(function(){
    $('.showCustomerButton').click(function(){
         var customer_id = $(this).attr("id");
         $.ajax({
              url:"http://127.0.0.1:8000/php/showCustomer.blade.php",
              method:"post",
              data:{customer_id:customer_id},
              success:function(data){
                   $('#showCustomer').html(data);
                   $('#showCustomerModal').modal("show");
              }
         });
    });
});

//Edit Customer
$(document).ready(function(){
    $('.editCustomerButton').click(function(){
         var customer_id = $(this).attr("id");
         $.ajax({
              url:"http://127.0.0.1:8000/php/editCustomer.blade.php",
              method:"post",
              data:{customer_id:customer_id},
              success:function(data)
              {
                $('#editCustomerForm').attr('action', '/customer/'+customer_id);
                $('#editCustomer').html(data);
                $('#editCustomerModal').modal("show");
              }
         });
    });
});

//Delete Customer
$(document).ready(function(){
    $('.deleteCustomerButton').click(function(){
        var customer_id = $(this).attr("id");
        $('#deleteCustomerForm').attr('action', '/customer/'+customer_id);
        $('#deleteCustomerModal').modal("show");
    });
});

//Show Supplier
$(document).ready(function(){
    $('.showSupplierButton').click(function(){
         var supplier_id = $(this).attr("id");
         $.ajax({
              url:"http://127.0.0.1:8000/php/showSupplier.blade.php",
              method:"post",
              data:{supplier_id:supplier_id},
              success:function(data){
                   $('#showSupplier').html(data);
                   $('#showSupplierModal').modal("show");
              }
         });
    });
});

//Edit Supplier
$(document).ready(function(){
    $('.editSupplierButton').click(function(){
         var supplier_id = $(this).attr("id");
         $.ajax({
              url:"http://127.0.0.1:8000/php/editSupplier.blade.php",
              method:"post",
              data:{supplier_id:supplier_id},
              success:function(data)
              {
                $('#editSupplierForm').attr('action', '/supplier/'+supplier_id);
                $('#editSupplier').html(data);
                $('#editSupplierModal').modal("show");
              }
         });
    });
});

//Delete Supplier
$(document).ready(function(){
    $('.deleteSupplierButton').click(function(){
        var supplier_id = $(this).attr("id");
        $('#deleteSupplierForm').attr('action', '/supplier/'+supplier_id);
        $('#deleteSupplierModal').modal("show");
    });
});