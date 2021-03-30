<?php 

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

$login = $_POST['login'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM USUARIO WHERE username = '$login' AND senha = '$senha'";
echo $sql;
//$sql = "SELECT * FROM USUARIO WHERE USERNAME = '123'";
$result = $conn->query($sql);

if (!$result) {
  trigger_error('Invalid query: ' . $conn->error);
}

echo mysqli_error($conn);

if ($result->num_rows > 0){
    session_start();
    session_unset();
    session_destroy();
    session_start();
    $_SESSION["username"] = $login;
    $_SESSION["login"] = true;

    $sql = "SELECT Nome, ID, Tipo FROM USUARIO, TIPO_USUARIO WHERE username = '$login' AND senha = '$senha' AND USUARIO.CPF = TIPO_USUARIO.CPF";
    $result = $conn->query($sql);

    if (!$result) {
      trigger_error('Invalid query: ' . $conn->error);
    }

    if($result->num_rows > 0){
      while($row = $result->fetch_assoc()){
        $_SESSION["id"] = $row["ID"];
        $_SESSION["nome"] = $row["Nome"];
        $_SESSION["tipo"] = $row["Tipo"];
      }
    }

    header('Location: home.php');
    echo "foi";
}

else {
    header('Location: index.php');
    echo "n foi";

    session_start();
  
    $_SESSION["mensagem"] = "Login ou senha incorretos.";
    $_SESSION["erro"] = true;
}

$conn->close();



?>