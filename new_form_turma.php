<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php 
include_once("includes/config.php");
include_once("includes/functions.php");
?>
<style>
    body{
                background: radial-gradient(circle, rgba(0,212,255,1) 0%, rgba(0,212,255,1) 35%, rgba(0,153,255,1) 100%);;
        
        }

    .box{
        margin-top: 20px;
        margin-right: 110px;
        margin-left: 110px;
        background-color: ghostwhite;
     
    }
    .box2{
                
            background-color: ghostwhite;
            margin-left: 80px;
                
    }   
    .titulo{
                background: radial-gradient(circle, rgba(0,212,255,1) 0%, rgba(0,212,255,1) 35%, rgba(0,153,255,1) 100%);;
                color: white;
                padding: 4px;
    }
    .caixa_texto{
                padding-left: 10px;
                padding: 8px;
                border: 0px solid aliceblue;
                border-bottom: 1px solid black;
                background-color: ghostwhite;
                margin-bottom: 18px;
                margin-right: 10px;
            }
    .prox{
        float: right;
        margin-right: 10px;
    }

    .volt{
        margin-right: 10px;
        float: left;
    }

    .letras{
        text-decoration: none;
        color: black;
        padding-bottom: 9px;
        border-bottom: 1px solid black;
    }

    .rodape{
        background-color: ghostwhite;
        padding-bottom: 80px;
    }
</style>
<?php
    
    if($_SESSION['tipo'] == "admin"){

        $invalidDia = $_GET['invalidDia']?? null;
        $invalidTime = $_GET['invalidTime']?? null;
        ?>
        <div class='box'>
        <h2 class='titulo'><center>Criar Turma</center></h2>
        <div class='box2'>
        
        <form action='new_form2_turma.php' method='post'>
            <br><input type='text' class='caixa_texto' required name='nomeTurma' maxlength="30" id='nomeTurma' size='50' placeholder='Nome da turma' >

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
            <a class='letras'>Código da turma:</a><input readonly type='text' class='caixa_texto' name='codTurma' id='codTurma' size='1' value='<?php echo $codTurmaBD ?>' ><br><Br>
            
            <?php
            if($invalidDia == "true"){
                echo "<a style='color: red; font-weight: bold'>Você precisa selecionar algum dia antes de prosseguir</a><br><br>";
             }
            ?>
            
            Escolha os dias da semana que terá aula:
            <div class="form-check">
            <br><input  class="form-check-input" type="checkbox" name="dias[]" id="dias" value="dom" > Domingo
            <br><input  class="form-check-input" type="checkbox" name="dias[]" value="seg"checked> Segunda-Feira
            <br><input  class="form-check-input" type="checkbox" name="dias[]" value="ter" checked> Terça-Feira
            <br><input  class="form-check-input" type="checkbox" name="dias[]" value="quar"checked> Quarta-Feira
            <br><input  class="form-check-input" type="checkbox" name="dias[]" value="quin"checked> Quinta-Feira
            <br><input  class="form-check-input" type="checkbox" name="dias[]" value="sex" checked> Sexta-Feira
            <br><input  class="form-check-input" type="checkbox" name="dias[]" value="sab"> Sábado
            <br><br>
            </div>
            
            Quantidade de aulas por dia:<br><input class='caixa_texto' type='number' name='qntAula' id='qntAula' min='1' max='10' value='5' ><br><br>
            Inicio das Aulas:<br>
            <select class='caixa_texto' id='horas' name='horas'>
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
            </select> : <select class='caixa_texto' id='min' name='min'>
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
            
            <?php 
            
             if($invalidTime == "true"){
                echo "<a style='color: red; font-weight: bold'>horário inválido, tente novamente</a><br><br>";
             }

            ?>
            
            <br>Tempo por aula:<br>
            <select class='caixa_texto' id='horaAula' name='horaAula'>
                <option value='00'>0hrs</option>
                <option value='1'>1hrs</option>
                <option value='2'>2hrs</option>
                <option value='3'>3hrs</option>
                <option value='4'>4hrs</option>
                <option value='5'>5hrs</option>
            </select>
            <select class='caixa_texto' id='minAula' name='minAula'>
                <option value='00'>00min</option>
                <option value='15'>15min</option>
                <option value='20'>20min</option>
                <option value='30'>30min</option>
                <option value='45'>45min</option>
                <option selected  value='50'>50min</option>
            </select>
            
        
        
             <Br>Intervalo<Br>
             <select class='caixa_texto' id='intervalo' name='intervalo'>
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
            </select>
            <div class='rodape'>
            <button type='submit' class='btn btn-primary prox'> Próximo &#8631;</button>
            <a href='view_turma.php'>
        <button id ="btn-2" class="btn btn-primary mb-3 volt">Ver Turmas</button>
        </a>
        <a href='index.php'>
        <button id ="btn-2" class="btn btn-primary mb-3 volt">Menu</button>
        </a>

            </div>
        </form>
            </div>
           
        <?php
    }else{
        echo "Somente administradores tem acesso a essa página!";
    }
?>

