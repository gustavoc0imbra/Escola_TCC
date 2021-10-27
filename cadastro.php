<DOCYTIPE html>
    <html lang="pt-br">
        <head>
            <titlle></titlle>
            <meta charset="utf-8">
            <link rel="stylesheet" href="Estilo/estilo.css">
        </head>
        <body>
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
                
                // USUARIO TIPO ALUNO
                if($tipo == ("aluno")){

                    if($senha1 === $senha2){
                        
                        // VERIFICANDO SE EXISTE ALGUM VALOR NULL PARA TIPO ALUNO, PROFESSOR E ADMIN
                        if((empty($nome)||empty($senha1)||empty($senha2)||empty($rg)||empty($cpf)||empty($datanasc)||empty($tel)||empty($cidade) ||empty($bairro)||empty($rua))){
                        
                            echo "Todos os dados são obrigatórios!";
                        
                           
                        //APLICANDO VALORES PARA O TIPO ALUNO
                        }else{
                            
                                $senha1 = gerarhash($senha1);

                                $q = "INSERT INTO  estudante(nomeAluno,senhaAluno,datanascAluno,rg,cpf,telefoneAluno,cidadeAluno,bairroAluno,ruaAluno) VALUES('$nome','$senha1','$datanasc','$rg','$cpf','$tel','$cidade','$bairro','$rua')";


                                if($banco->query($q)){
                                    echo "Usuário $nome cadastrado com sucesso!";
                                }else{
                                    echo "Não foi possivel cadastrar o usuário $nome";
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
                                        echo "Senha inválida, tente novamente!";
                                    }

                                }else{
                                    echo "Aluno ainda não cadastrado tente novamente mais tarde!";
                                }
                            }
                            
                        }else{
                           echo "Senha não conferem, tente novamente!";
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
            <br><br><a href="index.php">voltar</a>
        </body>
