<docytipe !html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
        require_once "includes/config.php";
        require_once "includes/functions.php";
        $n = $_GET['tipoSelect']?? null;
        $tipo = $_SESSION['tipo']?? null;
    ?>
    <body>
        <!--Nav horizontal -->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">   
             <div class="container-fluid">
               <a class="navbar-brand" href="index.php">Escola_TCC</a>
                 <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                 <span class="navbar-toggler-icon"> </span>
                </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                 <a class="nav-link active" aria-current="page" href="index.php">Voltar</a>
              </div>
            </div>
          </div>
           </nav>
           <!--Nav horizontal -->
        <h1>Usuários <?php echo "$n" ?></h1>
        <?php
            if($tipo == "admin"){
                echo "<center><a href='cadastro.php'><button type='button' class='btn btn-outline-primary'>Novo usuário</button></a></center>";
                
//                    Obtendo menor e maior valor das tabelas de usuarios
                if($n == "aluno"){           
                    $q = "SELECT MIN(codAluno) AS menorCod, MAX(codAluno) AS maiorCod FROM estudante;";
                    
                }else if($n == "professor"){
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
                            ?>
                            <div align="Center">
                                <a href='user_view.php?tipoSelect=responsavel'><button type="button" class="btn btn-outline-primary">Usuários responsável</button></a>
                                <a href='user_view.php?tipoSelect=professor'><button type="button" class="btn btn-outline-primary">Usuários professores</button></a><br><Br>
                            </div>
                            
                            <table class="table table-dark table-hover table-sm align-middle">
                                <tr>
                                    <th>Rm</th>
                                    <th>Nome</th>
                                    <th>Foto</th>
                                    <th>Data de nasc</th>
                                    <th>CPF</th>
                                    <th>RG</th>
                                    <th>Telefone</th>
                                    <th>Endereço</th>
                                    <th></th>
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
                                        <td>$reg->CPF</td>
                                        <td>$reg->RG</td>
                                        <td>$reg->telefoneAluno</td>
                                        <td>$reg->cidadeAluno,$reg->bairroAluno,<br>$reg->ruaAluno</td>
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
                            <center><a href="user_view.php?tipoSelect=aluno"><button type="button" class="btn btn-outline-primary">Usuários alunos</button></a></center>
                            <center><a href='user_view.php?tipoSelect=responsavel'><button type="button" class="btn btn-outline-primary">Usuários responsavel</button></a></center><br><Br>
                            <table class="table table-dark table-hover table-sm">
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
                             <a href="user_view.php?tipoSelect=aluno">Usuários alunos ||</a>
                             <a href='user_view.php?tipoSelect=professor'>Usuários professores </a><br><Br>
                             <table class="table table-dark table-hover table-sm">
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
                                        echo "teste";
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
                                        echo "teste";
                                        $c++;
                                    }
                                    
                                }else{
                                    echo "Erro na tabela do banco de dados! tente novamente mais tarde ;/";
                                }
                                
                            }echo "</table>";
                        }
                    }else{
                        echo "<a href='user_view.php?tipoSelect=aluno'>Usuários alunos ||</a>
                             <a href='user_view.php?tipoSelect=professor'>Usuários professores ||</a>
                             <a href='user_view.php?tipoSelect=responsavel'>Usuários responsavel </a>
                             <br><br>Nenhum usuário cadastrado no momento; ";
                    }
                }else{
                    echo "erro no banco de dados! tente novamente mais tarde :/";
                }
                
            }else{
                echo "Somente administradores tem acesso a essa página :/";
            }

        ?>
        <br><Br><center><a href="index.php">
        <button type="button" class="btn btn-outline-primary">Voltar</button>
        </a></center>
    </body>
</docytipe>
<style>
    h1{
        text-align: center;
    }
</style>