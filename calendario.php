<?php
    session_start();

    $usuario_id = $_SESSION["id"];

    if(isset($_GET["listagem"])){
        $listagem = $_GET["listagem"];
    } else{
        $listagem = NULL;
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
    <div class="container">
        <h3 class="display-3 text-center">Lista de atividades e avisos:</h3>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">
            <p>Selecione o tipo de listagem: </p>
            <div class="form-check">
                <input type="radio" name="listagem" class="form-check-input" value="turma">
                <label for="Por turma" class="form-check-lavel">Por turma</label>
            </div>
            <div class="form-check">
                <input type="radio" name="listagem" class="form-check-input" value="disciplina">
                <label for="Por turma" class="form-check-lavel">Por disciplina</label>
            </div>
            <input type="submit" value="Selecionar" class="my-3 btn btn-primary">
        </form>

        <?php 
        
        if(isset($_GET["listagem"])):
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

            if($_GET["listagem"] == "turma"):         
                $sql = "SELECT * FROM ATIVIDADES_DA_TURMA INNER JOIN MATRICULA_TURMA ON ATIVIDADES_DA_TURMA.TURMA = MATRICULA_TURMA.TURMA WHERE USUARIO='$usuario_id';";
                
                $result = $conn->query($sql) or die($conn->error);

                if (!$result) {
                    trigger_error('Invalid query: ' . $conn->error);
                }

                echo mysqli_error($conn);

                if($result->num_rows > 0):
                    echo "<ul>";
                    while($row = $result->fetch_assoc()):
                        $tipo = "AVISO";
                        $data = $row["DATA_DE_ENTREGA"];

                        if($row["ENTREGA"]){
                            $tipo = "TAREFA";
                        }
                        
        ?>
                        
                            <li>
                                <h4><?php echo  "$tipo: " . $row["TITULO"] . " ($data)"?></h4>
                                <p><?php echo $row["DESCRICAO"];?></p>
                                <p>Valor: <?php echo $row["VALOR"];?></p>
                            </li>
                        
        <?php
                    endwhile;
                    echo "</ul>";
                else:
                    echo "erro";
                endif;
            
            endif;    
        endif;
        ?>
        <!--<ul>
            <li>
                <h4>AVISO: Titulo (Data)</h4>
                <p>Morbi malesuada odio sed scelerisque feugiat. Proin et ullamcorper quam. Proin porttitor non nulla a egestas. Mauris et ante ex. Curabitur a pellentesque nunc, quis tristique diam. Morbi eu dui felis. Quisque ut tempor nulla, in finibus mi. Praesent ultricies, lorem sed consectetur sagittis, libero dolor ullamcorper erat, ac euismod augue nibh vel velit. Maecenas vel lectus at urna ullamcorper vestibulum. Nulla facilisi. Vivamus id condimentum nibh</p>
                <p>Valor: 0</p>
            </li>
            <li>
                <h4>TAREFA: Titulo (Data)</h4>
                <p>Morbi malesuada odio sed scelerisque feugiat. Proin et ullamcorper quam. Proin porttitor non nulla a egestas. Mauris et ante ex. Curabitur a pellentesque nunc, quis tristique diam. Morbi eu dui felis. Quisque ut tempor nulla, in finibus mi. Praesent ultricies, lorem sed consectetur sagittis, libero dolor ullamcorper erat, ac euismod augue nibh vel velit. Maecenas vel lectus at urna ullamcorper vestibulum. Nulla facilisi. Vivamus id condimentum nibh</p>
                <p>Valor: 2</p>
            </li>
        </ul>-->
    </div>
</body>