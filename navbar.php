<?php 

    $nome = $_SESSION['nome'];
    $tipo = $_SESSION['tipo'];
    $cod = $_SESSION['user'];

    $buscaImagem = $banco->query("SELECT imagemEstudante FROM estudante WHERE codAluno = $cod");
    //$buscaImagemAdmin = 
    $banco->query("SELECT imagemAdmin FROM administrador WHERE codAdm = $cod");
?>
                <?php
                $hoje = date('d/m/Y');
                   if (($tipo =="admin") || ($tipo == "professor")){
                     ?>
                <!-- sidebar lateral admin -->
               
                <div id="mySidebar" class="sidebar ">
                      <?php  //while ($imagem = $buscaImagemAdmin->fetch_assoc()){?>
                    <img class="imgPerfil"  src='Imagens\a.jpg'>
                   <?php //} ?>
                 
                        <a class="aSidebar">
                 <center> Bem vindo! <?php echo" $nome" ?></center></a> 
                  <a class="aSidebar" href="user_edit.php"><center><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-file-person" viewBox="0 0 16 16">
                  <path d="M12 1a1 1 0 0 1 1 1v10.755S12 11 8 11s-5 1.755-5 1.755V2a1 1 0 0 1 1-1h8zM4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4z"/>
                  <path d="M8 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                </svg> Alterar dados</center></a>
                <a class="aSidebar">
                       <center><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-calendar-date-fill" viewBox="0 0 16 16">
                        <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zm5.402 9.746c.625 0 1.184-.484 1.184-1.18 0-.832-.527-1.23-1.16-1.23-.586 0-1.168.387-1.168 1.21 0 .817.543 1.2 1.144 1.2z"/>
                        <path d="M16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zm-6.664-1.21c-1.11 0-1.656-.767-1.703-1.407h.683c.043.37.387.82 1.051.82.844 0 1.301-.848 1.305-2.164h-.027c-.153.414-.637.79-1.383.79-.852 0-1.676-.61-1.676-1.77 0-1.137.871-1.809 1.797-1.809 1.172 0 1.953.734 1.953 2.668 0 1.805-.742 2.871-2 2.871zm-2.89-5.435v5.332H5.77V8.079h-.012c-.29.156-.883.52-1.258.777V8.16a12.6 12.6 0 0 1 1.313-.805h.632z"/>
                      </svg> <?php echo $hoje ?><Br></center></a>
                
                     <center><a class='logout' href="login.php"><button type="button" class="btn btn-light mt-4"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-door-open-fill" viewBox="0 0 16 16">
                      <path d="M1.5 15a.5.5 0 0 0 0 1h13a.5.5 0 0 0 0-1H13V2.5A1.5 1.5 0 0 0 11.5 1H11V.5a.5.5 0 0 0-.57-.495l-7 1A.5.5 0 0 0 3 1.5V15H1.5zM11 2h.5a.5.5 0 0 1 .5.5V15h-1V2zm-2.5 8c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z"/>
                    </svg>Deseja Sair?</button></center></a>
                  
                     <form class="formLogout" action='login.php' method='post'>
                  </form>
                </div>
                     <?php
                   }elseif(($tipo == "aluno") || ($tipo == "responsavel")){
                     ?>
                
               
                <!-- sidebar lateral aluno -->
                <div id="mySidebar" class="sidebar">
                  <?php

                  $imagem = $buscaImagem->fetch_assoc()?? null;

                  if($imagem == null){
                    echo "<img class='imgPerfil'  src='Imagens/a.jpg'>";
                  }else{
                    ?>
                    <img class="imgPerfil" src="<?php echo $imagem['imagemEstudante'];?>">

                    <?php
                  }
                  ?>
                   
                  
                   <a class="aSidebar">
                 <center> Bem vindo! <?php echo" $nome" ?></center></a> 
                  <a class="aSidebar" href="user_edit.php"><center><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-file-person" viewBox="0 0 16 16">
                  <path d="M12 1a1 1 0 0 1 1 1v10.755S12 11 8 11s-5 1.755-5 1.755V2a1 1 0 0 1 1-1h8zM4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4z"/>
                  <path d="M8 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                </svg> Alterar dados</center></a>
                <a class="aSidebar">
                       <center><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-calendar-date-fill" viewBox="0 0 16 16">
                        <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zm5.402 9.746c.625 0 1.184-.484 1.184-1.18 0-.832-.527-1.23-1.16-1.23-.586 0-1.168.387-1.168 1.21 0 .817.543 1.2 1.144 1.2z"/>
                        <path d="M16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zm-6.664-1.21c-1.11 0-1.656-.767-1.703-1.407h.683c.043.37.387.82 1.051.82.844 0 1.301-.848 1.305-2.164h-.027c-.153.414-.637.79-1.383.79-.852 0-1.676-.61-1.676-1.77 0-1.137.871-1.809 1.797-1.809 1.172 0 1.953.734 1.953 2.668 0 1.805-.742 2.871-2 2.871zm-2.89-5.435v5.332H5.77V8.079h-.012c-.29.156-.883.52-1.258.777V8.16a12.6 12.6 0 0 1 1.313-.805h.632z"/>
                      </svg> <?php echo $hoje ?><Br></center></a>
                
                     <center><a class='logout' href="login.php"><button type="button" class="btn btn-light mt-4"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-door-open-fill" viewBox="0 0 16 16">
                      <path d="M1.5 15a.5.5 0 0 0 0 1h13a.5.5 0 0 0 0-1H13V2.5A1.5 1.5 0 0 0 11.5 1H11V.5a.5.5 0 0 0-.57-.495l-7 1A.5.5 0 0 0 3 1.5V15H1.5zM11 2h.5a.5.5 0 0 1 .5.5V15h-1V2zm-2.5 8c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z"/>
                    </svg>Deseja Sair?</button></center></a>
                  </form>
                </div>
                     <?php
                   }
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
              top: -250px;
              background-color:;
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
                position: relative;
                top:-200px;
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


