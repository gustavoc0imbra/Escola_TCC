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
        include_once "includes/config.php";
        include_once "includes/functions.php";
     ?>
     <body>
     <?php 
        
         if($_SESSION['tipo'] == "admin"){
             
             
             $delete = $_GET['delete']?? null;
             $disciplina = $_GET['disciplina']?? null;
             $add = $_GET['add']?? null;
             
//             Deletar disciplinas
             if($delete == "true"){
                 
                if($disciplina != "0"){
                    
                    $q5 = "SELECT nomeProf,codProf FROM professor WHERE codDisciplina = $disciplina;";
                    $busca5 = $banco->query($q5);
                    
                    if($banco->query($q5)){
                        
                        if($busca5->num_rows>0){
                            
                            $q5 = "UPDATE professor SET codDisciplina = 0 WHERE codDisciplina = $disciplina;";
                            
                            if($banco->query($q5)){
                                echo "Professores dessa disciplina foram alterado para 'Sem disciplina'<br>";
                                
                            }else{
                                echo "Erro ao mudar professores de tabela, por favor tente novamente mais tarde!";
                            }
                            
                        }
                        $q5 = "DELETE FROM disciplina Where codDisciplina = $disciplina;";
                            
                        if($banco->query($q5)){
                            echo "Disciplina Deletada com sucesso!";  
                            
                        }else{
                            echo "Erro ao apagar tabela, por favor tente novamente mais tarde!";
                        }
                        
                    }else{
                        echo "Erro ao apagar tabela, por favor tente novamente mais tarde!";
                    }
                    
                }else{
                    echo "Não é possivel deletar essa tabela por favor consulte o suporte para mais informações<br>";
                }
                 
                 
             } 
                 
             $q = "SELECT min(codDisciplina) AS menorCodDisciplina, max(codDisciplina) AS maiorCodDisciplina FROM disciplina;";
                 
             if($banco->query($q)){
                     
                 $buscaCod = $banco->query($q);
                 $reg = $buscaCod->fetch_object();
                 $menorCodDisciplina = $reg->menorCodDisciplina;
                 $maiorCodDisciplina = $reg->maiorCodDisciplina;
                     
                 echo "<a href='new_disciplina.php'>Nova Disciplina</a><br>";
                     
                 if($menorCodDisciplina != null){
                         
         ?>
                    <h1>Disciplinas</h1>
                        <table>
                            <tr>
                                <th>Codigo</th>
                                <th>Disciplina</th>
                                <th>Professores disponiveis</th>
                                <th>Código do(s) professor(es)</th>
                                <th></th>
                                
                            </tr>
                        <?php
                         
                     while($menorCodDisciplina != $maiorCodDisciplina+1){
                            
                         $q = "SELECT codDisciplina,nomeDisciplina FROM disciplina WHERE codDisciplina = $menorCodDisciplina ";
                         $busca = $banco->query($q);
                            
                         if($banco->query($q)){
                             $reg = $busca->fetch_object();
                             $regEmpty = $reg->codDisciplina?? null;
                                   
                            if($regEmpty == null){
                                $menorCodDisciplina++;
                                    
                            }else{
//                                dados mostrados dentro da tabela 'Disciplina'
                                    
                                echo"<tr>
                                <td>$reg->codDisciplina</td>
                                <td>$reg->nomeDisciplina</td>
                                <td>";
                                    
//                              Professores disponiveis
                                            
                                $q1 = "SELECT min(codProf) as minCod, max(codProf) as maxCod FROM professor WHERE codDisciplina = $menorCodDisciplina";
                                            
                                if($banco->query($q1)){
                                               
                                               $busca1 = $banco->query($q1);
                                               $reg1 = $busca1->fetch_object();
                                               
                                               $menorCod = $reg1->minCod;
                                               $maiorCod = $reg1->maxCod;
                                               
                                               if($menorCod != null){
                                                   
                                                 while($menorCod != $maiorCod+1){
                                                   $q2 = "SELECT nomeProf, codProf FROM professor WHERE codProf = $menorCod AND codDisciplina = $menorCodDisciplina";
                                                   $busca2 = $banco->query($q2);
                                                   
                                                   if($banco->query($q2)){
                                                       $reg2 = $busca2->fetch_object();
                                                       $regEmpty2 = $reg2->codProf?? null;
                                                       
                                                       if($regEmpty2 == null){
                                                           $menorCod++;
                                                       }else{
                                                           
                                                           if($reg2->codProf == $maiorCod){
                                                                   echo "$reg2->nomeProf</td>";
                                                           }else{
                                                                   echo "$reg2->nomeProf, ";
                                                               }
                                                           
                                                           $menorCod++;
                                                       }
                                                       
                                                   }else{
                                                       echo "Erro ao encontrar professor com essa disciplina, tente novamente mais tarde!";
                                                   }
                                                }
                                                   
                                               }else{
                                                   echo "Nenhum professor cadastrado com essa disciplina no momento!"; 
                                               }echo "<td>";
                                               
                                               
                                           }else{
                                    echo "Erro na procura de professores com essa disciplina por favor tente novamente mais tarde!";
                                }
                                        
//                              Código dos professores disponiveis
                                $q3 = "SELECT min(codProf) as minCod, max(codProf) as maxCod FROM professor WHERE codDisciplina = $menorCodDisciplina";
                                        
                                if($banco->query($q3)){
                                               
                                               $busca3 = $banco->query($q3);
                                               $reg3 = $busca3->fetch_object();
                                               
                                               $menorCod = $reg3->minCod;
                                               $maiorCod = $reg3->maxCod;
                                               
                                               if($menorCod != null){
                                                   
                                                 while($menorCod != $maiorCod+1){
                                                   $q4 = "SELECT codProf FROM professor WHERE codProf = $menorCod AND codDisciplina = $menorCodDisciplina";
                                                   $busca4 = $banco->query($q4);
                                                   
                                                   if($banco->query($q4)){
                                                       $reg4 = $busca4->fetch_object();
                                                       $regEmpty4 = $reg4->codProf?? null;
                                                       
                                                       if($regEmpty4 == null){
                                                           $menorCod++;
                                                       }else{
                                                           
                                                           if($reg4->codProf == $maiorCod){
                                                                   echo "$reg4->codProf</td>";
                                                           }else{
                                                                   echo "$reg4->codProf, ";
                                                               }
                                                           
                                                           $menorCod++;
                                                       }
                                                       
                                                   }else{
                                                       echo "Erro ao encontrar codigo do professor com essa disciplina, tente novamente mais tarde!";
                                                   }
                                                }
                                                   
                                               }else{
                                                   echo "NULL"; 
                                               }
                                               
                                               
                                           }else{
                                    echo "Erro na procura do codigo de  professores";
                                }   
                                            
                                echo   "</td>
                                        <td><a href='disciplina.php?delete=true&disciplina=$reg->codDisciplina'>Apagar Disciplina</a></td>
                                        </tr>";
                                $menorCodDisciplina++;
                                    
                                }
                                
                                
                            }else{
                                echo "Erro na tabela do banco de dados! tente novamente mais tarde ;/";
                            }
                            
                        }echo "</table>";
                         
                         
                     }else{
                       echo "Nenhuma Disciplina foi cadastrada no momento!"; 
                     }
                     
                 
             }else{
                 echo "falha ao acessar o banco de dados, por favor tente novamente";
             }   
             
         }else{
             echo "Somente administradores tem acesso a essa página!";
         }
         
         echo "<br><br><a href='index.php'>voltar</a>";
         
     ?>
     </body>
</DOCYTIPE>