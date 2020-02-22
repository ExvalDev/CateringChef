
$(function () {
  $('[data-toggle="popover"]').popover()
})

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