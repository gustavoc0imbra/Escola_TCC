<<<<<<< HEAD
<DOCYTIPE html>
    <html lang="pt-br">
        <head>
            <titlle></titlle>
            <meta charset="utf-8">
            <link rel="stylesheet" href="Estilo/estilo.css">
        </head>
        <body>
            <?php 
                require "Cadastro_form.php";
                require_once "config.php";
            ?>
            <?php 
                $tipo = $_POST['tipo']?? null;

                if($tipo == "aluno"){
                    
                    $nome = $_POST['nome']?? null;
                    $senha1 = $_POST['senha1']?? null;
                    $senha2 = $_POST['senha2']?? null;
                    $rg = $_POST['rg']?? null;
                    $cpf = $_POST['cpf']?? null;
                    $datanasc = $_POST['datanasc']?? null;
                    $tel = $_POST['tel']?? null;
                    $endereco = $_POST['endereco']?? null;

                    if($senha1 != $senha2){
                        // calma familia logo logo eu faço 
                    }
                    
                }elseif($tipo == "professor"){
                    $nome = $_POST['nome']?? null;
                    $datanasc = $_POST['datanasc']?? null;
                    $tel = $_POST['tel']?? null;
                    $endereco = $_POST['endereco']?? null;
                    
                }elseif($tipo == "responsavel"){
                    $nome = $_POST['nome']?? null;
                    $rg = $_POST['rg']?? null;
                    $cpf = $_POST['cpf']?? null;
                    $datanasc = $_POST['datanasc']?? null;
                    $nomeAluno = $_POST['nomeAluno']?? null;
                    $senha1 = $_POST['senha1']?? null;

                }else{
                    $nome = $_POST['nome']?? null;
                    $senha1 = $_POST['senha1']?? null;

                    echo $nome, $senha1;
                }
                
           

            ?>
        </body>



    </html>
