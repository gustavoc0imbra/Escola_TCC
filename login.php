<?php

include("config.php");

 $mysql = new BancodeDados();
 $mysql->conecta();
 $codAluno = $_POST['codAluno'];
 $senhaAluno = $_POST['senhaAluno'];

 $sqlstring = ("SELECT * FROM estudante WHERE codAluno=$codAluno AND senhaAluno='$senhaAluno'");
 $query = @mysqli_query($mysql->con, $sqlstring) or die ("Preencha o campo de usuário");

 if (strlen($senhaAluno)<1){
     echo 'Por favor preencha o campo de senha';
 }

 elseif($codAluno == "SELECT * FROM estudante where $codAluno = codAluno" && $senhaAluno == "SELECT * FROM estudante where $senhaAluno=$senhaAluno" ){
       //echo "<script>location.href('index2.php');</script>";
       echo "Deu tudo certo";
}
   //$stmt = $pdo->prepare('SELECT * FROM estudante WHERE codAluno = :codAluno');
   //$stmt->execute(['codAluno' => $codAluno]);

   //$stmt = $pdo->prepare('SELECT * FROM estudante WHERE senhaAluno = :senhaAluno');
   //$stmt->execute(['senhaAluno' => $senhaAluno]);
?>




