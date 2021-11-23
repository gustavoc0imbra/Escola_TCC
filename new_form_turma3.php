<DOCYTIPE html>
    <head>
        <meta charset="UTF-8">
        <meta description="...">
        <link rel="stylesheet" href="#">
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
        </style>
    </head>
    <?php 

        include_once("includes/config.php");
        include_once("includes/functions.php");
        
    ?>
    <?php

    // valores do new_form_turma.php
    $nomeTurma = $_POST['nomeTurma']??null;
    $codTurma = $_POST['codTurma']??null;
    $tempPorAula = $_POST['tempPorAula']??null;
    $intervalo = $_POST['intervalo']??null;
    $dias = $_POST['dias']?? null;
    
    $c = null;
    $a = array();
    $professores = array();
    $horarioFinal = $_POST['horarioFinal']??null;
    $cordenadaIntervalo = $_POST['cordenadaIntervalo']?? null;
    $totalAulas = $_POST['totalAulas']?? null;
    $qntDias = $_POST['qntDias']?? null;
    $disciplina = $_POST[$c]?? null;
    $qntAluno = $_POST['qntAluno']?? null;
    $horarioFinalDisciplina = array();


         
    
    
    
    
   

    ?>
    <body>
        <h1>Criar turma</h1>
        <h2>Adicionando usuários</h2>
        <form action='new_form4_turma.php' method='post'>
            <h3>Professores</h3>
            <!-- Tabela professores -->
            <table>
                <tr>
                    <th>Materia</th>
                    <th>Professor</th>
                    <th>Professor Extra</th>
                </tr>
                <?php 
            
            $disciplinasDaSala = array();
            $disciplinaVar = null;

                // formatando array do horarioFinalDisciplina;
                for($c = 0; $c < $totalAulas; $c++){

                    //intervalo
                    if(($c == $cordenadaIntervalo)&& ($intervalo != "00")){
                        for($a = 0; $a < $qntDias; $a++){
                        $horarioFinalDisciplina[] = "intervalo";
                        }
                    }

                    $disciplina = $_POST[$c]?? null;   
                    $horarioFinalDisciplina[] = $disciplina;

                    if($disciplina != $disciplinaVar){
                        if(!in_array($disciplina, $disciplinasDaSala)){
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
                                    echo"<td><select id='professor[]' name='professor[]'>";

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
                                                                    
                                                    echo "<option value='$reg2->codProf' >$reg2->nomeProf</option>";
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
                                                                     
                                                     echo "<option value='$reg2->codProf'>$reg2->nomeProf</option>";
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
                            
                        $disciplinaVar = $disciplina;
                    }
                        
                }
                
                ?>
            </table>
            <?php 

            $q3 = "SELECT MIN(codAluno) AS menorCod, MAX(codAluno) AS maiorCod FROM estudante;";

            $buscaCod = $banco->query($q3);
            $reg = $buscaCod->fetch_object();
            $c = $reg->menorCod;
            $maiorCod = $reg->maiorCod;
           
                    
            if($banco->query($q3)){
            ?>
                <h3>Alunos</h3>
                <!-- Tabela alunos -->
                <table>
                    <tr>
                        <th>Add</th>
                        <th>Aluno</th>
                        <th>Rm</th>
                    </tr>
                        <?php 
                        
                        while($c !=$maiorCod+1){
                                
                            $q = "SELECT codAluno,nomeAluno FROM estudante WHERE codAluno = $c";
                            $busca = $banco->query($q);
                            
                            if($banco->query($q)){
                                $reg = $busca->fetch_object();
                                $regEmpty = $reg->codAluno?? null;
                                
                                if($regEmpty == null ){
                                    $c++;
                                }else{
                                //dados mostrados dentro da tabela 'usuarios aluno'
                                ?>
                                <tr>
                                    <td><input type='checkbox' name='alunos[]' id='alunos[]' value='<?php echo $reg->codAluno?>'></td>
                                    <td><?php echo $reg->nomeAluno ?></td>
                                    <td><?php echo $reg->codAluno ?></td>
                                </tr>
                                <?php
                                
                                $c ++;
                                }
                                
                            }else{
                                echo "Erro na tabela do banco de dados! tente novamente mais tarde ;/";
                            }
                        }
                        ?>
                  
                </table>
            <?php
            }else{
                echo "Erro na busca dos alunos por favor tente novamente mais tarde!";
            }
            
            

            //Enviando valores 
            // valores de arrays
            foreach($dias as $valueDias)
            {
                echo '<input type="hidden" name="dias[]" value="'. $valueDias. '">';
            }
            foreach($disciplinasDaSala as $valueDisciplinas)
            {
                echo '<input type="hidden" name="disciplinasDaSala[]" value="'. $valueDisciplinas. '">';
            }

            foreach($horarioFinalDisciplina as $valuehorarioFinalDisciplina)
            {
                echo '<input type="hidden" name="horarioFinalDisciplina[]" value="'. $valuehorarioFinalDisciplina. '">';
            }

            foreach($horarioFinal as $valuehorarioFinal)
            {
                echo '<input type="hidden" name="horarioFinal[]" value="'. $valuehorarioFinal. '">';
            }
            ?>
            
            
            <!-- valores do new_form_turma.php -->
            <input type='hidden' id='nomeTurma' name='nomeTurma' value='<?php echo $nomeTurma?>'>
            <input type='hidden' id='codTurma' name='codTurma' value='<?php echo $codTurma?>'>
            <input type='hidden' id='tempPorAula' name='tempPorAula' value='<?php echo $tempPorAula?>'>
            <input type='hidden' id='intervalo' name='intervalo' value='<?php echo $intervalo?>'>


            <br><Br><button type='submit'> Próximo &#8631;</button>
        </form>
        <a href='new_form_turma.php'><button>&#8630; Voltar</button></a>
        <script>


        
        </script>

    </body>
