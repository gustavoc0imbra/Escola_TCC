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
            if(!isset($_POST['nomeDisciplina'])){
                require_once ('new_form_disciplina.php');
            }else{
                $nomeDisciplina = $_POST['nomeDisciplina']?? null;
                $codDisciplina = $_POST['codDisciplina']?? null;
                $professoresAdd = $_POST['professoresAdd']?? null;
                
                $q = "INSERT INTO disciplina (nomeDisciplina) values ('$nomeDisciplina');";
                if($banco->query($q)){
                    $q = "SELECT MAX(codDisciplina) AS maxCodDisciplina FROM disciplina";
                    if($banco->query($q)){
                        $busca = $banco->query($q);
                        $reg = $busca->fetch_object();
                        $maxCodDisciplina = $reg->maxCodDisciplina;

                        if($professoresAdd != null){

                            $qntProf = count($professoresAdd);
                            $c = 0;
        
                            while($c < $qntProf){
                                $prof = $professoresAdd[$c];
                                echo "Codigo da disciplina $maxCodDisciplina";
    
                                $q1 = "UPDATE professor SET codDisciplina = $maxCodDisciplina WHERE codProf = $prof";
    
                                if($banco->query($q1)){
                                    ?>
                                        <script>window.location.href='disciplina.php?add=true'</script>
                                    <?php
                                }else{
                                    echo "Algo deu errado na mudança de disciplina dos professore(s), por favor tente novamente mais tarde!";
                                    echo $q1;
                                }
    
                                $c++;
                            }
    
                        }else{
                            ?>
                                <script>window.location.href='disciplina.php?add=true'</script>
                            <?php
                        }

                    }else{
                        echo "Algo deu errado ao selecionar as disciplinas anteriores, por favor tente novamente mais tarde!";
                    }
                    
                }else{
                    echo "Algo deu errado ao criar disciplina, tente novamente mais tarde!";
                }
               

            }
            
        }else{
            echo "Somente administradores tem acesso a essa página :/";
        }
     
    ?>
    </body>
</DOCYTIPE>
