<docytipe html>
    <head>
    <meta charset="UTF-8">
        <meta description="...">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="Estilo/main3.css">  
        <style>
            table {
              font-family: arial, sans-serif;
              width: 30%;
            }
            th{
                text-align: center;
            }
        </style>
    </head>
    <?php 
    include_once("includes/config.php");
    include_once("includes/functions.php");
    ?>
    <body id="bodyvt" >
        
        <h3>
        <a href='new_turma.php'>
        <button type="button" class="btn btn-primary">Nova Turma</button>
        </a>
        <a href='index.php'>
        <button type="button" class="btn btn-primary ">Menu</button>
        </a>                         
        </h3> 
        <h1>Turmas</h1>

        <?php 

            $delete = $_GET['delete']?? null;
            $codTurma = $_GET['codTurma']??null;
            $TurmaAdd = $_GET['create']?? null;

             // Apagar turma 
             if($delete == 'true'){

                $q = "SELECT cod FROM turmas where codTurma = '$codTurma'";
                $banco->query($q);
                $busca = $banco->query($q);
                $reg = $busca->fetch_object();

                $cod = $reg->cod?? null;

                //Alterando alunos que estão na turma
                $q = "SELECT MIN(codAluno) AS menorCodAluno, MAX(codAluno) AS maiorCodAluno FROM estudante WHERE turma = '$cod'";
                if($banco->query($q)){
                    $busca = $banco->query($q);
                    $reg = $busca->fetch_object();
                    $minCodAluno = $reg->menorCodAluno?? null;
                    $maxCodAluno = $reg->maiorCodAluno?? null;
              

                    if($minCodAluno != null){
                        $q = "UPDATE estudante SET turma = '0' WHERE turma = '$cod'";

                        if($banco->query($q)){
                        }else{
                            echo "Algo deu errado ao alterar alunos";
                        }
                        
                    }

                     // Apagando tabelas da turma
                     $q = "DROP TABLE horarioturma$codTurma";
                     $banco->query($q);
                     $q = "DROP TABLE disciplinasturma$codTurma";
                     $banco->query($q);

                     
                     $q = "DELETE FROM turmas WHERE codTurma = '$codTurma'";

                     if($banco->query($q)){
                         echo "Turma apagada com sucesso!";
                     }else{
                         echo "Não foi possivel apagar a turma, por favor tente novamente mais tarde!";
                     }

                }else{
                    echo "Erro ao alterar turma de alunos, por favor tente novamente mais tarde!";
                }
             }

             // mensagem sucesso ao criar turma
            if($TurmaAdd != null){
                echo "Turma criada com sucesso!";
            }
            
        ?>
        
            <?php 
                $q = "SELECT MIN(cod) AS menorCod, MAX(cod) AS maiorCod FROM turmas;";

                if($banco->query($q)){
                    $busca = $banco->query($q);
                    $reg = $busca->fetch_object();
                    $minCod = $reg->menorCod?? null;
                    $maxCod = $reg->maiorCod;

                    if($maxCod != null){
                        ?>
                        <table class="table table-dark table-striped"> 
                            <tr>
                                <th>Nome Turma</th>
                                <th>Código</th>
                                <th>Alterar Horario/Professores/Alunos</th>
                                <th>Apagar turma</th>
                            </tr>
                        <?php

                        while($minCod <= $maxCod){

                            // não mostrar turma = "sem turma"
                            if($minCod != "0"){
                                $q = "SELECT nomeTurma, codTurma FROM turmas WHERE cod = $minCod";
                            
                                if($banco->query($q)){
        
                                    $busca = $banco->query($q);
                                    $reg = $busca->fetch_object();
                                    $nomeTurma = $reg->nomeTurma?? null;
                                    $codTurma = $reg->codTurma?? null;
                                    
                                    
                                    if($codTurma == null){
                                      
                                        $minCod++;
                                    }else{
                                        echo "<td>$nomeTurma</td><td>$codTurma</td>";
                                        echo "<td><a href='edit_turma.php?nomeTurma=$nomeTurma&cod=$codTurma'>Ver/Alterar</a></td><td><a href='view_turma.php?delete=true&codTurma=$codTurma'>Apagar</a></td></tr>";
                                        $minCod++;
                                    }
        
                                   
        
                                }else{
                                   
                                    echo "Algo deu errado na busca, tente novamente mais tarde!";
                                }
                            }else{
                                $minCod++;
                            }
    
                            
                        }
                    }else{
                        ?>
                            <script>window.location.href = 'new_turma.php'; </script>
                        <?php
                    }
                   

                }else{
                    echo "Erro na busca de turmas por favor tente novamente mais tarde!";
                }
            ?>
            <tr>
            </tr>
        </table>
        
    </body>
</html>