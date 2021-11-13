<?php
     
     include_once('includes/functions.php');
     require_once('includes/config.php');

     $nome = $_SESSION['nome'];
     $tipo = $_SESSION['tipo'];
     $cod = $_SESSION['cod'];

     $busca = $banco->query("SELECT * FROM acervo ORDER BY dataUp");
     
     if($tipo == 'admin'){
          ?>
          <div>
               <table class="table table-hover table-bordered " cellpadding="1">
                    <thead align="center" class="table table-dark">
                         <th>Preview</th>
                         <td>Nome</td>
                         <td>Data de envio</td>
                         <td>Baixar</td>
                         <td>Remover conteúdo</td>
                    </thead>
                    <?php while($arquivo = $busca->fetch_assoc()){ ?>
                    <tbody align="center">
                         <td class="col-lg-2"><img height="70" src="<?php echo $arquivo['path'];?>" alt=""></td>
                         <td class="col-lg-1"><?php echo $arquivo['nome']; ?></td>
                         <td class="col-lg-1"><?php echo date("d/m/Y H:i", strtotime($arquivo['dataUp'])); ?></td>
                         <td class="col-lg-1"><a href="<?php echo $arquivo['path']; ?>"><button class='btn btn-outline-secondary'>Clique aqui</button></a></td>
                         <td class="col-lg-1"><?php echo "<a href=\"deletaArq.php?codArquivo=".$arquivo['codArquivo']."\"><button class='btn btn-outline-secondary'>Remover</button></a>"; ?></td>
                         </tbody>
                         <?php 
                    } ?>
                    </table>
               
          </div>
          <?php
     }
?>
<!DOCKTYPE HTML>
<html>
     <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
          <title>Acervo Digital</title>
     </head>
     <body>
          <center>
          <a href="index.php">
               <button class='btn btn-outline-secondary'>Voltar</button>
          </a>
          </center>
     </body>
</html>
<style>
     body{
          background-color: white;
     }
</style>