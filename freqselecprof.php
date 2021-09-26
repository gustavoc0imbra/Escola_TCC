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
    ?><div id="selectTurma">
        <form action="freqenviarprof.php" method="POST">
            <select class="form-select form-select-sm">
             <option selected >Selecione a turma</option>
             <option> 
                 <?php
                  //while($busca == $q->fetch_array()){
                  //echo $busca["nomeTurma"];
                  //}
          ?></option>
        </select>
        <input type="submit" placeholder="Selecionar...">
        </form>
    </div>
    <?php
}
?>
<html>
    <head>
        <title><?php echo $nome.(" selecione a turma desejada:");?></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    </head>
    <body>
        <p class="rodape">Desenvolvido por...</p>
    </body>
</html>

<style>
    input{
        position: absolute;
        left: 47%;
        top: 50%;
    }
    .rodape{
        position: absolute;
        top: 87.5%;
        left: 47%;
    }
</style>