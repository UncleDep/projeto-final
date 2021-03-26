<?php

session_start();

function erro_redirecionar($erro){
  $v = array('login', 'senha', 'nome', 'sobrenome', 'cpf');

  foreach($v as $a){
    echo $_POST[$a];
    $_SESSION[$a] = $_POST[$a];
    echo $_SESSION[$a];
  }

  $_SESSION["registro"] = true;
  $_SESSION["erro"] = $erro;

  //header("Location: registrar.php");

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

$sql = "SELECT cpf, tipo FROM TIPO_USUARIO WHERE cpf = '123'";
$result = $conn->query($sql);

$tipo = 0;

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["cpf"]. " - Name: " . $row["tipo"] . "<br>";
    $tipo = $row['tipo'];
    session_unset();
    session_destroy();
    echo 'UHUUU';
  }
} else {
  echo "0 results";
  erro_redirecionar("CPF não existe no banco de dados.");
}

$conn->close();

?>