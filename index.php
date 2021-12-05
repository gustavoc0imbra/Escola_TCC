<DOCYTIPE html>
<html>
        <head>
         <meta charset="UTF-8">
         <meta description="...">
         <link rel="stylesheet" href="Estilo/estilo.css">
        
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
         <meta name="viewport" content="width=device-width, initial-scale=1">
         
         <title>Bem vindo(a)!</title>
        </head>
        <body>
            <header class='titulo'>Sistema de gerenciamento escolar (SGC)</header>
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
                
                if(($_SESSION['tipo'] == "admin") || ($_SESSION['tipo'] == "professor")){
                    
                     $nome = $_SESSION['nome'];
                     $cod = $_SESSION['user'];
                     ?> 
                   <Br><Br>
                 
                <center>
                <div class='border-gradient'>
                    <div class="card" style="width: 18rem;">
                       <img src="Imagens\mesa.jpg" height='284px' class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Turmas</h5>
                            <p class="card-text">Veja, Altere, edite ou exclue uma turma</p>
                            <a class='linkTurmas' href='view_turma.php'>Ver turmas</a>
                            <bsckp>
                            <?php 
                                if($tipo != "professor"){
                                 echo "<a class='linkTurmas' href='new_turma.php'>Criar turmas</a>";
                                }                                
    
                            ?>
                           
                        </div>
                    </div>
                </div>
                </center>
                <center>
                <div class='border-gradient2'>
                       
                       <div class="card" style="width: 18rem;">
                       
                           <img src="Imagens\wow-users-thumn.jpg" height='284px' class="card-img-top" alt="USERS">
                           <div class="card-body">
                               <h5 class="card-title">Usuarios</h5>
                               <p class="card-text">Veja, altere, delete os usuários desse sistema</p>
                          
                                   <a class='linkUsers' href='user_view.php?tipoSelect=aluno'>Alunos</a>
                                   <?php 
                                    if($tipo == "admin"){
                                        echo " <a class='linkUsers' href='user_view.php?tipoSelect=professores'>Professores</a>
                                        <a class='linkUsers' href='user_view.php?tipoSelect=responsavel'>Responsaveis</a>";
                                    }
                                   ?>
                           </div>
                        </div>
                </div>
                </center>
                <center>
                <div class='border-gradient3'>
                       
                       <div class="card" style="width: 18rem;">
                       
                           <img src="Imagens\caderno.png" height='284px' class="card-img-top" alt="Disciplinas">
                           <div class="card-body">
                               <h5 class="card-title">Disciplinas</h5>
                               <p class="card-text">Veja, altere ou delete as disciplinas do sistema</p>
                                    <?php 
                                        if($tipo == "professor"){
                                            echo "<a class='linkDisciplinas' href='#'>Ver disciplinas</a><a class='linkDisciplinas' href='#'>Nova disciplina</a>";
                                        }else{
                                            echo " <a class='linkDisciplinas' href='disciplina.php'>Ver disciplinas</a>
                                   <a class='linkDisciplinas' href='new_disciplina.php'>Nova disciplina</a>";
                                        }
                                    ?>
                                  
                           </div>
                        </div>
                </div>
                </center>
                <center>
                <div class='border-gradient4'>
                       
                       <div class="card" style="width: 18rem;">
                       
                           <img src="Imagens\acervo.png" height='284px' class="card-img-top" alt="Acervo">
                           <div class="card-body">
                               <h5 class="card-title">Acervo</h5>
                               <p class="card-text">Veja o acervou ou Adicione conteúdos ao acervo</p>
                          
                                   <a class='linkAcervo' href='arqProfMostrar.php'>Ver Acervo</a>
                                   <a class='linkAcervo' href='acervo.php'>Novo conteúdo</a>
                           </div>
                        </div>
                </div>
                </center>
               
                <?php
                }elseif(($_SESSION['tipo'] == "aluno") || ($_SESSION['tipo'] == "responsavel")){
                    ?>
                    
                    <div class='teste' style="padding-top: 3%">
                    <center>
                    <div class='border-gradient '>
                        <div class="card" style="width: 18rem; ">
                        <img src="Imagens\mesa.jpg" height='284px' class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Horário</h5>
                                <p class="card-text">Veja seu horário de aula de acordo com sua turma</p>
                                <a class='linkTurmas' href='view_horario.php'>Ver horário</a>
                            </div>
                        </div>
                    </div>
                    </center>
                    <center>
                    <div class='border-gradient2'>
                        
                        <div class="card" style="width: 18rem;">
                        
                            <img src="Imagens\wow-users-thumn.jpg" height='284px' class="card-img-top" alt="USERS">
                            <div class="card-body">
                                <h5 class="card-title">Frequência</h5>
                                <p class="card-text">Veja sua frequência de acordo com sua turma e suas faltas</p>
                            
                                    <a class='linkUsers' href='user_frequencia.php'>Ver frequência</a>
                    
                            </div>
                            </div>
                    </div>
                    </center>
                    <center>
                    <div class='border-gradient3'>
                        
                        <div class="card" style="width: 18rem;">
                        
                            <img src="Imagens\caderno.png" height='284px' class="card-img-top" alt="Disciplinas">
                            <div class="card-body">
                                <h5 class="card-title">Notas</h5>
                                <p class="card-text">Veja suas notas em cada disciplina e sua situação</p>
                            
                                    <a class='linkDisciplinas' href='user_nota.php'>Ver Notas</a>
                            </div>
                            </div>
                    </div>
                    </center>
                    <center>
                    <div class='border-gradient4'>
                        
                        <div class="card" style="width: 18rem;">
                        
                            <img src="Imagens\acervo.png" height='284px' class="card-img-top" alt="Acervo">
                            <div class="card-body">
                                <h5 class="card-title">Acervo</h5>
                                <p class="card-text">Veja o acervo de acordo com sua turma</p>
                            
                                    <a class='linkAcervo' href='arqProfMostrar.php'>Ver Acervo</a>
                                    
                            </div>
                            </div>
                    </div>
                    </center>
                </div>
                <?php
                }
            ?>
            <?php }    ?>
        <a class='edit' href='user_edit.php'>  Quem somos? <button type="button" class="btn btn-outline-dark">Configurações de usuário</button></a>
        </body>
</html>
