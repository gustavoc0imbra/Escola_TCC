<docytipe html>
    <head>
    <meta charset="UTF-8">
        <meta description="...">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="Estilos/main3.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
                  .ondas{
                 margin-top: 2%;
                 position: relative;
            }
            body{
                overflow: hidden;
            }
            .sgc{
                
                color: white;
                position: absolute;
                bottom: 8px;
                left: 16px;
                font-size: 26px;
            }
            table {
              font-family: arial, sans-serif;
              width: 30%;
            }
            th{
                text-align: center;
            }

            .apagar{
                width: 70%;
            }

            .alterar{
                width: 70%;
            }

            .aplicar {
                width: 60%;
            }

            .aplicar2 {
               float: right;
               margin-bottom: 30px;
               margin-right: 20px;
               margin-top: 10px;
            }

            .menu{
                margin-left: 10px;
            }
        </style>
    </head>
    <body>
    <?php 
    include_once("includes/config.php");
    include_once("includes/functions.php");
            $tipo = $_SESSION['tipo']?? null;
    ?>
    <body id="bodyvt">
        
        <h3>
        <?php 
            if($tipo != "admin"){
                echo "<button type='button' class='btn btn-success success aplicar2' disabled><svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' fill='currentColor' class='bi bi-box-seam' viewBox='0 0 16 16'>
                <path d='M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z'/>
                </svg> Nova Turma</button>";
            }else{
                echo " <a href='new_turma.php'><button type='button' class='btn btn-success success aplicar2'><svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' fill='currentColor' class='bi bi-box-seam' viewBox='0 0 16 16'>
                <path d='M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z'/>
                </svg> Nova Turma</button></a>";
            }
        ?>
        </h3>
        <h1>&nbsp;Turmas</h1>

        <?php 
            $alt = $_GET['alt']?? null;
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
            
            //Mensagem de sucesso ao alterar turma
            if($alt == 'true'){
                ?>
                    <script>window.alert('Turma alterada com sucesso!')</script>
                <?php
            }
        ?>
        
            <?php 
                $q = "SELECT MIN(cod) AS menorCod, MAX(cod) AS maiorCod FROM turmas;";

                if($banco->query($q)){
                    $busca = $banco->query($q);
                    $reg = $busca->fetch_object();
                    $minCod = $reg->menorCod?? null;
                    $maxCod = $reg->maiorCod;

                    if($maxCod != '0'){
                        ?>
                        <table class="table table-striped table-bordered"> 
                            <thead class="table table-dark">
                            <tr>
                                <th>Nome Turma</th>
                                <th>Código</th>
                                <th>Frequencia</th>
                                <th>Alterar Horario/Professores/Alunos</th>
                                <th>Apagar turma</th>
                            </tr>
                         </thead>
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
                                        echo "<td><center><a href='frequencia.php?codTurma=$codTurma&nomeTurma=$nomeTurma&cod=$minCod'>
                                        <button type='button' class='btn btn-success aplicar'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-bookmark-check-fill' viewBox='0 0 16 16'>
                                        <path fill-rule='evenodd' d='M2 15.5V2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.439L8 13.069l-5.26 2.87A.5.5 0 0 1 2 15.5zm8.854-9.646a.5.5 0 0 0-.708-.708L7.5 7.793 6.354 6.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z'/>
                                      </svg> Aplicar</button>
                                        </a></center></td>";
                                        echo "<td><center><a href='edit_turma.php?nomeTurma=$nomeTurma&cod=$codTurma'>
                                        <button type='button' class='btn btn-warning alterar'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-book-half' viewBox='0 0 16 16'>
                                        <path d='M8.5 2.687c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z'/>
                                        </svg> Ver/Alterar</button></a></center></td>
                                        <td><center><a href='view_turma.php?delete=true&codTurma=$codTurma'><button type='button' class='btn btn-danger apagar'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                        <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
                                        </svg> Apagar</button></a></center></td></tr>";
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
        <a href='index.php'><button type='button' class='btn btn-primary menu'>Menu</button></a>
        <div class='ondas'>
               <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
               <path fill="#a6a6a6" fill-opacity="1" d="M0,224L48,202.7C96,181,192,139,288,138.7C384,139,480,181,576,181.3C672,181,768,139,864,117.3C960,96,1056,96,1152,106.7C1248,117,1344,139,1392,149.3L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
                    <path fill="#8c8c8c" fill-opacity="1" d="M0,224L24,192C48,160,96,96,144,90.7C192,85,240,139,288,170.7C336,203,384,213,432,197.3C480,181,528,139,576,144C624,149,672,203,720,197.3C768,192,816,128,864,112C912,96,960,128,1008,160C1056,192,1104,224,1152,197.3C1200,171,1248,85,1296,64C1344,43,1392,85,1416,106.7L1440,128L1440,320L1416,320C1392,320,1344,320,1296,320C1248,320,1200,320,1152,320C1104,320,1056,320,1008,320C960,320,912,320,864,320C816,320,768,320,720,320C672,320,624,320,576,320C528,320,480,320,432,320C384,320,336,320,288,320C240,320,192,320,144,320C96,320,48,320,24,320L0,320Z"></path>
                    <path fill="#273036" fill-opacity="1" d="M0,64L34.3,85.3C68.6,107,137,149,206,176C274.3,203,343,213,411,186.7C480,160,549,96,617,90.7C685.7,85,754,139,823,160C891.4,181,960,171,1029,181.3C1097.1,192,1166,224,1234,218.7C1302.9,213,1371,171,1406,149.3L1440,128L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path>
               </svg>
               <h1 class='sgc'>Turmas</h1>
          </div>
    </body>
</html>