<?php

session_start();

if(!isset($_SESSION["erro"])){
  $erro = false;
  $mensagem = 'aa';
  session_unset();
  session_destroy();
} else{
  $erro = $_SESSION["erro"];
  $mensagem = $_SESSION["mensagem"];
  session_unset();
  session_destroy();
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="style.css" rel="stylesheet"></script>
    <title>PE</title>
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      
    </style>
</head>
<body class="text-center">
<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
      <a href="index.php"><img src="assets/a.png" id="icon" alt="User Icon"/></a>
    </div>

    <!-- Login Form -->
    <form method='POST' action='verificar-login.php'>
      <input type="text" id="login" class="fadeIn second" name="login" placeholder="Login">
      <input type="password" id="senha" class="fadeIn third" name="senha" placeholder="Senha"> 
      <input type="submit" class="fadeIn fourth" value="Enviar">
      <?php if($erro): ?>
      <p class="text-danger">Erro: <?php echo $mensagem; ?></p>
      <?php endif;?>
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="registrar.php">Criar conta</a>
    </div>

  </div>
</div>
</body>
</html>