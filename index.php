<?php
session_start();

  if($_GET['do'] == 'logout'){
    unset($_SESSION['id']);
    session_destroy();
  } 

  if (isset($_SESSION["id"]))  {
    header('Location: http://localhost/NOTEBOOK/private.php ');    
  }   

?>


<!DOCTYPE html>
<html lang="ru">
<head>
	  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="css/sticky-footer-navbar.css" rel="stylesheet">
    <link rel="shortcut icon" href="book_bookmark.png" type="image/x-icon">
	  <title>Записная книжка</title>
    <script src="form.js"></script>
</head>
<body class="text-center">
	
    <header>
      <nav class="navbar navbar-expand-md navbar-light fixed-top bg-light">
      	<div class="container justify-content-center">
           <h1>ЗАПИСНАЯ КНИЖКА</h1>
      	</div>
      </nav>
    </header>

    <main id="mainId" role="main" class="container mt-5">
    	<form id="loginForm" class="form-group row justify-content-center">
    		<div class="col-8 col-sm-6 col-md-4 col-lg-3">
      		<input class="form-control" id="login" name="login" placeholder="Логин">
          <input type="password" class="form-control mt-1" id="pass" name="pass" placeholder="Пароль">
          <button id="btnLogin" type="submit" class="btn btn-info btn-block mt-2">ВОЙТИ</button>
          <button id="btnReg" type="submit" class="btn btn-success btn-block mt-2">РЕГИСТРАЦИЯ</button>
      	</div>
		  </form>
    </main>

    <footer class="footer">
      <div class="container">
        <span class="text-muted">&#169 В. С. Зайцев, 2019</span>
      </div>
    </footer>

<script type="text/javascript">
    
    document.addEventListener("DOMContentLoaded", function(event) {
    document.querySelector('form').addEventListener('input', handle);
    
    btnReg.onclick = function (event){
      
      event.preventDefault();

      let elem = document.getElementById("loginForm");
      elem.remove();

      let newRegForm = formReg.createElem("form", {id    : "regForm",class : "form-group row justify-content-center"},
                        formReg.createElem("div", {class : "col-8 col-sm-6 col-md-4 col-lg-3"},
                          formReg.createElem("input", {class : "form-control", id : "login", name : "login", placeholder : "Логин"}),
                          formReg.createElem("input", {class : "form-control mt-1", id : "pass1", name : "pass1", placeholder : "Пароль", type : "password"}),
                          formReg.createElem("input", {class : "form-control mt-1", id : "pass2", name : "pass2", placeholder : "Повтор пароля", type : "password"}),
                          formReg.createElem("input", {class : "form-control mt-1", id : "email", name : "email", placeholder : "Email", type : "email"}),
                          formReg.createElem("submit", {class : "btn btn-success btn-block mt-2", id : "btnReg2", onclick : "reg()", type : "submit"})
                        )
                       );

      let elemMain = document.getElementsByTagName("main");
      elemMain[0].prepend(newRegForm);

      let btnReg2 = document.getElementById("btnReg2");
      btnReg2.innerHTML = "ЗАРЕГИСТРИРОВАТЬСЯ";

      document.querySelector('form').addEventListener('input', handle);

    }
})
//---------------------------------
    function handle(event) {
      let idError = event.target.id+"Error";

      event.target.classList.remove("is-invalid");
      let error = document.getElementById(idError);
      if (error) {
        error.remove();
      }
      }
//---------------------------------

btnLogin.onclick = async (event) => {
       event.preventDefault();


    let loginError = document.getElementById('loginError');
      if (loginError) {
        loginError.remove();
      }

    let passError = document.getElementById('passError');
      if (passError) {
        passError.remove();
      }

      let response = await fetch('login.php', { 
        method  : 'POST',
        body    : new FormData(loginForm)
      });

      if (response.ok) {
        let json = await response.json();
        
       
        if (json['OK']) {
          location.replace("/notebook/private.php");
         
        } else {
          for (let key in json){
            addError(key,json[key]);
          }
        }
        

      } else {
        alert("Ошибка HTTP: " + response.status);
      }

}
//--------------------------------- 
    async  function  reg() {

      /* ??????????????????????????
      let elements = document.getElementsByClassName('invalid-feedback');
  
      for (let elem of elements) {
        elem.remove();
      }*/

      let loginError = document.getElementById('loginError');
      if (loginError) {
        loginError.remove();
      }

      let pass1Error = document.getElementById('pass1Error');
      if (pass1Error) {
        pass1Error.remove();
      }

      let pass2Error = document.getElementById('pass2Error');
      if (pass2Error) {
        pass2Error.remove();
      }

      let emailError = document.getElementById('emailError');
      if (emailError) {
        emailError.remove();
      }
   
   
   
      
      let response = await fetch('registr.php', { 
        method  : 'POST',
        body    : new FormData(regForm)
      });

      if (response.ok) {
        let json = await response.json();
        
        
        if (json['OK']) {
          alert("Логин успешно создан!");
          location.replace("/notebook/private.php");
        } else {
          for (let key in json){
            addError(key,json[key]);
          }
        }
        

      } else {
        alert("Ошибка HTTP: " + response.status);
      }

    }

//--------------------------------- 
  function addError(id,text) {
     let elem = document.getElementById(id),
         idErrr = id+"Error";

     elem.classList.add('is-invalid');
     elem.after( formReg.createElem('div',{class : "invalid-feedback", id : idErrr, style : "display : flex;"}) );
     document.getElementById(idErrr).textContent = text;
  }

</script>

</body>
</html>