<?php // Depois troquem esse arquivo de conexao para o config.php do tiago. Esse aqui é so para conectar a tela notas, depois troquem lá.
class BancodeDados{
 // Nas linhas abaixo vocę poderá colocar as informaçőes do Banco de Dados.
    private $host = "localhost";    // Nome ou IP do Servidor
    private $user = "root";         // Usuário do Servidor MySQL
    private $senha = "";        // Senha do Usuário MySQL
    private $banco = "escola_tcc";        // Nome do seu Banco de Dados
    public $con;
    
    // método responsável para conexăo a base de dados
    function conecta(){
    $this->con = @mysqli_connect($this->host,$this->user,$this->senha, $this->banco);
        // Conecta ao Banco de Dados
        if(!$this->con){
            // Caso ocorra um erro, exibe uma mensagem com o erro
            die ("Problemas com a conexăo");
        }
    }   
    // método responsável para fechar a conexăo
    function fechar(){
        mysqli_close($this->con);
        return;
    }
    // funçăo para executar o SELECT 
    //(consultar.php, verexclusao.php, veralteracao.php)
    function sqlquery($string,$caminho){
        // executando instruçăo SQL
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
    
    // funçăo para executar o INSERT, UPDATE e DELETE 
    //(incluir.php, alterar.php, excluir.php, upload.php)
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