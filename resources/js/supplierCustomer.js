$(function () {
     
  /* $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  }); */

  // Show Customer
  $('.showCustomerButton').click(function(){
      let customerId = $(this).attr("id");
      $.get('customer/'+ customerId, function (customer) {
          $('#showName').text(customer.name);
          $('#showPostcode').text(customer.postcode);
          $('#showPlace').text(customer.place);
          $('#showStreet').text(customer.street);
          $('#showHouse_number').text(customer.house_number);
          $('#showAdults').val(customer.adults);
          $('#showChildrens').val(customer.childrens);
          $('#showCustomerModal').modal('show');
      })
  });

  // edit Customer
  $('.editCustomerButton').click(function(){
    let customerId = $(this).attr("id");
    $.get('customer/'+ customerId + '/edit', function (customer) {
        console.log(customer);
        $('#editCustomerForm').attr('action', '/customer/'+customerId);
        $('#editName').val(customer.name);
        $('#editPostcode').val(customer.postcode);
        $('#editPlace').val(customer.place);
        $('#editStreet').val(customer.street);
        $('#editHouse_number').val(customer.house_number);
        $('#editAdults').val(customer.adults);
        $('#editChildrens').val(customer.childrens);
        $('#editCustomerModal').modal('show');
    })
  });

  //Delete Customer
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



