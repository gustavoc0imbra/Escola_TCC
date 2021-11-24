<?php 
      
      require_once('includes/config.php');
      require_once('includes/functions.php');

      var_dump($pesquisar);
      $pesquisar = $_POST['buscar'];

      $result_pesq = $banco->query("SELECT * FROM acervo ORDER BY dataUp = LIKE '%$pesquisar%' LIMIT 5 ");
      
      while($row_pesquisa = $result_pesq->fetch_assoc($result_pesq)){
          echo "<h1>Resultado pesquisa:</h1></br>";
          echo $row_pesquisa;
      }
      //while($row_pesq = mysqli_fetch_array($result_pesq)){
          //echo ""
      //}

?>
<html>
    <head>

    </head>
    <body>
        
    </body>
</html>