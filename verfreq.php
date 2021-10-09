<?php

//conecta com o bd
include ("includes/BD.php");
$mysql = new BancodeDados();
$mysql->conecta();
//include 'mysqlexecuta.php';  //para executar o script no mysql
$sql="SELECT * FROM armazinfo";
$res = @mysqli_query($mysql->con, $sql) or die ("erro ao listar");

?>

<html lang ="PT-BR">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css"
       rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

   <!-- NAVBAR DA Pág -->
 <nav class="navbar navbar-expand-lg navbar-light bg-info">   
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Escola_TCC</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="home.php">Home</a>
        
      </div>
    </div>
  </div>
</nav>  
    </head> 
    <body>
    <br>
    <div class="jumbotron text-center">
      <h1>Frequência</h1>
         <p>Veja suas faltas e presenças!</p> 
    </div>
        <br>
        <div class="container">
  <!-- Content here -->
        <table class = "table table-bordered border border-info border border-3">
            <tr> 
                <td> <center> Frequência </center> </td>
                <td> <center> Disciplina </center> </td>
            </tr>

            <?php while($dado = $res->fetch_array()){ ?>
            <tr> 
                <td><?php echo $dado["frequenciaAluno"]; ?> </td>
                <td><?php echo $dado["FKcodDisciplina"]; ?> </td>
            </tr>
            <?php } ?>
        </table>

        </div>
     </body>



   