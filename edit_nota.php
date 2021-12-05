<?php 
        require_once "includes/config.php";
        require_once "includes/functions.php";
        $tipo = $_SESSION['tipo']?? null;
?>
<?php 
    if($tipo == 'admin' || $tipo == 'professor'){

        $clear = $_GET['clear']?? null;
        
        // limpar notas
        if($clear == 'true'){

            $cod = $_GET['cod']?? null;

            $q = "SET SQL_SAFE_UPDATES = 0;";
            
            if($banco->query($q)){

                $q = "UPDATE notas SET n1 = '20', n2='20', n3='20', n4='20', final='20' WHERE aluno = $cod";
                
                if($banco->query($q)){
                   ?>
                    <script>window.location.href='user_view.php?tipoSelect=aluno&clear=true'</script>
                   <?php
                }else{
                    echo "Algo deu errado ao limpar notas, tente novamente mais tarde!";
                }

            }else{
                echo "Algo deu errado ao desabilitar o safe mode, por favor tente novamente mais tarde!";
            }

            
                  
        }else{

            if(!isset($_POST['notas'])){
                require_once "edit_form_nota.php";
            }else{  
                    $nome = $_GET['nome']?? null;
                    $turma = $_GET['turma']?? null;
                    $cod = $_GET['cod']?? null;
                    $notas = $_POST['notas'];
                    $codAluno = $_POST['codAluno']?? null;
                    $disciplinas = $_POST['disciplinas'];
                    
                    $qntNotas = count($notas);
                    $qntDisciplinas = count($disciplinas);
    
                    // formatando notas
                    for($c = 0; $c < $qntNotas; $c++){
    
    
                        if($notas[$c] == null){
                            $notas[$c] = '20';
                        }
                    }
    
                    $c = 0;
                    $b = 0;
                    $d = 0;
                    
                    // Notas finais
                    while($d < $qntDisciplinas){
    
                        $totalNotasDaDisciplina = 0;
                        $qndDeNota = 0;
    
                        for($c = 0; $c < 4; $c++){
    
                            $nota = $notas[$b];
    
                            if($nota == '20'){
                                $totalNotasDaDisciplina = $totalNotasDaDisciplina + 0;
                            }else{
                                $totalNotasDaDisciplina = $totalNotasDaDisciplina + $nota;
                                $qndDeNota++;
                            }
                            $b++;
                        }
                        if($totalNotasDaDisciplina != '0' && $qndDeNota != '0'){
                            $a = $totalNotasDaDisciplina/$qndDeNota?? '0';
                        $notaFinal[] = number_format("$a", 1);
                        }else{
                            $notaFinal[] = '0';
                        }
                       
                        
                        $d++;
    
                    }
                    
                    $c = 0;
                    $b = 0;
                    $d = 0;
                    $a = 0;
                    
                    // tirando o bd do mode safe para podermos alterar as notas do aluno sem a primary key
                    $q = "SET SQL_SAFE_UPDATES = 0;";
    
                    if($banco->query($q)){
    
                    }else{
                        echo "Algo deu errado com o safe mode :(";
                    }
    
                    while($c < $qntDisciplinas){
                        
                        $disciplina = $disciplinas[$c];
    
                        $b = 0;
                        
                        $q1 = "SELECT * FROM notas WHERE aluno = $codAluno AND disciplina = $disciplina;";
                        $busca1 =$banco->query($q1);
    
                        //Se já existir notas dessa materia para esse aluno 
                        if($busca1->num_rows>0){
                           
                           $e = 1;
                           $q =" UPDATE notas SET";
    
                           while($b < 4){
                        
                                $nota = $notas[$d];
    
                                if($b == 3){
    
                                    $nF = $notaFinal[$a];
    
                                    $q.= " n$e='$nota', final= '$nF' ";
                                   
                                   
                                }else{
                                    $q.= " n$e='$nota',";
                                
                                }
    
                                $e++;
                                $b++;
                                $d++;
                            }
                            $a++;
                           $q.=" WHERE aluno = '$codAluno' AND disciplina = '$disciplina';";
                           if($banco->query($q)){
    
                            ?>
                                <script>window.location.href='user_view.php?tipoSelect=aluno&altNota=true'</script>
                               <?php
                            }else{
                                echo "<Br><Br>Algo deu errado ao cadastrar notas do aluno, por favor tente novamente mais tarde!";
                            }
    
                        // se não existir notas para esse aluno nessa matéria
                        }else{
    
                            $q = "INSERT INTO notas (aluno, disciplina, n1, n2, n3, n4, final) VALUES ('$codAluno','$disciplina',";
    
                            while($b < 4){
                                $nota = $notas[$d];
                                
                                if($b == 3){
                                    $q.= "'$nota', '0'";
                                }else{
                                    $q.= "'$nota',";
                                }
    
                                
    
                                $b++;
                                $d++;
                            }
                            
                            $q.= ");";
    
                            if($banco->query($q)){
    
                                ?>
                                <script>window.location.href='user_view.php?tipoSelect=aluno&altNota=true'</script>
                               <?php
            
                            }else{
                                echo "<Br><Br>Algo deu errado ao cadastrar notas do aluno, por favor tente novamente mais tarde!";
                            }
    
                        }
    
                        $c++;
                    
                    }
                   
    
                    
            }
        }
    }