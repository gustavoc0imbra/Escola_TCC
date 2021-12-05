<docytipe html>
    <head>
    <meta charset="UTF-8">
        <meta description="...">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            body{
                overflow: hidden;
            }
             .ondas{
          margin-top: 1.5%;
          position: relative;
            }

            .sgc{
                
                color: white;
                position: absolute;
                bottom: 8px;
                left: 16px;
                font-size: 26px;
            }
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

            .volt{
                margin-left: 8px;
            }
        </style>
    </head>
    <?php 
    include_once("includes/config.php");
    include_once("includes/functions.php");
    ?>
    <body>
        <?php 

            $codAluno = $_SESSION['user'];

            $q = "SELECT turma FROM estudante WHERE codAluno = $codAluno";
            $banco->query($q);
            $busca = $banco->query($q);
            $reg = $busca->fetch_object();
            $turma = $reg->turma??null;
            
            if($turma == null){
                echo "Aluno ainda não associado a nenhuma turma, tente novamente mais tarde!";
            }else{

                $q = "SELECT codTurma, nomeTurma FROM turmas WHERE cod = $turma";
                $banco->query($q);
                $busca = $banco->query($q);
                $reg = $busca->fetch_object();
                $codTurma = $reg->codTurma??null;
                $nomeTurma = $reg->nomeTurma;


                $linha1 = array();
                echo "<center><h3>Turma: $nomeTurma</h3><br>Código da turma: $codTurma</center>";
            ?>
    
            <h3>Horario</h3>
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
                                    <td>
                                    <?php
                                    $menorCodDisciplina = $menorCodDisciplina1+1;
    
                                    while($menorCodDisciplina <= $maiorCodDisciplina){
                                        $q2 = "SELECT nomeDisciplina, codDisciplina FROM disciplina WHERE codDisciplina = $menorCodDisciplina";
                                        if($banco->query($q2)){
                                            $busca2 = $banco->query($q2);
                                            $reg2 = $busca2->fetch_object();
                                            $codDisciplina = $reg2->codDisciplina?? null;
                                            $nomeDisciplina = $reg2->nomeDisciplina?? null;
    
                                            if($codDisciplina == null){
                                                $menorCodDisciplina++;
                                            }else{                
                                                
                                                if($var == $menorCodDisciplina){
                                                    echo "$nomeDisciplina";
                                                }else{
                                                   
                                                }
                                                
                                                $menorCodDisciplina++;
                                            }
    
                                        }else{
                                            echo "Algo deu errado na busca das disciplinas, tente novamente mais tarde!";
                                        }
                                    }
                                echo "</td>";
                                }else{
                                    
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
    }
             ?>

            <a href='index.php'><center><button type="button" class="btn btn-primary volt">Voltar</button></center></a>
            <div class='ondas'>
               <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
               <path fill="#a6a6a6" fill-opacity="1" d="M0,224L48,202.7C96,181,192,139,288,138.7C384,139,480,181,576,181.3C672,181,768,139,864,117.3C960,96,1056,96,1152,106.7C1248,117,1344,139,1392,149.3L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
                    <path fill="#8c8c8c" fill-opacity="1" d="M0,224L24,192C48,160,96,96,144,90.7C192,85,240,139,288,170.7C336,203,384,213,432,197.3C480,181,528,139,576,144C624,149,672,203,720,197.3C768,192,816,128,864,112C912,96,960,128,1008,160C1056,192,1104,224,1152,197.3C1200,171,1248,85,1296,64C1344,43,1392,85,1416,106.7L1440,128L1440,320L1416,320C1392,320,1344,320,1296,320C1248,320,1200,320,1152,320C1104,320,1056,320,1008,320C960,320,912,320,864,320C816,320,768,320,720,320C672,320,624,320,576,320C528,320,480,320,432,320C384,320,336,320,288,320C240,320,192,320,144,320C96,320,48,320,24,320L0,320Z"></path>
                    <path fill="#273036" fill-opacity="1" d="M0,64L34.3,85.3C68.6,107,137,149,206,176C274.3,203,343,213,411,186.7C480,160,549,96,617,90.7C685.7,85,754,139,823,160C891.4,181,960,171,1029,181.3C1097.1,192,1166,224,1234,218.7C1302.9,213,1371,171,1406,149.3L1440,128L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path>
               </svg>
               <h1 class='sgc'>Horário</h1>
          </div>
        </body>
    </html>



            
  