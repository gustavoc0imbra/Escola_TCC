<DOCYTIPE html>
<html>
        <head>
         <meta charset="UTF-8">
         <meta description="...">
         <link rel="stylesheet" href="Estilo/estilo.css">
         <link rel="stylesheet" href="Estilo/main6.css">
         <meta name="viewport" content="width=device-width, initial-scale=1">
         
         <title>Bem vindo(a)!</title>
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
              
                    </div>
                    <p> Desenvolvido por ...</p>
                    <br>
                    <div id="corpoCardAdmin1">
                             <h1><p>Veja as turmas!</p></h1>
                             <a href="view_turma.php">

                                 <button class="butao">Turmas</button>
                                </a>
                       </div>

                       <div id="corpoCardAdmin2">
                             <h1><p>Criei sua turma!</p></h1>

                             <a href="new_form_turma.php">
                                 <button class="b2">Criar</button>
                                </a>
                       </div>

                       <div id="corpoCardAdmin3">
                             <h1><p>Veja os alunos</p></h1>
                             <a href="user_view.php?tipoSelect=aluno">
                        
                                 <button class="b3">Alunos</button>
                                </a>      
                       </div>

                       <div id="corpoCardAdmin4">
                             <h1><p>Veja os reponsáveis</p></h1>
                             <a href="user_view.php?tipoSelect=responsavel">
                        
                                 <button class="b4">Veja</button>
                                </a>
                       </div>

                       <div id="corpoCardAdmin5">
                            <h1><p>Veja os professores</p></h1>
                            <a href="user_view.php?tipoSelect=professores">

                            <button class="b5"> Profs </button>
                          </div>

                          <div id="corpoCardAdmin6">
                            <a href="acervo.php">
                            <button class="b6"> Acervo digital </button>
                          </div>
                </div>
                <?php
                }elseif($_SESSION['tipo'] == "aluno"){
                    ?>
                    <div id="main">
                    <h1> Logado com sucesso aluno!</h1>
                     </div>
                        <div id="corpoCardAluno1">
                                <h1><p>Veja suas notas!</p></h1>
                                <a href="user_nota.php">
                                    <button class="butao">Notas</button>
                                    </a>
                        </div>
                        <div id="corpoCardAluno2">
                             <h1><p>Veja seu Horário de aula</p></h1>
                             <a href="horarioAluno.php">
                                 <button class="b2">Horário</button>
                                </a>
                       </div>

                       <div id="corpoCardAluno3">
                             <h1><p>Veja suas frequências</p></h1>
                             <a href="user_freq.php">
                                 <button class="b3">Frequências</button>
                                </a>      
                       </div>

                       <div id="corpoCardAluno4">
                            <h1><p>Acervo digital</p></h1>
                            <a href="acervo.php">
                            <button class="b5"> Acessar </button>
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

<style>
#corpoCardAdmin1{
        text-align: center;
        padding: 5px;
        top: 50%;
        left: 35%;
        height:26%;
        width: 35%;
        transform: translate(-35%, -200%);
        position: relative;
        background-color: aquamarine;
        border-radius: 25px;
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.4);
        z-index: -10px;
        
    }

    .butao{
        padding: 13px;
        border-radius: 20px;
        top: -20px;
        background-color: #3498DB;
        position: relative;
        color: white;
        font-size: 40px;
        border: none;
    }

    .butao:hover{
        cursor:pointer;
        background-color:#85C1E9;
        border: none;
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.1);


    }

    #corpoCardAdmin2{
        text-align: center;
        padding: 5px;
        top: 50%;
        left: 40%;
        height:26%;
        width: 35%;
        transform: translate(-50%, -176%);
        position: relative;
        background-color: #76D7C4;
        border-radius: 25px;
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.4);
    }

    .b2{
        padding: 13px;
        top: -20px;
        position: relative;
        border-radius: 20px;
        background-color: #3498DB;
        color: white;
        font-size: 40px;
        border: none;
    }

    .b2:hover{
        cursor:pointer;
        background-color:#85C1E9;
        border: none;
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.1);
    }

   


    #corpoCardAdmin3
    {
        text-align: center;
        padding: 5px;
        left: 78%;
        height:26%;
        width: 35%;
        transform: translate(-44%, -218%);
        position: relative;
        background-color: #bfd4d8;
        border-radius: 25px;
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.4);
        z-index: -5px;
    }

    .b3{
        padding: 13px;
        top: -20px;
        position: relative;
        border-radius: 20px;
        background-color: #3498DB;
        color: white;
        font-size: 40px;
        border: none;
    }

    .b3:hover{
        cursor:pointer;
        background-color:#85C1E9;
        border: none;
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.1);
    }

    #corpoCardAdmin4
    {
        text-align: center;
        padding: 5px;
        left: 78%;
        height:26%;
        width: 35%;
        transform: translate(-44%, -196%);
        position: relative;
        background-color: #C393FA;
        border-radius: 25px;
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.4);
    }

    .b4{
        padding: 13px;
        top: -20px;
        position: relative;
        border-radius: 20px;
        background-color: #3498DB;
        color: white;
        font-size: 40px;
        border: none;
    }

    .b4:hover{
        cursor:pointer;
        background-color:#85C1E9;
        border: none;
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.1);
    }

    #corpoCardAdmin5
    {
        text-align: center;
        padding: 5px;
        left: 60%;
        height:26%;
        width: 35%;
        transform: translate(-44%, -170%);
        position: relative;
        background-color: #C0ECB1;
        border-radius: 25px;
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.4);
    }

    .b5{
        padding: 13px;
        top: -20px;
        position: relative;
        border-radius: 20px;
        background-color: #3498DB;
        color: white;
        font-size: 40px;
        border: none;
    }

    .b5:hover{
        cursor:pointer;
        background-color:#85C1E9;
        border: none;
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.1);
    }

  

    .b6{
        padding: 2px;
        width:15%;
        height: 10%;
        left: 60%;
        top: -955px;
        transform: translate(130%, -150%);
        border-radius: 20px;
        background-color: #212132;
        color: white;
        font-size: 32px;
        border: none;
        position: relative;
    }

    .b6:hover{
        cursor:pointer;
        background-color:#63636F;
        border: none;
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
    }

    body{
    font-family: Arial, Helvetica, sans-serif;
    }
    
    #corpoCardAluno1{
        text-align: center;
        padding: 5px;
        top: 50%;
        left: 35%;
        height:26%;
        width: 35%;
        transform: translate(-35%, -200%);
        position: relative;
        background-color: aquamarine;
        border-radius: 25px;
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.4);
        z-index: -10px;
    }

    #corpoCardAluno2{
        text-align: center;
        padding: 5px;
        top: 50%;
        left: 40%;
        height:26%;
        width: 35%;
        transform: translate(-50%, -176%);
        position: relative;
        background-color: #76D7C4;
        border-radius: 25px;
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.4);
    }

    #corpoCardAluno3{
        text-align: center;
        padding: 5px;
        left: 78%;
        height:26%;
        width: 35%;
        transform: translate(-44%, -218%);
        position: relative;
        background-color: #bfd4d8;
        border-radius: 25px;
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.4);
        z-index: -5px;
    }

    #corpoCardAluno4{
        text-align: center;
        padding: 5px;
        left: 78%;
        height:26%;
        width: 35%;
        transform: translate(-44%, -196%);
        position: relative;
        background-color: #C393FA;
        border-radius: 25px;
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.4);

    }

</style>