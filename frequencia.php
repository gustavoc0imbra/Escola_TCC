<?php 
        require_once "includes/config.php";
        require_once "includes/functions.php";
    ?>
<?php
if(!isset($_POST['variavel'])){
    require_once 'frequencia_form.php';
}else{
    $frequencia = $_POST['presenca']?? null;
    $disciplina = $_POST['disciplina']?? null;
    $cod = $_POST['cod']?? null;



    // se alguem ta presente
    if($frequencia != null){

        $c = 0;
        $qntFrequencia = count($frequencia);
        
        // Aplicando presença aos alunos 
        while($c < $qntFrequencia){
            $frequenciaAtual = $frequencia[$c];

            $q = "SELECT aluno FROM frequencia WHERE aluno = $frequenciaAtual AND disciplina = $disciplina";
            $banco->query($q);
            $busca = $banco->query($q);
            $reg = $busca->fetch_object();
            $aluno = $reg->aluno?? null;

            // se ele já tem uma tabela com aquela disciplina
            if($aluno != null){
                $q = "SELECT aulas FROM frequencia WHERE aluno = $frequenciaAtual AND disciplina = $disciplina";
                $busca = $banco->query($q);
                $reg = $busca->fetch_object();
                $a = $reg->aulas;
                $a++;
                $q = "UPDATE frequencia SET aulas = '$a' WHERE aluno = $frequenciaAtual AND disciplina = $disciplina";
                $banco->query($q);

                $tudoCerto = '1';

            // se não
            }else{
                $q = "INSERT INTO frequencia (aluno, disciplina, aulas) VALUES ('$frequenciaAtual', '$disciplina', '1');";
                $banco->query($q);
                $tudoCerto = '1';
            }
            $c++;

        }
      
    }

    // Aplicando faltas aos alunos da turma 
    
    $q = "SELECT min(codAluno) AS menorAluno, max(codAluno) AS maiorAluno FROM estudante WHERE turma = $cod";
    $banco->query($q);
    $busca = $banco->query($q);
    $reg = $busca->fetch_object();
    $minAluno = $reg->menorAluno?? null;
    $maiorAluno = $reg->maiorAluno?? null;

    while($minAluno <= $maiorAluno){
        $q = "SELECT turma FROM estudante WHERE codAluno = $minAluno";
        $busca = $banco->query($q);
        $reg = $busca->fetch_object();
        $turma = $reg->turma?? null;

        if($turma == $cod){
            $alunosDaTurma[] = $minAluno;
        }
       
        $minAluno++;
    }
    $alunosComFalta = array_diff($alunosDaTurma, $frequencia);
    $c = 0;
    $qntAlunosDaTurma = count($alunosDaTurma);


    while($c < $qntAlunosDaTurma){
        $alunoAtual = $alunosDaTurma[$c];

        $q = "SELECT aluno FROM frequencia WHERE aluno = $alunoAtual AND disciplina = $disciplina";
        $banco->query($q);
        $busca = $banco->query($q);
        $reg = $busca->fetch_object();
        $aluno = $reg->aluno?? null;

        if(in_array($alunoAtual, $alunosComFalta)){
            
            // se ele já tem uma tabela com aquela disciplina
            if($aluno != null){

                $q = "SELECT faltas FROM frequencia WHERE aluno = $alunoAtual AND disciplina = $disciplina";
                $busca = $banco->query($q);
                $reg = $busca->fetch_object();
                $a = $reg->faltas;
                $a++;
                $q = "UPDATE frequencia SET faltas = '$a' WHERE aluno = $alunoAtual AND disciplina = $disciplina";
                $banco->query($q);

                $tudoCerto = '2';

            // se não
            }else{
                $q = "INSERT INTO frequencia (aluno, disciplina, faltas) VALUES ('$alunoAtual', '$disciplina', '1');";
                $banco->query($q);

                 $tudoCerto = '2';
            }
        }

        $c++;
    }
    
    if(1 == 1){
        ?>
            <script>window.location.href='view_turma.php'</script>
        <?php
    }
}
?>
<html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
</html>