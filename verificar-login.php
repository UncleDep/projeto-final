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
    header('Location: home.php');
    echo "foi";
}

else {
    //Aqui pode botar alguma msg de erro de login
    header('Location: index.php');
    echo "n foi";

    session_start();
    $_SESSION["mensagem"] = "Login ou senha incorretos.";
    $_SESSION["erro"] = true;
}

$conn->close();



?>