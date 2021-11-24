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
                $profAdd1 = $_POST['addProf1']?? null;
                $profAdd2 = $_POST['addProf2']?? null;
                $profAdd3 = $_POST['addProf3']?? null;

                if((empty($nomeDisciplina)||empty($codDisciplina))){
                    
                    echo "O nome da discplina e seu codigo são obrigatórios, por favor tente novamente!";

                }else{
                    
                    $q1 = "INSERT INTO disciplina (codDisciplina, nomeDisciplina) values('$codDisciplina','$nomeDisciplina');";

                    if($banco->query($q1)){
                        
                        echo "Disciplina $nomeDisciplina criada com sucesso!<br>";

                        if(($profAdd1 || $profAdd2 || $profAdd3) != null){

                            $q2 = "UPDATE professor SET codDisciplina = $codDisciplina WHERE codProf IN ('$profAdd1','$profAdd2','$profAdd3');";

                            if($banco->query($q2)){
                                echo "Professores adicionado com sucesso a nova disciplina!<br>";
    
                            }else{
                                echo "Algo deu errado :/ Professores não foram adicionados a essa nova matéria";
                            }
                        }

                    }else{
                        echo "Erro ao criar disciplina, por favor tente novamente mais tarde!";
                    }

                }

            }
            
        }else{
            echo "Somente administradores tem acesso a essa página :/";
        }
        echo "<a href='index.php'>Menu</a>";
    ?>
    </body>
</DOCYTIPE>
