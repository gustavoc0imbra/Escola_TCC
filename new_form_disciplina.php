<DOCYTIPE html>
    <?php 
    include_once "includes/config.php";
    include_once "includes/functions.php";
    $tipo = $_SESSION['tipo']??null;
    
    if($tipo == "admin"){
        
        $q = "SELECT max(codDisciplina) AS maiorDisciplina FROM disciplina; ";
        $q2 = "SELECT max(codProf) AS maiorCodProf, min(codProf) AS menorCodProf FROM professor;";
    
        if(!$banco->query($q) || !$banco->query($q2)){
            echo "Erro durante a busca no banco no dados, por favor tente novamente mais tarde<br>";
        }else{
            
            $busca = $banco->query($q);
            $reg = $busca->fetch_object();
            $maiorDisciplina = $reg->maiorDisciplina + 1;
            
            $busca2 = $banco->query($q2);
            $reg2 = $busca2->fetch_object();
            $maiorCodProf = $reg2->maiorCodProf;
            $menorCodProf = $reg2->menorCodProf;
                
                
            ?>
    
            <body>    
            <form action="new_disciplina.php" method="post">
                Nome da disciplina:<br><input type="text" name="nomeDisciplina" id="nomeDisciplina" placeholder="Ex: Matemática" ><br><br>
                Código:<br><input type="number" style="width:34px;" name="codDisciplina" id="codDisciplina" value="<?php echo $maiorDisciplina ?>"><br><br>
                Adicionar professores a nova disciplina:<br>
                <select name="nomeProfs" id="nomeProfs" >
                    <option  selected value="">Escolha o(s) professor(es)</option>
                    <?php 
                    while($menorCodProf != $maiorCodProf+1){
                        
                        $q3 = "SELECT nomeProf,codProf FROM professor WHERE codProf = $menorCodProf";
                        
                        if($banco->query($q3)){
                            
                            $busca3 = $banco->query($q3);
                            $reg3 = $busca3->fetch_object();
                            $regEmpty = $reg3->codProf?? null;
                            
                            
                            if($regEmpty == null){
                                $menorCodProf++;
                            }else{
                                
                                $nomeProf = $reg3->nomeProf;
                                $codProf = $reg3->codProf;
                                
                                echo "<option id='nomeProfs' onchange='functionProfessores()' value='$codProf'>$nomeProf</option>";
                                $menorCodProf++;
                            }
                         
                            
                        }else{
                            echo "Erro na procura do professor";
                        }
                    }
                            
                    ?>
                </select><br><br>
                
                <p id="professores"></p>
                <button type="submit" value="Enviar">Criar</button>
            </form>
            
<!--            Function dos professores após selecionados-->
            <script>
                function functionProfessores(){
                    var x = document.getElementById('nomeProfs').value;
                    document.getElementById('professores').innerHTML="<?php echo $nomeProf ?>";
                        
                }    
            </script>
                
            <?php     
        
        }
    }else{
       echo "somente administradores tem acesso a essa página!";
    }

?>
    </body>
</DOCYTIPE>