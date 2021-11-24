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
        require_once "includes/config.php";
        require_once "includes/functions.php";
        $tipo = $_SESSION['tipo']?? null;
    ?>
    <body>
        <?php
            if($tipo != null){

                    if($tipo == "admin"){
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
                        <table>
                        <tr>
                            <th>Matérias</th>
                            <th>1º</th>
                            <th>2º</th>
                            <th>3º</th>
                            <th>4º</th>
                            <th>Nota Final</th>
                            <th>Aulas</th>
                            <th>Faltas</th>
                            <th>Frequencia</th>
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

                                        $q1 = "SELECT nomeDisciplina FROM disciplina WHERE codDisciplina = $reg->disciplinas";
                                        $busca1 = $banco->query($q1);
                                        $reg1 = $busca1->fetch_object();

                                        // disciplinas
                                        echo "<td>$reg1->nomeDisciplina</td>";
                                        // aplicar notas 
                                        echo "<td>A<input type='number' name='notas[]' id='notas[]' min='0' max='10' value='6'></td>";
                                        echo "<td><input type='number' name='notas[]' id='notas[]' min='0' max='10' value='6'></td>";
                                        echo "<td><input type='number' name='notas[]' id='notas[]' min='0' max='10' value='6'></td>";
                                        echo "<td><input type='number' name='notas[]' id='notas[]' min='0' max='10' value='6'></td>";
                                        echo "<td><input type='number' name='notas[]' id='notas[]' min='0' max='10' value='6'></td>";
                                        echo "<td>Null</td>";
                                        echo "<td>Null</td>";
                                        echo "<td>Null</td></tr>";
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
                        <!-- enviando valores do aluno -->
                        <input type='hidden' name='nome' id='nome' value='<?php echo $nome?>'>
                        <input type='hidden' name='codAluno' id='codAluno' value='<?php echo $cod?>'>
                        <br><br><button type='submit'>Alterar nota</button>
                        </form>
                        <?php
            }else{
                echo "Você precisa fazer o login para ter acesso a essa página!";
            }
            
        ?>
    </body>
</DOCYTIPE>