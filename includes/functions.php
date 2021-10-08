<?php 

session_start();

// VALORES PADRÕES PARA "$_SESSION"
if(!isset($_SESSION['user'])){
    $_SESSION['cod'] = '';
    $_SESSION['nome'] = '';
    $_SESSION['tipo'] = '';
    $_SESSION['aluno'] = '';
}


// LOGOUT DE USUARIO 
function logout(){
    unset($_SESSION['user']);
    unset($_SESSION['nome']);
    unset($_SESSION['tipo']);
    unset($_SESSION['aluno']);
    
}

// FUNCTION PARA SABER SE O USUARIO ESTÁ LOGADO
function is_logado(){
    if(empty($_SESSION['user'])){
        return false;
        
    }else{
        return true;
    }
}


// GERAR HASH PARA SENHA
function gerarhash($senha){
    $txt=cripto($senha);
    $hash=password_hash($txt,PASSWORD_DEFAULT);
    return $hash;
}


// TESTAR A HASH
function testarhash($senha,$hash){
    $ok=password_verify(cripto($senha),$hash);
    return $ok;
}
// CRIPTOGRAFAR SENHA
function cripto($senha){
    $c='';
        for($pos=0;$pos<strlen($senha);$pos ++){
            $letra=ord($senha[$pos])+1;
            $c.=chr($letra);
        }
    return $c;
}

/*  TESTAR A HASH E SUA CRIPTOGRAFIA
$original = "senhateste"; // insira sua senha
gerarhash($original);  // gerou uma hash
echo gerarhash($original); // mostrou essa hash copie e cole no 'testarhash'
echo testarhash($original,'$2y$10$qPzyxZMHazGPz9AKKedhx..TJbWbHGSb8Fxg9I4NciCQJO2/4IMEW')?"<br><br>SIM<br><br>":"<br><br>NÃO"<br><br>; // resultado = sim (tudo certo), não (algo deu errado) */ 

?>