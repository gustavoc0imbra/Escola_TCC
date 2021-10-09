<?php
        include_once("includes/functions.php");
        require_once("includes/config.php");

        $nome = $_SESSION['nome'];
        $tipousuario = $_SESSION['tipo'];

        if($tipousuario != 'professor'){
            echo $nome.(" você não tem acesso à esta página");
            echo ("<script>window.location.href='index2.php'</script>");
        }else{
            ?>
            <form action="">

            </form>
            <?php
        }

?>