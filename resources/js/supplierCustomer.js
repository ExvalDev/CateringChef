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

//------------------------------- Supplier -------------------------------
    // Show Supplier
    $('.showSupplierButton').click(function(){
      let supplierId = $(this).attr("id");
      $.get('supplier/'+ supplierId, function (supplier) {
          $('#showName').text(supplier.name);
          $('#showPostcode').text(supplier.postcode);
          $('#showPlace').text(supplier.place);
          $('#showStreet').text(supplier.street);
          $('#showHouse_number').text(supplier.house_number);
          $('#showSupplierModal').modal('show');
      })
  });

  // edit Supplier
  $('.editSupplierButton').click(function(){
    let supplierId = $(this).attr("id");
    $.get('supplier/'+ supplierId + '/edit', function (supplier) {
        console.log(supplier);
        $('#editSupplierForm').attr('action', '/supplier/'+supplierId);
        $('#editName').val(supplier.name);
        $('#editPostcode').val(supplier.postcode);
        $('#editPlace').val(supplier.place);
        $('#editStreet').val(supplier.street);
        $('#editHouse_number').val(supplier.house_number);
        $('#editSupplierModal').modal('show');
    })
  });

  //Delete Supplier
  $('.deleteSupplierButton').click(function(){
      var supplier_id = $(this).attr("id");
      $('#deleteSupplierForm').attr('action', '/supplier/'+supplier_id);
      $('#deleteSupplierModal').modal("show");
  });
});