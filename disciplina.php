<DOCYTIPE html>
    <head>
        <meta charset="UTF-8">
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

            .newDisciplina{
                margin: 20px;
                margin-top: 40px;
                float: right;
                position: relative;
            }

            .voltar{
                margin-top:0px;
                margin-left: 10px;
            }

            .apagar{
                margin: 0px;
                text-decoration: none;
                width: 80%;
               
            }

            .editar{
                margin: 0px;
                text-decoration: none;
                width: 80%;
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
             $alt = $_GET['alt']?? null;
             $add = $_GET['add']?? null;
             $disciplina = $_GET['disciplina']?? null;
             $add = $_GET['add']?? null;
             
//             Deletar disciplinas
            $disciplinaAssociada = '0';
            if($delete == "true"){
                $q5 = "SELECT nomeProf,codProf FROM professor WHERE codDisciplina = $disciplina;";
                $busca5 = $banco->query($q5);
                    
                if($disciplina != '0'){

                    // verificando se existe essa disciplina em alguma turma
                    $q6 = "SELECT MIN(cod) AS menorTurma, MAX(cod) AS maiorTurma FROM turmas;";
                    $busca6 = $banco->query($q6);
                    $reg6 = $busca6->fetch_object();
                    $menorTurma = $reg6->menorTurma?? null;
                    $maiorTurma = $reg6->maiorTurma?? null;

                    while($menorTurma <= $maiorTurma){

                        $q6 = "SELECT codTurma FROM turmas WHERE cod = $menorTurma";

                        if($banco->query($q6)){
                            $busca6 = $banco->query($q6);
                            $reg6 = $busca6->fetch_object();
                            $codTurma = $reg6->codTurma?? null;

                            if($codTurma != null){

                                if($codTurma != '0'){
                                    
                                    $q7 = "SELECT MIN(cod) AS minDisciplina, MAX(cod) AS maxDisciplina FROM disciplinasturma$codTurma";
                                    
                                    if($banco->query($q7)){
                                        $busca7 = $banco->query($q7);
                                        $reg7 = $busca7->fetch_object();
                                        $minDisciplina = $reg7->minDisciplina?? null;
                                        $maxDisciplina = $reg7->maxDisciplina?? null;

                                        while($minDisciplina <= $maxDisciplina){

                                            $q7 = "SELECT disciplinas FROM disciplinasturma$codTurma WHERE cod = $minDisciplina";
                                            
                                            if($banco->query($q7)){
                                                $busca7 = $banco->query($q7);
                                                $reg7 = $busca7->fetch_object();
                                                $disciplinaMomentanea = $reg7->disciplinas?? null;

                                                if($disciplinaMomentanea == $disciplina){
                                                   
                                                    $disciplinaAssociada = 'true';

                                                }else{
                                                    if($disciplinaAssociada != 'true'){
                                                        $disciplinaAssociada = 'false';
                                                    }
                                                    
                                                }

                                            }else{
                                                echo "Algo deu errado ao selecionar disciplinas da turma $codTurma, por favor tente novamente mais tarde!<Br><Br>";
                                            }

                                            $minDisciplina++;
                                        }
                                    }else{
                                        echo "Algo deu errado ao selecionar disciplinas da turma, por favor tente novamente mais tarde!";
                                    }
                                }

                            }
                           
                        }else{
                            echo "Algo deu errado ao selecionar turmas, tente novamente mais tarde!";
                        }

                        $menorTurma++;
                    }
                    
                    if($disciplinaAssociada == 'true'){
                    
                        echo "Não é possivel apagar essa disciplina, pois esta associada a uma turma, por favor primeiro altere essa disciplina na turma: $codTurma";
                   
                    }else{

                        if($banco->query($q5)){
                        
                            if($busca5->num_rows>0){
                                    
                                $q5 = "UPDATE professor SET codDisciplina = 0 WHERE codDisciplina = $disciplina;";
                                    
                                if($banco->query($q5)){
                                    echo "Professores dessa disciplina foram alterado para 'Sem disciplina'<br>";
                                        
                                }else{
                                    echo "Erro ao mudar professores de tabela, por favor tente novamente mais tarde!<br>";
                                }
                                    
                            }
                            $q5 = "DELETE FROM disciplina Where codDisciplina = $disciplina;";
                                    
                            if($banco->query($q5)){
                                echo "Disciplina Deletada com sucesso!<br>";  
                                    
                            }else{
                                echo "Erro ao apagar disciplina, por favor tente novamente mais tarde!<br>";
                            }
                                
                        }else{
                            echo "Erro ao apagar tabela, por favor tente novamente mais tarde!<br>";
                        } 

                    }
                    
                }else{
                    echo "Não é possivel alterar ou editar essa tabela!<Br>";
                }
             }

             // MSG sucesso alteração de disciplina
             if($alt == 'true'){
                 echo "<br>Disciplina alterada com sucesso!</br>";
             }
            
            // MSG Criação de disciplina
            if($add == 'true'){
                echo "<br>Disciplina Criada com sucesso!</br>";
            }
             $q = "SELECT min(codDisciplina) AS menorCodDisciplina, max(codDisciplina) AS maiorCodDisciplina FROM disciplina;";
                 
             if($banco->query($q)){
                     
                 $buscaCod = $banco->query($q);
                 $reg = $buscaCod->fetch_object();
                 $menorCodDisciplina = $reg->menorCodDisciplina;
                 $maiorCodDisciplina = $reg->maiorCodDisciplina;
                     
                 echo "<a class='newDisciplina' href='new_disciplina.php'><button type='button' class='btn btn-success'>
                 <svg xmlns='http://www.w3.org/2000/svg' width='17' height='17' fill='currentColor' class='bi bi-box-seam' viewBox='0 0 16 16'>
                <path d='M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z'/>
                </svg>
                 Nova Disciplina</button></a><br>";
                     
                 if($menorCodDisciplina != null){
                         
         ?>
                    <h1>Disciplinas</h1>
                        <table>
                            <tr>
                                <th>Codigo</th>
                                <th>Disciplina</th>
                                <th>Professores disponiveis</th>
                                <th>Código do(s) professor(es)</th>
                                <th>&#9998;Editar</th>
                                <th>&#9940;Apagar disciplina</th>
                                
                            </tr>
                        <?php
                         
                     while($menorCodDisciplina != $maiorCodDisciplina+1){
                            
                         $q = "SELECT codDisciplina,nomeDisciplina FROM disciplina WHERE codDisciplina = $menorCodDisciplina ";
                         $busca = $banco->query($q);
                         
                            
                         if($banco->query($q)){
                             $reg = $busca->fetch_object();
                             $regEmpty = $reg->codDisciplina?? null;
                             $cacheDisciplina = $reg->codDisciplina?? null;
                             $nomeDisciplina = $reg->nomeDisciplina?? null;
                                   
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
                                            
                              
                                        if($reg->codDisciplina == '0'){
                                            echo "<td>Indisponivel</td><td>Indisponivel</td>";
                                        }else{
                                            echo   "</td>
                                            <td><center><a  href='edit_disciplina.php?disciplina=$cacheDisciplina&nomeDisciplina=$nomeDisciplina'>
                                            <button type='button' class='btn btn-warning editar'>Editar</button>
                                           
                                            </a></td></center>";
                                            echo "<td><center><a href='disciplina.php?disciplina=$reg->codDisciplina&delete=true'>
                                            <button type='button' class='btn btn-danger apagar'>Apagar</button></a></center></td>";
                                        }
                                        echo "</tr>";
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
         
         echo "<br><br><a class='voltar' href='index.php'>
         <button  type='button' class='btn btn-primary'>Voltar</button></a>";
         
     ?>
     </body>
</DOCYTIPE>