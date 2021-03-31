<?php

session_start();

if(!isset($_SESSION["erro"])){
    $titulo = '';
    $descricao = '';
    $data = '';
    $turmas = '';
    $disciplinas = '';
    $erro = false;
    $mensagem = '';
} else if($_SESSION["erro"]){
    $titulo = $_SESSION["aviso-cache"]["titulo"];
    $descricao = $_SESSION["aviso-cache"]["descricao"];
    $data = $_SESSION["aviso-cache"]["data"];
    $turmas = $_SESSION["aviso-cache"]["turmas"];
    $disciplinas = $_SESSION["aviso-cache"]["disciplinas"];
    $turmas = $_SESSION["aviso-cache"]["turmas"];
    $erro = true;
    $mensagem = $_SESSION["mensagem"];
}

unset($_SESSION["aviso-cache"]);
unset($_SESSION["erro"]);
unset($_SESSION["mensagem"]);

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
    <nav class="navbar navbar-dark bg-dark">
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

    <div class="container py-5">
        <h3 class="text-center display-3">Criar tarefa</h3>
        <form class="py-4" action="validar-tarefa.php" method="post" enctype="multipart/form-data">
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
            <input type="hidden" name="MAX_FILE_SIZE" value="30000">
            <input type="file" name="questoes" class="form-control mb-4">
            <input type="submit" value="Criar" class="btn btn-primary w-100">

            <?php if($erro): ?>
                <p class="text-danger">Erro: <?php echo $mensagem; ?></p>
            <?php endif;?>
        </form>
    </div>
</body>