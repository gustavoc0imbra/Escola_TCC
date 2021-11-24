    <?php 
     include_once("includes/config.php");
     include_once("includes/functions.php");
     ?>
     <?php
    if(!isset($_POST['0'])){
        require_once('edit_form_turma.php');
    }else{
        
        $codTurma = $_POST['codTurma'];
        $totalAulas = $_POST['totalAulas'];
        $professor = $_POST['professor']?? null;
        $extraProf = $_POST['extraProf']?? null;
        $retiraAlunos = $_POST['alunos']?? null;
        $addAlunos = $_POST['alunosAdd']?? null;
        $a = $_POST['15']?? null;
        $c = null;
        $b = 0;

        // formatando array do horarioFinalDisciplina;
        for($c = 0; $c < $totalAulas; $c++){

            $disciplina = $_POST[$c]?? null;   
            $horarioFinalDisciplina[] = $disciplina;
            
        }
        $q = "SELECT MIN(cod) AS minCod, MAX(cod) AS maxCod FROM horarioturma$codTurma;";
        if($banco->query($q)){
            $busca = $banco->query($q);
            $reg = $busca->fetch_object();
            $minCod = $reg->minCod?? null;
            $maxCod = $reg->maxCod?? null;

           
                $q = "SELECT dias FROM horarioTurma$codTurma WHERE cod = $minCod";
                if($banco->query($q)){
                    $busca = $banco->query($q);
                    $reg = $busca->fetch_object();
                    $dia = $reg->dias;


                    $q1 = "UPDATE horarioTurma$codTurma WHERE cod = '1'";

                    if($banco->query($q1)){
                        echo "Tudo cert, Tiago deve dar uma chance para a T";
                    }else{
                        echo "algo deu errado!";
                    }
                    /*
                    if($dia != null){
                        $dias[] = $reg->dias;
                        echo $dia;
                        $q1 = "UPDATE horarioturma$codTurma SET $dia =";

                        $cacheDisciplina = $horarioFinalDisciplina[$b];
                        echo "<Br>$cacheDisciplina";

                        $q1.= "$cacheDisciplina";

                        $q1.=" WHERE dias = $dia";
                        $b++;

                        if($banco->query($q1)){
                            
                            
                        }else{
                            echo "Algo deu errado tente novamente!";
                        }
                    }
                    */

                }else{
                    "Erro na busca, por favor tente novamente mais tarde!";
                }
            
          
            print_r($dias);
        }else{
            echo "Erro na busca do horario dessa turma, por favor tente novamente mais tarde!";
        }
       
       print_r($horarioFinalDisciplina);
       echo "<br>";
       print_r($professor);
       print_r($extraProf);
       echo "<br>";
       print_r($addAlunos);
       print_r($retiraAlunos);
    }   
?>