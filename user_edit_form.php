<docytipe !html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">   
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    </head>

<?php 




    if($tipo != "admin"){
        $a = 2;
        $c = $_SESSION['tipo'];
        $cod = $_SESSION['user'];
      
    }else{
        $a = 1;
    }

    if($c == null){
        $c = 'admin';
        $cod = $_SESSION['user'];
    }

    if($c == 'aluno'){
        
        $q="SELECT * FROM estudante WHERE codAluno = $cod";
        $busca=$banco->query($q);
        $reg=$busca->fetch_object();
        ?>
        
        <form id="forma" action="user_edit.php?c=aluno&cod=<?php echo $reg->codAluno?>" method="post">
            
            Nome:<br><input type="text" name="nome" value="<?php echo $reg->nomeAluno ?>"><br><br>
            RM:<br><input type="number" readonly name="usuario" value="<?php echo $reg->codAluno ?>" ><Br><Br>
            Senha:<br><input type="password" name="senha1" id="senha1" size="20" placeholder="Senha antiga" maxlength="10"><br>
            Confirme á senha:<br><input type="password" name="senha2" id="senha2" size="20" maxlength="10"><br><br>
            Data de nascimento:<br><input type="text" name="datanasc" id="datanasc" value="<?php echo$reg->datanascAluno ?>"><br><br>
            RG:<br><input type="number" name="rg" id="rg" value="<?php echo $reg->RG ?>"><br><br>
            CPF:<br><input type="number" name="cpf" id="cpf" value="<?php echo $reg->CPF ?>"><br><br>
            Telefone:<br><input type="number" name="tel" id="tel" value="<?php echo $reg->telefoneAluno ?>"><br><br>
            <h2>Endereço</h2>
            Cidade:<br><input type="text" name="cidade" id="cidade" value="<?php echo $reg->cidadeAluno ?>"><br><br>
            Bairro:<br><input type="text" name="bairro" id="bairro" value="<?php echo $reg->bairroAluno ?>"><br><br>
            Rua:<br><input type="text" name="rua" id="rua" value="<?php echo $reg->ruaAluno ?>"><br><br>
            <br><br>

            <input class="btn btn-success" type="submit" value="Salvar">             
                
        </form> 
        <?php
            
            if($a == 1){
                echo "<a class='btn btn-danger' href='user_edit.php?delete=true&tipoUsuario=aluno&cod=$reg->codAluno'>Deletar Aluno</a><br>";
            }
          
            
    }else if($c == 'professor'){
        
        $q="SELECT * FROM professor WHERE codProf = $cod";
        $busca=$banco->query($q);
        $reg=$busca->fetch_object();
        ?>
            
        <form action="user_edit.php?c=professor&cod=<?php echo $reg->codProf?>" method="post">
            Nome:<br><input type="text" name="nome" value="<?php echo $reg->nomeProf ?>"><br><br>
            Codigo:<br><input type="number" readonly name="usuario" value="<?php echo $reg->codProf ?>" ><Br><Br>
            Senha:<br><input type="password" name="senha1" id="senha1" size="20" placeholder="Senha antiga" maxlength="10"><br>
            Confirme a senha:<br><input type="password" name="senha2" id="senha2" size="20" maxlength="10" placeholder="Confirme a senha"><br><br>
            Data de nascimento:<br><input type="text" name="datanasc" id="datanasc" value="<?php echo $reg->datanascProf ?>"><br><br>
            Celular:<br><input type="number" name="cel" id="cel" value="<?php echo $reg->celProf ?>"><br><br>
            Telefone:<br><input type="number" name="tel" id="tel" value="<?php echo $reg->telProf ?>"><br><br>
            Disciplina:<br><input type="text" name="disciplina" id="disciplina" value="<?php echo $reg->codDisciplina ?>">
            <h2>Endereço</h2>
            Cidade:<br><input type="text" name="cidade" id="cidade" value="<?php echo $reg->cidadeProf ?>"><br><br>
            Bairro:<br><input type="text" name="bairro" id="bairro" value="<?php echo $reg->bairroProf ?>"><br><br>
            Rua:<br><input type="text" name="rua" id="rua" value="<?php echo $reg->ruaProf ?>">
           <input class="btn btn-success"  type="submit" value="Salvar">
           <a id="padrao" class="btn btn-primary" href="index.php" role="button">Menu</a>
            
        </form>
            
        <?php
            
            if($a == 1){
                echo "<a class='btn btn-danger' href='user_edit.php?delete=true&tipoUsuario=professor&cod=$reg->codProf'>Deletar Professor</a><br>";
            }
            
    }else if($c == 'admin'){
        
        $q = "SELECT * FROM administrador WHERE codAdm = $cod";
        $busca=$banco->query($q);
        $reg=$busca->fetch_object();
        ?>

        <form action="user_edit.php?c=admin&cod=<?php echo $reg->codAdm?>" method="post">
            Nome:<Br><input type="text" name="nome" id="nome" value="<?php echo $reg->nomeAdm?>"><br><Br>
            Código:<Br><input type="number" name="usuario" id="usuario" value="<?php echo $reg->codAdm?>"><br><Br>
            Senha:<br><input type="password" name="senha1" id="senha1" size="20" placeholder="Senha antiga" maxlength="10"><br><br>
            Confirme a senha:<br><input type="password" name="senha2" id="senha2" size="20" maxlength="10">
            <br><br><input class="btn btn-success" type="submit" value="Salvar">
            <a class="btn btn-danger" href="user_edit.php?delete=true&tipoUsuario=admin&cod=<?php echo $reg->codAdm?>">Deletar administrador</a><br><br>
            <a id="padrao" class="btn btn-primary" href="index.php" role="button">Menu</a>
        </form>
        <br><br>
        
       
            
            
        <?php
    }else{
        $q="SELECT * FROM responsaveis WHERE codResponsavel = $cod";
        $busca=$banco->query($q);
        $reg=$busca->fetch_object();
        ?>

        <form  action="user_edit.php?c=responsavel&cod=<?php echo $reg->codResponsavel?>" method="post">
            Nome:<br><input type="text" name="nome" value="<?php echo $reg->nomeResponsavel ?>"><br><br>
            Código:<br><input type="number" readonly name="usuario" value="<?php echo $reg->codResponsavel ?>" ><Br><Br>
            Senha:<br><input type="password" name="senha1" id="senha1" size="20" placeholder="Senha antiga" maxlength="10"><br>
            confirme á senha:<br><input type="password" name="senha2" id="senha2" size="20" maxlength="10"><br><br>
            RG:<br><input type="number" name="rg" id="rg" value="<?php echo $reg->rgMae ?>"><br><br>
            CPF:<br><input type="number" name="cpf" id="cpf" value="<?php echo $reg->cpfMae ?>"><br><br>
            RM Aluno:<br><input readonly type="text" name="rmAluno" id="rmAluno" value="<?php echo $reg->codAluno ?>">
            <br><br><input id="" type="submit" value="Salvar">
        </form>
        
        <?php
            
         if($a == 1){
                echo "<a class='btn btn-danger' href='user_edit.php?delete=true&tipoUsuario=responsavel&cod=$reg->codResponsavel'>Deletar Responsavel</a><br>";
            }
            
    }

?>


<style>


.voltar{
    text-decoration: none;
    position: relative;
    color: white;
    font-size: 15px;
    background-color: #111;
    padding: 15px;
}


.voltar:hover{
    color:white;
}

#padrao{
    left: 25%;
    top: 50%;
    position: relative;
}
form{
    text-aling: center;
    position: absolute;
    left: 40%;
    top: 15%;
}


body{
    font-family: Arial, Helvetica, sans-serif;
    background-color: lightcyan;
    background: rgb(0,212,255);
    background: radial-gradient(circle, rgba(0,212,255,1) 0%, rgba(0,212,255,1) 35%, rgba(0,153,255,1) 100%);
}
</style>