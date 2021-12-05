<docytipe html>
    <head>
        <meta charset="UTF-8">
        <meta description="...">
        <link rel="stylesheet" href="#">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            table {
              font-family: arial, sans-serif;
              border-collapse: collapse;
              width: 100%;
            }

            td, th {
              border: 1px solid grey;
              text-align: left;
              padding: 5px;
            }

            tr:nth-child(even) {
              background-color: #dddddd;
            }

            .conf{
                margin-right: 150px;
                margin-bottom: 20px;
                float:right;
            }
            .volt{
                margin-left: 150px;
                margin-bottom: 20px;
                float:left;
            }
        </style>
    </head>
<?php 
 include_once("includes/config.php");
 include_once("includes/functions.php");
?>
<?php
$nomeTurma = $_POST['nomeTurma']?? null;
$codTurma = $_POST['codTurma']?? null;
$tempPorAula = $_POST['tempPorAula']?? null;
$intervalo = $_POST['intervalo']?? null;
$horarioFinalDisciplina = $_POST['horarioFinalDisciplina']?? null;
$horarioFinal = $_POST['horarioFinal']?? null;
$professor = $_POST['professor']?? null;
$extraProf = $_POST['extraProf']?? null;
$alunos = $_POST['alunos']?? null;
$disciplinasDaSala = $_POST['disciplinasDaSala']?? null;
$dias = $_POST['dias']?? null;
$qntDeDisciplinas = count($disciplinasDaSala);
$qntDias = count($dias);
$qntdeAulas = count($horarioFinalDisciplina);


?>
<center><h1>Confirmar criação</h1></center>
<?php
echo "<center>Nome Turma: $nomeTurma,<br> Código da turma: $codTurma,<Br> Tempo por aula: $tempPorAula,<br> Tempo de intervalo: $intervalo</center>";
?>
<Br><br><center><h2>Professores:</h2></center>
<!-- Tabela dos professores -->
<center>
<table class='table table-bordered table-striped table-dark' style="width:80%">
    <tr>
        <th>Rm Prof</th>
        <th>Professor</th>
        <th>Professor Extra</th>
        <th>Disciplina</th>
    </tr>
    <?php 
    
    for($c = 0; $c < $qntDeDisciplinas; $c++){

        ?>
    <tr>
        <?php 
        
        // Rm dos professores
        echo "<td> $professor[$c]";

        if(($extraProf[$c] != 0) && ($extraProf[$c] != $professor[$c])){
            echo ", $extraProf[$c]";
        }

        echo "</td>";

        // nome dos professores
        $q = "SELECT  nomeProf FROM professor WHERE codProf = $professor[$c]";
        
        if($banco->query($q)){
            $busca = $banco->query($q);
            $reg = $busca->fetch_object();
            $nomeProf = $reg->nomeProf?? null;

            if($nomeProf != null){
                echo "<td>$reg->nomeProf</td>";
            }else{
                echo "<td>Nenhum</td>";
            }
            

            // nome dos professores Extra
            if(($extraProf[$c] != 0) && ($extraProf[$c] != $professor[$c])){
                $q2 = "SELECT  nomeProf FROM professor WHERE codProf = $extraProf[$c]";

                if($banco->query($q2)){
                    $busca2 = $banco->query($q2);
                    $reg2 = $busca2->fetch_object();
                    echo "<td>$reg2->nomeProf</td>";

                }else{
                    echo "<td>Erro ao procurar nome dos professores extra, por favor tente novamente mais tarde!</td>";
                }

            }else{
                // se caso sem professor extra
                echo "<td>Null</td>";
            }

            
            // Disciplinas
            $q3 = "SELECT nomeDisciplina FROM disciplina WHERE codDisciplina = $disciplinasDaSala[$c]";

            if($banco->query($q3)){
                $busca3 = $banco->query($q3);
                $reg3 = $busca3->fetch_object();
                echo "<td>$reg3->nomeDisciplina</td>";

            }else{
                echo "<td>Erro ao pesquisar disciplinas, por favor tente novamente mais tarde!</td>";
            }
            
        }else{
            echo "<td>Algo deu errado na busca dos professores por favor tente novamente mais tarde!</td>";
        }


        ?>
    </tr>

    <?php
    }
    ?>

</table>
</center>
<?php 
    if($alunos == null){
        echo "<center><h3 style='color:red'>Atenção! nenhum aluno está sendo cadastrado nessa turma</h3></center>";
    }else{
        ?>
        <center><h2> Alunos:</h2>
        <!-- tabela Alunos -->
        <table class='table table-bordered table-striped table-dark' style="width:80%">
            <tr>
                <th>Nome</th>    
                <th>Rm</th>  
            </tr>
            <?php 
        
                foreach($alunos as $valueAlunos){
                    echo "<tr>";
                    
                            $q = "SELECT nomeAluno FROM estudante WHERE codAluno = $valueAlunos";
                            if($banco->query($q)){
                                $busca=$banco->query($q);
                                $reg=$busca->fetch_object();
        
                                echo "<td>$reg->nomeAluno</td>";
                            }else{
                                echo "<td>Erro na busca, por favor tente novamente mais tarde!</td>";
                            }
                    echo "<td>$valueAlunos</td>
                    </tr>";
                }
            ?>
            
        </table>
            </center>
        <?php
    }
?>

<center><h2>Horario das aulas</h2></center>
<!-- tabela do Horario das aulas -->
<center>
<table class='table table-bordered table-striped table-dark' style="width:80%">
    <tr>
        <?php
        foreach($dias as $valueDias){
            echo "<th>$valueDias</th>";
        }
        // horario
        echo "<th>Horario</th>";
        ?>
    </tr>
    <?php


        /* --logica horario--
         aulas = $c
         quebra de linha = $b
         horario das aulas = $h
         */ 

       $c = 0;
       $b = 0;
       $h = 0;

      

        while($c < $qntdeAulas){
            if($b == $qntDias){
                echo "<td>$horarioFinal[$h]</td></tr>";
                $h++;
                $b = 0;
            }

            if($horarioFinalDisciplina[$c] != "intervalo"){
                $q = "SELECT nomeDisciplina FROM disciplina WHERE codDisciplina = $horarioFinalDisciplina[$c]";

                if($banco->query($q)){
                    $busca = $banco->query($q);
                    $reg = $busca->fetch_object();
                    
                    echo "<td>$reg->nomeDisciplina</td>"; 
    
                }else{
                    echo "<td>Algo deu errado, tente novamente mais tarde!</td>";
                }
            }else{
                echo "<td>$horarioFinalDisciplina[$c]</td>";
            }

            
            
            $b++;
            $c++;
        }echo "<td>$horarioFinal[$h]</td>";
   
    ?>
</table>
</center>
<!-- Enviando valores -->
<form action='new_turma.php' method='post'>
    
        <input type='hidden' name='nomeTurma' value='<?php echo $nomeTurma?>'>
        <input type='hidden' name='codTurma' value='<?php echo $codTurma?>'>
        <input type='hidden' name='tempPorAula' value='<?php echo $tempPorAula?>'>
        <input type='hidden' name='intervalo' value='<?php echo $intervalo?>'>

        <!-- valores de Arrays -->
        <?php
        foreach($professor as $valueProfessor){
            echo '<input type="hidden" name="professor[]" value="'. $valueProfessor. '">';
        }
        foreach($extraProf as $valueExtraProf){
            echo '<input type="hidden" name="extraProf[]" value="'. $valueExtraProf. '">';
        }
        foreach($disciplinasDaSala as $valueDisicplinasDaSala){
            echo '<input type="hidden" name="disciplinasDaSala[]" value="'. $valueDisicplinasDaSala. '">';
        }
        if($alunos != null){
            foreach($alunos as $valueAlunos){
                echo '<input type="hidden" name="alunos[]" value="'. $valueAlunos. '">';
            }
        }
        
        foreach($horarioFinalDisciplina as $valuehorarioFinalDisciplina){
            echo '<input type="hidden" name="horarioDisciplina[]" value="'. $valuehorarioFinalDisciplina. '">';
        }
        foreach($horarioFinal as $valueHorarioFinal){
            echo '<input type="hidden" name="horarioFinal[]" value="'. $valueHorarioFinal. '">';
        }
        foreach($dias as $valueDias){
            echo '<input type="hidden" name="dias[]" value="'. $valueDias. '">';
        }
            

        ?>
        <br>
        <button class="btn btn-primary conf" type='submit' value='enviar'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-check" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
  <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
  <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/>
</svg> Confirmar</button>
        <a href='new_form_turma.php'><button class="btn btn-primary volt">&#8630; Voltar</button></a>
</form>
