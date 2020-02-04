//------------------------------- Ingredient -------------------------------

//Show Ingredient
$(document).ready(function(){
    $('.showIngredientButton').click(function(){
         var ingredient_id = $(this).attr("id");
         $.ajax({
              url:"/php/showIngredient.blade.php",
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
              url:"/php/editIngredient.blade.php",
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

//------------------------------- Component -------------------------------

//ADD Component -> Dynamic Form
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
$(document).ready(function(){
    $('.showComponentButton').click(function(){
         var component_id = $(this).attr("id");
         $.ajax({
              url:"/php/showComponent.blade.php",
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
              url:"/php/editComponent.blade.php",
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

//Edit Component -> Dynamic Form
$('.edit-ingredient').click(function(){
    var row = $('.dynamic-ingredient-edit').first().clone();
    row.appendTo('.dynamic-ingredient-edit-area').show();
    attach_delete_edit_ingredient();
    var parent = document.getElementById("dynamic-ingredient-edit-area");
    var count = parent.getElementsByClassName("dynamic-ingredient-edit").length-1;
    $('.selectIngredient').last().attr('id', 'selectIngredient'+count);
    $('.selectIngredient').last().attr('onchange', 'changeUnit('+count+')');
    $('.unitIngredient').last().attr('id', 'unitIngredient'+count);
});//Clone the hidden element and shows it
  
function attach_delete_edit_ingredient(){
    $('.delete-ingredient-edit').click(function(){
        $(this).closest('.dynamic-ingredient-edit').remove();
    });
}//Attach functionality to delete buttons

//Delete Component
$(document).ready(function(){
    $('.deleteComponentButton').click(function(){
        var component_id = $(this).attr("id");
        $('#deleteComponentForm').attr('action', '/component/'+component_id);
        $('#deleteComponentModal').modal("show");
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
  
function attach_delete_add_component(){
    $('.delete-dynamic-component').off();
    $('.delete-dynamic-component').click(function(){
        $(this).closest('.dynamic-component').remove();
    });
}//Attach functionality to delete buttons

//Show Meal
$(document).ready(function(){
    $('.showMealButton').click(function(){
         var meal_id = $(this).attr("id");
         $.ajax({
              url:"/php/showMeal.blade.php",
              method:"post",
              data:{meal_id:meal_id},
              success:function(data){
                   $('#showMeal').html(data);
                   $('#showMealModal').modal("show");
              }
         });
    });
});

//Edit Meal
$(document).ready(function(){
    $('.editMealButton').click(function(){
         var meal_id = $(this).attr("id");
         $.ajax({
              url:"/php/editMeal.blade.php",
              method:"post",
              data:{meal_id:meal_id},
              success:function(data)
              {
                console.log('test');
                $('#editMealForm').attr('action', '/meal/'+meal_id);
                $('#editMeal').html(data);
                $('#editMealModal').modal("show");
              }
         });
    });
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
    $('.delete-component-edit').click(function(){
        $(this).closest('.dynamic-component-edit').remove();
    });
}//Attach functionality to delete buttons

//Delete Meal
$(document).ready(function(){
    $('.deleteMealButton').click(function(){
        var meal_id = $(this).attr("id");
        $('#deleteMealForm').attr('action', '/meal/'+meal_id);
        $('#deleteMealModal').modal("show");
    });
});

//-------------------------------Customer -------------------------------

//Show Coustomer
$(document).ready(function(){
    $('.showCustomerButton').click(function(){
         var customer_id = $(this).attr("id");
         $.ajax({
              url:"/php/showCustomer.blade.php",
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
              url:"/php/editCustomer.blade.php",
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

//------------------------------- Supplier -------------------------------

//Show Supplier
$(document).ready(function(){
    $('.showSupplierButton').click(function(){
         var supplier_id = $(this).attr("id");
         $.ajax({
              url:"/php/showSupplier.blade.php",
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
              url:"/php/editSupplier.blade.php",
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



$(function () {
       
    /* $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }); */
    $('.showCustomerTest').click(function(){
        let customerId = $(this).attr("id");
        $.get('customer/'+ customerId +'/edit', function (customer) {
            $('#nameEdit').val(customer.name);
            
            $('#showCustomerModal').modal('show');
        })
    });
  
   
});