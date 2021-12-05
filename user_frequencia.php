<docytipe html>
<head>
<meta charset="UTF-8">
        <meta description="...">
        <link rel="stylesheet" href="#">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            h1{
                margin-left: 10px;
            }
            .volt{
                margin-left: 10px;
            }
                  .ondas{
                 margin-top: 5.6%;
                 position: relative;
            }

            .sgc{
                
                color: white;
                position: absolute;
                bottom: 8px;
                left: 16px;
                font-size: 26px;
            }
            body{
                overflow: hidden;
            }
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
    
            $tipo = $_SESSION['tipo'];

            if($tipo == 'aluno'){

                $cod = $_SESSION['user']?? null;
                $nome = $_SESSION['nome']?? null;
                
                $q = "SELECT turma FROM estudante where codAluno = $cod";
                        
                $banco->query($q);
                $busca = $banco->query($q);
                $reg = $busca->fetch_object();
                $turma = $reg->turma?? null;

                if($turma == null){
                    echo "Voce não tem turma, tente novamente mais tarde!";
                }else{
                    $q = "SELECT codTurma FROM turmas where cod = $turma";
                    $busca = $banco->query($q);
                    $reg = $busca->fetch_object();
                    $turma = $reg->codTurma?? null;
                }

            }else{
                $cod = $_GET['cod'];
                $nome = $_GET['nome']?? null;
                $turma = $_GET['turma']?? null;
            }
        
           
        ?>
        <br>
        <center><h2>Frequência do aluno: <?php echo " $nome"?></h2></center>
        <table class="table table-striped table-bordered"> 
                            <tr>
                                 <thead class="table table-dark">
                <th>Disciplina</th>
                <th>Aulas Assitidas</th>
                <th>Faltas</th>
                <th>Total de aulas</th>
                <th>Frequência</th>
                <th>Situação</th>
        </thead>
            </tr>
            <tr>
                <?php 
                    $q = "SELECT min(cod) AS menorCod, MAX(cod) AS maiorCod FROM disciplinasturma$turma";
                    $banco->query($q);
                    $busca = $banco->query($q);
                    $reg = $busca->fetch_object();
                    $menorCod = $reg->menorCod;
                    $maiorCod = $reg->maiorCod;

                    while($menorCod <= $maiorCod){
                        $q = "SELECT disciplinas FROM disciplinasturma$turma WHERE cod = $menorCod";
                        $banco->query($q);
                        $busca = $banco->query($q);
                        $reg = $busca->fetch_object();

                        $q1 = "SELECT nomeDisciplina FROM disciplina WHERE codDisciplina = $reg->disciplinas";
                        $banco->query($q1);
                        $busca1 = $banco->query($q1);
                        $reg1 = $busca1->fetch_object();

                        echo "<td>$reg1->nomeDisciplina</td>";

                        $q2 = "SELECT aulas, faltas FROM frequencia WHERE aluno = '$cod' AND disciplina = '$reg->disciplinas'; ";
                        $banco->query($q2);
                        $busca2= $banco->query($q2);
                        $reg2 = $busca2->fetch_object();
                        $aulas = $reg2->aulas?? null;
                        $faltas = $reg2->faltas?? null;
                        $totalAulas = $faltas + $aulas;
                        $freq = null;
                        

                        // formatando frequencia 
                        if($totalAulas == '0'){
                            $totalAulas = null;
                        }else{
                            $freq = ($aulas / $totalAulas) * 100;
                            $freq = (int) $freq; 
                        }

                        if($aulas != null){
                            if($faltas == null){
                               
                                $faltas = '0';
                            }
                        }

                        if($faltas != null){
                            if($aulas == null){
                               
                                $aulas = '0';
                            }
                        }

                       
                        

                        echo "<td>$aulas</td>";
                        echo "<td>$faltas</td>";
                        echo "<td>$totalAulas</td>";

                        if($freq != null){
                            if($freq >= '75'){
                                echo "<td style='color:green'>$freq%</td>";
                            }else{
                                echo "<td style='color:red'>$freq%</td>";
                            }
                        }else{
                            echo "<td>Null%</td>";
                        }
                        
                        echo "<td>Cursando</td></tr>";

                        $menorCod++;
                    }
                echo "</table><Br><Br>";
                echo "<a href='index.php'><center><button type='button' class='btn btn-primary volt'>Voltar</button></center></a>";
                ?>
         <div class='ondas'>
               <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
               <path fill="#a6a6a6" fill-opacity="1" d="M0,224L48,202.7C96,181,192,139,288,138.7C384,139,480,181,576,181.3C672,181,768,139,864,117.3C960,96,1056,96,1152,106.7C1248,117,1344,139,1392,149.3L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
                    <path fill="#8c8c8c" fill-opacity="1" d="M0,224L24,192C48,160,96,96,144,90.7C192,85,240,139,288,170.7C336,203,384,213,432,197.3C480,181,528,139,576,144C624,149,672,203,720,197.3C768,192,816,128,864,112C912,96,960,128,1008,160C1056,192,1104,224,1152,197.3C1200,171,1248,85,1296,64C1344,43,1392,85,1416,106.7L1440,128L1440,320L1416,320C1392,320,1344,320,1296,320C1248,320,1200,320,1152,320C1104,320,1056,320,1008,320C960,320,912,320,864,320C816,320,768,320,720,320C672,320,624,320,576,320C528,320,480,320,432,320C384,320,336,320,288,320C240,320,192,320,144,320C96,320,48,320,24,320L0,320Z"></path>
                    <path fill="#273036" fill-opacity="1" d="M0,64L34.3,85.3C68.6,107,137,149,206,176C274.3,203,343,213,411,186.7C480,160,549,96,617,90.7C685.7,85,754,139,823,160C891.4,181,960,171,1029,181.3C1097.1,192,1166,224,1234,218.7C1302.9,213,1371,171,1406,149.3L1440,128L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path>
               </svg>
               <h1 class='sgc'>Frequência</h1>
          </div>
    </body>
</html>