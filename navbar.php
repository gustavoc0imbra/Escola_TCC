<?php 

    $nome = $_SESSION['nome'];
    $tipo = $_SESSION['tipo'];
    $cod = $_SESSION['user'];
?>
<!-- navBar horizontal -->
                <?php
                   if ($tipo =="admin"){
                     ?>
                     <div class="navbar">
                      <div class="openbtn" id="openNav" onclick="openNav(this)"><p id="icon">&#9776; Menu</p></div>
                      <a class="config" href="user_edit.php">&#9881;</a>
                      <a class="aNavbar" href="acervo.php">Acervo Digital</a> 
                      <a class="aNavbar" href="#">Quem somos?</a>
                      <div class="dropdown">
                         <button class="dropbtn">Usuários  &#8744;</button>
                         <div class="dropdown-content">
                             <a href="user_view.php?tipoSelect=aluno">Alunos</a>
                             <a href="user_view.php?tipoSelect=responsavel">Responsaveis</a>
                             <a href="user_view.php?tipoSelect=professor">Professores</a>
                         </div>
                     </div>
                     <div class="dropdown">
                         <button class="dropbtn">Turmas  &#8744;</button>
                         <div class="dropdown-content">
                             <a href="#">Ver turmas</a>
                             <a href="#">Criar turma</a>
                         </div>
                     </div>
               </div>
                <!-- sidebar lateral admin -->
                <div id="mySidebar" class="sidebar">
                    <img class="imgPerfil" src="">
                  <a class="aSidebar"><p align="center">Bem vindo!</p> <?php echo"<center>$nome</center>" ?></a>
                     <a class="mudarSenha" href="user_edit.php">Mudar senha</a>
                     <a class="sair" href="login.php">Deseja Sair?</a>
                     
                     
                     <form class="formLogout" action='login.php' method='post'>
                   
                  </form>
                </div>
                     <?php
                   }elseif($tipo == "aluno"){
                     ?>
                     <div class="navbar">
                      <div class="openbtn" id="openNav" onclick="openNav(this)"><p id="icon">&#9776; Menu</p></div>
                      <a class="config" href="user_edit.php">&#9881;</a>
                      <a class="aNavbar" href="horarioAluno.php">Horários</a>
                      <a class="aNavbar" href="notas.php">Notas</a>
                      <a class="aNavbar" href="verfreq.php">Frequências</a>
                      <a class="aNavbar" href="acervo.php">Acervo</a>
                     </div>
               </div>
                <!-- sidebar lateral aluno -->
                <div id="mySidebar" class="sidebar" stlye="height: 30px">
                    <img class="imgPerfil" src="Imagens/gustavo.jpg">
                  <a class="aSidebar"><p align="center">Bem vindo!</p> <?php echo"<center>$nome</center>" ?></a>
                     <form class="formLogout" action='login.php' method='post'>
                     <a class="sair" href="login.php">Deseja Sair?</a>
                  </form>
                </div>
                     <?php
                   }elseif($tipo == "professor"){
                    ?>
                    <div class="navbar">
                     <div class="openbtn" id="openNav" onclick="openNav(this)"><p id="icon">&#9776; Menu</p></div>
                     <!--<a class="aNavbar" href="">Acervo Digital</a>-->
                     <a class="aNavbar" href=""> Tabela de Horários</a>
                     <a class="aNavbar" href=""> Enviar Notas</a>
                     <a class="aNavbar" href="freqselecprof.php">Enviar Frequências</a>
                    </div>
              </div>
               
               <!-- sidebar lateral prof -->
               <div id="mySidebar" class="sidebar">
               <img class="imgPerfil" src="">
                 <a class="aSidebar"><p align="center">Bem vindo!</p> <?php echo"<center>$nome</center>" ?></a>
                    <form class="formLogout" action='login.php' method='post'>
                    <a class="sair" href="login.php">Deseja Sair?</a>
                 </form>
               </div>
               <?php }
                ?>

            <script>
            
              window.onload = function() { document.getElementById("openNav").click(); };
                
              function openNav(botao){
                document.getElementById("mySidebar").style.width = "250px";
                document.getElementById("main").style.marginLeft = "250px";
                botao.setAttribute("onclick","fecharNav(this);");
                document.getElementById("icon").innerHTML = "&#9932; Menu ";
              }

              function fecharNav(botao){
                document.getElementById("mySidebar").style.width = "0";
                document.getElementById("main").style.marginLeft = "0";
                botao.setAttribute("onclick","openNav(this);");
                document.getElementById("icon").innerHTML = "&#9776; Menu";
              }
               
                
            </script>
            <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="Estilo/estilo.css">
            <style>
            .mudarSenha{
              position: relative;
              top: -160px;
              padding: 20px;
              font-size: 20px;
              width: 35%;
              left: -30px;
              color: white;
              text-decoration: none;
              }

              



              .sair{
                background-color: gray;
                padding: 10px;
                top:-120px;
                font-size: 20px;
                text-decoration: none;
                color: white;
                position: relative;
                display: inline-block;
              }

              .sair:hover{
                box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 1);

              }

        

 

              
            

    </style>
    </head>
       

<?php


