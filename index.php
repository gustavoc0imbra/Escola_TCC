<DOCYTIPE html>
<html>
        <head>
         <meta charset="UTF-8">
         <meta description="...">
         <link rel="stylesheet" href="Estilo/estilo.css">
         <meta name="viewport" content="width=device-width, initial-scale=1">
         <title>Bem vindo(a)!</title>
         <style>
        
             
             </style>
        </head>
        <?php
             include_once "includes/config.php";
             include_once "includes/functions.php";
         ?>
        <body>
        <?php 
            if(empty($_SESSION['user'])){
                require_once "login.php";
            }else{
                
                require_once("navbar.php");
                
                if($_SESSION['tipo'] == "admin"){
                    
                     $nome = $_SESSION['nome'];
                     $cod = $_SESSION['user'];
                     ?> 
                     <div id="main">
                    <h1> Logado com sucesso admin!</h1>
                    <p id="rodape">Desenvolvido por ...</p>
                </div>
                <?php
                }elseif($_SESSION['tipo'] == "aluno"){
                    ?>
                    <div id="main">
                    <h1 style = "font-family:courier,arial,helvetica; font-size: 40px"> Logado com sucesso aluno!</h1>
                    <div id="card1Aluno">
                        <img src="Imagens/livro.jpg" style="width:35%">
                       <div id="corpoCard1Aluno">
                             <h1><p>Horário</p></h1>
                             <a href="horarioAluno.php">
                        
                                 <button class=botaozinho>Horário</button>
                      
                                </a>
                             <p><h1><b>Veja seus horários de aulas!<b></h1></p>
                             
                       </div>
                    <p id="rodape">Desenvolvido por ...</p> 
                    
                     </div>
                </div>
                    <?php
                }elseif($_SESSION['tipo'] == "professor"){
                    ?>
                    <div id="main">
                    <h1> Logado com sucesso Professor<br><?php echo $nome; ?>!</h1>
                    <p id="rodape">Desenvolvido por ...</p>
                </div>
                    <?php
                }elseif($_SESSION['tipo'] == "responsavel"){
                    ?>
                    <div id="main">
                    <h1> Logado com sucesso Responsável<br><?php echo $nome; ?>!</h1>
                    <p id="rodape">Desenvolvido por ...</p>
                </div>
                    <?php
                }
            ?>
            <?php }    ?>
        </body>
</html>
