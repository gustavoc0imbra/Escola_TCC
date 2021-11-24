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
        include_once "includes/config.php";
        include_once "includes/functions.php";
        $tipo = $_SESSION['tipo'];
     ?>
     <body>
         <h1>Editar disciplina</h1>
     <?php 
        if($tipo == "admin"){
            
            $disciplina = $_GET['disciplina']?? null;
            $delete = $_GET['delete']?? null;

            //Deletar disciplinas
            if($delete == "true"){
                ?> 
                <script>window.location.href = "disciplina.php?delete=true"</script>
                <?php
            }


        }else{
            echo "Somente administradores tem acesso a essa página";
        }