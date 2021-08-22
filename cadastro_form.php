<h1>Novo Cadastro</h1>
<form action="Cadastro.php" method="post">
    <table>
        Tipo de Cadastro:<br><select class="caixa_texto" name="tipo" id="tipo" onchange="functionCadastro()">
                    <option selected disabled="disabled">Selecione seu tipo de cadastro</option>
                    <option value="aluno">Aluno</option>
                    <option value="professor">Professor</option>
                    <option value="responsavel">Responsável</option>
                    <option value="admin">Admin</option>
                </select>
        <p id="mudarusuario"></p>
        <script>
            // variaveis 
            var letras = "<br><br><a class = 'letras'>",
            nome = "<br><input class='caixa_texto' required type='text' name='nome' id='nome' size='20' maxlength='30'>",
            senha1 = "<br><input class='caixa_texto' required type='password' name='senha1' id='senha1' size='10' maxlength='10'>",
            senha2 = "<br><input class='caixa_texto' required type='password' name='senha2' id='senha2' size='10' maxlength='10'>",
            rg = "<br><input required type='text' name='rg' id='rg' size='20' maxlength='30'>",
            cpf = "<br><input required type='text' name='cpf' id='cpf' size='20' maxlength='30'>",
            datanasc = "<br><input required type='text' name='datanasc' id='datanasc' size='20' maxlength='30'>",
            tel = "<br><input required type='text' name='tel' id='tel' size='20' maxlength='30'>",
            endereco = "<br><input required type='text' name='endereco' id='endereco' size='20' maxlength='30'>";

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
                letras + "Endereço:</a>" + endereco;

                }if(x == "professor"){
                    document.getElementById("mudarusuario").innerHTML =
                    letras + "Nome:</a>" + nome +
                    letras + "Data de Nascimento:</a>" + datanasc +
                    letras + "Telefone:</a>" + tel +
                    letras + "Endereço:</a>" + endereco; 

                }if(x == "responsavel"){
                    document.getElementById("mudarusuario").innerHTML =
                    letras + "Nome do responsável:</a>" + nome +
                    letras + "Rg do responsável:</a>" + rg +
                    letras + "Cpf do responsável:</a>" + cpf +
                    letras + "Data de nascimento do responsável:</a>" + datanasc +
                    letras + "Nome do aluno: </a><br><input required class='caixa_texto' type='text' name='nomedoAluno' id='nomedoAluno' size='20' maxlength='30'>" + 
                    letras + "Senha do aluno: </a>" + senha1;
                }if(x == "admin"){
                    document.getElementById("mudarusuario").innerHTML =
                    letras + "Nome:</a>" + nome +
                    letras + "Senha:</a>" + senha1;

                }
        } 
        </script>
       
        <br><input class="botao" type="submit" value="Cadastrar">         

    </table>
</form>


        