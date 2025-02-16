<?php 
    include 'connect.php';
    session_start();
    
    $stock_insuficiente = false;
    $id_prod_insuficiente = null;
    
    if (isset($_SESSION["id_utilizador"])) {
        $id_user = $_SESSION["id_utilizador"];
        $query = "SELECT * FROM carrinho WHERE id_user = $id_user";
        $resultado = mysqli_query($cn, $query);
        
        if ($resultado && mysqli_num_rows($resultado) > 0) {
            while ($linha = mysqli_fetch_array($resultado)) {
                $id_prod = $linha["id_prod"];
                $qtd = $linha["qtd_cart"];

                $sql_remove = "SELECT * FROM produto WHERE id_prod = $id_prod";
                $resultado_remove = mysqli_query($cn, $sql_remove);
                $rowd = mysqli_fetch_array($resultado_remove);

                if ($rowd["estado"] == 'D') {
                    $sql_remove_indisponivel = "DELETE FROM carrinho WHERE id_user = $id_user AND id_prod = $id_prod";
                    $resultado_remove_indisponivel = mysqli_query($cn, $sql_remove_indisponivel);

                    if($resultado_remove_indisponivel){
                        $nome = $rowd['nome'];
                        $mensagem = 'O produto '. $nome .' ficou indisponível!';
                        header("Location: cart.php?indisponivel=1&mensagem=" . urlencode($mensagem));
                        exit();
                    }
                } else {
                    $query_prod = "SELECT stock FROM produto WHERE id_prod = $id_prod";
                    $resultado_prod = mysqli_query($cn, $query_prod);
                    
                    if ($resultado_prod && mysqli_num_rows($resultado_prod) > 0) {
                        $linha_prod = mysqli_fetch_array($resultado_prod);
                        if ($linha_prod["stock"] < $qtd) {
                            $stock_insuficiente = true;
                            $id_prod_insuficiente = $id_prod;
                            
                            $nome_produto = $rowd['nome'];
                            $mensagem = 'A quantidade solicitada do produto ' . $nome_produto . ' excede o estoque disponível (' . $linha_prod["stock"] . ').';
                            header("Location: cart.php?indisponivel=1&mensagem=" . urlencode($mensagem));
                            exit();
                        }
                    }
                }
            }
        }
    } elseif (isset($_SESSION["carrinho"])) {
        foreach ($_SESSION["carrinho"] as $id_prod => $qtd) {
            $query_prod = "SELECT nome, stock FROM produto WHERE id_prod = $id_prod";
            $resultado_prod = mysqli_query($cn, $query_prod);
            
            if ($resultado_prod && mysqli_num_rows($resultado_prod) > 0) {
                $linha_prod = mysqli_fetch_array($resultado_prod);
                if ($linha_prod["stock"] < $qtd) {
                    $stock_insuficiente = true;
                    $id_prod_insuficiente = $id_prod;
                    
                    $nome_produto = $linha_prod['nome'];
                    $mensagem = 'A quantidade solicitada do produto ' . $nome_produto . ' excede o estoque disponível (' . $linha_prod["stock"] . ').';
                    header("Location: cart.php?indisponivel=1&mensagem=" . urlencode($mensagem));
                    exit();
                }
            }
        }
    }

    if (!$stock_insuficiente) {
        header("Location: checkout.php");
        exit();
    }
?>
