<?php
        include_once('includes/functions.php');
        require_once('includes/config.php');
        
        $cod = $_SESSION['cod'];
        $tipo = $_SESSION['tipo'];
        $presenca = $_POST['presenca'];
        $falta =  $_POST['falta'];
        
        var_dump($presenca);
        var_dump($falta);

        //if(isset($presenca){
            //echo "<script>alert('Você esqueceu de preencher algum nome');</script>";
        //}
        
        if($tipo != 'professor'){
            die("Você não pode continuar esta operação!");
            ?> <a href="index.php">Voltar</a>
            <?php
        }else{
            
        }
?>
<html>
    <head>
    </head>
    <body>
    </body>
</html>