 <?php 
        
        include_once('includes/functions.php');
        require_once('includes/config.php');

        $nome = $_SESSION['nome'];
        $tipo = $_SESSION['tipo'];
        $codArq = $_GET['codArquivo'];

        
        $deletaArq = $banco->query("DELETE FROM acervo WHERE codArquivo=$codArq") or die("<script>alert('Erro ao remover! Tente novamente!'); window.location.href='index.php'</script>");

        if($deletaArq){
                echo ("<script>alert('Arquivo deletado com sucesso =D!');</script>");
                echo ("<script>window.location.href='index.php';</script>");
        }else{
                echo ("<script>alert('Falha ao deletar arquivo :C !');</script>");
                echo ("<script>window.location.href='index.php';</script>");
        }
?>