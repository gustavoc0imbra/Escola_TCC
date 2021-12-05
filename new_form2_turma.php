<DOCYTIPE html>
    <head>
        <meta charset="UTF-8">
        <meta description="...">
        <link rel="stylesheet" href="#">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            body{
                margin: 10px;
            }
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

            tr{
              background-color: #dddddd;
            }
            body{
                background: radial-gradient(circle, rgba(0,212,255,1) 0%, rgba(0,212,255,1) 35%, rgba(0,153,255,1) 100%);;
            }

            .prox {
                float:right;
            }

            .volt{
                float:left;
            }
        </style>
     </head>
<?php 

    include_once("includes/config.php");
    include_once("includes/functions.php");

?>
<?php

    if($_SESSION['tipo'] == "admin"){
        
        $nomeTurma = $_POST['nomeTurma']?? null;
        $codTurma = $_POST['codTurma']?? null;
        $qntAula = $_POST['qntAula']?? null;
        $horaInicio = $_POST['horas']?? null;
        $minInicio = $_POST['min']?? null;
        $horaAula = $_POST['horaAula']?? null;
        $minAula = $_POST['minAula']?? null;
        $dias = $_POST['dias']?? null;
        $intervalo = $_POST['intervalo']?? null;
        $qntAluno = $_POST['qntAluno']?? null;
        $horaIntervalo = $qntAula/2;
        $horarioIntervalo = (int)$horaIntervalo;
        $horarioDaAula = (($horaAula * 60) + $minAula);
        $horarioDoComecoDaAula = ($horaInicio * 60) + $minInicio;
        $horario = $horarioDaAula + $horarioDoComecoDaAula;
        $horarioFinal = array();
        $linha1 = array();
        $cordenadaLinha = 0;
        $cordenadaIntervalo = null;
        $tempPorAula = "$horaAula:$minAula";
        

        $minutos = $minInicio + $minAula;
        $horas = $horaInicio + $horaAula;
      
        if($dias == null){
            ?><script>
                window.location.href = "new_form_turma.php?invalidDia=true";
            </script>
            <?php
            
        }else if(($horaAula == '0')&&($minAula == '0')){
            ?><script>
            window.location.href = "new_form_turma.php?invalidTime=true";
        </script>
        <?php
        }
        echo "<center><h1>Criar Turma</h1></center>";
        ?>
        <form action='new_form3_turma.php' method='post'>
            <center><h2>Horário das aulas</h2><br></center>
            <center>
            <div class='tableDiv'>
            <table class="table table-striped table-bordered"> 
                                
                <tr>
                <thead class="table table-dark">
                    <?php 
                        $c = count($dias);
                        $b = 0;
                        while($b != $c){
                            echo "<th style='text-align:center'>$dias[$b]</th>";
                            $b++;
                        }
                    ?>
                    <th style="text-align:center">Horário</th>
                    </thead>
                </tr>
                
                <?php 
               
                // $i = quantidade de aulas
                // $d = quantidade de dias
                for($i = 0; $i < $qntAula; $i++){ 
                echo "<tr>";

                    for($d = 0; $d < $b; $d++){
                    echo "<td>";
                      $q = "SELECT min(codDisciplina) AS menorCodDisciplina, max(codDisciplina) AS maiorCodDisciplina FROM disciplina;";

                      if($banco->query($q)){
                            $linha1[] = $cordenadaLinha;
                          
                        ?>
                        <select class='form-select' style='width:100%;text-align:center;' id='<?php print_r($linha1[$cordenadaLinha])?>' name='<?php print_r($linha1[$cordenadaLinha])?>'>
                        <?php
                          $buscaCod = $banco->query($q);
                          $reg = $buscaCod->fetch_object();
                          $menorCodDisciplina = $reg->menorCodDisciplina+1;
                          $maiorCodDisciplina = $reg->maiorCodDisciplina;

                          while($menorCodDisciplina != $maiorCodDisciplina+1){
                            
                            $q = "SELECT codDisciplina,nomeDisciplina FROM disciplina WHERE codDisciplina = $menorCodDisciplina ";
                            $busca = $banco->query($q);
                               
                            if($banco->query($q)){
                                $reg = $busca->fetch_object();
                                $regEmpty = $reg->codDisciplina?? null;
                                $codDisciplina = $reg->codDisciplina;
                                
                               if($regEmpty == null){
                                   $menorCodDisciplina++;
                                       
                               }else{
                                // dados mostrados dentro da tabela 'Disciplina'
                                       
                                   echo "<option value='$codDisciplina'>$reg->nomeDisciplina</option>";
                                   $menorCodDisciplina++;
                               }
                            }else{
                                echo "Erro ao mostrar disciplina, tente novamente mais tarde";
                            }
                        }echo"</select>";
                        
                        
                       
                      }else{
                          echo "Erro ao pesquisar tabela de disciplina";
                      }
                    echo "</td>";

                    $cordenadaLinha++;
                    }
                    
                    // Horario
                    if($i == "0"){

                        $horarioFinal[] = "$horaInicio:$minInicio";

                        if($minInicio < 10){
                            echo "<td style='text-align:center'>$horaInicio:0$minInicio</td>";
                        }else{
                            echo "<td style='text-align:center'>$horaInicio:$minInicio</td>";
                        }
                        

                    }else{
                       
                        if($horas >=24){
                            $horas = $horas-24;
                        }

                        while($minutos >= 60){
                            $minutos = $minutos-60;
                            $horas = $horas + 1;
                        }

                        if($horas >=24){
                            $horas = $horas-24;
                        }
                        
                        if($minutos < 10){
                            echo "<td style='text-align:center'>$horas:0$minutos</td>";
                            $horarioFinal[] = "$horas:0$minutos";
                        }else{
                            echo "<td style='text-align:center'>$horas:$minutos</td>";
                            $horarioFinal[] = "$horas:$minutos";
                        }

                        

                        if($intervalo != "00"){
                           
                            if($i != $horarioIntervalo-1){
                                $minutos = $minutos + $horarioDaAula;
                            }
                                
                        }else{
                            while($minutos >= 60){
                                $minutos = $minutos-60;
                                $horas = $horas + 1;
                            }
                            $minutos = $minutos+$horarioDaAula;
                        }
                        
                    }

                    // intervalo
                    if($i == $horarioIntervalo-1){
                           
                            
                        if($intervalo != "00"){
                            echo"<tr>";
                            for($g = 0; $g < $b; $g++){
                                echo "<td style='text-align:center'>intervalo</td>";

                                if($cordenadaIntervalo == null){
                                    $cordenadaIntervalo = $cordenadaLinha;
                                   
                                }
                                
                            }
                           
                            $minutos = $minutos + $intervalo;  

                            while($minutos >= 60){
                                $minutos = $minutos-60;
                                $horas = $horas + 1;
                            }
                            if($horas >=24){
                                $horas = $horas-24;
                            }

                            if($minutos < 10){
                                echo "<td style='text-align:center'>$horas:0$minutos</td>";
                                $horarioFinal[] = "$horas:0$minutos";
                            }else{
                                echo "<td style='text-align:center'>$horas:$minutos</td>";
                                $horarioFinal[] = "$horas:$minutos";    
                            }
                            
                            $minutos = $minutos + $horarioDaAula;
                            echo "</tr>";
                            
                            
                        }
                           
                    }
                            
                }
                echo "</tr>";
               
                
                ?> 
            </table>
            
        </center>
            <?php
            // enviando valores de array(s)
             foreach($horarioFinal as $valuehorarioFinal)
             {
                 echo '<input type="hidden" name="horarioFinal[]" value="'. $valuehorarioFinal. '">';
             }
             foreach($dias as $valueDias)
             {
                 echo '<input type="hidden" name="dias[]" value="'. $valueDias. '">';
             }
          
            ?>
            <!-- valores do new_form_turma.php -->
            <input type='hidden' id='nomeTurma' name='nomeTurma' value='<?php echo $nomeTurma?>'>
            <input type='hidden' id='codTurma' name='codTurma' value='<?php echo $codTurma?>'>
            <input type='hidden' id='tempPorAula' name='tempPorAula' value='<?php echo $tempPorAula?>'>
            <input type='hidden' id='intervalo' name='intervalo' value='<?php echo $intervalo?>'>
            

            <!-- Enviando valores -->
            <input type='hidden' id='cordenadaIntervalo' name='cordenadaIntervalo' value='<?php echo $cordenadaIntervalo?>'>
            <input type='hidden' id='totalAulas' name='totalAulas' value='<?php echo $cordenadaLinha?>'>
            <input type='hidden' id='qntDias' name='qntDias' value='<?php echo $b?>'>

            
                
           <br><Br><button type='submit' class="btn btn-primary prox"> Próximo &#8631;</button>
        </form>
        <center><a href='new_form_turma.php'><button class="btn btn-primary volt">&#8630; Voltar</button></a></center>
        <?php
    }else{
        echo "Somente administradores tem acesso a essa página!";
    }
    ?>