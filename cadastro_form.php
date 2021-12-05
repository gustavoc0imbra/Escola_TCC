<head>
        <meta charset="UTF-8">
        <meta description="...">
        <link rel="stylesheet" href="#">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>

            .titulo{
                background: radial-gradient(circle, rgba(0,212,255,1) 0%, rgba(0,212,255,1) 35%, rgba(0,153,255,1) 100%);;
                color: white;
                padding: 4px;
                
            }
            body{
                
                background: radial-gradient(circle, rgba(0,212,255,1) 0%, rgba(0,212,255,1) 35%, rgba(0,153,255,1) 100%);;
               
            }
            .box{
                
                margin: 40px;
                margin-left: 320px;
                margin-right: 320px;
                background-color: ghostwhite;
                
            }
            .letras{
                text-decoration: none;
                color: black;
            }
            .box2{
                padding: 10px;
                padding-left: 30px;
                padding-right: 30px;
            }
            .cad{
                float: right;
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
            .datatxt{
                color: black;
                text-decoration: none;
                padding: 10px;
                border-bottom: 1px solid black;
            }
        </style>
    </head>
    <?php
            $tipo = $_SESSION['tipo'];
            $cod  = $_SESSION['cod'];

            if($tipo != "admin"){
                echo "<script>alert('Você não tem acesso a esta página!');</script>";
                echo "<script>window.location.href='index.php'</script>";
            }
            else{
                ?>
                
                <div class='box'>
                <center><h1 class='titulo'>Novo cadastro de usuário</h1></center>
                </h2></h3></h4>
                    <div class='box2'>
                    <form id="formsCadastro" action="Cadastro.php" method="post">
                            <table>
                                Tipo de Cadastro:<br><select name="tipo" id="tipo" onchange="functionCadastro()">
                                 <option value="" selected disabled="disabled">Selecione seu tipo de cadastro que deseja</option>
                                 <option value="aluno">Aluno</option>
                                 <option value="professor">Professor</option>
                                 <option value="responsavel">Responsável</option>
                                 <option value="admin">Admin</option>
                                </select><br>
                    <p id="mudarusuario"></p>
        
        <script>
            // variaveis 
            var letras = "<a class = 'letras'>",
            nome = "<br><input placeholder='Digite o nome' required class='caixa_texto' type='text' name='nome' id='nome' size='98' maxlength='30'>",
            senha1 = "<br><input placeholder='Digite a senha' required class='caixa_texto' type='password' name='senha1' id='senha1' size='40' maxlength='10'>",
            senha2 = "<input placeholder='Confirmar senha'required class='caixa_texto' type='password' name='senha2' id='senha2' size='50' maxlength='10'><Br>",
            rg = "<input required type='text' placeholder='Rg' class='caixa_texto' name='rg' id='rg' size='20' maxlength='30'>",
            cpf = "<input required type='text' placeholder='Cpf'class='caixa_texto' name='cpf' id='cpf' size='20' maxlength='30'>",
            datanasc = "<input required type='date' class='caixa_texto' name='datanasc' id='datanasc' size='30' maxlength='30'>",
            tel = "<br><input placeholder='Telefone' required class='caixa_texto' type='text' name='tel' id='tel' size='20' maxlength='30'>",
            cel = "<input placeholder='Celular' required class='caixa_texto' type='text' name='cel' id='cel' size='50' maxlength='30'>",
            cidade = "<input required class='caixa_texto' placeholder='Cidade' type='text' name='cidade' id='cidade' size='70' maxlength='30'><br>",
            bairro = "<input required placeholder='Bairro' class='caixa_texto' type='text' name='bairro' id='bairro' size='50' maxlength='30'>",
            rua = "<input placeholder='Rua' required class='caixa_texto' type='text' name='rua' id='rua' size='40' maxlength='30'><br><br>",
            imagem = "<br><center> <input type='hidden' name='MAX_FILE_SIZE' value='5242880'><input required class='input-group-file' type='file' name='imagem' id='imagem'></center>";
   
            function functionCadastro(){
                 
                var x = document.getElementById("tipo").value;
                if( x == "aluno"){
                document.getElementById("mudarusuario").innerHTML = 

                nome + senha1 + senha2 + rg + cpf + "<a class='datatxt'>Data de nascimento :</a>" + datanasc + tel + cidade +bairro + rua +
                letras + "Imagem:</a>" + imagem;

                }if(x == "professor"){
                    document.getElementById("mudarusuario").innerHTML =
                    nome + senha1 + senha2 + "<a class='datatxt'>Data de Nascimento:</a>" + datanasc + cel + tel + cidade + bairro + rua +
                    letras + "Imagem:</a>" + imagem;


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
                    letras + "Confirme sua senha:</a>" + senha2 +
                    letras + "Imagem:</a>" + imagem;
                }
        } 
        </script>
                
                                
                        </table>
                        <br><button type="submit" class="btn btn-primary cad">Cadastrar</button>
                                <a class="voltar"href="index.php"><button type="button" class="btn btn-primary">Menu</button></a>
                    </form>
                <?php
                    }
                ?>
                </div>
            </div>
        </body>

</html>


        