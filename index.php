<DOCYTIPE html>
<html>
        <head>
         <meta charset="UTF-8">
         <meta description="...">
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
              
                    
                    <br>
                    <div id="corpoCardAdmin1">
                             <h1><p>Veja as turmas!</p></h1>
                             <a href="view_turma.php">
                        
                                 <button class="butao">Turmas</button>
                                </a>
                             
                       </div>

                       <div id="corpoCardAdmin2">
                             <h1><p>Criei a turma!</p></h1>
                             <a href="new_turma.php">
                        
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

                    
                            <a href="user_view.php?tipoSelect=professor">
                            <button class="b5" style="font-size: 20px"> Professores </button>
                          


                          <div id="corpoCardAdmin6">
                            <a href="acervo.php">

                            <button class="b6" style="font-size: 9px"> <h1>Acervo digital</h1> </button>
                          </div>



                </div>

             </div>
                <?php
                }elseif($_SESSION['tipo'] == "aluno"){
                    ?>
                    <div id="main">
                    <h1> Logado com sucesso aluno!</h1>
                       <div id="corpoAluno1">
                             <h1><p>Veja seus horários de aulas!</p></h1>
                             <a href="horarioAluno.php">
                        
                                 <button class="botaozinho">Horário</button>
                      
                                </a>
                        
                       </div>
                    <p id="rodape">Desenvolvido por ...</p> 
                    
                  </div>
                    <?php
                }elseif($_SESSION['tipo'] == "professor"){
                    ?>
                    <div id="main">
                    <h1> Logado com sucesso Professor<br><?php echo $nome; ?>!</h1>
                    <div id="corpoProf1">
                             <h1><p>Envie Frequências!</p></h1>
                             <a href="freqselecprof.php">
                                 <button class="p1">enviar</button>
                                </a>
                    </div>            

                    <div id="corpoProf2">
                             <h1><p>Envie Notas!</p></h1>
                             <a href=".php">
                                 <button class="p2">enviar</button>
                                </a>
                   
                   
                    </div>

                    <div id="corpoProf3">
                             <h1><p>Tabela de horários!</p></h1>
                             <a href=".php">
                                 <button class="p3">Veja</button>
                                </a>
                   
                   
                    </div>
                
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
        left: 30%;
        height:26%;
        width: 35%;
        transform: translate(-50%, 150%);
        position: relative;
        background-color: #76D7C4;
        border-radius: 25px;
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.4);
        
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
        left: 30%;
        height:26%;
        width: 35%;
        transform: translate(-50%, -70%);
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
        top: 50%;
        left: 75%;
        height:26%;
        width: 35%;
        transform: translate(-50%, -170.8%);
        position: relative;
        background-color: aquamarine;
        border-radius: 25px;
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.4);
        z-index: -10px;
        
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
        top: 50%;
        left: 75%;
        height:26%;
        width: 35%;
        transform: translate(-50%, -150%);
        position: relative;
        background-color: aquamarine;
        border-radius: 25px;
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.4);
        z-index: -10px;
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

    

    .b5{
        
        width: 15%;
        height: 10%;
        font-size
        left: 100%;
        top: -790px;
        transform: translate(530%, 60%);
        border-radius: 5%;
        background-color: #212132;
        color: white;
        border: none;
        position: relative;
    }

    .b5:hover{
        cursor:pointer;
        background-color:#63636F;
        border: none;
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
    }

  
    .b6{
        
        
        width: 15%;
        height: 10%;
        left: 60%;
        top: -790px;
        transform: translate(130%, -150%);
        border-radius: 5%;
        background-color: #212132;
        color: white;
        border: none;
        position: relative;
    }

    .b6:hover{
        cursor:pointer;
        background-color:#63636F;
        border: none;
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
    }


    #corpoProf1{
        text-align: center;
        padding: 5px;
        top: 50%;
        left: 30%;
        height:26%;
        width: 35%;
        transform: translate(-70%, 40%);
        position: relative;
        background-color: #76D7C4;
        border-radius: 25px;
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.4);
    

    }

    .p1{
        padding: 13px;
        border-radius: 20px;
        top: -20px;
        background-color: #3498DB;
        position: relative;
        color: white;
        font-size: 40px;
        border: none;

    }

    .p1:hover{
        cursor:pointer;
        background-color:blue;
        border: none;
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.7);
    }


    #corpoProf2{
        text-align: center;
        padding: 5px;
        top: 50%;
        left: 30%;
        height:26%;
        width: 35%;
        transform: translate(80%, -61%);
        position: relative;
        background-color: #76D7C4;
        border-radius: 25px;
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.4);

    }

    .p2{
        padding: 13px;
        border-radius: 20px;
        top: -20px;
        background-color: #3498DB;
        position: relative;
        color: white;
        font-size: 40px;
        border: none;

    }

    .p2:hover{
        cursor:pointer;
        background-color:blue;
        border: none;
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.7);
    }


    #corpoProf3{
        text-align: center;
        padding: 5px;
        top: 50%;
        left: 30%;
        height:26%;
        width: 35%;
        transform: translate(7%, -45%);
        position: relative;
        background-color: #76D7C4;
        border-radius: 25px;
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.4);

    }

    .p3{
        padding: 13px;
        border-radius: 20px;
        top: -20px;
        background-color: #3498DB;
        position: relative;
        color: white;
        font-size: 35px;
        border: none;

    }

    .p3:hover{
        cursor:pointer;
        background-color:blue;
        border: none;
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.7);
    }

    
    


    
  


</style>