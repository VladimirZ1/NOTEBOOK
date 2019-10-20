<?php
session_start();

  if($_GET['do'] == 'logout'){
    unset($_SESSION['id']);
    session_destroy();
  } 

  if (isset($_SESSION["id"]))  {
    header('Location: NOTEBOOK/private.php ');    
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
      <script src="js/forms.js"></script>
  </head>
  <body class="text-center" onload="forms.bodyOnLoad()">
  	
    <header>
      <nav class="navbar navbar-expand-md navbar-light fixed-top bg-light">
        <div class="container justify-content-center">
          <h1>ЗАПИСНАЯ КНИЖКА</h1>
        </div>
      </nav>
    </header>

    <main role="main" class="container mt-5">
      <form id="loginForm" class="form-group row justify-content-center">
      	<div class="col-8 col-sm-6 col-md-4 col-lg-3">
        	<input class="form-control" id="login" name="login" placeholder="Логин">
          <input type="password" class="form-control mt-1" id="pass" name="pass" placeholder="Пароль">
          <button id="btnLogin" type="button" class="btn btn-info btn-block mt-2">ВОЙТИ</button>
          <button id="btnReg" type="button" class="btn btn-success btn-block mt-2">РЕГИСТРАЦИЯ</button>
        </div>
  		</form>
    </main>

    <footer class="footer">
      <div class="container">
        <span class="text-muted">&#169 В. С. Зайцев, 2019</span>
      </div>
    </footer>

  </body>
</html>