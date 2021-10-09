<DOCYTIPE html>
<html>
        <head>
         <meta charset="UTF-8">
         <meta description="...">
         <link rel="stylesheet" href="Estilo/main.css">
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
        </head>
        <?php
             include_once "includes/config.php";
             include_once "includes/functions.php";
         ?>
        <body>
        <?php 
            if(empty($_SESSION['user'])){
                include_once "login.php";
            }else{
                echo "<br>Codigo: ";echo $_SESSION['user'];
                echo "<br>Nome:";echo $_SESSION['nome'];
                echo "<br>Tipo:";echo $_SESSION['tipo'];
                echo "<br>";
                echo $_SESSION['aluno']; 
            ?>
                Logado com sucesso! (index.php)
                
                <form action='login.php' method='post'>
                    <input type='submit' id='logout' value='deseja sair?' name='logout'> 
                </form>
        <?php
            }
        ?>
        <div>
         <?php
             $data = date('d/m/Y ');
             echo ("<p id='data'>Hoje é ").$data.("</p>");
         ?>
         </div>
               <p id="rodape">Desenvolvido por ...</p>

        </body>
</html>
<style>
    #data{
        position: relative;
        left: 45.5%;
    }

</style>
