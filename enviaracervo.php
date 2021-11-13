<?php
     require_once ('includes/config.php');
     require_once ('includes/functions.php');

          $dir = 'Arquivos/';
          $arquivo = $_FILES['arquivo'];
          $nomearquivo = $arquivo['name'];
          $novoNomeArquivo = uniqid();
          $extensao = strtolower(pathinfo($nomearquivo, PATHINFO_EXTENSION));

          $nome = $_SESSION['nome'];
          $tipo = $_SESSION['tipo'];

          if($tipo == 'admin'){
               
               if($extensao != "jpg" && $extensao != "png" && $extensao != "pdf" && $extensao != "docx" && $extensao != "pptx" && $extensao != "txt" && $extensao != "mp4" && $extensao != "mp3"){
                    echo "<script>alert('Tipo de arquivo não aceito');</script>";
                    logout();
                    ?> <script>window.location.href='login.php'</script>;
                    <?php
               }        
          

          $path = $dir . $novoNomeArquivo . "." . $extensao;
            
          $deu_certo = move_uploaded_file($arquivo['tmp_name'], $path);
          
          if($deu_certo){
              echo "<p align='center'>Arquivo Enviado com sucesso!</p>";
              $banco->query("INSERT INTO acervo (path, nome) VALUES ('$path','$nomearquivo')") or die($banco->error);
              echo "<a href='acervo.php'><button class='btn btn-outline-secondary'>Voltar</button></a>";
          }
          else{
               echo "<p>Arquivo não foi enviado</p>";
               echo "<a href='acervo.php'><button class='btn btn-outline-secondary'>Voltar</button></a>";
          }
          }

          
          //$uploadfile = $dir.basename($_FILES['arquivo']['name']);
          //$sql = "INSERT INTO acervo (arquivo) VALUES ($uploadfile)";
     //if(move_uploaded_file($_FILES['arquivo']['tmp_name'], $uploadfile)){
                   
             //echo "Arquivo enviado com sucesso!";

        //}else{
             //echo "Arquivo não foi enviado! Tente Novamente!";
           //}
?> 
<html>
     <head>
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
          <title>Acervo Digital</title>
     </head>
     <body>
     </body>
</html>