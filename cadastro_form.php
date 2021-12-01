<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="Estilo/estilo.css">
</head>

<body>

<style>
    body{
            font-family: Arial, Helvetica, sans-serif;
            background-color: lightcyan;
            background: rgb(0,212,255);
            background: radial-gradient(circle, rgba(0,212,255,1) 0%, rgba(0,212,255,1) 35%, rgba(0,153,255,1) 100%);
        }

       a{
           text-decoration: none;
           font-size: 20px;
           color: black;

       }

       .voltar{
           font-family: Arial, Helvetica, sans-serif;
           

       }

       .voltar:hover{
           font-family: Arial, Helvetica, sans-serif;
           cursor: pointer;
           color: white;
           background-color: #0180fe;
           padding: 15px;
           border-radius: 12%;

       }

       .cad{
            border-radius: 12%;
            padding: 15px;
            font-size: 20px;
            border: none;
       }

       .cad:hover{
           cursor: pointer;
           background-color: #1E90FF;
           color: white;
       }
       

       



</style>
<br>
<div>
    <?php
            $tipo = $_SESSION['tipo'];
            $cod  = $_SESSION['cod'];

            if($tipo != "admin"){
                echo "<script>alert('Você não tem acesso a esta página!');</script>";
                echo "<script>window.location.href='index.php'</script>";
            }
            else{
                ?>
                <h1 stlye="color:black"><b>Novo cadastro de usuário</b></h1>

                    <form enctype="multipart/form-data" id="formsCadastro" action="Cadastro.php" method="post">
                            <table>
                                <h4>Tipo de Cadastro:<h4><br><select class="form-select-lg mb-3" name="tipo" id="tipo" onchange="functionCadastro()">
                                 <option value="" selected disabled="disabled">Selecione seu tipo de cadastro que deseja</option>
                                 <option value="aluno">Aluno</option>
                                 <option value="professor">Professor</option>
                                 <option value="responsavel">Responsável</option>
                                 <option value="admin">Admin</option>
                                </select><br>
                    <p id="mudarusuario"></p>
        
        <script>
            // variaveis 
            var letras = "<br><br><a class = 'letras'>",
            nome = "<br><center><input required class='input-group-text' class='input-group-text' class='caixa_texto' type='text' name='nome' id='nome' size='20' maxlength='30'></center>",
            senha1 = "<br><center><input required class='input-group-text'  class='caixa_texto' type='password' name='senha1' id='senha1' size='10' maxlength='10'></center>",
            senha2 = "<br><center><input required class='input-group-text' class='caixa_texto' type='password' name='senha2' id='senha2' size='10' maxlength='10'></center>",
            rg = "<br><center><input required class='input-group-text' type='text' name='rg' id='rg' size='20' maxlength='30'></center>",
            cpf = "<br><center><input required class='input-group-text' type='text' name='cpf' id='cpf' size='20' maxlength='30'></center>",
            datanasc = "<br><center><input required class='input-group-text' type='date' name='datanasc' id='datanasc' size='30' maxlength='30'></center>",
            tel = "<br><center><input required class='input-group-text' type='tel' placeholder='(DDD)0000-0000' name='tel' id='tel' size='20' maxlength='30'></center>",
            cel = "<br><center><input required class='input-group-text' type='text' name='cel' id='cel' size='20' maxlength='30'></center>",
            cidade = "<br><center><input required class='input-group-text' type='text' name='cidade' id='cidade' size='20' maxlength='30'></center>",
            bairro = "<br><center><input required class='input-group-text' type='text' name='bairro' id='bairro' size='20' maxlength='30'></center>",
            rua = "<br><center><input required class='input-group-text' type='text' name='rua' id='rua' size='20' maxlength='30'></center>",
            disciplina = "<br><select class='caixa_texto' name='disciplina' id='disciplina'><option value='' selected disabled='disabled'>Selecione sua disciplina</option><option value='1'>Português</option><option value='2'>Matemática</option><option value='3'>Geografia</option><option value='4'>História</option></select><br>",
            imagem = "<br><center> <input type='hidden' name='MAX_FILE_SIZE' value='5242880'><input required class='input-group-file' type='file' name='imagem' id='imagem'></center>";
   
            function functionCadastro(){
                 
                var x = document.getElementById("tipo").value;
                if( x == "aluno"){
                document.getElementById("mudarusuario").innerHTML = 

                letras + "Nome:</a>" + nome +
                letras + "Senha:</a>" + senha1 +
                letras + "Confirme sua senha:</a>" + senha2 +
                letras + "RG:</a>" + rg +
                letras + "CPF</a>" + cpf +
                letras + "Data de Nascimento:</a>" + datanasc +
                letras + "Telefone:</a>" + tel + 
                letras + "Cidade:</a>" + cidade +
                letras + "Bairro:</a>" + bairro +
                letras + "Rua:</a>" + rua +
                letras + "Imagem:</a>" + imagem;

                }if(x == "professor"){
                    document.getElementById("mudarusuario").innerHTML =
                    letras + "Disciplina:</a>" + disciplina +
                    letras + "Nome:</a>" + nome +
                    letras + "Senha:</a>" + senha1 +
                    letras + "Confirme sua senha:</a>" + senha2 +
                    letras + "Data de Nascimento:</a>" + datanasc +
                    letras + "Celular:</a>" + cel +
                    letras + "Telefone:</a>" + tel +
                    letras + "Cidade:</a>" + cidade +
                    letras + "Bairro:</a>" + bairro +
                    letras + "Rua:</a>" + rua;


                }if(x == "responsavel"){
                    document.getElementById("mudarusuario").innerHTML =
                    letras + "Nome do responsável:</a>" + nome +
                    letras + "Senha:</a>" + senha1 +
                    letras + "Confirme sua senha:</a>" + senha2 +
                    letras + "RG do responsável:</a>" + rg +
                    letras + "CPF do responsável:</a>" + cpf +
                    letras + "Data de nascimento do responsável:</a>" + datanasc +
                    letras + "Código do aluno: </a><br><input required class='caixa_texto' type='text' name='codAluno' id='codAluno' size='20' maxlength='30'>" + 
                    letras + "Senha do aluno: </a><br><input class='caixa_texto' type='password' name='senhaAluno' id='senha1' size='10' maxlength='10'>" ;
                    
                }if(x == "admin"){
                    document.getElementById("mudarusuario").innerHTML =
                    letras + "Nome:</a>" + nome +
                    letras + "Senha:</a>" + senha1 +
                    letras + "Confirme sua senha:</a>" + senha2;

                }
        } 
        </script>
                            <div>
                                <br><input class="cad" type="submit" value="Cadastrar">  
                                <br><br> <a class="voltar"href="index.php" role="button">Menu</a>
                                    </div>
                        </table>
                    </form>
                <?php
                    }
                ?>
            </div>
        </body>

</html>


        