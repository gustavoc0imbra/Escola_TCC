<!DOCKTYPE HTML>
<?php

    include_once ('includes/functions.php');
    require_once ('includes/config.php');     
       
      if(empty($_SESSION)){
          echo "<script>window.location.href='login.php'";
      }

       $nome = $_SESSION['nome'];
       $tipo = $_SESSION['tipo'];

       $busca = $banco->query("SELECT * FROM acervo WHERE codArquivo ORDER BY dataUp");

       if ($tipo == 'aluno'){
           ?>
           <div id="">
                <h1>Bem vindo ao acervo Aluno <?php echo $nome; ?></h1>
                <table align="center">
                    <thead class="table table-dark table-striped">
                    <tr>Código</tr>
                    <tr>Arquivo</tr>
                    <tr>Data de Upload</tr>
                     </thead>
                    <?php while ($arquivo = $busca->fetch_assoc()) {
                    ?>
                    <tbody>
                            <tr><?php echo $arquivo['codArquivo']; ?></tr>
                            <tr><a href="<?php echo $arquivo['path']; ?>"><img id="downloadImg" height="25" src="Imagens/download.svg" alt=""></a></tr>
                            <tr><?php echo $arquivo['dataUp']; ?></tr>
                        </tbody>
                    <?php 
                }?>
                </table>
           </div>
           <?php
       }elseif(($tipo == 'professor')||($tipo == 'admin')){
           ?>
        <div class='box'>
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
                <center>
            <a href="index.php">
                <button id ="btn-2" class="btn btn-outline-primary mb-3">Voltar</button>
            </a>
            </center>
       </div>
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
    <div class='ondas'>
               <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
               <path fill="#a6a6a6" fill-opacity="1" d="M0,224L48,202.7C96,181,192,139,288,138.7C384,139,480,181,576,181.3C672,181,768,139,864,117.3C960,96,1056,96,1152,106.7C1248,117,1344,139,1392,149.3L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
                    <path fill="#8c8c8c" fill-opacity="1" d="M0,224L24,192C48,160,96,96,144,90.7C192,85,240,139,288,170.7C336,203,384,213,432,197.3C480,181,528,139,576,144C624,149,672,203,720,197.3C768,192,816,128,864,112C912,96,960,128,1008,160C1056,192,1104,224,1152,197.3C1200,171,1248,85,1296,64C1344,43,1392,85,1416,106.7L1440,128L1440,320L1416,320C1392,320,1344,320,1296,320C1248,320,1200,320,1152,320C1104,320,1056,320,1008,320C960,320,912,320,864,320C816,320,768,320,720,320C672,320,624,320,576,320C528,320,480,320,432,320C384,320,336,320,288,320C240,320,192,320,144,320C96,320,48,320,24,320L0,320Z"></path>
                    <path fill="#273036" fill-opacity="1" d="M0,64L34.3,85.3C68.6,107,137,149,206,176C274.3,203,343,213,411,186.7C480,160,549,96,617,90.7C685.7,85,754,139,823,160C891.4,181,960,171,1029,181.3C1097.1,192,1166,224,1234,218.7C1302.9,213,1371,171,1406,149.3L1440,128L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path>
               </svg>
               <h1 class='sgc'>Acervo Digital</h1>
          </div>
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

     .ondas{
          margin-top: 22.2%;
          position: relative;
     }

     .sgc{
        
          color: white;
          position: absolute;
          bottom: 8px;
          left: 16px;
          font-size: 26px;
     }

     .box{
         
     }
</style>