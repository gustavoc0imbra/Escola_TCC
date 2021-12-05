

<link rel="stylesheet" href="Estilo/main4.css">
<style>
  .volt{
    float:left;
  }
  .ent{
    float: right;
  }
  .titulo{
    color: black;
    font-weight: bold;
  }
</style>
<form align="center" action="login.php" method="POST">
             <div>
               <h2 class='titulo'>SGEA</h2>
               Sistema de gerenciamento escolar com acervo<br><Br>
             <input class= "top" type="text" placeholder="Usuário (Seu código)" name="cod">
             <br><Br>
             <input class="top"  type="password" placeholder="Senha de usuário" name="senha">
             <br><Br><select name="tipo" class="form-select" id="tipo">
                  <option selected value="aluno">Aluno</option>
                  <option value="professor">Professor</option>
                  <option value="responsavel">Responsável</option>
                  <option value="admin">Administrador</option>
             </select>
             <br><br>
               
               <input class="tn btn-primary btn-lg ent" type="submit" value="Entrar" placeholder="Entrar">
               <input class="tn btn-primary btn-lg volt" type="reset" value="Cancelar">
             
             </div>
    
</form>
