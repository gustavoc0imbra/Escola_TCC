<DOCYTIPE html>
<html>
        <head>
         <meta charset="UTF-8">
         <meta description="...">
         <link rel="stylesheet" href="Estilo/estilo.css">
         <meta name="viewport" content="width=device-width, initial-scale=1">
        </head>
        <?php
             include_once "includes/config.php";
             include_once "includes/functions.php";
         ?>
        <body>
        <?php 
            if(empty($_SESSION['user'])){
                require_once "login.php";
            }else{
                
                require_once("navbar.php");
                
                if($_SESSION['tipo'] == "admin"){
                    
                     $nome = $_SESSION['nome'];
                     $cod = $_SESSION['user'];
                     
                }  
            ?>
                <div id="main">
                    <h1> Logado com sucesso! (index.php) </h1>
                    <p id="rodape">Desenvolvido por ...</p>
                </div>
            
            <?php }    ?>
        </body>
</html>
