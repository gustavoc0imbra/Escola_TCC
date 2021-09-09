<form align="center" id="formslogin" action="login.php" method="POST">
             
             <input type="text" placeholder="Usuário (Seu código)" name="cod">
             <br><Br>
             <input type="password" placeholder="Senha de usuário" name="senha">
             <br><Br><select name="tipo" id="tipo">
                  <option selected value="aluno">Aluno</option>
                  <option value="professor">Professor</option>
                  <option value="responsavel">Responsável</option>
                  <option value="admin">Administrador</option>
             </select>
             <br><br>
             <input type="submit" value="Entrar" placeholder="Entrar">
             <input type="reset" value="Cancelar">
             <br><Br><a href="cadastro.php">Cadastrar-se</a>
    
</form>
