
/**
 *Search in a List by input
 * @param {String} inputField - id of the Field where search input ('#id')
 * @param {String} listName - id of ul where the span will be searched for ('id')
 */
function searchInUl(inputField, listName){
    $(inputField).on("keyup", function() 
    {
        // Declare variables
        var filter, ul, li, span, i, txtValue;
        filter = $(this).val().toLowerCase();
        ul = document.getElementById(listName);
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
}

/**
 * Search in a table by input
 * @param {String} inputField - id of the Field where search input ('#id')
 * @param {String} listName - id of tablebody where the text will be searched for ('id')
 */
function searchInTable(inputField, tableName){
    $(inputField).on("keyup", function() 
    {
        // Declare variables
        var filter, tableBody, tRow, Item, i, txtValue;
        filter = $(this).val().toLowerCase();
        tableBody = document.getElementById(tableName);
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
}

// Search on Table View
$(document).ready(function()
{
    //Search Ingredient
    searchInUl("#SearchIngredient","ListIngredient");
    //Search Component
    searchInUl("#SearchComponent","ListComponent");
    //Search Meal
    searchInUl("#SearchMeal","ListMeal");
    
});

// Search on Customer & Suppliers View
$(document).ready(function()
{
    //Search Customers
    searchInTable("#SearchCustomer", "TableCustomer");
    //Search Suppliers
    searchInTable("#SearchSupplier", "TableSupplier");
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
$('.add-one').click(function(){
    var row = $('.dynamic-element').first().clone();
    row.appendTo('.dynamic-stuff').show();
    attach_delete();
    var parent = document.getElementById("dynamic-stuff");
    var count = parent.getElementsByClassName("dynamic-element").length-1;
    console.log(count);
    $('.selectIngredient').last().attr('id', 'selectIngredient'+count);
    $('.selectIngredient').last().attr('onchange', 'changeUnit('+count+')');
    $('.unitIngredient').last().attr('id', 'unitIngredient'+count);
});//Clone the hidden element and shows it
  
function attach_delete(){
    $('.delete').off();
    $('.delete').click(function(){
        $(this).closest('.dynamic-element').remove();
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