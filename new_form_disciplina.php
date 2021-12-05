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

            a{
                text-decoration:none;
            }
            body{
                margin: 8px;
            }

            .criar {
                float:right;
                margin-right: 10px;
            }
        </style>
    </head>
    <body>
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
           <h1>Nova disciplina</h1>
           <form action="new_disciplina.php" method='post'>
               Nome da disciplina<Br><input type='text' required name='nomeDisciplina' id='nomeDisciplina' placeholder='Ex: Matemática'><Br><Br>
               Código:<br><input type="number" readonly style="width:50px;" name="codDisciplina" id="codDisciplina" value="<?php echo $maiorDisciplina ?>"><br><br>

               <h2>Adicionar professores a nova disciplina:</h2>
               <br>
               <table>
                    <tr>
                        <th>Rm</th>
                        <th>Nome</th>
                        <th>Adicionar</th>
                    </tr>
                    <tr>
                <?php   
                    while($menorCodProf <= $maiorCodProf){
                        $q = "SELECT nomeProf, codProf FROM professor WHERE codProf = $menorCodProf";
                        if($banco->query($q)){
                            $busca = $banco->query($q);
                            $reg = $busca->fetch_object();
                            $codProf = $reg->nomeProf?? null;

                            if($codProf == null){
                                $menorCodProf++;
                            }else{
                                echo "<td>$reg->codProf</td><td>$reg->nomeProf</td><td>
                                <div class='form-check form-switch'>
                                <input class='form-check-input' type='checkbox'  id='professoresAdd[]' name='professoresAdd[]' value='$reg->codProf'>
                                </div>
                              
                                
                                </tr>";
                            }

                        }else{
                            echo "Algo deu errado na busca dos professore, por favor tente novamente!";
                        }
                        $menorCodProf++;
                    }  
                ?>

                </table><br>
                <a href='index.php'><button type="button" class="btn btn-primary">Menu</button></a>
                <a href='disciplina.php'><button type="button" class="btn btn-secondary">Ver disciplinas</button></a>
                <a class='criar'>
                <button type="submit" value="Enviar" type="button" class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-seam" viewBox="0 0 16 16">
                <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"/>
                </svg> Criar</button>
                </a>
            </form>
          
            <?php 

        }
    }else{
       echo "somente administradores tem acesso a essa página!";
    }

?>
    </body>
</DOCYTIPE>