<DOCYTIPE html>
    <head>
       <meta charset="UTF-8">
        <meta description="...">
        <link rel="stylesheet" href="#">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

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

            body{
              margin: 8px;
            }
        </style>
     </head>
     <body>
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
            $nomeDisciplina = $_GET['nomeDisciplina']?? null;
            $delete = $_GET['delete']?? null;

            //Deletar disciplinas
          if($delete == "true"){
            ?> 
            <script>window.location.href = "disciplina.php?delete=true"</script>
            <?php
          }else{

            if(!isset($_POST['nomeDisciplina'])){
              require_once "edit_form_disciplina.php";
            }else{
                $nomeDisciplina = $_POST['nomeDisciplina'];
                $codDisciplina = $_POST['codDisciplina'];
                $add = $_POST['add']?? null;
                
                $c = 0;

                // alterando nome da disciplina

                $q = "UPDATE disciplina SET nomeDisciplina = '$nomeDisciplina' WHERE codDisciplina = '$codDisciplina'";
                if($banco->query($q)){

                  
                  if($add != null){

                    $qntAdd = count($add)?? null;

                    // Alterando professores para a disciplina
                    while($c < $qntAdd){

                      $professorAdd = $add[$c];

                      $q = "UPDATE professor SET codDisciplina = $codDisciplina WHERE codProf = $professorAdd";

                      if($banco->query($q)){
                        ?>
                        <script>window.location.href='disciplina.php?alt=true'</script>
                      <?php
                      }else{
                        echo "Algo deu errado ao adicionar professores, tente novamente mais tarde!";
                      }
                      
                      $c++;

                    }
                  }else{
                    ?>
                      <script>window.location.href='disciplina.php?Alt=true'</script>
                    <?php
                  }
                  
                }else{
                  echo "Algo deu errado ao mudar nome da disciplina por favor tente novamente mais tarde!";
                }

              
            }

          } 

        }else{
            echo "Somente administradores tem acesso a essa página";

        }
        ?>
      </body>