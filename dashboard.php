<?php 
session_start();

$usuario_id = $_SESSION["id"];


if(isset($_GET["listagem"])){
    $listagem = $_GET["listagem"];
} else{
    $listagem = NULL;
}


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

    header("Location: home.php");



$idQuery = 0;
$atividades = array();


    $sql = "SELECT atividade from ATIVIDADE_HAS_USUARIO where aluno = '$usuario_id'";

               
                    
                    $result = $conn->query($sql) or die($conn->error);

                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                            $idQuery = $row;
                            }
                        }
                     




                    $sql2 = "SELECT titulo from atividade where '$idQuery' = ID";

                    
                    if($conn->query($sql2)){ 
                        $result2 = $conn->query($sql2) or die($conn->error);
                        
                        if($result2->num_rows > 0){
                            while($row = $result2->fetch_assoc()){
                                
                                array_push($atividades,$row);

                            }

                        }
                    }

                    

                }

                


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <title>PE</title>
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark mb-3">
        <div class="container-fluid row pl-4 pr-4">
            <div class="container col position-start">
                <label class="navbar-brand" href="#">Bem vindo, <?php echo $_SESSION["nome"]; ?></label>
            </div>
            
            <ul class="container col navbar-nav px-1">
                <div class="row">
                    <li class="nav-item col px-0 pe-2">
                        <a class="nav-link active text-end" aria-current="page" href="home.php">Home</a>
                    </li>
                    <li class="nav-item col px-0 ps-2">
                        <a class="nav-link active" href="calendario.php">Calendário</a>
                    </li>
                </div>
            </ul>
            <ul class="navbar-nav col row px-1 position-end">
                <li class="av-item col">
                    <a class="nav-link active text-end" href="sair.php">Sair</a>
                </li>
            </ul>  
        </div>   
    </nav>
   

    <div class="container py-5" >
        <h3 class="text-center display-3">Dashboard</h3>
        <form class="py-4" action="#" method="post">

            <div class = "">
            <h5 class ="text-center display-3">Tarefas</h5>

            <?php 
            
            foreach($atividades as $x){

            
            ?>
            <ul>
                <li>
                <?php echo $x;
                    echo "1";
                 ?>
                


                

    
                </li>

                <li><?php echo $x;
                echo "2"; ?>

                </li>

                <li><?php echo $x;
                echo "3";
            }
                ?>
                
                
                
                </li>
            </ul>



            <!--
            <label for="titulo" class="form-label">Título</label>
            <input type="text" class="form-control mb-4" name="titulo" placeholder="Título">
            <label for="descricao">Descrição</label>
            <textarea name="descricao" cols="30" rows="10" class="form-control mb-4" placeholder="Descrição"></textarea>
            <label for="Data" class="form-label">Data de entrega</label>
            <input type="datetime-local" name="data" class="form-control mb-4" placeholder="mês/dia/ano">
            <label for="turma">Turmas afetadas</label>
            <input type="text" name="turmas" class="form-control mb-4">
            <label for="disciplinas">Disciplinas afetadas</label>
            <input type="text" name="disciplinas" class="form-control mb-4">
            <label for="disciplinas">Pontuação</label>
            <input type="text" name="pontuacao" class="form-control mb-4">
            <label for="disciplinas">Inserir questões</label>
            
            <input type="submit" value="Criar" class="btn btn-primary w-100">
            !-->

          
        </form>
    </div>
        
</body>