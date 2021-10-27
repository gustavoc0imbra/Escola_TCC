<!DOCKTYPE HTML>
<?php

    include_once ('includes/functions.php');
    require_once ('includes/config.php');         

       $nome = $_SESSION['nome'];
       $tipo = $_SESSION['tipo'];
       $cod  = $_SESSION['cod'];

       if ($tipo == 'aluno'){
           ?>
           <div id="">
                <h1>Bem vindo ao acervo Aluno <?php echo $nome; ?></h1>
                <table>
                </table>
           </div>
           <?php
       }elseif($tipo == 'professor'){
           ?>
           <div id="">
                <h1>Bem vindo ao acervo Professor <?php echo $nome; ?> </h1>
           </div>
           <?php
       }
?>
<html>
    <head>
       <meta charset="UTF-8">
       <meta lang="PT-BR">
       <link rel="stylesheet" href="Estilo/main3.css">
    </head>
    <body>
        
    </body>
</html>