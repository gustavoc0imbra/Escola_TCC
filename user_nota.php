<DOCYTIPE html>
    <head>
        <meta charset="UTF-8">
        <meta description="...">
        <link rel="stylesheet" href="#">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            #btnvoltar{
                position: absolute;
                top: 47%;
            }
            .ondas{
                 margin-top: 9.1%;
                 position: relative;
            }

            .sgc{
                
                color: white;
                position: absolute;
                bottom: 8px;
                left: 16px;
                font-size: 26px;
            }
        </style>
    </head>
    <?php 
        require_once "includes/config.php";
        require_once "includes/functions.php";
        $tipo = $_SESSION['tipo']?? null;
    ?>
    <body>
        <?php
        $d = null;
            if($tipo != null){

                    if($tipo == "admin" || $tipo == "professor"){
                        $cod = $_GET['cod'];
                        $nome = $_GET['nome'];
                        $codTurma = $_GET['turma'];
                    
                        
                        echo "<br><h2>Notas do aluno: $nome (Rm:$cod)</h2>";

                        echo "<br><center><a href='edit_nota.php?nome=$nome&turma=$codTurma&cod=$cod'><button class='btn btn-primary'>Aplicar ou alterar nota</button></a></center><br><br>";
    
                    }else if(($tipo == "aluno")|| ($tipo == "responsavel")){
    
                        $cod = $_SESSION['user'];
                        $nome = $_SESSION['nome'];
                        $q = "SELECT turma FROM estudante where codAluno = $cod";
                        
                        $banco->query($q);
                        $busca = $banco->query($q);
                        $reg = $busca->fetch_object();
                        $turma = $reg->turma?? null;

                        echo "<br><center><a href='index.php'><button class='btn btn-primary' id='btnvoltar'>Voltar</button></a></center>";

                        if($turma == null){
                            echo "Voce não tem turma, tente novamente mais tarde!";
                            $d = '1';
                        }else{
                            $q = "SELECT codTurma FROM turmas where cod = $turma";
                            $busca = $banco->query($q);
                            $reg = $busca->fetch_object();
                            $codTurma = $reg->codTurma?? null;
                        }
    
                        echo "<center><h2>Suas notas</h2></center>";
                    }
                    
                    ?>
                    <center>
                    <table class="table table-striped" style="width:80%">
                       <tr>
                           <th class="table table-dark">Matérias</th>
                           <th class="table table-dark">1º</th>
                           <th class="table table-dark">2º</th>
                           <th class="table table-dark">3º</th>
                           <th class="table table-dark">4º</th>
                           <th class="table table-dark">Nota Final</th>
                           <th class="table table-dark">Aulas</th>
                           <th class="table table-dark">Faltas</th>
                           <th class="table table-dark">Frequencia</th>
                       </tr>
                       <tr>
                        <?php

                        $q = "SELECT MIN(cod) AS minCodDisciplina, MAX(cod) AS maxCodDisciplina FROM disciplinasturma$codTurma";
                    
                        if($banco->query($q)){
                            $busca = $banco->query($q);
                            $reg = $busca->fetch_object();
                            
                            $minDisciplina = $reg->minCodDisciplina;
                            $maxDisciplina = $reg->maxCodDisciplina;
                           
                            while($minDisciplina <= $maxDisciplina){
                                
                                $q = "SELECT disciplinas FROM disciplinasturma$codTurma WHERE cod = $minDisciplina";
                                if($banco->query($q)){
                                    $busca = $banco->query($q);
                                    $reg = $busca->fetch_object();

                                    $q1 = "SELECT nomeDisciplina,codDisciplina FROM disciplina WHERE codDisciplina = $reg->disciplinas";
                             
                                    $busca1 = $banco->query($q1);
                                    $reg1 = $busca1->fetch_object();
                                    $codDisciplina = $reg1->codDisciplina?? null;

                                    // disciplinas
                                    echo "<td class='table table-hover'>$reg1->nomeDisciplina</td>";

                                    // aplicar notas 
                                    $q2 = "SELECT * FROM notas where aluno = $cod AND disciplina = $codDisciplina;";
                                    if($banco->query($q2)){
                                        $busca2 = $banco->query($q2);
                                        $reg2 = $busca2->fetch_object();
                                        $n1 = $reg2->n1?? null;
                                        $n2 = $reg2->n2?? null;
                                        $n3 = $reg2->n3?? null;
                                        $n4 = $reg2->n4?? null;
                                        $final = $reg2->final?? null;
                                        $var = null;

                                        if($n1 == '20'){
                                            $var = '1';
                                           echo "<td></td>";
                                        }else{
                                           echo "<td class='table table-hover'>$n1</td>";
                                        }

                                        if($n2 == '20'){
                                            $var++;
                                            echo "<td></td>";
                                        }else{
                                            echo "<td class='table table-hover'>$n2</td>";
                                        }
                                        if($n3 == '20'){
                                            $var++;
                                            echo "<td></td>";
                                        }else{
                                            echo "<td class='table table-hover'>$n3</td>";
                                        }                       
                                        
                                        if($n4 == '20'){
                                            $var++;
                                            echo "<td></td>";
                                        }else{
                                            echo "<td class='table table-hover'>$n4</td>";
                                        }
                                        
                                        
                                        if($final == '20'){
                                            echo "<td></td>";
                                        }else{
                                            if($var == '4'){
                                                echo "<td></td>";
                                            }else{
                                                echo "<td class='table table-hover'>$final</td>";
                                            }
                                           
                                        }
                                        
                                     
                                        
                                        
                                        
                                        
                                    }else{
                                        echo "<td> A busca pela nota deu errado, tente novamente mais tarde!</td>";
                                    }

                                    // frequencia 
                                   
                                    $q3 = "SELECT aulas, faltas FROM frequencia WHERE aluno = '$cod' AND disciplina = '$codDisciplina'; ";
                                    $banco->query($q3);
                                    $busca3= $banco->query($q3);
                                    $reg3 = $busca3->fetch_object();
                                    $aulas = $reg3->aulas?? null;
                                    $faltas = $reg3->faltas?? null;
                                    $totalAulas = $faltas + $aulas;
                                    $freq = null;
                                    
            
                                    // formatando frequencia 
                                    if($totalAulas == '0'){
                                        $totalAulas = null;
                                    }else{
                                        $freq = ($aulas / $totalAulas) * 100;
                                        $freq = (int) $freq; 
                                    }
            
                                    if($aulas != null){
                                        if($faltas == null){
                                           
                                            $faltas = '0';
                                        }
                                    }
            
                                    if($faltas != null){
                                        if($aulas == null){
                                           
                                            $aulas = '0';
                                        }
                                    }
            
                                   
                                    
            
                                    echo "<td>$aulas</td>";
                                    echo "<td>$faltas</td>";
                                   
                                    
                                    if($freq != null){
                                        if($freq >= '75'){
                                            echo "<td style='color:green'>$freq%</td>";
                                        }else{
                                            echo "<td style='color:red'>$freq%</td>";
                                        }
                                    }else{
                                        echo "<td>Null%</td>";
                                    }

                                    echo "</tr>";

                                }else{
                                    echo "Erro na busca de disciplinas da turma, tente novamente mais tarde!";
                                }
                                $minDisciplina++;
                            }
                            

                        }else{
                            echo "Algo deu errado na busca das disciplinas da turma!";
                        }
                        ?>
                    </table>
                </center>
                    <?php
                    
              
            }else{
                echo "Você precisa fazer o login para ter acesso a essa página!";
            }
            
        ?>
        <div class='ondas'>
               <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
               <path fill="#a6a6a6" fill-opacity="1" d="M0,224L48,202.7C96,181,192,139,288,138.7C384,139,480,181,576,181.3C672,181,768,139,864,117.3C960,96,1056,96,1152,106.7C1248,117,1344,139,1392,149.3L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
                    <path fill="#8c8c8c" fill-opacity="1" d="M0,224L24,192C48,160,96,96,144,90.7C192,85,240,139,288,170.7C336,203,384,213,432,197.3C480,181,528,139,576,144C624,149,672,203,720,197.3C768,192,816,128,864,112C912,96,960,128,1008,160C1056,192,1104,224,1152,197.3C1200,171,1248,85,1296,64C1344,43,1392,85,1416,106.7L1440,128L1440,320L1416,320C1392,320,1344,320,1296,320C1248,320,1200,320,1152,320C1104,320,1056,320,1008,320C960,320,912,320,864,320C816,320,768,320,720,320C672,320,624,320,576,320C528,320,480,320,432,320C384,320,336,320,288,320C240,320,192,320,144,320C96,320,48,320,24,320L0,320Z"></path>
                    <path fill="#273036" fill-opacity="1" d="M0,64L34.3,85.3C68.6,107,137,149,206,176C274.3,203,343,213,411,186.7C480,160,549,96,617,90.7C685.7,85,754,139,823,160C891.4,181,960,171,1029,181.3C1097.1,192,1166,224,1234,218.7C1302.9,213,1371,171,1406,149.3L1440,128L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path>
               </svg>
               <h1 class='sgc'>Notas</h1>
          </div>
    </body>
</DOCYTIPE>