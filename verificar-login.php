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

$sql = "SELECT * FROM USUARIO WHERE login = " . $login . " AND senha = " . $senha;
$result = $conn->query($sql);

if ($result->num_rows > 0){
    header('Location: home.php');


}

else {
    //Aqui pode botar alguma msg de erro de login
    header('Location: index.php');

}

$conn->close();



?>