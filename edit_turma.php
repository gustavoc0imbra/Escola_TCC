    <?php 
     include_once("includes/config.php");
     include_once("includes/functions.php");
     ?>
     <?php
    if(!isset($_POST['professor'])){
        require_once('edit_form_turma.php');
    }else{
        
        $codTurma = $_POST['codTurma'];
        $professor = $_POST['professor']?? null;
        $extraProf = $_POST['extraProf']?? null;
        $retiraAlunos = $_POST['alunos']?? null;
        $addAlunos = $_POST['alunosAdd']?? null;
        $disciplinasDaSala = $_POST['disciplinasDaSala'];
        $horarioFinalDisciplina = $_POST['horarioFinalDisciplina'];

        $q = "SELECT MIN(cod) AS menorCod, MAX(cod) AS maiorCod FROM horarioturma$codTurma";
        if($banco->query($q)){
            $busca = $banco->query($q);
            $reg = $busca->fetch_object();
            $menorCod = $reg->menorCod?? null;
            $menorCod1 = $menorCod;
            $maiorCod = $reg->maiorCod?? null;

            while($menorCod <= $maiorCod){

                $q = "SELECT dias FROM horarioturma$codTurma WHERE cod = $menorCod";
                
                if($banco->query($q)){
                    $busca = $banco->query($q);
                    $reg = $busca->fetch_object();
                    $dia = $reg->dias?? null;

                    if($dia != null){
                        $dias[] = $dia;
                    }
                }else{
                    echo "Algo  deu errado ao buscar os dias de aula, por favor tente novamente mais tarde!";
                }
                $menorCod++;
            }

        }else{
            echo "Algo deu errado na busca dos codigos do horario da turma, por favor tente novamente mais tarde!";
        }


        $qntDisciplinasDaSala = count($disciplinasDaSala);
        $qntDias = count($dias);
        $menorCod = $menorCod1;
        $b = 0;

        //Aplicando novo horario de aula
        while($menorCod <= $maiorCod){
            $c = 0;
            
            $q = "UPDATE horarioturma$codTurma SET ";

            while($c < $qntDias){

                $dia = $dias[$c];
                $disciplinaAtual = $horarioFinalDisciplina[$b];

                $q.="$dia = '$disciplinaAtual'";

                

                if($c != $qntDias-1){
                    
                    $q.=", ";
                
                }
                $b++;
                $c++;
            }

            $q.= "WHERE cod = $menorCod";

            if($banco->query($q)){

                $tudoCerto = '1';

            }else{
                echo "Algo deu errado ao atualizar horario da turma, por favor tente novamente mais tarde!";
            }

          $menorCod++;
        }

        $c = 0;
        $z = 0;

        $q = "SELECT MIN(cod) AS menorCod, MAX(cod) AS maiorCod FROM disciplinasturma$codTurma";
        $banco->query($q);
        $busca = $banco->query($q);
        $reg = $busca->fetch_object();
        $menorCod = $reg->menorCod;
        $menorCod1 = $menorCod;
        $maiorCod = $reg->maiorCod;

        //Atualizando as disciplinas e professores
        while($menorCod <= $maiorCod){
            $q = "SELECT disciplinas FROM disciplinasturma$codTurma WHERE cod = $menorCod";
            $banco->query($q);
            $busca = $banco->query($q);
            $reg = $busca->fetch_object();
            $disciplina = $reg->disciplinas?? null;

            if($disciplina != null){
                $antigasDisciplinas[] = $reg->disciplinas?? null;
            }

            $menorCod++;
        }
     
        $menorCod = $menorCod1;
        $novasDisciplinas = array_diff($disciplinasDaSala, $antigasDisciplinas);
        $c = 0;
        
        while($c < $qntDisciplinasDaSala){

            $disciplinaAtual = $disciplinasDaSala[$c];
            $professorAtual = $professor[$c]?? null;
            $extraProfAtual = $extraProf[$c]?? null;
            
            if(in_array($disciplinaAtual, $novasDisciplinas)){

                $q = "INSERT INTO disciplinasturma$codTurma (disciplinas, professores, extraProf) VALUES ('$disciplinaAtual', '$professorAtual', '$extraProfAtual');";
            }else{
                $q = "UPDATE disciplinasturma$codTurma SET professores = '$professorAtual', extraProf = '$extraProfAtual' WHERE disciplinas = $disciplinaAtual;";
            }

            if($banco->query($q)){
               $tudoCerto = '2';
            }else{ 
                echo "Algo deu errado na alteração dos professores e disciplinas, por favor tente novamente mais tarde!!";
            }
            $c++;
        }

        //Alunos

         //Retirar Alunos
        
        $c = 0;

        if($retiraAlunos != null){
            $qntRetirarAlunos = count($retiraAlunos);
            while($c < $qntRetirarAlunos){
                
                $retiraAlunosAtual = $retiraAlunos[$c];

                $q = "UPDATE estudante SET turma = '0' WHERE codAluno = $retiraAlunosAtual";

                if($banco->query($q)){
                    $tudoCerto = '3';
                }else{
                    echo "Algo deu errado ao retirar alunos da turma, por favor tente novamente mais tarde!";
                }

                $c++;        
            }
        
        }else{
            $tudoCerto = '3';
        }

        $q = "SELECT cod FROM turmas WHERE codTurma = '$codTurma'";
        if($banco->query($q)){
            $busca = $banco->query($q);
            $reg = $busca->fetch_object();
            $cod = $reg->cod?? null;

        }else{
            echo "Algo deu errado na busca do cod da turma, por favor tente novamente mais tarde!";
        }
   

         //Adicionar Alunos
   
        $c = 0;

        if($addAlunos != null){
            
            $qntAddAlunos = count($addAlunos);

            while($c < $qntAddAlunos){
                
                $addAlunosAtual = $addAlunos[$c];

                $q = "UPDATE estudante SET turma = '$cod' WHERE codAluno = $addAlunosAtual ";
                if($banco->query($q)){

                    $tudoCerto = '4';
                }else{
                    echo "Algo deu errado ao adicionar alunos a turma, por favor tente novamente mais tarde!";
                }
                $c++;
            }
        }else{
            $tudoCerto = '4';
        }

        if($tudoCerto == '4'){
            ?>
                <script>window.location.href='view_turma.php?alt=true'</script>
            <?php
        }

    }