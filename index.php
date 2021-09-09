<DOCYTIPE html>
<html>
        <head>
         <meta charset="UTF-8">
         <meta description="...">
         <link rel="stylesheet" href="Estilo/main.css">
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
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
            <footer align="center">
               <p>Desenvolvido por ...</p>
            </footer>

        </body>
</html>
