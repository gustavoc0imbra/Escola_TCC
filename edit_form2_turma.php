<docytipe html>
<head>
    <meta charset="UTF-8">
        <meta description="...">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            table {
              font-family: arial, sans-serif;
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
        </style>
    </head>
    <?php 
    include_once("includes/config.php");
    include_once("includes/functions.php");
    ?>
    <body><br>
    <h1>Professores</h1>
<?php
    $dias = $_POST['dias'];
    $totalAulas = $_POST['totalAulas']?? null;
    $codTurma = $_POST['codTurma']?? null;
    $nomeTurma = $_POST['nomeTurma']?? null;

    $c = null;
    $disciplinaVar = null;
    $disciplinasDaSala = array();

    ?>
    <form action='edit_turma.php' method='post'>
    <table>
        <tr>
            <th>Disciplina</th>
            <th>Professor</th>
            <th>Professor Extra</th>
        </tr>
    
    <?php

    // formatando array do horarioFinalDisciplina;
    for($c = 0; $c < $totalAulas; $c++){

        $disciplina = $_POST[$c]?? null;   
        $horarioFinalDisciplina[] = $disciplina;

        if($disciplinaVar != $disciplina){
            if(!in_array($disciplina, $disciplinasDaSala)){
               

                if($disciplina != 'intervalo'){
                    $disciplinasDaSala[] = $disciplina;
                    $q = "SELECT codDisciplina,nomeDisciplina FROM disciplina WHERE codDisciplina = $disciplina ";
                    $busca = $banco->query($q);
                    $reg = $busca->fetch_object();

                    if($banco->query($q)){
                        echo "<td>$reg->nomeDisciplina</td>";
                    

                        $q1 = "SELECT min(codProf) as minCod, max(codProf) as maxCod FROM professor WHERE codDisciplina = $disciplina";
                                        
                        if($banco->query($q1)){
                                        
                            $busca1 = $banco->query($q1);
                            $reg1 = $busca1->fetch_object();
                                        
                            $menorCod = $reg1->minCod?? null;
                            $maiorCod = $reg1->maxCod;
                            echo"<td><select id='professor[]' name='professor[]'><option value='0'>Nenhum</option>";

                            if($menorCod != null){

                                
                                // escolher professor
                                while($menorCod != $maiorCod+1){


                                        
                                    $q2 = "SELECT nomeProf, codProf FROM professor WHERE codProf = $menorCod AND codDisciplina = $disciplina";
                                    $busca2 = $banco->query($q2);
                                                    
                                    if($banco->query($q2)){
                                        $reg2 = $busca2->fetch_object();
                                        $regEmpty2 = $reg2->codProf?? null;
                                        
                                        
                                                        
                                        if($regEmpty2 == null){
                                            $menorCod++;
                                        }else{                   
                                            
                                            $q3 = "SELECT professores FROM disciplinasturma$codTurma WHERE disciplinas = $disciplina";
                                            
                                        
                                            if($banco->query($q3)){

                                                $busca3 = $banco->query($q3);
                                                $reg3 = $busca3->fetch_object();
                                                $professor = $reg3->professores?? null;

                                                if($regEmpty2 == $professor){
                                                
                                                    echo "<option selected value='$reg2->codProf'> $reg2->nomeProf</option>";

                                                }else{
                                                    echo "<option value='$reg2->codProf'>$reg2->nomeProf</option>";
                                                }
                                                
                                                
                                            }else{
                                                echo "Algo deu errado ao carregar professores da turma, por favor tente novamente mais tarde!";
                                            }
                                            
                                            $menorCod++;
                                        }
                                                        
                                    }else{
                                        echo "Erro ao encontrar professor com essa disciplina, tente novamente mais tarde!";
                                    }
                                }
                                    
                                echo"</select></td>";
                            }else{
                                echo "<option value='0'>Nenhum</option></select>";
                                
                            }
                            echo "<td><select id='extraProf[]' name='extraProf[]'><option value='0'>Nenhum</option>";
                            if($menorCod != null){
                                // PROFESSOR EXTRA
                                
                                $menorCod = $reg1->minCod;
                                $maiorCod = $reg1->maxCod;
                                while($menorCod != $maiorCod+1){
                                        
                                    $q2 = "SELECT nomeProf, codProf FROM professor WHERE codProf = $menorCod AND codDisciplina = $disciplina";
                                    $busca2 = $banco->query($q2);
                                                    
                                    if($banco->query($q2)){
                                        $reg2 = $busca2->fetch_object();
                                        $regEmpty2 = $reg2->codProf?? null;
                                                        
                                        if($regEmpty2 == null){
                                            $menorCod++;
                                        }else{
                                            
                                            $q3 = "SELECT extraProf FROM disciplinasturma$codTurma WHERE disciplinas = $disciplina";
                                            if($banco->query($q3)){
                                                $busca3 = $banco->query($q3);
                                                $reg3 = $busca3->fetch_object();
                                                $extraProf = $reg3->extraProf?? null;

                                                if($regEmpty2 == $extraProf){
                                                    echo "<option selected value='$reg2->codProf'> $reg2->nomeProf</option>";
                                                }else{
                                                    echo "<option value='$reg2->codProf'>$reg2->nomeProf</option>";
                                                }
                                            }else{
                                                echo "Algo deu errado na busca dos professores da turma, por favor tente novamente mais tarde!";
                                            }
                                           
                                            $menorCod++;
                                        }
                                                        
                                    }else{
                                        echo "Erro ao encontrar professor com essa disciplina, tente novamente mais tarde!";
                                    }
                                }
                                echo "</select></td></tr>";  
                            }else{
                                echo "<option value='0'>Sem professor</option></select></tr>";
                            }   
                                    
                                        
                        }else{
                            echo "Erro na procura de professores com essa disciplina por favor tente novamente mais tarde!";
                        }

                    }else{
                        echo "<td>Algo deu errrado tente novamente mais tarde!</td>";
                    }

                }

                
            }
        }

        $disciplinaVar = $disciplina;
        
    }
  
    ?>
    </table><Br><Br>
    <?php
    // ALUNOS 

    $q = "SELECT cod FROM turmas where codTurma = '$codTurma'";
    $banco->query($q);
    $busca = $banco->query($q);
    $reg = $busca->fetch_object();

    $cod = $reg->cod;
    
    $q = "SELECT MIN(codAluno) AS menorCodAluno, MAX(codAluno) AS maiorCodAluno FROM estudante WHERE turma = '$cod'";
    $banco->query($q);
    $busca = $banco->query($q);
    $reg = $busca->fetch_object();

    $menorCodAluno = $reg->menorCodAluno?? null;
    $maiorCodAluno = $reg->maiorCodAluno?? null;
    
    if($menorCodAluno == null){
        echo "<h3 style='color:red'>Atenção! nenhum aluno está cadastrado nessa turma</h3>";
    }else{
     
        ?>
        <!-- Tabela Alunos -->
        <h3>Retirar Alunos </h3>
        <table>
            <tr>
                <th>Nome</th>
                <th>Rm</th>
                <th>Retirar</th>
            </tr>

            <?php 
                while($menorCodAluno <= $maiorCodAluno){
                    $q = "SELECT nomeAluno, codAluno FROM estudante WHERE codAluno = $menorCodAluno and turma = $cod";
                    
                    if($banco->query($q)){
                        $busca = $banco->query($q);
                        $reg = $busca->fetch_object();
                        $codAluno = $reg->codAluno?? null;

                        if($codAluno == null){
                            $menorCodAluno++;
                        }else{
                            echo "<td>$reg->nomeAluno</td><td>$reg->codAluno</td><td>";
                            echo "<input type='checkbox' name='alunos[]' id='alunos[]' value='$reg->codAluno'></tr>";
                            $menorCodAluno++;
                        }

                       
                    }else{
                        echo "Erro na busca de alunos, por favor tente novamente mais tarde!";
                    }
                }
            ?>
            <tr>
            </tr>
        </table><Br><Br>
        <?php
    }
   ?>
   <!-- Tabela Add alunos -->
   <h3>Adicionar Alunos</h3>
   <table>
       <tr>
           <th>Nome</th>
           <th>Rm</th>
           <th>Add</th>
       </tr>
       <?php
       $q = "SELECT MIN(codAluno) AS minCodAluno, MAX(codAluno) AS maxCodAluno FROM estudante WHERE turma is null or turma = '0'";
       $busca = $banco->query($q);
       $reg = $busca->fetch_object();
       $minCodAluno = $reg->minCodAluno?? null;
       $maxCodAluno = $reg->maxCodAluno?? null;

       if($minCodAluno == null){
           echo "todos os alunos já estão cadastrado!";
       }else{
           
           while($minCodAluno <= $maxCodAluno){
               $q = "SELECT codAluno, nomeAluno FROM estudante WHERE codAluno = $minCodAluno and turma ='0'";

               if($banco->query($q)){
                    $busca = $banco->query($q);
                    $reg = $busca->fetch_object();
                    $codAluno = $reg->codAluno?? null;


                    if($codAluno != null){
                        echo "<td>$reg->nomeAluno</td><td>$reg->codAluno</td><td>";
                        echo "<input type='checkbox' name='alunosAdd[]' id='alunosAdd[]' value='$reg->codAluno'></tr>";

                    }
                    $minCodAluno++;

               }else{
                   echo "Erro na busca dos alunos não cadastrado em nenhuma turma, por favor tente novamente mais tarde!";
               }
           }
           $minCodAluno = 0;
           while($minCodAluno <= $maxCodAluno){
            $q = "SELECT codAluno, nomeAluno FROM estudante WHERE codAluno = $minCodAluno and turma is null";

            if($banco->query($q)){
                 $busca = $banco->query($q);
                 $reg = $busca->fetch_object();
                 $codAluno = $reg->codAluno?? null;


                 if($codAluno != null){
                     echo "<td>$reg->nomeAluno</td><td>$reg->codAluno</td><td>";
                     echo "<input type='checkbox' name='alunosAdd[]' id='alunosAdd[]' value='$reg->codAluno'></tr>";

                 }
                 $minCodAluno++;

            }else{
                echo "Erro na busca dos alunos não cadastrado em nenhuma turma, por favor tente novamente mais tarde!";
            }
        }
       }
       ?>
</table>
<?php 
     foreach($horarioFinalDisciplina as $valueHorarioFinalDisciplina)
     {
         echo '<input type="hidden" name="HorarioFinalDisciplina[]" value="'. $valueHorarioFinalDisciplina. '">';
     }

    foreach($disciplinasDaSala as $valueDisciplinas)
    {
        echo '<input type="hidden" name="disciplinasDaSala[]" value="'. $valueDisciplinas. '">';
    }

    foreach($horarioFinalDisciplina as $valuehorarioFinalDisciplina)
    {
        echo '<input type="hidden" name="horarioFinalDisciplina[]" value="'. $valuehorarioFinalDisciplina. '">';
    }
?>
<Br>
<input type='hidden' name='codTurma' id='codTurma' value='<?php echo $codTurma?>'>
<button type='submit'>Confirmar alterações</button>
</form>

<?php 
    echo "<a href='edit_form_turma.php?nomeTurma=$nomeTurma&cod=$codTurma'><button>Voltar</button</a>";
?>