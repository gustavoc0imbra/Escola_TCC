<DOCYTIPE html>
    <html lang="pt-br">
        <head>
            <title>cadastrar</title>
            <meta charset="utf-8">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
            <link rel="stylesheet" href="Estilo/estilo.css">
        </head>
        <body>
            <div>
            <?php 
                require_once "includes/functions.php";
                require_once "includes/config.php";
                require "Cadastro_form.php";

            ?>
            <?php
            
                $tipo = $_POST['tipo']?? null;
                $nome = $_POST['nome']?? null;
                $senha1 = $_POST['senha1']?? null;
                $senha2 = $_POST['senha2']?? null;
                $rg = $_POST['rg']?? null;
                $cpf = $_POST['cpf']?? null;
                $datanasc = $_POST['datanasc']?? null;
                $tel = $_POST['tel']?? null;
                $cel = $_POST['cel']?? null;
                $cidade = $_POST['cidade']?? null;
                $bairro = $_POST['bairro']?? null;
                $rua = $_POST['rua']?? null;
                $disciplina = $_POST['disciplina']?? null;
                $imagem = $_FILES['imagem']?? null;
                $nomeimg = $imagem['name']?? null;
                $novonomeimg = uniqid();
                $extensao = strtolower(pathinfo($nomeimg, PATHINFO_EXTENSION));

                //Falta fazer o cadastro de imagem para os outros usuários família 
                
                $dir = "UsersImage/";
                
                // USUARIO TIPO ALUNO
                if($tipo == ("aluno")){

                    if($senha1 === $senha2){
                        
                        // VERIFICANDO SE EXISTE ALGUM VALOR NULL PARA TIPO ALUNO, PROFESSOR E ADMIN
                        if((empty($nome)||empty($senha1)||empty($senha2)||empty($rg)||empty($cpf)||empty($datanasc)||empty($tel)||empty($cidade) ||empty($bairro)||empty($rua) ||empty($imagem))){
                        
                            echo "Todos os dados são obrigatórios!";
                        
                           
                        //APLICANDO VALORES PARA O TIPO ALUNO
                        }else{
                                
                                $senha1 = gerarhash($senha1);
                                $path = $dir . $novonomeimg . "." . $extensao;
                                $mover = move_uploaded_file($imagem['tmp_name'], $path);
                                if ($mover){
                                    $q = "INSERT INTO  estudante(nomeAluno,senhaAluno,datanascAluno,rg,cpf,telefoneAluno,cidadeAluno,bairroAluno,ruaAluno,imagemEstudante) VALUES('$nome','$senha1','$datanasc','$rg','$cpf','$tel','$cidade','$bairro','$rua','$path')";
                                if($banco->query($q)){
                                    echo "Usuário $nome cadastrado com sucesso!";
                                }else{
                                    echo "Não foi possivel cadastrar o usuário $nome";
                                }
                            }

                                
                            }
                    
                    }else{
                        echo "Senhas não conferem! tente novamente";
                    }
                
                    
                // USUARIO TIPO PROFESSOR
                }elseif($tipo == "professor"){
                   
                    $disciplina = $_POST['disciplina']?? null;
                    
                    if(empty($nome)||empty($disciplina)||empty($senha1)||empty($senha2)||empty($datanasc)||empty($tel)||empty($cidade)||empty($bairro)||empty($rua)){
                        
                        echo "Todos os dados são obrigatórios!";
                    
                    }else{
                        
                        $senha1 = gerarhash($senha1);
                        
                        $q = "INSERT INTO professor(codDisciplina,nomeProf,senhaProf,datanascProf,celProf,telProf,cidadeProf,bairroProf,ruaProf) VALUES ('$disciplina','$nome','$senha1','$datanasc','$cel','$tel','$cidade','$bairro','$rua')";
                        
                        if($banco->query($q)){
                            echo "Usuário $nome cadastradado com sucesso!";
                        }else{
                            echo "Não foi possivel cadastrar o usuário $nome";
                            }
                        }
                    
                // USUARIO TIPO RESPONSAVEL
                }elseif($tipo == "responsavel"){
                    
                    $codAluno = $_POST['codAluno']?? null;
                    $senhaAluno = $_POST['senhaAluno']?? null;
                    
                    if(empty($nome)||empty($senha1)||empty($senha2)||empty($rg)||empty($cpf)||empty($datanasc)||empty($codAluno)||empty($senhaAluno)){
                        
                        echo "Todos os dados são obrigatórios!";
                        
                    }else{
                        
                        if($senha1 == $senha2){
                            
                            $a = "select codAluno,senhaAluno from estudante where codAluno = $codAluno";
                            $busca= $banco->query($a);
                            
                            $senha1 = gerarhash($senha1);

                            if(!$busca){

                                echo "Falha ao acessar o banco! tente novamente mais tarde!";

                            }else{
                                
                                if($busca->num_rows>0){

                                    $reg = $busca->fetch_object();

                                    if(testarhash($senhaAluno,$reg->senhaAluno)){

                                        $senhaAluno = $reg->senhaAluno;
                                        $q = "INSERT INTO responsaveis(codAluno,nomeResponsavel,senhaResponsavel,cpfMae,rgMae) VALUES ('$codAluno','$nome','$senha1','$cpf','$rg')";

                                        if($banco->query($q)){

                                            echo "Usuário $nome cadastradado com sucesso!";
                                        }else{

                                            echo "Não foi possivel cadastrar o usuário $nome";
                                        }

                                    }else{
                                        echo "<h1>Senha inválida, tente novamente!</h1>";
                                    }

                                }else{
                                    echo "<h1>Aluno ainda não cadastrado tente novamente mais tarde!</h1>";
                                }
                            }
                            
                        }else{
                           echo "<h1>Senha não conferem, tente novamente</h1>!";
                        }
                    }
                    
                // USAURIO TIPO ADMIN
                }elseif($tipo == "admin"){
                    
                    if(empty($nome)||empty($senha1)||empty($senha2)){
                        
                       echo "Todos os dados são obrigatórios!";
                    
                    }else{
                        
                       $senha1 = gerarhash($senha1);
                        
                       $q = "INSERT INTO administrador(nomeAdm,senhaAdm) VALUES ('$nome','$senha1')";
                        
                       if($banco->query($q)){
                            echo "Usuário $nome cadastradado com sucesso!";
                       }else{
                            echo "Não foi possivel cadastrar o usuário $nome";
                       }
                    }
                }
                

            ?>
          </div>
        </body>

        <style>
            div{
                 text-align: center;
                 position: relative;
                 font-size: 40px;
                 
                
            }
        </style>
