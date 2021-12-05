<docytipe !html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <title>Usuários do osistema</title>
    </head>
    <style>
        a{
            text-decoration: none;
        }
        table{
            text-align: center;
        }
        #voltar{
            padding: 10px;
        }
        #btn02{
            position: relative;
        }

        .button{
            margin: 0;
            float: left;
            margin-left: 10px;
        }
    </style>
    <?php 
        require_once "includes/config.php";
        require_once "includes/functions.php";
        $n = $_GET['tipoSelect']?? null;
        $altNota = $_GET['altNota']?? null;
        $clear = $_GET['clear']?? null;
        $newuser = $_GET['newuser']?? null;
        $tipo = $_SESSION['tipo']?? null;

        if($newuser == 'true'){
            ?>
                <script>window.alert('Usuário cadastrado com sucesso!, redirecionando...')</script>
            <?php
        }
    ?>
    <body>
        <h1>Usuários <?php echo "$n" ?></h1>
        <?php
            if($tipo == "admin" || $tipo == "professor"){

                if($tipo == "professor"){
                    echo "<center><a href='cadastro.php'><button class='btn btn-secondary button' disabled><svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' fill='currentColor' class='bi bi-bookmark-plus-fill' viewBox='0 0 16 16'>
                <path fill-rule='evenodd' d='M2 15.5V2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.439L8 13.069l-5.26 2.87A.5.5 0 0 1 2 15.5zm6.5-11a.5.5 0 0 0-1 0V6H6a.5.5 0 0 0 0 1h1.5v1.5a.5.5 0 0 0 1 0V7H10a.5.5 0 0 0 0-1H8.5V4.5z'/>
              </svg> Novo usuário</button></a></center>";
                }else{
                    echo "<center><a href='cadastro.php'><button class='btn btn-secondary button'><svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' fill='currentColor' class='bi bi-bookmark-plus-fill' viewBox='0 0 16 16'>
                    <path fill-rule='evenodd' d='M2 15.5V2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.439L8 13.069l-5.26 2.87A.5.5 0 0 1 2 15.5zm6.5-11a.5.5 0 0 0-1 0V6H6a.5.5 0 0 0 0 1h1.5v1.5a.5.5 0 0 0 1 0V7H10a.5.5 0 0 0 0-1H8.5V4.5z'/>
                  </svg> Novo usuário</button></a></center>";
                }
                
                
//                    Obtendo menor e maior valor das tabelas de usuarios
                if($n == "aluno"){           
                    $q = "SELECT MIN(codAluno) AS menorCod, MAX(codAluno) AS maiorCod FROM estudante;";
                    
                }   else if($n == "professor"){
                    $q = "SELECT MIN(codProf) AS menorCod, MAX(codProf) AS maiorCod FROM professor;";
                
                }else{
                    $q = "SELECT MIN(codResponsavel) AS menorCod, MAX(codResponsavel) AS maiorCod FROM responsaveis;";
                }
                    $buscaCod = $banco->query($q);
                    $reg = $buscaCod->fetch_object();
                    $c = $reg->menorCod;
                    $maiorCod = $reg->maiorCod;
                
                if($banco->query($q)){
                    
                    if(!$reg->menorCod == null){
                        
                        if($n == "aluno"){
                            // alerts 
                            if($altNota == 'true'){
                                ?>
                                <script>window.alert('Nota alterada/aplicada com sucesso!')</script>
                                <?php
                            }else if($clear == 'true'){
                                ?>
                                <script>window.alert('Notas do aluno zerada com sucesso!')</script>
                                <?php
                            }
                            ?>
                            <center>
                                <?php 
                                    if($tipo == "professor"){
                                       echo "<a id='btn02' href='user_view.php?tipoSelect=responsavel'><button class='btn btn-secondary button' disabled>Usuários responsavel</button></a>
                                        <a id='btn02' href='user_view.php?tipoSelect=professor'><button class='btn btn-secondary button' disabled>Usuários professores</button></a>";
                                    }else{
                                        echo "<a id='btn02' href='user_view.php?tipoSelect=responsavel'><button class='btn btn-secondary button'>Usuários responsavel</button></a>
                                        <a id='btn02' href='user_view.php?tipoSelect=professor'><button class='btn btn-secondary button'>Usuários professores</button></a>";
                                    }
                                ?>
              
                                
                                <br><Br>
                            </center>
                            
                            <table class="table table-striped table-bordered"> 
                            <tr>
                                 <thead class="table table-dark">
                                        <th>Rm</th>
                                        <th>Nome</th>
                                        <th>Foto</th>
                                        <th>Data de nasc</th>
                                        <th>R.G</th>
                                        <th>Turma</th>
                                        <th>Frequência</th>
                                        <th>Notas</th>
                                        <th>Dados pessoais</th>
                                    </thead>
                                </tr>
                        <?php
                         
                        while($c !=$maiorCod+1){
                            
                            $q = "SELECT * FROM estudante WHERE codAluno = $c";
                            $busca = $banco->query($q);
                            
                            if($banco->query($q)){
                                $reg = $busca->fetch_object();
                                $regEmpty = $reg->codAluno?? null;
                                
                                if($regEmpty == null ){
                                    $c++;
                                }else{
                                
                                    
//                                dados mostrados dentro da tabela 'usuarios aluno'
                                echo"<tr>
                                        <td>$reg->codAluno</td>
                                        <td>$reg->nomeAluno</td>
                                        <td>$reg->imagemEstudante</td>
                                        <td>$reg->datanascAluno</td>
                                        <td>$reg->CPF</td>";

                                        $q1 = "SELECT codTurma,nomeTurma FROM turmas WHERE cod = '$reg->turma'";
                                        if($banco->query($q1)){
                                            $busca1 = $banco->query($q1);
                                            $reg1 = $busca1->fetch_object();
                                            $codTurma = $reg1->codTurma?? null;

                                            echo "<td>$reg1->nomeTurma</td>";
                                        }else{
                                            echo "<td>Algo deu errado na busca da turma!</td>";
                                        }
                                        if($codTurma == '0' || $codTurma == null){
                                            echo "<td>(Associe a uma turma)</td><td>(Associe a uma Turma)</td>";
                                        }else{
                                            echo "<td><a href='user_frequencia.php?cod=$reg->codAluno&nome=$reg->nomeAluno&turma=$reg1->codTurma'>Ver frequencia</a></td>
                                        <td><a href='user_nota.php?cod=$reg->codAluno&nome=$reg->nomeAluno&turma=$reg1->codTurma'>Ver Notas</a></td>";
                                        }
                                        echo "
                                        <td><a href='user_edit.php?tipoUsuario=aluno&nome=$reg->nomeAluno&cod=$reg->codAluno'>alterar dados</a></td>
                                    </tr>";
                                $c ++;
                                }
                                
                            }else{
                                echo "Erro na tabela do banco de dados! tente novamente mais tarde ;/";
                            }
                        }echo "</table>";
                            
//                      tabela dos professores
                        }else if($n == "professor"){
                            ?>
                            <center>
                                <a href="user_view.php?tipoSelect=aluno"><button class="btn btn-secondary">Usuários alunos</button></a>
                                <a href='user_view.php?tipoSelect=responsavel'><button class="btn btn-secondary">Usuários responsavel</button></a><br><Br>
                            </center> 
                            <table class="table table-dark table-striped">
                                <tr>
                                    <th>Rm</th>
                                    <th>Nome</th>
                                    <th>Data de nasc</th>
                                    <th>Tel/Cel</th>
                                    <th>Endereço</th>
                                    <th>Disciplina</th>
                                    <th>Foto</th>
                                    <th>Alterar</th>

                                </tr>
                            <?php     
                            while($c !=$maiorCod+1){
                                
                                $q = "SELECT * FROM professor WHERE codProf = $c";
                                $busca = $banco->query($q);
                                
                                if($banco->query($q)){
                                    $reg= $busca->fetch_object();
                                    $regEmpty = $reg->codProf?? null;
                                    
                                    if($regEmpty == null){
                                        $c++;
                                    }else{
//                                      dados mostrados dentro da tabela 'usuarios professores'
                                        echo "<tr>
                                                <td>$reg->codProf</td>
                                                <td>$reg->nomeProf</td>
                                                <td>$reg->datanascProf</td>
                                                <td>$reg->telProf<br>$reg->celProf</td>
                                                <td>$reg->cidadeProf<br>$reg->bairroProf<br>$reg->ruaProf</td> 
                                                <td>$reg->codDisciplina</td> 
                                                <td>$reg->imagemProfessor</td>  
                                                <td><a href='user_edit.php?tipoUsuario=professor&nome=$reg->nomeProf&cod=$reg->codProf'>alterar dados</a></td> 
                                              </tr>";
                                        $c++;
                                    }
                                    
                                }else{
                                     echo "Erro na tabela do banco de dados! tente novamente mais tarde ;/";
                                }
                                
                            }echo "</table>";
                            
//                      tabela dos responsaveis
                        }else{
                            ?>
                            <center>
                                <a href="user_view.php?tipoSelect=aluno"><button class="btn btn-secondary">Usuários alunos</button></a>
                                <a href='user_view.php?tipoSelect=professor'><button class="btn btn-secondary">Usuários professores</button></a><br><Br>
                            </center>
                             <table class="table table-dark table-striped">
                                 <tr>
                                     <th>Rm</th> 
                                     <th>Nome</th>
                                     <th>CPF</th>
                                     <th>Rg</th>
                                     <th>Responsavel de:</th>
                                     <th>Alterar</th>

                                 </tr>
                            <?php
                            while($c !=$maiorCod+1){
                                
                                $q = "SELECT * FROM responsaveis WHERE codResponsavel = $c";
                                $busca = $banco->query($q);
                                
                                if($banco->query($q)){
                                    $reg= $busca->fetch_object();
                                    $regEmpty = $reg->codResponsavel?? null;
                                    
                                    if($regEmpty == null){
                                        $c++;
                                    }else{
//                                      dados mostrados dentro da tabela 'usuarios responsaveis'
                                        echo "<tr>
                                                <td>$reg->codResponsavel</td>
                                                <td>$reg->nomeResponsavel</td>
                                                <td>$reg->cpfMae</td>
                                                <td>$reg->rgMae</td>
                                                <td>$reg->codAluno</td>
                                                <td><a href='user_edit.php?tipoUsuario=responsavel&nome=$reg->nomeResponsavel&cod=$reg->codResponsavel'>alterar dados</a></td>
                                             </tr>";
                                        $c++;
                                    }
                                    
                                }else{
                                    echo "Erro na tabela do banco de dados! tente novamente mais tarde ;/";
                                }
                                
                            }echo "</table>";
                        }
                    }else{
                        echo "<center><a href='user_view.php?tipoSelect=aluno'><button class='btn btn-secondary'>Usuários alunos</button></a>
                             <a href='user_view.php?tipoSelect=professor'><button class='btn btn-secondary'>Usuários professores</button></a>
                             <center><a href='user_view.php?tipoSelect=responsavel'><button class='btn btn-secondary'>Usuários responsavel</button></a>
                             <br><br><center><h1>Nenhum usuário cadastrado no momento;</h1></center> ";
                    }
                }else{
                    echo "erro no banco de dados! tente novamente mais tarde :/";
                }
                
            }else{
                echo "Somente administradores tem acesso a essa página :/";
            }

        ?>
        <br><Br><a id="voltar" href="index.php"><button class="btn btn-primary">Voltar</button></a>
    </body>
</docytipe>
