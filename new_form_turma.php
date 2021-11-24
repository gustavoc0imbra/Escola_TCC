<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php 
include_once("includes/config.php");
include_once("includes/functions.php");
?>
<?php
    
    if($_SESSION['tipo'] == "admin"){

        $invalidDia = $_GET['invalidDia']?? null;
        $invalidTime = $_GET['invalidTime']?? null;

        echo "<h1>Criar Turma</h1>";
        ?>
        <form align="center" action='new_form2_turma.php' method='post' >
            Turma:<br><input class="form-label" type='text' required name='nomeTurma' maxlength="30" id='nomeTurma' placeholder='Exemplo Turma A' ><Br><Br>

            <?php 
            // código da turma
            $q = "SELECT MAX(codTurma) AS maxCodTurma FROM turmas ORDER BY codTurma ASC";
            if($banco->query($q)){

                $busca = $banco->query($q);
                $reg = $busca->fetch_object();
                $codTurmaBD = $reg->maxCodTurma?? null;

                if($codTurmaBD == null){
                    $codTurmaBD = "A";
                }else{
                    $codTurmaBD = ++$codTurmaBD;
                }
                

            }else{
                echo "Algo deu errado na busca do código, tente novamente mais tarde!";
            }
            ?>
            Código da turma:<br><input readonly type='text' name='codTurma' id='codTurma' size='1' value='<?php echo $codTurmaBD ?>' ><br><Br>
            
            <?php
            if($invalidDia == "true"){
                echo "<a style='color: red; font-weight: bold'>Você precisa selecionar algum dia antes de prosseguir</a><br><br>";
             }
            ?>
            
            Escolha os dias da semana que terá aula:
            <br><input type="checkbox" name="dias[]" id="dias" value="dom" > Domingo
            <br><input type="checkbox" name="dias[]" value="seg"checked> Segunda-Feira
            <br><input type="checkbox" name="dias[]" value="ter" checked> Terça-Feira
            <br><input type="checkbox" name="dias[]" value="quar"checked> Quarta-Feira
            <br><input type="checkbox" name="dias[]" value="quin"checked> Quinta-Feira
            <br><input type="checkbox" name="dias[]" value="sex" checked> Sexta-Feira
            <br><input type="checkbox" name="dias[]" value="sab"> Sábado
            <br><br>
            
            Quantidade de aulas por dia:<br><input type='number' name='qntAula' id='qntAula' min='1' max='10' value='5'><br><br>
            Inicio das Aulas:<br>
            <select id='horas' name='horas'>
                <?php 
                for($h = 0; $h < 24; $h++){
                    if($h < 10){
                        $a = "0$h";
                    }else{
                        $a = "$h";
                    }
                    if($a == "07"){
                        echo "<option selected value='$h'>$a h</option>";
                    }
                    echo "<option value='$h'>$a h</option>";
                }
                ?>
            </select> : <select id='min' name='min'>
            <?php 
                for($m = 0; $m < 60; $m++){
                    if($m < 10){
                        $a = "0$m";
                    }else{
                        $a = "$m";
                    }
                    if($a == "20"){
                        echo "<option selected value='$m'>$a min</option>";
                    }
                    echo "<option value='$m'>$a min</option>";
                }
                ?>
            </select> (Horas:minutos)
            <br><br>
            
            <?php 
            
             if($invalidTime == "true"){
                echo "<a style='color: red; font-weight: bold'>horário inválido, tente novamente</a><br><br>";
             }

            ?>
            
            Tempo por aula:<br>
            <select id='horaAula' name='horaAula'>
                <option value='00'>0hrs</option>
                <option value='1'>1hrs</option>
                <option value='2'>2hrs</option>
                <option value='3'>3hrs</option>
                <option value='4'>4hrs</option>
                <option value='5'>5hrs</option>
            </select>
            <select id='minAula' name='minAula'>
                <option value='00'>00min</option>
                <option value='15'>15min</option>
                <option value='20'>20min</option>
                <option value='30'>30min</option>
                <option value='45'>45min</option>
                <option selected  value='50'>50min</option>
            </select><br><br>

             Intervalo<br>
             <select id='intervalo' name='intervalo'>
                <option selected value='00'>Sem intervalo</option>
                <option value='10'>10min</option>
                <option value='15'>15min</option>
                <option value='20'>20min</option>
                <option value='25'>25min</option>
                <option value='30'>30min</option>
                <option value='35'>35min</option>
                <option value='40'>40min</option>
                <option value='45'>45min</option>
                <option value='50'>50min</option>
                <option value='55'>55min</option>
                <option value='60'>1hr</option>
            </select><br><br>

             <button type='submit'> Próximo &#8631;</button>
        </form>
        <a href='view_turma.php'>Ver turmas ||</a>
        <a href='index.php'>Menu</a>
        <?php
    }else{
        echo "Somente administradores tem acesso a essa página!";
    }
?>

