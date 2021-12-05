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
    <body>
        <?php 
            $codTurma = $_GET['cod'];
            $nomeTurma = $_GET['nomeTurma'];
            $linha1 = array();
            echo "<h3>Nome da turma: $nomeTurma <br> código: $codTurma</h3>";
        ?>

        <h3>Horario</h3>
         <form action='edit_form2_turma.php' method='post'>
         <table class="table table-dark table-striped">
            <tr>
                <?php 
            
                $q = "SELECT MIN(cod) AS minCod, MAX(cod) AS maxCod FROM horarioturma$codTurma ";

                if($banco->query($q)){
                    $busca = $banco->query($q);
                    $reg = $busca->fetch_object();
                    $minCod = $reg->minCod;
                    $minCod1 = $reg->minCod;
                    $maxCod = $reg->maxCod;

                    while($minCod <= $maxCod){
                        $q = "SELECT * FROM horarioTurma$codTurma WHERE cod = $minCod";

                        if($banco->query($q)){
                            $busca = $banco->query($q);
                            $reg = $busca->fetch_object();
                            $dia = $reg->dias?? null;

                           

                            if($dia != null){
                                
                                // colunas da tabela (dias(seg,ter,quar))
                                echo "<th>$dia</th>";
                                $dias[] = $dia;
                            }

                            $minCod++;
                            
                        }else{
                            echo "Erro na busca do horario, tente novamente mais tarde!";
                        }
                    }
                    $minCod = $minCod1;
                }else{
                    echo "Erro na busca, tente novamente mais tarde!";
                }

                ?>
                <th>Horario</th>
            </tr>
            <?php 

                // selecionando a maior e a menor disciplina para incrementar ao select
                $q1 = "SELECT min(codDisciplina) AS menorCodDisciplina, max(codDisciplina) AS maiorCodDisciplina FROM disciplina;";
                $banco->query($q1);
                $busca1 = $banco->query($q1);
                $reg1 = $busca1->fetch_object();
                $menorCodDisciplina = $reg1->menorCodDisciplina;
                $menorCodDisciplina1 = $reg1->menorCodDisciplina;
                $maiorCodDisciplina = $reg1->maiorCodDisciplina;
                $cordenadaLinha = 0;
                
              
              $countDias = count($dias);

              while($minCod <= $maxCod){
                  echo "<tr class='table table-striped'>";
                  $q = "SELECT horario, ";

                 // selecionando os dias
                 $c = 0;
                 while($c < $countDias){

                    $dia = $dias[$c];

                    if($c == $countDias-1){
                        $q.= "$dia ";
                    }else{
                        $q.= "$dia,";
                    }
                    $c++;
                  }

                  $q.="FROM horarioturma$codTurma WHERE cod = $minCod";

                  if($banco->query($q)){
                        $busca = $banco->query($q);
                        $reg = $busca->fetch_object();
                        $b = 0;

                        while($b < $countDias){
                            $dia = $dias[$b];
                            $var = $reg->$dia;
                            
                            $linha1[] = $cordenadaLinha;

                            if($var != "0"){
                                ?>
                                <td><select id='<?php print_r($linha1[$cordenadaLinha])?>' name='<?php print_r($linha1[$cordenadaLinha])?>'>
                                <?php
                                $menorCodDisciplina = $menorCodDisciplina1+1;

                                while($menorCodDisciplina <= $maiorCodDisciplina){
                                    $q2 = "SELECT nomeDisciplina, codDisciplina FROM disciplina WHERE codDisciplina = $menorCodDisciplina";
                                    if($banco->query($q2)){
                                        $busca2 = $banco->query($q2);
                                        $reg2 = $busca2->fetch_object();
                                        $codDisciplina = $reg2->codDisciplina?? null;
                                        $nomeDisciplina = $reg2->nomeDisciplina;

                                        if($codDisciplina == null){
                                            $menorCodDisciplina++;
                                        }else{                
                                            
                                            if($var == $menorCodDisciplina){
                                                echo "<option selected value='$codDisciplina'>$nomeDisciplina</option>";
                                            }else{
                                                echo "<option value='$codDisciplina'>$nomeDisciplina</option>";
                                            }
                                            
                                            $menorCodDisciplina++;
                                        }

                                    }else{
                                        echo "Algo deu errado na busca das disciplinas, tente novamente mais tarde!";
                                    }
                                }
                            echo "</select></td>";
                            }else{
                                ?>
                                <input type='hidden' id='<?php print_r($linha1[$cordenadaLinha])?>' name='<?php print_r($linha1[$cordenadaLinha])?>' value='intervalo'>
                                <?php
                                echo "<td>intervalo</td>";
                            }
                            
                            if($b == $countDias-1){
                                echo "<td>$reg->horario</td>";
                            }
                                
                            
                            $cordenadaLinha++;
                            $b++;
                        }

                        
                       
                  }else{
                      echo "Algo deu errado tente novamente mais tarde!";
                  }
                  $minCod++;
                  
              }
              
            ?>
         </table>
              
         <!-- Enviando valores de array(s) -->
         <?php 
             foreach($dias as $valueDias)
             {
                 echo '<input type="hidden" name="dias[]" value="'. $valueDias. '">';
             }
         ?>
         <input type='hidden' id='codTurma' name='codTurma' value='<?php echo $codTurma?>'>
         <input type='hidden' id='totalAulas' name='totalAulas' value='<?php echo $cordenadaLinha?>'>
         <input type='hidden' id='nomeTurma' name='nomeTurma' value='<?php echo $nomeTurma?>'>
         <Br><br><button type='submit'>Próximo</button>
         </form>   
        <br><a href='view_turma.php'>Voltar</a> ||
        <a href='index.php'>Menu</a>
    </body>
</html>