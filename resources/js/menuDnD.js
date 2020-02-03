function htmlToElement(html) {
  var template = document.createElement('template');
  html = html.trim(); // Never return a text node of whitespace as the result
  template.innerHTML = html;
  return template.content.firstChild;
}

function prependMainCourse(ev) {
  let dataId = ev.dataTransfer.getData("text");
  const meal = $(document.getElementById(dataId));
  let allergenes = meal.data('allergenes');
  let outputMenu = htmlToElement(`<div class="course text-align-center bg-light p-2 rounded-lg mb-2 mx-1"> ${meal.data('name')} <br>`+
    allergenes
    
    +`</div>`);
  console.log(ev.currentTarget);
  ev.currentTarget.prepend(outputMenu);
}

function allowDrop(ev) {
  ev.preventDefault();
}

function drag(ev) {
  ev.dataTransfer.setData("text", ev.target.id);
}

function copy(ev) {
  ev.preventDefault();
  
  /* allergenes = allergenes.split(",");
  console.log(allergenes); */
  let courseCount = ev.currentTarget.getAttribute('data-courseCount');
  console.log(courseCount);
  switch (courseCount) {
    case '0':
      prependMainCourse(ev);
      ev.currentTarget.setAttribute('data-courseCount','1');
      ev.target.removeAttribute('class');
      ev.target.setAttribute('class','oneMoreCourse rounded-lg mb-2 mx-1');
      break;
  
    case '1':
      prependMainCourse(ev);
      ev.currentTarget.setAttribute('data-courseCount','2');
      ev.target.removeAttribute('class');
      ev.target.setAttribute('class','noMoreCourse');
      break;
    case '2':
      alert('Es sind bereits zwei Speisen in dem Tag vorhanden.')
  }
  


  /* Insert to Database */
}