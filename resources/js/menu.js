
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
  ev.preventDefault();
  let courseCount = ev.currentTarget.getAttribute('data-courseCount');
  let dataId = ev.dataTransfer.getData("text");
  const meal = $(document.getElementById(dataId));
  let allergenes = meal.data('allergenes');
  if (meal.data('name') != undefined) {
    let outputMenu = htmlToElement(`<div class="course text-align-center bg-light p-2 rounded-lg mb-2 mx-1" id="menu_${dataId}" draggable='true' ondragstart='drag(event)'> ${meal.data('name')} <br>`+
        allergenes
        +`</div>`);
  switch (courseCount) {
    case '0':
      ev.currentTarget.prepend(outputMenu);
      ev.currentTarget.setAttribute('data-courseCount','1');
      ev.target.removeAttribute('class');
      ev.target.setAttribute('class','oneMoreCourse rounded-lg mb-2 mx-1');
      break;
  
    case '1':
      if (ev.target.getAttribute('class') == 'oneMoreCourse rounded-lg mb-2 mx-1') {
        ev.currentTarget.append(outputMenu);
        ev.currentTarget.setAttribute('data-courseCount','2');
        ev.target.removeAttribute('class');
        ev.target.setAttribute('class','noMoreCourse');
      }
      
      break;
    case '2':
      alert('Es sind bereits zwei Speisen in dem Tag vorhanden.')
  }
  


  /* Insert to Database */
  }
  
}

function deleteMenu(ev) {
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
  
  
  /* delete in Database */
  menuDiv.parentNode.removeChild(menuDiv);
  
}
