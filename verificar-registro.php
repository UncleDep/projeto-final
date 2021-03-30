<?php

session_start();

function erro_redirecionar($mensagem){
  $v = array('email', 'login', 'senha', 'nome', 'sobrenome', 'nascimento', 'matricula', 'cpf');

  foreach($v as $a){
    echo $_POST[$a];
    $_SESSION[$a] = $_POST[$a];
    echo $_SESSION[$a];
  }

  $_SESSION["registro"] = true;
  $_SESSION["erro"] = true;
  $_SESSION["mensagem"] = $mensagem;

  header("Location: registrar.php");
  die();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Calendario";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$cpf = 123;

$sql = "SELECT cpf, tipo FROM TIPO_USUARIO WHERE cpf = " . $_POST['cpf'];
$result = $conn->query($sql);

$tipo = 0;

$existe = false;

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "cpf: " . $row["cpf"]. " - Name: " . $row["tipo"] . "<br>";
    $tipo = $row['tipo'];
    //session_unset();
    //session_destroy();
    echo 'UHUUU';
    $existe = true;
    //$sql = "INSERT INTO USUARIO VALUES('" . $_POST["email"] . "', '" . $_POST["login"] . "', '" . $_POST["senha"] . "', '" . $_POST["nome"] . "', '" . $_POST["sobrenome"] . "', '" . $_POST["nascimento"] . "', '" . $_POST["matricula"] . "', '" . $_POST["cpf"] . "');";   
    
    /*if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

    header("Location: index.php");*/

    echo $sql;
  }
} else {
  echo "0 results";
  erro_redirecionar("CPF não existe no banco de dados.");
}

$username = $_POST["login"];
$email = $_POST["email"];
$cpf = $_POST["cpf"];
$senha = $_POST["senha"];
$nome = $_POST["nome"];
$sobrenome = $_POST["sobrenome"];
$nascimento = $_POST["nascimento"];
$matricula = $_POST["matricula"];

$sql = "SELECT * FROM USUARIO WHERE username = '$username' or email = '$email' or cpf = '$cpf'";
$result = $conn->query($sql);

if($result->num_rows > 0){
  echo 'ja existe';
  erro_redirecionar("Email, login ou cpf já possuem conta.");
} else{
  echo "foi";
  $sql = "INSERT INTO USUARIO VALUES('$email', '$username', '$senha', '$nome', '$sobrenome', '$nascimento', '$matricula', '$cpf')";
  echo $sql;
    
  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  header("Location: index.php");
}

$conn->close();

?>