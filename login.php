<DOCYTIPE html>
    <html lang="pt-br">
        <head>
            <title></title>
            <meta charset="utf-8">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <style>


                #bodyUserEdit{ 
                    text-align: center;
                    font-size: 20px;
                    background-color: #0dcaf0;
                    position: relative;
                    top: 40px;
                }

                .botaog{
                    background-color: white;
                    position: relative;
                    border: none;
                    padding: 15px;
                    padding-left: 60px;
                    padding-right: 60px;
                    border-radius: 70px;

                }

                .botaog:hover{
                    background-color: darkcyan;
                    color: white;
                    cursor: pointer;
                }

                body{
                    background: radial-gradient(circle, rgba(0,212,255,1) 0%, rgba(0,212,255,1) 35%, rgba(0,153,255,1) 100%);;
                    text-align: center;
                    position: absolute;
                    top: 55%;
                    left: 50%;
                    transform: translate(-50%,-50%);
                    
                }

</style>
    </head>

        <body>
            <?php 
                require_once "includes/config.php";
                require_once "includes/functions.php";
                
            ?>
   

            <div id="corpo">
            
                <?php 
                
                    if(!empty($_POST['logout'])){
                        logout();
                        echo "<script>alert.deslogado com sucesso!</script>";
                    }
                
                    $tipo = $_POST['tipo'] ?? null;
                    $u = $_POST ['cod'] ?? null;
                    $s = $_POST ['senha'] ?? null;
                    
                    if(is_null($u) || is_null($s)){
                        require "login_form.php";
                    }else{
                        
                        if($tipo == "aluno"){
                            
                        $q = "select codAluno,senhaAluno,nomeAluno from estudante where codAluno = $u";
                        $busca=$banco->query($q);
                        if(!$busca){
                            echo ("<h1>Falha ao acessar o banco de dados!</h1>");
                        }else{
                            if($busca->num_rows>0){
                                $reg = $busca->fetch_object();
                                
                                if(testarhash($s,$reg->senhaAluno)){
                                    
                                    ?> <script> window.location.href = 'index.php' </script>
                                    <?php
                                    $_SESSION['user'] = $reg->codAluno;
                                    $_SESSION['nome'] = $reg->nomeAluno;
                                    $_SESSION['tipo'] = $tipo;

                                    echo $_SESSION['user'], $_SESSION['nomeAluno'];
                                    
                                }else{ 
                                    echo "<h1>Senha inv??lida!</h1>";
                                    echo "<br>";
                                    echo "<a href='login.php'><button class='btn btn-light'>Voltar</button></a>";
                                }
                            }else{
                                echo ("<h1> Usu??rio inexistente! </h1>");
                                echo "<br>";
                                echo "<a href='login.php'><button class='btn btn-light'>Voltar</button></a>";
                            }
                        }
                            
                        }elseif($tipo == "professor"){
                            
                            $q = "select codProf,senhaProf,nomeProf from professor where codProf = $u";
                            $busca = $banco->query($q);
                                
                            if(!$busca){
                                echo ("<h1>Falha ao acessar o banco de dados!</h1>");
                            }else{
                                if($busca->num_rows>0){
                                    $reg = $busca->fetch_object();
                                    
                                    if(testarhash($s,$reg->senhaProf)){
                                        
                                        ?> <script>window.location.href = "index.php" </script>
                                        <?php 
                                        $_SESSION['user'] = $reg->codProf;
                                        $_SESSION['nome'] = $reg->nomeProf;
                                        $_SESSION['tipo'] = $tipo;
                                        
                                        
                                        
                                    }else{
                                        echo "<h1>Senha inv??lida!</h1>";
                                        echo "<a href='login.php'><button class='btn btn-light'>Voltar</button></a>";
                                    }
                                    
                                }else{
                                   echo ("<h1>Usu??rio inexistente!</h1>");
                                   echo "<br>";
                                   echo "<a href='login.php'><button class='btn btn-light'>Voltar</button></a>";
                                }
                            }
                            
                        }elseif($tipo == "responsavel"){
                            
                            $q = "select codResponsavel,codAluno,senhaResponsavel,nomeResponsavel from responsaveis where codResponsavel = $u";
                            $busca = $banco->query($q);
                            
                            if(!$busca){
                                 echo ("<h1>Falha ao acessar o banco de dados!</h1>");
                            }else{
                                if($busca->num_rows>0){
                                    $reg = $busca->fetch_object();
                                    
                                    if(testarhash($s,$reg->senhaResponsavel)){
                                        
                                        ?> <script>window.location.href = "index.php" </script>
                                        <?php 
                                        $_SESSION['user'] = $reg->codResponsavel;
                                        $_SESSION['nome'] = $reg->nomeResponsavel;
                                        $_SESSION['tipo'] = $tipo;
                                        $_SESSION['aluno'] = $reg->codAluno;
                                        
                                        
                                    }else{
                                        echo "<h1>Senha inv??lida!</h1>";
                                        echo "<br>";
                                        echo "<a href='login.php'><button class='btn btn-light'>Voltar</button></a>";
                                    }
                                    
                                }else{
                                    echo ("<h1>Usu??rio inexistente!</h1>");
                                    echo "<br>";
                                    echo "<a href='login.php'><button class='btn btn-light'>Voltar</button></a>";
                                }
                            }
                            
                        }elseif($tipo == "admin"){
                            $q = "select codAdm,senhaAdm,nomeAdm from administrador where codAdm = $u";
                            $busca = $banco->query($q);
                            
                            if(!$busca){
                                 echo ("<h1>Falha ao acessar o banco de dados!</h1>");
                            }else{
                                if($busca->num_rows>0){
                                    $reg = $busca->fetch_object();
                                    
                                    if(testarhash($s,$reg->senhaAdm)){
                                        
                                        ?> <script>window.location.href = "index.php" </script>
                                        <?php 
                                        $_SESSION['user'] = $reg->codAdm;
                                        $_SESSION['nome'] = $reg->nomeAdm;
                                        $_SESSION['tipo'] = $tipo;
                                        
                                        
                                    }else{
                                        echo "<h1>Senha inv??lida!</h1>";
                                        echo "<br>";
                                        echo "<a href='login.php'><button class='btn btn-light'>Voltar</button></a>";
                                    }
                                    
                                }else{
                                    echo ("<h1>Usu??rio inexistente!</h1>");
                                    echo "<br>";
                                    echo "<a href='login.php'><button class='btn btn-light'>Voltar</button></a>";
                                }
                            }
                            
                        }
                        
                    }
                ?>
            </div>
               
        </body>
    </html>



    



   
