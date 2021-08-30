<?php

include("config.php");

 $mysql = new BancodeDados();
 $mysql->conecta();
 $codAluno = $_POST['codAluno'];
 $senhaAluno = $_POST['senhaAluno'];

 $sqlstring = ("SELECT * FROM estudante WHERE codAluno=$codAluno AND senhaAluno='$senhaAluno'");

 $query = @mysqli_query($mysql->con, $sqlstring) or die ("Erro ao selecionar as informações");

 //if (strlen($senhaAluno)<1){
     //echo 'Senha inválida tente novamente';
 //}
   if($senhaAluno == "SELECT * FROM estudante where $senhaAluno = senhaAluno"){
     echo "<script>location.href='home.php';</script>";
 }



   //$stmt = $pdo->prepare('SELECT * FROM estudante WHERE codAluno = :codAluno');
   //$stmt->execute(['codAluno' => $codAluno]);

   //$stmt = $pdo->prepare('SELECT * FROM estudante WHERE senhaAluno = :senhaAluno');
   //$stmt->execute(['senhaAluno' => $senhaAluno]);
?>



