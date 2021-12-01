<docytipe !html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
      

    </head>
    <?php 
        require_once "includes/config.php";
        require_once "includes/functions.php";
        $tipo = $_SESSION['tipo']?? null;
    ?>
    <body>
    <?php 
        $edit = null;
        $delete = null;
        if($tipo == "admin"){
            
//          variaveis do user_view
            $edit = "true";
            $c = $_GET['tipoUsuario']?? null;
            $cod = $_GET['cod']?? null;
            $nome = $_GET['nome']?? null;
            $delete = $_GET['delete']?? null;

            echo "<center><h1 >Alterar dados do $c </h1></center>";
        }
        
            
            if($delete == "true"){
                    
                    if($c == 'aluno'){
                        
                        $q= "SELECT codResponsavel FROM responsaveis where codAluno = $cod;";
                        
                        $busca= $banco->query($q);
                        $reg = $busca->fetch_object();
                        $responsavel = $reg->codResponsavel??null;
                        
                        if($responsavel == null){
                        
                            $q = "DELETE FROM estudante WHERE codAluno=$cod";
                            if($banco->query($q)){
                                echo "Usuário deletado com sucesso!";

                            }else{
                                echo "Erro ao deletar aluno, Tente novamente mais tarde!";
                            }

                            echo"<br><br><a href='user_view.php?tipoSelect=aluno'>voltar</a>";
                        }else{
                            $q = "DELETE FROM responsaveis where codAluno = $cod";
                            
                            if($banco->query($q)){
                                
                                $q = "DELETE FROM estudante WHERE codAluno=$cod";
                            if($banco->query($q)){
                                echo "Usuário deletado com sucesso!";

                            }else{
                                echo "Erro ao deletar aluno, Tente novamente mais tarde!";
                            }
                                
                            }else{
                                echo "Erro ao apagar o responsavel do aluno";
                            }
                        }
                        
                    }else if($c == 'professor'){
                        
                        $q = "DELETE FROM professor WHERE codProf = $cod";
                        if($banco->query($q)){
                            echo "Usuário deletado com sucesso!";
                            
                        }else{
                            echo "Erro ao deletar aluno, Tente novamente mais tarde!";
                        }
                        
                        echo "<br><a href='user_view.php?tipoSelect=professor'>voltar</a>";
                        
                    }else if ($c == 'admin'){
                        
                        $q = "DELETE FROM administrador WHERE codAdm = $cod";
                        if($banco->query($q)){
                            logout();
                            echo "Usuário deletado com sucesso!, por favor faça novamente o <a href='login.php'>login</a>";
                            
                        }else{
                            echo "Erro ao deletar admin, Tente novamente mais tarde!";
                            
                        }
                        
                        
                    }else{
                        
                        $q = "DELETE FROM responsaveis WHERE codResponsavel = $cod";
                        if($banco->query($q)){
                            echo "Usuário deletado com sucesso!";
                            
                        }else{
                            echo "Erro ao deletar aluno, Tente novamente mais tarde!";
                        }
                        
                         echo"<br><br><a href='user_view.php?tipoSelect=responsavel'>voltar</a>";
                        
                    }  
        }else{
        
            if(!isset($_POST['usuario'])){
                include "user_edit_form.php";
            }else{

                $codNovo = $_POST['usuario']?? null;
                $nome = $_POST['nome']?? null;
                $senha1 = $_POST['senha1']?? null;
                $senha2 = $_POST['senha2']?? null;
                $datanasc = $_POST['datanasc']?? null;
                $rg = $_POST['rg']?? null;
                $cpf = $_POST['cpf']?? null;
                $cel = $_POST['cel']?? null;
                $disciplina = $_POST['disciplina']?? null;
                $tel = $_POST['tel']?? null;
                $cidade = $_POST['cidade']?? null;
                $bairro = $_POST['bairro']?? null;
                $rua = $_POST['rua']?? null;
                $rmAluno = $_POST['rmAluno']?? null;

                if($tipo != "admin"){

                    $c = $tipo;
                    $cod = $_SESSION['user'];

                }else{

                    $c = $_GET['c']??null;
                    $cod = $_GET['cod']??null;
                }


                if($c == "admin"){

                    $q = "UPDATE administrador SET codAdm = '$codNovo', nomeAdm = '$nome'";

                    if($senha1 != null){

                        if($senha1 == $senha2){

                            $senha=gerarhash($senha1);
                            $q.= " , senhaAdm='$senha'";

                            }else{
                                echo "Senhas não conferem a senha anterior será mantida!";
                        }   
                    }

                    $q.="WHERE codAdm='$cod';";

                }else if($c == "aluno"){

                    $q = "UPDATE estudante SET codAluno='$codNovo', nomeAluno='$nome', datanascAluno='$datanasc', RG='$rg', CPF='$cpf', telefoneAluno='$tel', bairroAluno='$bairro', ruaAluno='$rua', cidadeAluno='$cidade'";

                    if($senha1 != null){
                        if($senha1 == $senha2){

                            $senha=gerarhash($senha1);
                            $q.= " , senhaAluno='$senha'";

                        }else{
                            echo "Senhas não conferem a senha anterior será mantida!";
                        }
                    }

                    $q.=" WHERE codAluno='$cod';";

                }else if($c == "professor"){

                    $q = "UPDATE professor SET codProf='$codNovo', nomeProf='$nome', datanascProf='$datanasc', celProf='$cel', telProf='$tel', bairroProf='$bairro', ruaProf='$rua', cidadeProf='$cidade', codDisciplina='$disciplina'";

                    if($senha1 != null){
                        if($senha1 == $senha2){

                            $senha=gerarhash($senha1);
                            $q.= " , senhaProf='$senha'";

                        }else{
                            echo "Senhas não conferem a senha anterior será mantida!";
                        }
                    }

                    $q.=" WHERE codProf='$cod';";


                }else if($c == "responsavel"){

                    $q = "UPDATE responsaveis SET codResponsavel='$codNovo', nomeResponsavel='$nome', cpfMae='$cpf', rgMae='$rg', codAluno='$rmAluno'";

                    if($senha1 != null){
                        if($senha1 == $senha2){

                            $senha=gerarhash($senha1);
                            $q.= " , senhaResponsavel='$senha'";

                        }else{
                            echo "Senhas não conferem a senha anterior será mantida!";
                        }
                    }

                    $q.=" WHERE codResponsavel='$cod';";

                }

                if($banco->query($q)){
                    echo "Dados alterado com sucesso!";
                    
                    if($edit != "true"){
                        
                       logout();
                       echo "<br>por favor faça o login novamente!";
                    }

                }else{
                    echo "Não foi possivel alterar os dados, tente novamente mais tarde :/";
                }

            }
        }
        
        
    ?>

       
      

    </body>

    <style>
 
    </style>

