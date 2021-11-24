<?php 
        require_once "includes/config.php";
        require_once "includes/functions.php";
        $tipo = $_SESSION['tipo']?? null;
?>
<?php 
    if($tipo == 'admin'){
        if(!isset($_POST['notas'])){
            require_once "edit_form_nota.php";
        }else{
                $notas = $_POST['notas'];
                $codAluno = $_POST['codAluno']?? null;
                $qntNotas = count($notas);
                echo $qntNotas;
                print_r($notas);

                // formatando notas
                for($c = 0; $c < $qntNotas; $c++){
                    if($notas[$c] == null){
                        $notas[$c] = '0';
                    }
                }
                print_r($notas);
                $q = "INSERT INTO notas (aluno, disciplina, n1, n2, n3, n4, final) VALUES ('$codAluno','','','','','','');";

                
        }
    }