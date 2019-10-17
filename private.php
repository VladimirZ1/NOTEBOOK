<?php
require_once("config.php");
require_once("DBClass.php");

session_start();

if (!isset($_SESSION["id"]))  {
    header('Location: http://localhost/NOTEBOOK/index.php ');  
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
<?php
  
  
  	$id = $_SESSION["id"];
    $user = new DBClass(SERVER,USER,PASS,DBNAME);
    $result = $user->select("login","user","id='".$id."'");
    echo "<h1>Добро пожаловать,". $result[0]['login']."!
    <a href='index.php?do=logout'>Выйти</a></h1>";

  
?>
          
      	</div>
      </nav>
    </header>

   

    <footer class="footer">
      <div class="container">
        <span class="text-muted">&#169 В. С. Зайцев, 2019</span>
      </div>
    </footer>



</body>
</html>