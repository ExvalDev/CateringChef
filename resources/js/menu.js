
function htmlToElement(html) {
  var template = document.createElement('template');
  html = html.trim(); // Never return a text node of whitespace as the result
  template.innerHTML = html;
  return template.content.firstChild;
}

function allowDrop(ev) {
  ev.preventDefault();
}

function drag(ev) {
  ev.dataTransfer.setData("text", ev.target.id);
}

function copy(ev) {
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  ev.preventDefault();
  var currentTarget = ev.currentTarget;
  var target = ev.target;
  let courseCount = currentTarget.getAttribute('data-courseCount');
  let courseRow = currentTarget.getAttribute('data-course');
  let courseDate = currentTarget.getAttribute('data-date');
  let dataId = ev.dataTransfer.getData("text");
  const meal = $(document.getElementById(dataId));
  let allergenes = meal.data('allergenes');
  if (meal.data('name') != undefined) {    
    console.log(courseRow);
    console.log(meal.data('main-course'));
    if (meal.data('main-course') == true && courseRow == 'main' || meal.data('dessert-course') == true && courseRow == 'dessert') {
      switch (courseCount) {
        case '0':
          $.post('/menu', {course: courseRow, date: courseDate, mealId: meal.data('id')}, function(menuMeal){
            let outputMenu = htmlToElement(`<div class="course text-align-center bg-light p-2 rounded-lg mb-2 mx-2" id="menuMeal_${menuMeal.id}" draggable='true' ondragstart='drag(event)'> ${meal.data('name')} <br>`+
              allergenes
            +`</div>`);
            currentTarget.prepend(outputMenu);
            currentTarget.setAttribute('data-courseCount','1');
            target.removeAttribute('class');
            target.setAttribute('class','oneMoreCourse rounded-lg mb-2 mx-2');
          });
          toastr.success("Speise wurde dem Speiseplan hinzugefügt!");
          
          break;
      
        case '1':
          if (ev.target.getAttribute('class') == 'oneMoreCourse rounded-lg mb-2 mx-2') {
            $.post('/menu', {course: courseRow, date: courseDate, mealId: meal.data('id')}, function(menuMeal){
              let outputMenu = htmlToElement(`<div class="course text-align-center bg-light p-2 rounded-lg mb-2 mx-2" id="menuMeal_${menuMeal.id}" draggable='true' ondragstart='drag(event)'> ${meal.data('name')} <br>`+
                allergenes
              +`</div>`);
              currentTarget.append(outputMenu);
              currentTarget.setAttribute('data-courseCount','2');
              target.removeAttribute('class');
              target.setAttribute('class','noMoreCourse');
            }); 
            toastr.success("Speise wurde dem Speiseplan hinzugefügt!");         
          }
          
          break;
        case '2':
          toastr.error("Es sind bereits 2 Speisen vorhanden!");
      } 
    } else {
      toastr.error("Die gewählte Speise passt nicht zum Menügang!");
    }
  } 
}

function deleteMenu(ev) {
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  ev.preventDefault();
  var id = ev.dataTransfer.getData("text");
  var menuDiv = document.getElementById(id);
  console.log(menuDiv);
  if (menuDiv.getAttribute('data-name') == undefined) {
    if (menuDiv.parentNode.getAttribute('data-courseCount') == '1'){
      menuDiv.parentNode.setAttribute('data-courseCount','0');
      menuDiv.parentNode.innerHTML= '<div class="emptyCourse rounded-lg mb-2 mx-2"></div>';
    }else if (menuDiv.parentNode.getAttribute('data-courseCount') == '2'){
      menuDiv.parentNode.setAttribute('data-courseCount','1');
      menuDiv.parentNode.append(htmlToElement('<div class="oneMoreCourse rounded-lg mb-2 mx-2"></div>'));
    }
   
    var menuMealId = id.slice(9);
    console.log(menuMealId);
    $.ajax({
      url: '/menu/'+ menuMealId,
      type: 'DELETE'
    });
    toastr.success("Speise wurde aus Speiseplan entfernt!");
    if (menuDiv.parentNode != null) {
      menuDiv.parentNode.removeChild(menuDiv);
    }
   
  } else {
    toastr.error("Speise aus Liste kann nicht entfernt werden!");
  }
  
};

//Show Meal
$(function () {
  $('.showMealButton').click(function(){
      let mealId = $(this).attr("id");
      $.get('/meal/'+ mealId, function (meal) {
          $('#showNameMeal').text(meal.name);
          let course = "";
          if(meal.main == 1)
          {
              course += "Hauptgericht, ";
          }
          if(meal.dessert == 1)
          {
              course += "Dessert, ";
          }
          $('#showCourseMeal').text("("+course.substr(0, course.length-2)+")"); 
          let components = []; 
          for(var i = 0; i < meal.components.length; i++) {
              components.push([meal.components[i].name, meal.components[i].pivot.amount, meal.components[i].db_unit])
          }
          let componentsHTML ="<table class='table table-striped table-sm mt-2'>";
          components.forEach(component =>{
              componentsHTML += `<tr><td> ${component[1]} ${component[2]}</td><td> ${component[0]}</td></tr>`
          });
          componentsHTML += "</table>";
          $('#showComponentsMeal').html(componentsHTML);
          $('#showRecipeMeal').text(meal.recipe);
          $('#showMealModal').modal('show');
      })
  });
});

//Set Customer 0
function setCustomer(id){
  $('#adults'+id).val(0);
  $('#childrens'+id).val(0);
};

//Set Customer back to Standard
function setStandardCustomer(id){
  $('#adults'+id).val($('#adults'+id).attr('data-standard'));
  $('#childrens'+id).val($('#childrens'+id).attr('data-standard'));
};


