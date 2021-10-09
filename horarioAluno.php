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
            <div id="tabelahorario" class="table-responsive">
               <table class="table">
                  <tr>
                      <th></th>
                      <th>Segunda-Feira</th>
                      <th>Terça-Feira</th>
                      <th>Quarta-Feira</th>
                      <th>Quinta-Feira</th>
                      <th>Sexta-Feira</th>
                  </tr>
                  <tr>
                      <td>Português</td>
                      <td>Matemática</td>
                      <td>História</td>
                      <td>Inglês</td>
                      <td>Biologia</td>
                      <td>Física</td>
                  </tr>
               </table>
            </div>
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
        <a href="index2.php">
      <button type="button" class="btn btn-outline-primary">Voltar</button>
         </a>
    </body>
</html>