<!DOCKTYPE html>
<html>
    <head>
     <meta charset="UTF-8">
     <meta description="...">
     <link rel="stylesheet" href="main.css">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <style>
          form{
               position: absolute;
               top: 49%;
               width: 100%;
          }
          footer{
               position: absolute;
               top: 94%;
               width: 99.5%;
               text-align: center;
               font-family: Arial;
          }
     </style>
    </head>
     <body>
        <form align="center" id="formslogin" action="login.php" method="POST">
             <!--<select>
                  <option value="aluno">Aluno</option>
                  <option value="prof">Professor</option>
                  <option value="responsavel">Responsável</option>
                  <option value="adm">Administrador</option>
             </select> -->
             <input type="text" placeholder="Usuário (Seu código)" name="codAluno">
             <br>
             <input type="password" placeholder="Senha de usuário" name="senhaAluno">
             <br>
             <input type="submit" value="Entrar" placeholder="Entrar">
             <input type="reset" value="Cancelar">
       </form>
       <footer align="center">
           <p>Desenvolvido por ...</p>
      </footer>
     </body>
</html>

<script type="text/javascript">


</script>

