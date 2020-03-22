<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="icon" href="img/favicon.ico"/>   
    
    <link rel="stylesheet" href="css/style.css">
    
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous" defer></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous" defer></script>

    <!-- icon font -->
    <script src="js/all.js" defer></script>
    <link href="https://fonts.googleapis.com/css?family=Barlow+Condensed&display=swap" rel="stylesheet">

    <title><?echo $page_name?></title>
</head>

<body>
<div class="wrap">
  
	<div class="content">
    <div class="header" >
    PHP & SQL&nbsp;<i class="fas fa-database"></i>&nbsp;Bootstrap - <span class="text-danger">NO JS</span>
    </div>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      
      <div class="container">
        <a class="navbar-brand" href="index.php">Home</a>

        <?
          if($page_name !== "New task"){
            echo '<a href="addtask.php"><button type="button" class="btn btn-info">Add New Task</button></a>';
          };

          if (isset($_COOKIE['id']) AND isset($_COOKIE['hash'])){                
            echo '<div class="nav-item nav-link text-white">Welcome '.$_COOKIE['user_name'].'</div>';

            echo '<a class="nav-item nav-link" href="logout.php"> <button type="button" class="btn btn-outline-secondary">Log Out</button></a>';

          } else {

            echo '<a class="nav-item nav-link" href="login.php"> <button type="button" class="btn btn-danger">Log In / Registration</button></a>';          
          
          }      
        ?>      
          
          
      </div>  
    </nav>
    