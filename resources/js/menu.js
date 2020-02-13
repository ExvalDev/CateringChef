

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
            let outputMenu = htmlToElement(`<div class="course text-align-center bg-light p-2 rounded-lg mb-2 mx-1" id="menuMeal_${menuMeal.id}" draggable='true' ondragstart='drag(event)'> ${meal.data('name')} <br>`+
              allergenes
            +`</div>`);
            currentTarget.prepend(outputMenu);
            currentTarget.setAttribute('data-courseCount','1');
            target.removeAttribute('class');
            target.setAttribute('class','oneMoreCourse rounded-lg mb-2 mx-1');
          });
          
          break;
      
        case '1':
          if (ev.target.getAttribute('class') == 'oneMoreCourse rounded-lg mb-2 mx-1') {
            $.post('/menu', {course: courseRow, date: courseDate, mealId: meal.data('id')}, function(menuMeal){
              let outputMenu = htmlToElement(`<div class="course text-align-center bg-light p-2 rounded-lg mb-2 mx-1" id="menuMeal_${menuMeal.id}" draggable='true' ondragstart='drag(event)'> ${meal.data('name')} <br>`+
                allergenes
              +`</div>`);
              currentTarget.append(outputMenu);
              currentTarget.setAttribute('data-courseCount','2');
              target.removeAttribute('class');
              target.setAttribute('class','noMoreCourse');
            });          
          }
          
          break;
        case '2':
          alert('Es sind bereits zwei Speisen in dem Tag vorhanden.')
      } 
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
  if (menuDiv.parentNode.getAttribute('data-courseCount') == '1'){
    menuDiv.parentNode.setAttribute('data-courseCount','0');
    menuDiv.parentNode.innerHTML= '<div class="emptyCourse rounded-lg mb-2 mx-1"></div>';
  }else if (menuDiv.parentNode.getAttribute('data-courseCount') == '2'){
    menuDiv.parentNode.setAttribute('data-courseCount','1');
    menuDiv.parentNode.append(htmlToElement('<div class="oneMoreCourse rounded-lg mb-2 mx-1"></div>'));
  }
 
  var menuMealId = id.slice(9);
  console.log(menuMealId);
  $.ajax({
    url: '/menu/'+ menuMealId,
    type: 'DELETE'
  });
  /* ,
    success: function(data) {
      //play with data
    } */
  menuDiv.parentNode.removeChild(menuDiv);
  
}
