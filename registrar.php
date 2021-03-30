<?php

session_start();

$valores = array();
$v = array('email', 'login', 'senha', 'nome', 'sobrenome', 'nascimento', 'matricula', 'cpf');

if(!isset($_SESSION["registro"])){
  foreach($v as $a){
      $valores[$a] = '';
  }

  $erro = false;
  $mensagem = '';
}

else{
  foreach($v as $a){
    $valores[$a] = $_SESSION[$a];
  }

  $erro = $_SESSION["erro"];
  $mensagem = $_SESSION["mensagem"];
}

session_unset();
session_destroy();

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
    <form method='POST' action='verificar-registro.php'>
      <input required type="email" id="email" class="fadeIn second" name="email" placeholder="Email" value=<?php echo $valores['email'];?>>
      <input required type="text" id="login" class="fadeIn second" name="login" placeholder="Login" value=<?php echo $valores['login'];?>>
      <input required type="password" id="senha" class="fadeIn third password" name="senha" placeholder="Senha" value=<?php echo $valores['senha'];?>>
      <input required type="text" id="nome" class="fadeIn third" name="nome" placeholder="Nome" value=<?php echo $valores['nome'];?>>
      <input required type="text" id="sobrenome" class="fadeIn third" name="sobrenome" placeholder="Sobrenome" value=<?php echo $valores['sobrenome'];?>>
      <input type="date" name="nascimento" class="fadeIn third" placeholder="Data de nascimento" value=<?php echo $valores['nascimento'];?>>
      <input required type="text" id="cpf" class="fadeIn third" name="cpf" placeholder="CPF" value=<?php echo $valores['cpf'];?>>
      <input required type="text" id="matricula" class="fadeIn third" name="matricula" placeholder="Matrícula" value=<?php echo $valores['matricula'];?>>
      <input required type="submit" class="fadeIn fourth" value="Enviar">
      <?php if($erro): ?>
      <p class="text-danger">Erro: <?php echo $mensagem; ?></p>
      <?php endif;?>
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="#">Não consegue se cadastrar?</a>
    </div>

  </div>
</div>
</body>
</html>

<?php

?>