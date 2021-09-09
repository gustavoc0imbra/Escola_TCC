<?php

/* linha de conexão com BD
$banco = new mysqli(host,usuario,senha,banco);*/
$banco = new mysqli("localhost","root","","escola_tcc");

/* Se houver algum erro na conexão será emitido uma msg de die() mata tudo*/
if($banco->connect_errno){
    echo"<p>Encontrei um erro $banco->errno --> $banco->connect_error</p>";
    die();
}

/* Transformar os resultados com padrões utf-8 */
$banco->query("SET NAMES 'utf8'");
$banco->query("SET character_set_connection=utf8");
$banco->query("SET character_set_client=utf8");
$banco->query("SET character_set_results=utf8");

?>