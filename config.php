<?php
class BancodeDados{
    private $host = "localhost";
    private $user = "root";
    private $senha = "";
    private $banco = "escola_tcc";
    public $con;
    
    
    function conecta(){
    $this->con = @mysqli_connect($this->host,$this->user,$this->senha, $this->banco);
        if(!$this->con){

            die ("Problemas com a conexăo");
        }
    }   
    function fechar(){
        mysqli_close($this->con);
        return;
    }
    function sqlquery($string,$caminho){
        $resultado = @mysqli_query($this->con, $string);
        if (!$resultado) {
            echo '<input type="button" onclick="window.location='."'index.php'".';" value="Voltar"><br><br>';
            die('<b>Query Inválida:</b>' . @mysqli_error($this->con)); 
        } else {
            $num = @mysqli_num_rows($resultado);
            if ($num==0){
            echo "<b>Código: </b>năo localizado !!!!<br><br>";
            echo '<input type="button" onclick="window.location='."'$caminho'".';" value="Voltar"><br><br>';
            exit;       
            }else{
                $dados=mysqli_fetch_array($resultado);
            }
        } 
        $this->fechar();
        return $dados;

        
    }
    function sqlstring($string,$texto){
        $resultado = @mysqli_query($this->con, $string);
        if (!$resultado) {
            echo '<input type="button" onclick="window.location='."'index.php'".';" value="Voltar"><br><br>';
            die('<b>Query Inválida:</b>' . @mysqli_error($mysql->con)); 
        } else {
            echo "<b>$texto </b> - Realizada com  Sucesso";
        }
        $this->fechar();
        return;
    }
    
}
?>