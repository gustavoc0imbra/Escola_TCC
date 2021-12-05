<DOCYTIPE html>
    <head>
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
            body{
                overflow:hidden;
            }
            .ondas{
                 margin-top: 9.1%;
                 position: relative;
            }
            .volt{
                margin-left: 8px;
            }
            .sgc{
                
                color: white;
                position: absolute;
                bottom: 8px;
                left: 16px;
                font-size: 26px;
            }

            .alt{
                float:right;
                margin-left: 8px;
                margin-right: 8px;
            }
            .clear{
                float:right;
            }
        </style>
        </style>
    </head>
    <?php 
        require_once "includes/config.php";
        require_once "includes/functions.php";
        $tipo = $_SESSION['tipo']?? null;
    ?>
    <body>
        <?php
            if($tipo != null){

                    if($tipo == "admin" || $tipo == "professor"){
                        $cod = $_GET['cod'];
                        $nome = $_GET['nome'];
                        $codTurma = $_GET['turma'];
                    
    
                        echo "<h2>Notas do aluno: $nome (Rm:$cod)</h2>";
    
                    }else if($tipo == "aluno"){
    
                        $cod = $_SESSION['user'];
                        $nome = $_SESSION['nome'];
    
                        echo "<h2>Suas nota: $nome (Rm:$cod)</h2>";
                    }
                    ?>
                    <form action='edit_nota.php' method='post'>
                    <table class="table table-striped table-bordered"> 
                            <tr>
                                 <thead class="table table-dark">
                            <th>Matérias</th>
                            <th>1º</th>
                            <th>2º</th>
                            <th>3º</th>
                            <th>4º</th>
                            <th>Nota Final</th>
                </thead>
                        </tr>
                        <tr>
                            <?php

                            $q1 = "SELECT MIN(cod) as primeiraNotaFinal, MAX(cod) AS ultimaNotaFinal FROM notas WHERE aluno = $cod";
                            if($banco->query($q1)){
                                $busca1 = $banco->query($q1);
                                $reg1 = $busca1->fetch_object();
                                $primeiraNotaFinal = $reg1->primeiraNotaFinal?? null;
                                $primeiraNotaFinal1 = $primeiraNotaFinal?? null;
                                $ultimaNotaFinal = $reg1->ultimaNotaFinal?? null;
                                

                                while($primeiraNotaFinal <= $ultimaNotaFinal){
                                    $notas[] = $primeiraNotaFinal;
                                    $primeiraNotaFinal++;
                                }

                                if($ultimaNotaFinal != null){
                                    $qntNotas = count($notas);
                                }else{
                                    $qntNotas = null;
                                }
                                

                                $primeiraNotaFinal = $primeiraNotaFinal1;
                            }else{
                                echo "Algo deu errado na busca das notas Finais, por favor tente novamente mais tarde!";
                            }

                            $q = "SELECT MIN(cod) AS minCodDisciplina, MAX(cod) AS maxCodDisciplina FROM disciplinasturma$codTurma";
                            if($banco->query($q)){
                                $busca = $banco->query($q);
                                $reg = $busca->fetch_object();
                                
                                $minDisciplina = $reg->minCodDisciplina;
                                $minDisciplina1 = $minDisciplina;
                                $maxDisciplina = $reg->maxCodDisciplina;

                                while($minDisciplina <= $maxDisciplina){
                                    $qntDisciplinas[] = $minDisciplina;
                                    $minDisciplina++;
                                }
                                $qntDisciplinas = count($qntDisciplinas);
                                $minDisciplina = $minDisciplina1;

                            
                                while($minDisciplina <= $maxDisciplina){
                                    
                                    
                                    $q = "SELECT disciplinas FROM disciplinasturma$codTurma WHERE cod = $minDisciplina";
                                    if($banco->query($q)){
                                        $busca = $banco->query($q);
                                        $reg = $busca->fetch_object();

                                        $q1 = "SELECT nomeDisciplina FROM disciplina WHERE codDisciplina = $reg->disciplinas";
                                        $busca1 = $banco->query($q1);
                                        $reg1 = $busca1->fetch_object();

                                        // disciplinas
                                        $disciplinas[] = $reg->disciplinas;
                                        echo "<td>$reg1->nomeDisciplina</td>";


                                        // se a tabela notas do aluno não existir ainda
                                        if($ultimaNotaFinal == null){
                                            echo "<td><input type='number' name='notas[]' id='notas[]' min='0' max='10' value='' style='width:93px' placeholder='Aplicar nota'</td>";
                                            echo "<td><input type='number' name='notas[]' id='notas[]' min='0' max='10' value='' style='width:93px' placeholder='Aplicar nota'</td>";
                                            echo "<td><input type='number' name='notas[]' id='notas[]' min='0' max='10' value='' style='width:93px' placeholder='Aplicar nota'</td>";
                                            echo "<td><input type='number' name='notas[]' id='notas[]' min='0' max='10' value='' style='width:93px' placeholder='Aplicar nota'</td>";
                                            echo "<td></td></tr>";
                                          
                                        }else{

                                            if($primeiraNotaFinal <= $ultimaNotaFinal){
                                            
                                                $q1 = "SELECT n1,n2,n3,n4,final FROM notas WHERE cod = $primeiraNotaFinal";
    
                                                if($banco->query($q1)){
    
                                                    $busca1 = $banco->query($q1);
                                                    $reg1 = $busca1->fetch_object();
                                                    $final = $reg1->final?? null;
                                                    $n1 = $reg1->n1;
                                                    $n2 = $reg1->n2;
                                                    $n3 = $reg1->n3;
                                                    $n4 = $reg1->n4;
    
                                                    if($final != null){
                                                       
                                                        // aplicar notas
                                                        echo "<td><input type='number' name='notas[]' id='notas[]' min='0' max='10'";
                                                        if($n1 == '20'){
                                                            echo" value=''></td>";
                                                        }else{
                                                            echo" value='$reg1->n1'></td>";
                                                        }
    
                                                        echo "<td><input type='number' name='notas[]' id='notas[]' min='0' max='10'";
    
                                                        if($n2 == '20'){
                                                            echo "value='' style='width:93px' placeholder='Aplicar nota'</td>";
                                                        }else{
                                                            echo "value='$reg1->n2' style='width:93px' ></td>";
                                                        }
                                                        
                                                        echo "<td><input type='number' name='notas[]' id='notas[]' min='0' max='10'";
    
                                                        if($n3 == '20'){
                                                            echo "value='' style='width:93px' placeholder='Aplicar nota'</td>";
                                                        }else{
                                                            echo "value='$reg1->n3' style='width:93px'></td>";
                                                        }
    
                                                        echo "<td><input type='number' name='notas[]' id='notas[]' min='0' max='10'";
                                                        if($n4 == '20'){
                                                            echo "style='width:93px' placeholder='Aplicar nota'</td>";
                                                        }else{
                                                            echo "value='$reg1->n4' style='width:93px'></td>";
                                                        }

                                                        if($final == '20'){
                                                            echo "<td></td>";
                                                        }else{
                                                            echo "<td>$final</td>";
                                                        }
                                                       
                                                        echo "</tr>";
                                                    }
    
                                                }else{
                                                    echo "Algo deu errado na busca das notas finais, por favor tente novamente mais tarde!";
                                                }
                                                $primeiraNotaFinal++;
                                            }

                                        }
                                       
                                    
                                    }else{
                                        echo "Erro na busca de disciplinas da turma, tente novamente mais tarde!";
                                    }
                                    if($qntNotas != null){
                                        while($minDisciplina == $qntNotas+1){
                                            echo "<td><input type='number' name='notas[]' id='notas[]' min='0' max='10' value='' style='width:93px' placeholder='Aplicar nota'</td>";
                                            echo "<td><input type='number' name='notas[]' id='notas[]' min='0' max='10' value='' style='width:93px' placeholder='Aplicar nota'</td>";
                                            echo "<td><input type='number' name='notas[]' id='notas[]' min='0' max='10' value='' style='width:93px' placeholder='Aplicar nota'</td>";
                                            echo "<td><input type='number' name='notas[]' id='notas[]' min='0' max='10' value='' style='width:93px' placeholder='Aplicar nota'</td>";
                                            echo "<td></td>";
                                            echo "<td>Null</td>";
                                            echo "<td>Null</td>";
                                            echo "<td>Null</td></tr>";
                                            $qntNotas++;
                                        }
                                    }
                                    $minDisciplina++;
                                    
                                    
                                   
                                }

                              
                                    
                                

                            }else{
                                echo "Algo deu errado na busca das disciplinas da turma!";
                            }
                            
                        ?> 
                        </table>
                        <!-- enviando valores do aluno -->
                        <?php 
                        foreach($disciplinas as $valueDisciplinas){
                            echo "<input type='hidden' name='disciplinas[]' value='$valueDisciplinas'>";
                        }
                        ?>
                        <input type='hidden' name='nome' id='nome' value='<?php echo $nome?>'>
                        <input type='hidden' name='codAluno' id='codAluno' value='<?php echo $cod?>'>
                        <br><br><button type="submit" class="btn btn-success alt"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-seam" viewBox="0 0 16 16">
                        <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"/>
                        </svg> Alterar nota</button>
                       
                       
                        
                        <?php
                        echo "<a href='user_nota.php?cod=$cod&nome=$nome&turma=$codTurma'><button type='button' class='btn btn-primary volt'>Voltar</button></a>";
                        echo "<a href='edit_nota.php?clear=true&cod=<?php echo $cod?>'><button type='button' class='btn btn-warning clear'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-clipboard-check' viewBox='0 0 16 16'>
                        <path fill-rule='evenodd' d='M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z'/>
                        <path d='M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z'/>
                        <path d='M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z'/>
                      </svg> Limpar Notas</button></a> </form>";
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