<?php 

    $nome = $_SESSION['nome'];
    $tipo = $_SESSION['tipo'];
    $cod = $_SESSION['user'];
?>
<!-- navBar horizontal -->
                <div class="navbar">
                      <div class="openbtn" id="openNav" onclick="openNav(this)"><p id="icon">&#9776; Menu</p></div>
                      <a class="config" href="user_edit.php">&#9881;</a>
                      <a class="aNavbar" href="#">Acervo Digital</a> 
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
                     <div class="dropdown">
                          <button class="dropbtn">Matérias  &#8744;</button>
                          <div class="dropdown-content">
                              <a href="disciplina.php">Ver Disciplinas</a>
                              <a href="disciplina.php?add=true">Criar disciplina</a>
                          </div>
                      </div>
                    <div class="pesquisa">
                      <form class="barraPesquisa" action="index.php">
                                <input type="text" class="buscar" placeholder="buscar" name="buscar" size="10" maxlength="40">
                                <input type="submit" class="button" value="OK">
                     </form>
                    </div>
               </div>
                
            
                <!-- sidebar lateral -->
                <div id="mySidebar" class="sidebar">
                    <img class="imgPerfil">
                  <a class="aSidebar">Bem vindo! <?php echo"$nome" ?></a>
                     <a class="mudarSenha" href="you_edit.php">Mudar senha</a>
                     <form class="formLogout" action='login.php' method='post'>
                    <input class="logout" type='submit' id='logout' value='Deseja Sair?' name='logout'> 
                  </form>
                </div>

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
<?php