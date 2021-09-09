<h1>Novo Cadastro</h1>
<form action="Cadastro.php" method="post">
    <table>
        Tipo de Cadastro:<br><select class="caixa_texto" name="tipo" id="tipo" onchange="functionCadastro()">
                    <option value="" selected disabled="disabled">Selecione seu tipo de cadastro</option>
                    <option value="aluno">Aluno</option>
                    <option value="professor">Professor</option>
                    <option value="responsavel">Responsável</option>
                    <option value="admin">Admin</option>
                </select><br>
        <p id="mudarusuario"></p>
        
        <script>
            // variaveis 
            var letras = "<br><br><a class = 'letras'>",
            nome = "<br><input required class='caixa_texto' type='text' name='nome' id='nome' size='20' maxlength='30'>",
            senha1 = "<br><input required class='caixa_texto' type='password' name='senha1' id='senha1' size='10' maxlength='10'>",
            senha2 = "<br><input required class='caixa_texto' type='password' name='senha2' id='senha2' size='10' maxlength='10'>",
            rg = "<br><input required type='text' name='rg' id='rg' size='20' maxlength='30'>",
            cpf = "<br><input required type='text' name='cpf' id='cpf' size='20' maxlength='30'>",
            datanasc = "<br><input required type='text' name='datanasc' id='datanasc' size='20' maxlength='30'>",
            tel = "<br><input required type='text' name='tel' id='tel' size='20' maxlength='30'>",
            cel = "<br><input required type='text' name='cel' id='cel' size='20' maxlength='30'>",
            cidade = "<br><input required type='text' name='cidade' id='cidade' size='20' maxlength='30'>",
            bairro = "<br><input required type='text' name='bairro' id='bairro' size='20' maxlength='30'>",
            rua = "<br><input required type='text' name='rua' id='rua' size='20' maxlength='30'>",
            disciplina = "<br><select class='caixa_texto' name='disciplina' id='disciplina'><option value='' selected disabled='disabled'>Selecione sua disciplina</option><option value='1'>Português</option><option value='2'>Matemática</option><option value='3'>Geografia</option><option value='4'>História</option></select><br>";
   
            function functionCadastro(){
                 
                var x = document.getElementById("tipo").value;
                if( x == "aluno"){
                document.getElementById("mudarusuario").innerHTML = 

                letras + "Nome:</a>" + nome +
                letras + "Senha:</a>" + senha1 +
                letras + "Confirme sua senha:</a>" + senha2 +
                letras + "Rg:</a>" + rg +
                letras + "Cpf</a>" + cpf +
                letras + "Data de Nascimento:</a>" + datanasc +
                letras + "Telefone:</a>" + tel + 
                letras + "Cidade:</a>" + cidade +
                letras + "Bairro:</a>" + bairro +
                letras + "Rua:</a>" + rua;

                }if(x == "professor"){
                    document.getElementById("mudarusuario").innerHTML =
                    letras + "Disciplina:</a>" + disciplina +
                    letras + "Nome:</a>" + nome +
                    letras + "senha:</a>" + senha1 +
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
                    letras + "Rg do responsável:</a>" + rg +
                    letras + "Cpf do responsável:</a>" + cpf +
                    letras + "Data de nascimento do responsável:</a>" + datanasc +
                    letras + "Rm do aluno: </a><br><input required class='caixa_texto' type='text' name='codAluno' id='codAluno' size='20' maxlength='30'>" + 
                    letras + "Senha do aluno: </a><br><input class='caixa_texto' type='password' name='senhaAluno' id='senha1' size='10' maxlength='10'>" ;
                    
                }if(x == "admin"){
                    document.getElementById("mudarusuario").innerHTML =
                    letras + "Nome:</a>" + nome +
                    letras + "Senha:</a>" + senha1 +
                    letras + "Confirme sua senha:</a>" + senha2;

                }
        } 
        </script>
       
        <br><input class="botao" type="submit" value="Cadastrar">         

    </table>
</form>


        