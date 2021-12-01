<?php

      include_once('includes/functions.php');
      require_once('includes/config.php');

$nome = $_SESSION['nome'];
$cod = $_SESSION['cod'];
$tipousuario = $_SESSION['tipo'];
$q = "SELECT codTurma AND nomeTurma FROM professor WHERE codProf = $cod";
$busca = $banco->query($q);

if($tipousuario != 'professor'){
    echo $nome.("<br>você não tem acesso à esta página!</p>");
    echo ("<script>window.location.href='index2.php'</script>");
}else{
    ?>
    <!-- NAVBAR DA Pág -->
 <nav class="navbar navbar-expand-lg navbar-light bg-info">   
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Escola_TCC</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        <a class="nav-link active" href=""> Enviar Notas</a>
        <a class="nav-link active" href=""> Tabela de horários</a>
      </div>
    </div>
  </div>
</nav>  
    <div id="selectTurma">
        <form action="freqenviarprof.php" method="POST">
            <select class="form-select form-select-sm">
             <option selected >Selecione a turma</option>
                 <?php
                  //while($busca == $q->fetch_array()){
                  //echo $busca["nomeTurma"];
                  //}
          ?>
        </select>
        <input type="submit" placeholder="Selecionar..." class="btn btn-outline-success">
        </form>
    </div>
    <?php
}
?>
<html>
    <head>
        <title>Selecione a turma desejada:</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    </head>
    <body>
        <center>
          <a href="index.php">
            <button class="btn btn-outline-primary">Voltar</button>
            </a>
          <p class="rodape">Desenvolvido por...</p>
          </center>
        
    </body>
</html>

<style>
    input{
        position: fixed;
        left: 47.4%;
        top: 70%;
    }
    .rodape{
        position: absolute;
        top: 87.5%;
        left: 45%;
    }
</style>