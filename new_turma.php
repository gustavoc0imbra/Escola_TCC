<docytipe !html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <?php 
        require_once "includes/config.php";
        require_once "includes/functions.php";
        $tipo = $_SESSION['tipo']?? null;
    ?>
    <body>
    <?php 
    
        if($tipo == "admin"){
            if(!isset($_POST['nomeTurma'])){
                require_once("new_form_turma.php");
            }else{

                $nomeTurma = $_POST['nomeTurma']?? null;
                $codTurma = $_POST['codTurma']?? null;
                $tempPorAula = $_POST['tempPorAula']?? null;
                $intervalo = $_POST['intervalo']?? null;

                // valores de arrays()

                $professor = $_POST['professor']?? null;
                $extraProf = $_POST['extraProf']?? null;
                $disciplinasDaSala = $_POST['disciplinasDaSala']?? null;
                $alunos = $_POST['alunos']?? null;
                $horarioDisciplina = $_POST['horarioDisciplina']?? null;
                $horarioDeAula = $_POST['horarioFinal']?? null;
                $dias = $_POST['dias']?? null;

               
            
                
                $q = "INSERT INTO turmas (codTurma,nomeTurma,tempPorAula,intervalo) values
                ('$codTurma', '$nomeTurma', '$tempPorAula', '$intervalo'); ";

                if($banco->query($q)){

                    // pegando o codigo criado da turma;
                    $q = "SELECT cod FROM turmas WHERE codTurma = '$codTurma';";
                    if($banco->query($q)){

                        $busca = $banco->query($q);
                        $reg = $busca->fetch_object();
                        $codigoTurma = $reg->cod;

                        //cadastrando turma aos alunos
                        if($alunos != null){

                            $qntAlunos = count($alunos);
                            $c = 0;
                            
                            
                            while($c < $qntAlunos){
                                $q = "UPDATE estudante SET turma = '$codigoTurma' WHERE codAluno = '$alunos[$c]'";
                                $banco->query($q);
                                $c++;
                            }
    
                        }
                        
                      // Criando tabela de disciplinas da turma (disciplinas, Professores, extraProf)

                        $q = "create table Disciplinasturma$codTurma(
                        cod int(11) primary key not null auto_increment,
                        disciplinas int(11),
                        professores int(11),
                        extraProf int(11)
                        )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

                        if($banco->query($q)){
                           
                            // acrescentando valores a tabela Disciplinas da turma x

                            $qntDisciplinas = count($disciplinasDaSala);
                            $c = 0;

                            while($c < $qntDisciplinas){
                                $q = "INSERT INTO Disciplinasturma$codTurma (disciplinas, professores, extraProf) values 
                                ('$disciplinasDaSala[$c]', '$professor[$c]', '$extraProf[$c]')";
                                $banco->query($q);
                                $c++;

                            }
                            
                            // criando tabela de horario da turma ('$dias', horario)
                            $q = "create table Horarioturma$codTurma (
                                cod int(11) primary key not null auto_increment,
                                dias varchar(30),
                                horario varchar(30)
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

                            if($banco->query($q)){
                               
                                $qntdias = count($dias);
                               
                                
                                $c = 0;

                                while($c < $qntdias){
                                    $q = "ALTER TABLE horarioturma$codTurma ADD COLUMN $dias[$c] int(11);";
                                    $banco->query($q);
                                    $c++;

                                }
                               
                                $c = 0; 

                              
                                $q = "INSERT INTO horarioturma$codTurma (dias, horario, ";

                                while($c < $qntdias){
                                    $t = $dias[$c];

                                    if($c == $qntdias-1){
                                        $q.= "$t)";
                                    }else{
                                        $q.="$t, ";
                                    }
                                    

                                    $c++;
                                }

                            
                                
                              
                                $c = 0;

                               
                                

                                $qntDeAulaPorDia = count($horarioDeAula);

                                // horario de aula
                                $t = 0;
                                $d = 0;
                                $b = 0;
                                
                              

                                $q.= "VALUES ";

                                // (Coluna)
                                while($d < $qntDeAulaPorDia){


                                    $c = 0;

                                    $b = $dias[$d]?? null;
                                    $h = $horarioDeAula[$d]?? null;
                                    

                                    $q.= " ('$b', '$h', ";

                                    
                                    
                                    // (Linha)
                                    while($c < $qntdias){

                                        $aula = $horarioDisciplina[$t];
                                        
                                        if($c == $qntdias-1){

                                            $q.= "'$aula')";

                                            if($d == $qntDeAulaPorDia-1){
                                                $q.= ";";
                                            }else{
                                                $q.= ",";
                                            }
                                            
                                        }else{
                                            $q.= "'$aula',";
                                        }

                                      
                                        
                                        $t++;
                                        $c++;
                                        
                                    }
                                    $b++;
                                    $d++;
                                }

                              
                                
                                if($banco->query($q)){
                                    ?>
                                        <script> window.location.href = 'view_turma.php?create=true' </script>
                                    <?php
                                    
                                }else{
                                    echo "ERRO 0010";
                                }
                                

                                
                                $coluna = 0;
                                $linha = 0;
                                



                            }else{
                                echo "Algo deu errado na criação de tabela, tente novamente mais tarde. ERRO #05";
                            }

                        }else{
                            echo "Turma já existente, tente novamente. ERRO #04";
                        }

                    }else{
                        echo "Algo deu errado, tente novamente mais tarde. ERRO #02";
                    }
                  
                }else{
                    echo "Algo deu errado, tente novamente mais tarde. ERRO #01";
                }

            }
        }else{
            echo "somente administradores tem acesso a essa página!";
        }