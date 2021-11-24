<DOCYTIPE html>
    <head>
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

            a {
                text-decoration:none;
            }
        </style>
    </head>
    <?php 
    include_once "includes/config.php";
    include_once "includes/functions.php";
    $tipo = $_SESSION['tipo']??null;
    
    if($tipo == "admin"){
        
        $codAddProf1 = $_GET['prof']?? null;
        $codAddProf2 = $_GET['prof2']?? null;
        $codAddProf3 = $_GET['prof3']?? null;
        $profDrop1 = $_GET['profDrop']?? null;
        $profDrop2 = $_GET['profDrop']?? null;
        $profDrop3 = $_GET['profDrop']?? null;
        $nomeDisciplina = $_GET['nomeDisciplina']?? null;

        

        if($profDrop1 != null){
            $codAddProf1 == null;
        }else if($profDrop2 != null){
            $codAddProf2 == null;
        }elseif($profDrop3 != null){
            $codAddProf3 == null;
        }

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
           <h1>Nova disciplina</h1>
           <form action="new_form_disciplina.php">
            <?php 
      
            if($nomeDisciplina == null){
                echo "Nome da disciplina:<br><input required type='txt' id='nomeDisciplina' name='nomeDisciplina' placeholder='Ex: Matemática'>";
            }else{
               echo "Nome da disciplina:<br><input type='txt' id='nomeDisciplina' name='nomeDisciplina' value='$nomeDisciplina'>";
            }
            ?>
           <button type="submit" value="Salvar">Salvar Nome</button>
           </form>
            <form action="new_disciplina.php" method="post">
                Código:<br><input type="number" style="width:34px;" name="codDisciplina" id="codDisciplina" value="<?php echo $maiorDisciplina ?>"><br><br>
                <h2>Adicionar professores a nova disciplina:</h2>
                <?php 

                // caso 3 professores seja selecionada aparecer na tela
                if(($codAddProf1 && $codAddProf2 && $codAddProf3) != null){
                    echo "Atenção! só se pode adicionar 3 professores por vez";
                }

                ?><br>
                    <table>
                        <tr>
                            <th>Rm</th>
                            <th>Nome</th>
                            <th>Adicionar</th>
                        </tr>
                        <?php     
                        while($menorCodProf !=$maiorCodProf+1){
                                
                                $q3 = "SELECT * FROM professor WHERE codProf = $menorCodProf";
                                $busca = $banco->query($q3);
                                
                                if($banco->query($q3)){
                                    $reg= $busca->fetch_object();
                                    $regEmpty = $reg->codProf?? null;
                                    
                                    if($regEmpty == null){
                                        $menorCodProf++;
                                    }else{
                                    // dados mostrados dentro da tabela 'usuarios professores'
                                        echo "<tr>
                                                <td>$reg->codProf</td>
                                                <td>$reg->nomeProf</td>
                                                <td>";
                                                // Logica de colocar e tirar professores
                                                if($codAddProf1 == null){
                                                    if(($codAddProf2 == null) && ($codAddProf3 == null)){
                                                        echo"<a href='new_form_disciplina.php?nomeDisciplina=$nomeDisciplina&prof=$reg->codProf'>";     
                                                    }else if(($codAddProf2 != null) && ($codAddProf3 != null)){
                                                        echo"<a href='new_form_disciplina.php?nomeDisciplina=$nomeDisciplina&prof=$reg->codProf&prof2=$codAddProf2&prof3=$codAddProf3'>";
                                                    }else if(($codAddProf3 == null) && ($codAddProf2 != null)){
                                                        echo"<a href='new_form_disciplina.php?nomeDisciplina=$nomeDisciplina&prof=$codAddProf1&prof2=$codAddProf2&prof3=$reg->codProf'>";  
                                                    }
                                                }else if($codAddProf2 == null){
                                                    if($codAddProf3 == null){
                                                        echo"<a href='new_form_disciplina.php?nomeDisciplina=$nomeDisciplina&prof=$codAddProf1&prof2=$reg->codProf'>";
                                                    }else if(($codAddProf1 && $codAddProf3) != null){
                                                        echo"<a href='new_form_disciplina.php?nomeDisciplina=$nomeDisciplina&prof=$codAddProf1&prof2=$reg->codProf&prof3=$codAddProf3'>";
                                                    }
                                                }else if($codAddProf3 == null){
                                                   echo"<a href='new_form_disciplina.php?nomeDisciplina=$nomeDisciplina&prof=$codAddProf1&prof2=$codAddProf2&prof3=$reg->codProf'>";
                                                }
                                               
                                                    // mostrar na tela 
                                                    if($codAddProf1 == $reg->codProf){
                                                        echo "<a> &#9989; adicionado!</a><a href='new_form_disciplina.php?nomeDisciplina=$nomeDisciplina&profDrop=$codAddProf1&prof2=$codAddProf2&prof3=$codAddProf3'>(Clique para retirar esse professor dessa discipina)</a>";
                                                    }else if($codAddProf2 == $reg->codProf){
                                                        echo "<a> &#9989; adicionado!</a><a href='new_form_disciplina.php?nomeDisciplina=$nomeDisciplina&prof=$codAddProf1&profDrop=$codAddProf2&prof3=$codAddProf3'>(Clique para retirar esse professor dessa discipina)</a>";
                                                    }else if($codAddProf3 == $reg->codProf){
                                                        echo "<a> &#9989; adicionado!</a><a href='new_form_disciplina.php?nomeDisciplina=$nomeDisciplina&prof=$codAddProf1&prof2=$codAddProf2&profDrop=$codAddProf3'>(Clique para retirar esse professor dessa discipina)</a>";
                                                    }else{
                                                        echo "&#9940; Adicionar";
                                                    }

                                                    ?>
                                                    <!-- Enviando para new_disciplina.php os professores adicionados -->
                                                    <input type='hidden' name='nomeDisciplina' id='nomeDisciplina' value='<?php echo $nomeDisciplina?>'>
                                                    <input type='hidden' name='addProf1' id='addProf1' value='<?php echo $codAddProf1?>'>
                                                    <input type='hidden' name='addProf2' id='addProf2' value='<?php echo $codAddProf2?>'>
                                                    <input type='hidden' name='addProf3' id='addProf3' value='<?php echo $codAddProf3?>'>
                                                    <?php

                                                echo"</a></td>
                                              </tr>";
                                        $menorCodProf++;
                                    }
                                    
                                }else{
                                     echo "Erro na tabela do banco de dados! tente novamente mais tarde ;/";
                                     $menorCodProf++; 
                                }
                                
                            }echo "</table><br><br>";
                            ?>
                <button type="submit" value="Enviar">Criar</button>
            </form>
           <a href='disciplina.php'>Ver disciplinas</a><br><br>
            <?php 

        }
    }else{
       echo "somente administradores tem acesso a essa página!";
    }

?>
    </body>
</DOCYTIPE>