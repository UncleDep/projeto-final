<?php
session_start();

$usuario_id = $_SESSION["id"];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Calendario";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
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
<body class=bg-light>
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

    <div clas="container my-4 text-center">
        
    <div class="container py-5" >
        <h3 class="text-center display-3">Dashboard</h3>
        
        <h4 class="display-5 mb-4">Eventos da turma: </h4>
        <?php
        
        $sql = "SELECT * FROM ATIVIDADES_DA_TURMA INNER JOIN MATRICULA_TURMA ON ATIVIDADES_DA_TURMA.TURMA = MATRICULA_TURMA.TURMA WHERE USUARIO='$usuario_id' ORDER BY DATA_DE_ENTREGA DESC";

        $result = $conn->query($sql) or die($conn->error);

        if($result->num_rows > 0):
            echo "<ul>";
            $count = 0;
            while($row = $result->fetch_assoc() and $count <= 4):   
        ?>
                <li>
                    <h4><?php echo $row["TITULO"]?></h4>
                    <p><?php echo $row["DESCRICAO"]?></p>
                    <p><b>Data de entrega:</b> <?php echo $row["DATA_DE_ENTREGA"]; ?></p>
                </li>
        <?php 
            endwhile; 
            echo "</ul>"; 
        else:
            echo "<p>Nenhum evento<p>";
        endif; ?>

        <h4 class="display-5 mb-4">Eventos da disciplina: </h4>
        <?php
        
        $sql = "SELECT * FROM ATIVIDADES_DA_DISCIPLINA INNER JOIN MATRICULA_DISCIPLINA ON ATIVIDADES_DA_DISCIPLINA.DISCIPLINA = MATRICULA_DISCIPLINA.DISCIPLINA WHERE USUARIO='$usuario_id'ORDER BY DATA_DE_ENTREGA DESC;";

        $result = $conn->query($sql) or die($conn->error);

        if($result->num_rows > 0):
            echo "<ul>";
            $count = 0;
            while($row = $result->fetch_assoc() and $count <= 4):   
        ?>
                <li>
                    <h4><?php echo $row["TITULO"]?></h4>
                    <p><?php echo $row["DESCRICAO"]?></p>
                    <p><b>Data de entrega:</b> <?php echo $row["DATA_DE_ENTREGA"]; ?></p>
                </li>
        <?php 
            endwhile; 
            echo "</ul>"; 
        else:
            echo "<p>Nenhum evento<p>";
        endif; 
        $conn->close(); ?>
    </div>

        <?php if($_SESSION["tipo"] == 2): ?>
            <h1 class="display-1 text-center mb-5">Ações:</h1>
            <div class="container d-flex justify-content-center my-5">
                <a href="criar-aviso.php" class="btn btn-primary me-3">Criar aviso</a>
                <a href="criar-tarefa.php" class="btn btn-primary me-3">Criar tarefa</a>      
            </div>
             
        <?php endif;?>
    </div>

    
</body>