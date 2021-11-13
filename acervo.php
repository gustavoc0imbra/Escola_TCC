<!DOCKTYPE HTML>
<?php

    include_once ('includes/functions.php');
    require_once ('includes/config.php');     
       
      if(empty($_SESSION)){
          echo "<script>window.location.href='login.php'";
      }

       $nome = $_SESSION['nome'];
       $tipo = $_SESSION['tipo'];

       //$q = "SELECT * FROM acervo ORDER BY codArquivo";
       //$busca = $banco->query($sql);

       if ($tipo == 'aluno'){
           ?>
           <div id="">
                <h1>Bem vindo ao acervo Aluno <?php echo $nome; ?></h1>
                <table>
                    <tr>Código</tr>
                    <tr>Arquivo</tr>
                    <tr>Data de Upload</tr>
                    <?php 
                         //$path = "Arquivos/";
                         //$diretorio = dir($path);

                         //while($arquivo = $diretorio -> read()){
                             //echo "<td><ahref=''>".$arquivo."</a>"
                        // }
                    ?>
                </table>
           </div>
           <?php
       }elseif($tipo == 'admin'){
           ?>
           <h1 align="center">Enviar arquivo para sua turma</h1>
           <div id="formsEnvio" align="center" class="mb-3">
                <form enctype="multipart/form-data" action="enviaracervo.php" method="post">
                <div class="input-group" id="enviarBarra">
                    <input type="hidden" name="MAX_FILE_SIZE" value="52428800">
                    <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="arquivo">
                    <input class="btn btn-outline-secondary" type="submit" id="inputGroupFileAddon04">
            </div>
                </form>
           </div>
           <center>
               <button id="btn1" class="btn mb-3">
                    <a id="link" href="arqProfMostrar.php">Para consultar os arquivos já enviados clique aqui</a>
               </button>
            </center>
           <?php
       }else{
           echo "<script>alert('Você não tem acesso a esta página! Retornando...');</script>";
           echo "<script>window.location.href='index.php'</script>";
       }
?>
<html>
    <head>
       <meta charset="UTF-8">
       <meta lang="PT-BR">
       <meta name="viewport" content="width=device-width, initial-scale=1">
       <link rel="stylesheet" href="Estilo/main3.css">
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
       <title>Acervo Digital</title>
    </head>
    <body>
        <center>
        <a href="index.php">
            <button id ="btn-2" class="btn btn-outline-primary mb-3">Voltar</button>
        </a>
    </center>   
    </body>
</html>
<style>
     #link{
         font-family: arial;
         color: black;
         text-decoration: none;
     }
     #btn1{
         background-color: #FFFFFF;
         position: absolute;
         top: 39.5%;
         left: 37.5%;
     }
     #btn1:hover{
        background-color: #2565AE;
     }
     #btn-2{
         position: absolute;
         top: 47.5%;
     }
     #enviarBarra{
         width: 50%;
     }
</style>