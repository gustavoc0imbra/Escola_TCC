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
    <form action='edit_disciplina.php' method='post'>
        Nome Disciplina:<br><input type='text' name='nomeDisciplina' value='<?php echo $nomeDisciplina?>'><br><br>
        Código:<br><input type='text' name='codDisciplina' id='codDisciplina' readonly value='<?php echo $disciplina?>'><br><br>

        <!-- professores -->
        <h2>Alterar professores para a disciplina</h2>
        <table>
        <tr>
            <th>Nome</th>
            <th>Disciplina Atual</th>
            <th>Alterar para essa disciplina</th>
        </tr>
        <tr>
        <?php 
        $q = "SELECT MIN(codProf) AS menorCodProf, MAX(codProf) AS maiorCodProf FROM professor";
               
        if($banco->query($q)){
            $busca = $banco->query($q);
            $reg = $busca->fetch_object();
            $menorCodProf = $reg->menorCodProf?? null;
            $maiorCodProf = $reg->maiorCodProf?? null;

            while($menorCodProf <= $maiorCodProf){
                $q = "SELECT nomeProf, codDisciplina, codProf FROM professor WHERE codProf = $menorCodProf";

                if($banco->query($q)){
                    $busca = $banco->query($q);
                    $reg = $busca->fetch_object();
                    $codProf = $reg->codProf?? null;

                    if($codProf == null){
                        $menorCodProf++;
                    }else{
                        echo "<td>$reg->nomeProf</td>";
                        $q1 = "SELECT nomeDisciplina FROM disciplina WHERE codDisciplina = $reg->codDisciplina";
                        $busca1 = $banco->query($q1);
                        $reg1 = $busca1->fetch_object();
                        echo "<td>$reg1->nomeDisciplina</td><td><div class='form-check form-switch'>
                        <input class='form-check-input' type='checkbox'  name='add[]' id='add[]' value='$reg->codProf'>
                        </div></td>
                        </tr>";
                    }

                }else{
                    echo "Algo deu errado na busca dos professores!";
                }
                $menorCodProf++;
            }
        }else{
            echo "Algo deu errado na busca dos professores, tente novamente mais tarde!";
        }
        ?>
        </table><Br>
        <a href='disciplina.php'>  <button  type='button' class='btn btn-primary'>Voltar</button></a>
        <button type="submit" value="Enviar" type="button" class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-seam" viewBox="0 0 16 16">
        <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"/>
        </svg> Alterar Disciplina</button>
       
        
    </form>