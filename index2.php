<!DOCKTYPE HTML>
<html>
    <head>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="main2.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <?php
        //require ('login.php');
        
           ?>
    <body>
        <div id="navbarLateral">
        <ul id="navbarAluno">
           <li></li>
           <li><input type="text" placeholder="Procurar..."></li>
           <li><a href="notas.php">Ver notas</a></li>
           <li><a href="">Frequências</a></li>
           <li><a href="">Acervo</a></li>
           <li><a href="">Avisos da escola</a></li>
           <li><i class='bx bx-log-out'></i><a>Log out</a></li>
        </ul>
        </div>
       
    </body>
</html>
<!--<script>
    function LogOut{
        session_start();
        unset($_SESSION['codAluno']);
        unset($_SESSION['nomeAluno']);
        unset($_SESSION['senhaAluno']);
    }
</script> -->