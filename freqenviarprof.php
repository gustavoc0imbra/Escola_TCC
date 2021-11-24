<?php
        include_once("includes/functions.php");
        require_once("includes/config.php");

        $nome = $_SESSION['nome'];
        $tipousuario = $_SESSION['tipo'];
        $buscaAluno = $banco->query("SELECT * FROM estudante ORDER BY nomeAluno");

        if($tipousuario != 'professor'){
            echo $nome.(" você não tem acesso à esta página");
            echo ("<script>window.location.href='index.php'</script>");
        }else{
            ?>
               <h1 align="center">Turma atual: <?php echo "Os mais BR4B0$!"; ?></h1>
               <br>
               <form action="inserir_freq.php" method="POST"> 
                   <table align="center" class="table table-hover table-bordered" style="width:50%; text-align:center">
                        <thead class="table table-dark">
                            <td>Código</td>
                            <td>Nome</td>
                            <td>Presente</td>
                            <td>Falta</td>
                        </thead>
                <?php while($estudante = $buscaAluno->fetch_array()){ ?>
                    
                        <tbody>
                            <td style="width:10%"><label class="form-check-label"> <?php echo $estudante['codAluno']; ?><br></label></td>
                            <td><label class="form-check-label" style="width:40% height:50%"> <?php echo $estudante['nomeAluno']; ?><br></label></td>
                            <td style="width:10%"><input class="form-check-input" type="checkbox" name="presenca" id=""></td>
                            <td style="width:10%"><input class="form-check-input" type="checkbox" name="falta" id=""></td>
                            </tbody>
                            
                    <?php
                    }?>
                    </table>
                        <p align="center"><input type="submit" value="Enviar"></p>
                    </form>
            <?php
        }

?>
<!DOCKTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    <body>
        <center>
            <a href="index.php">Menu</a><br>
            <a href="freqselecprof.php">Voltar</a>
        </center>
        
    </body>
</html>