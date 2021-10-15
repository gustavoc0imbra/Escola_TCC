<DOCYTIPE html>
    <head>
        <meta charset="UTF-8">
        <meta description="...">
        <link rel="stylesheet" href="#">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <?php 
        include_once "includes/config.php";
        include_once "includes/functions.php";
        $tipo = $_SESSION['tipo']??null;
    ?>
    <body>
    <?php 
        
        if($tipo == 'admin'){
            echo "<h1>Nova disciplina</h1>";
            
            if(!isset($_POST['nomeDisciplina'])){
                require_once ('new_form_disciplina.php');
            }else{
             
                
                 echo"<a href='disciplina.php'>Ver disciplinas</a>";
            }
        }else{
            echo "Somente administradores tem acesso a essa página :/";
        }
    ?>
    </body>
</DOCYTIPE>
