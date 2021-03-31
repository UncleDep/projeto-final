<?php 

session_start();
unset($_SESSION["aviso-cache"]);
unset($_SESSION["erro"]);
unset($_SESSION["mensagem"]);

$titulo = $_POST["titulo"];
$descricao = $_POST["descricao"];
$data = $_POST["data"];

$turmas = trim($_POST["turmas"]);
$disciplinas = trim($_POST["disciplinas"]);

$cache = array("titulo" => $titulo, "descricao" => $descricao, "data" => $data, "turmas" => $turmas, "disciplinas" => $disciplinas);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Calendario";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

function erro($mensagem, $cache, $conn){
    $conn->close();

    $_SESSION["erro"] = true;
    $_SESSION["mensagem"] = $mensagem;
    $_SESSION["aviso-cache"] = $cache;

    echo $_SESSION["erro"];
    echo $_SESSION["mensagem"];
    print_r($_SESSION["aviso-cache"]);

    header("Location: criar-aviso.php");
}

$turmas = explode(", ", $turmas);
$count_turmas = count($turmas);
array_push($turmas, "/end");

$disciplinas = explode(", ", $disciplinas);
$count_disciplinas = count($disciplinas);
array_push($disciplinas, "/end");

print_r($disciplinas);
print_r($turmas);

$sql = "SELECT count(DISTINCT ID) as COUNT, count(DISTINCT ID) as COUNT2 FROM TURMA WHERE ID IN(";

for($x = 0; $x<$count_turmas; $x++){
    echo $turmas[$x];

    $sql.= "'$turmas[$x]'";

    if($turmas[$x + 1] == "/end"){
        $sql.= ");";
    }

    else{
        $sql.= ", ";
    }
}

echo $sql;

$result = $conn->query($sql) or die($conn->error);

if (!$result) {
    trigger_error('Invalid query: ' . $conn->error);
}

echo mysqli_error($conn);

$existe_turmas = false;

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        if($row["COUNT"] == $count_turmas){
            $existe_turmas = true;
            echo "foi 1 " . $row["COUNT"];
        }else{
            erro("Turmas inválidas.", $cache, $conn);
        }
    }
} else{
    erro("Disciplinas inválidas", $cache, $conn);
}

$sql = "SELECT count(DISTINCT ID) as COUNT FROM DISCIPLINA WHERE ID IN(";

for($x = 0; $x<$count_disciplinas; $x++){
    echo $disciplinas[$x];

    $sql.= "'$disciplinas[$x]'";

    if($disciplinas[$x + 1] == "/end"){
        $sql.= ");";
    }

    else{
        $sql.= ", ";
    }
}

echo $sql;

$result = $conn->query($sql) or die($conn->error);

if (!$result) {
    trigger_error('Invalid query: ' . $conn->error);
}

echo mysqli_error($conn);

$existe_disciplinas = false;

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        if($row["COUNT"] == $count_disciplinas){
            $existe_disciplinas = true;
            echo "foi 2 " . $row["COUNT"];
        }else{
            erro("Disciplinas inválidas", $cache, $conn);
        }
    }
} else{
    erro("Disciplinas inválidas", $cache, $conn);
}

$autor = $_SESSION['id'];
$last_id = 0;

if($existe_disciplinas and $existe_turmas){
    $_SESSION["id"];
    $sql = "INSERT INTO ATIVIDADE VALUES(NULL, FALSE, '$data', 0, '$titulo', '$descricao', '$autor')";
    echo $sql;

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        $last_id = $conn->insert_id;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    foreach($turmas as $x){
        if($x != "/end"){
            $sql = "INSERT INTO ATIVIDADE_TURMA VALUES(NULL, '$last_id', '$x');";
            echo $sql;

            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }

    foreach($disciplinas as $x){
        if($x != "/end"){
            $sql = "INSERT INTO ATIVIDADE_DISCIPLINA VALUES(NULL, '$last_id', '$x')";
            echo $sql;
        }

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
header("Location: home.php");

?>