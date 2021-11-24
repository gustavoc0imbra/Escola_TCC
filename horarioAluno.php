<?php
       include_once ("includes/functions.php");
       require_once ("includes/config.php");

       $nome = $_SESSION['nome'];
       $tipousuario = $_SESSION['tipo'];
       //$q = "SELECT "

       if($tipousuario != 'aluno'){
           echo $nome.(" você não tem acesso à esta página, retornando...");
           ?>
           <script>
               alert("Retornando para página....");
               window.location.href="index2.php";
           </script>
           <?php
       }else{
           ?>
           <!-- NAVBAR DA Pág -->
 <nav class="navbar navbar-expand-lg navbar-light bg-info">   
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Escola_TCC</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        
      </div>
    </div>
  </div>
</nav>
<br><br>
<h1 align="center"><?php echo ("3º Ano E.M"); ?></h1>
<!-- Tabela de horários -->
          <center>
            <div id="tabelahorario" class="table-responsive">
               <table class="table table-bordered" width="5">
                  <thead class="table-dark table-hover">
                  <tr>
                      <th></th>
                      <th>Segunda-Feira</th>
                      <th>Terça-Feira</th>
                      <th>Quarta-Feira</th>
                      <th>Quinta-Feira</th>
                      <th>Sexta-Feira</th>
                  </tr>
                </thead>
                <!-- Execução do retorno das informações de horário -->
                <!-- calma que jajá termino família -->
                  
                  <tr>
                      <td>1ª Aula</td>
                      <td>Português<?//php echo ?></td>
                      <td>Matemática</td>
                      <td>História</td>
                      <td>Inglês</td>
                      <td>Biologia</td>
                  </tr>
                  <tr>
                    
                     <td>2ª Aula</td>
                     <td>Física</td>
                     <td>Matemática</td>
                     <td>Inglês</td>
                     <td>Química</td>
                     <td>História</td>
                  </tr>
                  
                  <tr>
                    <td>3ª Aula</td>
                    <td>Biologia</td>
                    <td>Português</td>
                    <td>Sociologia</td>
                    <td>Filosofia</td>
                    <td>Matemática</td>
                  </tr>
                  <tr>
                    <td>4ª Aula</td>
                    <td>Filosofia</td>
                    <td>Inglês</td>
                    <td>Química</td>
                    <td>Física</td>
                    <td>Geografia</td>
                  </tr>
                  <tr>
                    <td>5ª Aula</td>
                    <td>Geografia</td>
                    <td>Filosofia</td>
                    <td>Sociologia</td>
                    <td>Matemática</td>
                    <td>Matemática</td>
                  </tr>
                  <tr>
                    <td>6ª Aula</td>
                    <td>Matemática</td>
                    <td>Português</td>
                    <td>Português</td>
                    <td>Ed. Física</td>
                    <td>Ed. Física</td>
                  </tr>
                  <?//php } ?>
               </table>
            </div>
          </center>
           <?php
       }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <link rel="stylesheet" href="main3.css">
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    </head>
    <body>
        <center>
        <a href="index.php">
      <button type="button" class="btn btn-outline-primary">Voltar</button>
         </a>
        </center>
    </body>
</html>
<style>
  .table{
    width: 70%;
    position: relative;
    
  }
  tr{
    text-align: center;
  }
</style>