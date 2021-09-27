<?php
        include_once ('includes/functions.php');
        require_once ('includes/config.php');
        
        $nome = $_SESSION['nome'];
        $cod = $_SESSION['cod'];
        $q = "SELECT imagemEstudante FROM estudante WHERE codAluno = $cod";
        $busca = $banco->query($q);
        $tipousuario = $_SESSION['tipo'];

        if ($tipousuario == 'aluno'){
            ?>
            <div id="navbarAl">
            <ul id="navbarAluno">
                <div id="conteudo-menu-1">
                 <li><input id="searchbar" type="text" placeholder="Procurar..."></li>
                 <li><a href="notas.php">Ver notas</a></li>
<<<<<<< HEAD

                


                 <li><a href="freqselecprof.php">Frequências</a></li>
>>>>>>> c54cf6388fe78d336e024901225c52df05daa710
                 <li><a href="">Acervo</a></li>
                 <li><a href="" >Avisos da escola</a></li>
                 <li id='userNav'><?php echo $nome.("<br> Bem vindo!");?></li>
                 <li><?php echo "<img id='userImage' src='$busca'>"; ?></li>
                 <li>
                     <i id="iconOut" class='bx bx-log-out'></i>
                     <form action='login.php' method='post'>
                     <input  type='submit' id='logoutBtn' value='Log out' name='logout' class="btn btn-outline-primary"> 
                    </form>
                </li>
                </div>
              </ul>
           </div>
           <div id="centroInfoAluno">
            <div id="content-boxes-1">
            <li id="verNotas"><a href="notas.php">Veja suas notas</a></li>
            </div>
            <div id="content-boxes-2">

<<<<<<< HEAD

   
            <li id="verFrequencia"><a href="freqselecprof.php">Veja sua frequência aqui</a></li>
>>>>>>> c54cf6388fe78d336e024901225c52df05daa710
            </div>
            <div id="content-boxes-3">
                <li id="avisos">
                    Avisos da escola
                     <p>Não Haverá aula nesta sexta-feira!!!!</p>
                     <p>Alterado o horário das aulas!!!!</p>
                     <p>Atualizações no sistema!!!!</p>
            </li>
            </div>
            <div id="content-boxes-4">
                  <li id="acervo"><a href="">Acesso ao acervo</a></li>
            </div>
        </div> <?php
        }elseif ($tipousuario == 'professor'){
            ?>
            <div id="navbarProf">
                <ul id="navbarProfessor">
                    <div id="conteudo-menu-2">
                     <li><input id="searchbar" type="text" placeholder="Procurar..."></li>
                     <li><a href="">Enviar Notas</a></li>
                     <li><a href="freqselecprof.php">Enivar Frequências</a></li>
                     <li><a href="">Acervo</a></li>
                     <li><?php echo $nome.("<br>Bem vindo(a) novamente!"); ?></li>
                     <li><img id="userImage" src="$busca"></li>
                     <li><i id="iconOut" class='bx bx-log-out'></i><form action='login.php' method='post'>
                      <input type='submit' id='logoutBtn' class="btn btn-outline-primary" value='Log out' name='logout'> 
                     </form>
                  </li>
                    </div>
                </ul>
            </div>
            <div id="centroInfoProfessor">
            <div id="content-boxes-1">
            <li id="verNotas"><a href="">Veja suas notas</a></li>
            </div>
            <div id="content-boxes-2">
            <li id="verFrequencia"><a href="freqselecprof.php">Veja sua frequência aqui</a></li>
            </div>
            <div id="content-boxes-3">
                <li id="avisos">
                    Avisos da escola
                     <p>Não Haverá aula nesta sexta-feira!!!!</p>
                     <p>Alterado o horário das aulas!!!!</p>
                     <p>Atualizações no sistema!!!!</p>
            </li>
            </div>
            <div id="content-boxes-4">
                  <li id="acervo"><a href="">Acesso ao acervo</a></li>
            </div>
            <?php
        }elseif($tipousuario == 'responsavel'){
            ?>
            <!--<div id="navbarResp">
                <ul id="navbarResponsavel">
                    <div id="conteudo-menu-1Resp">
                     <li><input id="searchbar" type="text" placeholder="Procurar..."></li>
                     <li><a href="notas.php">Ver notas</a></li>
                     <li><a href="">Frequências</a></li>
                     <li><a href="">Acervo</a></li>
                     <li><a href="" >Avisos da escola</a></li>
                     <li id='userNav'><//?php echo $nome.(" Bem vindo!")?></li>
                     <li><//?php echo "<img id='userImage' src='$busca'>"; ?></li>
                     <li>
                         <i id="iconOut" class='bx bx-log-out'></i>
                         <form action='login.php' method='post'>
                         <input  type='submit' id='logoutBtn' value='Log out' name='logout' class="btn btn-outline-primary"> 
                        </form>
                    </li>
                    </div>
                  </ul>
               </div> -->
               <?php
        }//elseif($tipousuario == 'admin'){

        //}
        ?>
<!DOCKTYPE HTML>
<html>
    <head>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="Estilo/main2.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <style>
     @import url('https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@200&display=swap');
    </style>
    <body>
             <!--<div id="navbarLateral">
              <div id="navbarAl">
                <ul id="navbarAluno">
                    <div id="conteudo-menu-1">
                     <li><input id="searchbar" type="text" placeholder="Procurar..."></li>
                     <li><a href="notas.php">Ver notas</a></li>
                     <li><a href="">Frequências</a></li>
                     <li><a href="">Acervo</a></li>
                     <li><a href="" >Avisos da escola</a></li>
                     <li id='userNav'><//?php echo $nome.(" Bem vindo!")?></li>
                     <li><//?php echo "<img id='userImage' src='$busca'>"; ?></li>
                     <li>
                         <i id="iconOut" class='bx bx-log-out'></i>
                         <form action='login.php' method='post'>
                         <input  type='submit' id='logoutBtn' value='Log out' name='logout' class="btn btn-outline-primary"> 
                        </form>
                    </li>
                    </div>
                  </ul>
               </div> -->
        
        </div>
        <h1 align="center"><//?php echo $nome.(' Bem vindo Novamente!'); ?></h1>
        
        <p id="rodape">Desenvolvido por...</p>
    </body>
</html>

<style></style>