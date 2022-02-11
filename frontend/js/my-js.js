// Swiper slider initialization
// Popup functions

function checkModal(){
  const date = new Date();
  date.setTime(date.getTime() + (1*24*60*60*1000));
  let expires = "expires="+ date.toUTCString();
  document.cookie = "sawModal=true;"+expires;
}

function getCookie(cname) {
  let name = cname + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(';');
  for(let i = 0; i <ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function openModal(popupId) {
  let popup = document.getElementById(popupId);
  popup.style.display = 'block';
}

function closeModal(popupId) {
  let popup = document.getElementById(popupId);
  popup.style.display = 'none';
}

var backgroundImageUrl;

function previewFile() {
  var preview = document.querySelector('img#preview');
  var backgroundImg = document.querySelector('#background-img');
  var file    = document.querySelector('#backgroundImageUrl').files[0];
  var reader  = new FileReader();

  reader.onloadend = function () {
    backgroundImg.value = reader.result;
    preview.src = reader.result;
  }

  if (file) {
    reader.readAsDataURL(file);
  } else {
    preview.src = "";
  }
}

function previewFileUser() {
  var preview = document.querySelector('img#previewUser');
  var backgroundImg = document.querySelector('#background-img-user');
  var file    = document.querySelector('#user_img').files[0];
  var reader  = new FileReader();

  reader.onloadend = function () {
    backgroundImg.value = reader.result;
    preview.src = reader.result;
  }

  if (file) {
    reader.readAsDataURL(file);
  } else {
    preview.src = "";
  }
}


function createCourse(){
  var request = new XMLHttpRequest();

  request.open('POST','http://localhost:9001/api/courses');

  request.onload = function(){
    if(request.status >= 200 && request.status <400){
      alert('Curso cadastrado');
      location.reload();  
    }else{
      console.log('CONNECTED TO THE SERVER, BUT, GOT AN ERROR');
    }
  };
  
  request.onerror = () => {
    console.log('CONNECTION ERROR');
  };

  let form = new FormData();

  form.append('name',document.getElementById('name').value)
  form.append('backgroundImage',document.getElementById('backgroundImageUrl').files[0])
  form.append('description',document.getElementById('description').value)
  form.append('redirectionUrl',document.getElementById('redirectionUrl').value)

  request.send(form);

}

function updateCourse(id){
  var request = new XMLHttpRequest();

  request.open('POST','http://localhost:9001/api/courses/edit?id='+id);

  request.onload = function(){
    if(request.status >= 200 && request.status <400){
      alert('Curso atualizado');
      //location.reload();  
    }else{
      console.log('CONNECTED TO THE SERVER, BUT, GOT AN ERROR');
    }
  };
  
  request.onerror = () => {
    console.log('CONNECTION ERROR');
  };

  let form = new FormData();

  form.append('name',document.getElementById('name').value)
  
  if(document.getElementById('backgroundImageUrl').files[0] !== undefined){
    form.append('backgroundImage',document.getElementById('backgroundImageUrl').files[0])
  }
  
  form.append('description',document.getElementById('description').value)
  form.append('redirectionUrl',document.getElementById('redirectionUrl').value)

  request.send(form);

}

function deleteCourse(id){
  var request = new XMLHttpRequest();

  request.open('POST','http://localhost:9001/api/courses/delete?id='+id);

  request.onload = function(){
    if(request.status >= 200 && request.status <400){
      alert('Curso deletado');
      location.reload(); 
    }else{
      console.log('CONNECTED TO THE SERVER, BUT, GOT AN ERROR');
    }
  };
  
  request.onerror = () => {
    console.log('CONNECTION ERROR');
  };

  request.send();
}

function openModalUpdateCourse(id){
  var request = new XMLHttpRequest();

  request.open('GET','http://localhost:9001/api/courses?id='+id);

  request.onload = function(){

    if(request.status >= 200 && request.status <400){

      var data = JSON.parse(request.responseText);
      var course = data[0];

      document.getElementById('name').value = course.name
      document.getElementById('description').value = course.description
      document.getElementById('redirectionUrl').value = course.redirectionUrl

      document.getElementById('createCourse').style.display = 'none';      
      document.getElementById('createCourse').insertAdjacentHTML('afterend',`<button id='updateCourse' onclick="updateCourse(${id})">Atualizar</button>`)      

      openModal('modal-add-course');

      }else{
      console.log('CONNECTED TO THE SERVER, BUT, GOT AN ERROR');
    }
  };
  
  request.onerror = () => {
    console.log('CONNECTION ERROR');
  };

  request.send();
}

function getCourses(){
  var request = new XMLHttpRequest();

  request.open('GET','http://localhost:9001/api/courses');

  request.onload = function(){
    if(request.status >= 200 && request.status <400){

      var data = JSON.parse(request.responseText);
      let coursesGrid = document.getElementById('courses-grid');
      data.forEach((course,counter) => {
        coursesGrid.insertAdjacentHTML(
          'beforeend',
          `
            <div class='course-card'>
              <div class='course-img'>
                <img src="${course.backgroundImage}" />
              </div>
              <div class='course-desc'>
                <h2>${course.name}</h2>
                <p>${course.description}</p>
              </div>
              <div class='course-view-more'>
                <button onclick="getCourse(${course.id})" class='course-view-more-button'>VER CURSO</button>
                <br>
                <button onclick="deleteCourse(${course.id})" class='course-view-more-button'>DELETAR CURSO</button>
                <br>
                <button onclick="openModalUpdateCourse(${course.id})" class='course-view-more-button'>ATUALIZAR CURSO</button>
              </div>
            </div>
          `
          );
      });
    }else{
      console.log('CONNECTED TO THE SERVER, BUT, GOT AN ERROR');
    }
  };
  
  request.onerror = () => {
    console.log('CONNECTION ERROR');
  };

  request.send();

}

function getCourse(id){
  var request = new XMLHttpRequest();

  request.open('GET','http://localhost:9001/api/courses?id='+id);

  request.onload = function(){

    if(request.status >= 200 && request.status <400){

      var data = JSON.parse(request.responseText);
      var course = data[0];
      let modal = document.getElementById('modal-get-course-content');
        modal.innerHTML = 
          ` <div class="modal-img-presentation">
              <img src="${course.backgroundImage}" alt="course image">
            </div>
            <div class="modal-briefing">
              <h2>${course.name}</h2>
              <p>${course.description}</p>
            </div>
            <div class="modal-button">
              <button class="btn-modal">
                <a href='${course.redirectionUrl}' target='_blank'>INSCREVA-SE</a>
              </button>
            </div>
          `;
          openModal('modal-get-course');
    }else{
      console.log('CONNECTED TO THE SERVER, BUT, GOT AN ERROR');
    }
  };
  
  request.onerror = () => {
    console.log('CONNECTION ERROR');
  };

  request.send();

}

document.addEventListener("DOMContentLoaded", function() {
  let showModalPresentation = getCookie('sawModal');

  if(showModalPresentation == ""){
    openModal('modal-presentation')
  }

  const swiper = new Swiper(".mySwiper", {
      navigation: {
          nextEl: ".swiper-button-next",
              prevEl: ".swiper-button-prev",
          },
      pagination: {
          el: ".swiper-pagination"
      }
  });
  getCourses();
});

