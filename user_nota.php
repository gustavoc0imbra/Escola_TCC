<DOCYTIPE html>
    <head>
        <meta charset="UTF-8">
        <meta description="...">
        <link rel="stylesheet" href="#">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            table {
              font-family: arial, sans-serif;
              border-collapse: collapse;
              width: 100%;
            }

            td, th {
              border: 1px solid grey;
              text-align: left;
              padding: 5px;
            }

            tr:nth-child(even) {
              background-color: #dddddd;
            }
        </style>
    </head>
    <?php 
        require_once "includes/config.php";
        require_once "includes/functions.php";
    ?>
    <body>
        <?php
            if($_SESSION['tipo'] != null){
                
                if($_SESSION['tipo'] == "admin"){
                
                $cod = $_GET['cod'];
                $nome = $_GET['nome'];
                
                echo "<h2>Notas do aluno: $nome (Rm:$cod)</h2>";
                
                ?>
                <table>
                   <tr>
                       <th>Matérias</th>
                       <th>1 Bimestre</th>
                       <th>2º</th>
                       <th>3º</th>
                       <th>4º</th>
                       <th>Nota Final</th>
                       <th>Aulas</th>
                       <th>Faltas</th>
                       <th>Frequencia</th>
                   </tr> 
            
        
                <?php
                echo "<br><a href='user_view.php?tipoSelect=aluno'>Voltar</a>";
                
                }else{
                    echo "entrei como um aluno ou professor ou responsavel!";
                }
            }else{
                echo "Você precisa fazer o login para ter acesso a essa página!";
            }
            
        ?>
    </body>
</DOCYTIPE>