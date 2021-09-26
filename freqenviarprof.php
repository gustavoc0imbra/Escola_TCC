<?php
        include_once("includes/functions.php");
        require_once("incles/config.php");

        $nome = $_SESSION['nome'];
        $tipousuario = $_SESSION['tipo'];

        if($tipousuario != 'professor'){
            echo $nome.(" você não tem acesso à esta página");
            echo ("<script>widow.location.href='index2.php'");
        }else{
            ?>
            <form action="">

            </form>
            <?php
        }

?>