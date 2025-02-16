<?php
require 'dompdf/dompdf/autoload.inc.php';
require 'connect.php';

$id_venda = $_GET['id_venda'];

$subtotal_total = 0;

$sql = "SELECT * FROM venda WHERE id_venda = '$id_venda'";
$resultado = mysqli_query($cn, $sql);
$row = mysqli_fetch_array($resultado);

$sql_user = "SELECT * FROM utilizador WHERE id_user = '$row[id_user]'";
$resultado_user = mysqli_query($cn, $sql_user);
$row_user = mysqli_fetch_array($resultado_user);

$sql_detalhes = "SELECT * FROM detalhe_venda WHERE id_venda = '$id_venda'";
$resultado_detalhes = mysqli_query($cn, $sql_detalhes);
$row_detalhe = mysqli_fetch_array($resultado_detalhes);

$data = date("d/m/Y H:i:s", strtotime($row['data_venda']));

use Dompdf\Dompdf;
use Dompdf\Options;

// Configurações do Dompdf
$options = new Options();
$options->set('isRemoteEnabled', true); // Permite carregar imagens remotas
$options->set('chroot', __DIR__); // Define o diretório raiz para acesso a arquivos locais
$dompdf = new Dompdf($options);

// Caminho da imagem local (relativo ao script PHP)
$imagePath = 'img/logoofc (1).png';

// Verifica se há informações extra
$info_extra = !empty($row_detalhe['outras_info']) ? 'Informações Extra: ' . $row_detalhe['outras_info'] . '<br>' : '';

// HTML da fatura
$html = '
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Fatura</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .header img { width: 150px; }
        .header h1 { color:rgb(255, 115, 0); text-align: center; flex-grow: 1; margin: 0; }
        .header .date { text-align: right; color: #555; }
        .info { margin-bottom: 20px; }
        .info table { width: 100%; border-collapse: collapse; }
        .info th, .info td { padding: 8px; text-align: left; }
        .products { margin-top: 20px; }
        .products table { width: 100%; border-collapse: collapse; }
        .products th { background-color: rgb(255, 115, 0); color: white; padding: 8px; text-align: left; }
        .products td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .total { margin-top: 20px; text-align: right; }
    </style>
</head>
<body>
    <div class="header">
        <img src="' . $imagePath . '" alt="Chronofit Logo">
        <h1>Fatura</h1>
        <div class="date">Data: ' . $data . '</div>
    </div>

    <div class="info">
        <table>
            <tr>
                <th>Informações do Utilizador</th>
                <th>Morada de Expedição</th>
            </tr>
            <tr>
                <td>
                    Nome: '. $row_user['nome'] .'<br>
                    Email: '. $row_user['email'] .'<br>
                    Telefone: '. preg_replace('/(\d{3})(?=\d)/', '$1 ', $row_user['telefone']) .'<br> <!-- a expressão /(\d{3})(?=\d)/ encontra grupos de três dígitos seguidos por mais dígitos e $1 insere um espaço após cada grupo de três dígitos -->
                    NIF: '. preg_replace('/(\d{3})(?=\d)/', '$1 ', $row_user['nif']) .'<br>
                    Nº Encomenda: '.$id_venda.'
                </td>
                <td>
                    Endereço: '. $row_detalhe['endereco'] .'<br>
                    ' . $info_extra . '
                    País: '. $row_detalhe['pais'] .'<br>
                    Cidade: '. $row_detalhe['cidade'] .'<br>
                    Código Postal: '. $row_detalhe['cod_post'] .'
                </td>
            </tr>
        </table>
    </div>

    <div class="products">
        <table>
            <tr>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Preço Unitário</th>
                <th>Subtotal</th>
            </tr>';

$sql_detalhes = "SELECT * FROM detalhe_venda WHERE id_venda = '$id_venda'";
$resultado_detalhes = mysqli_query($cn, $sql_detalhes);
// Adiciona os detalhes dos produtos da venda
while ($row_detalhe = mysqli_fetch_array($resultado_detalhes)) {
    $subtotal = $row_detalhe['quantidade'] * $row_detalhe['preco_venda'];
    $subtotal_total += $subtotal;
    
    $sql_produto = "SELECT nome FROM produto WHERE id_prod = '".$row_detalhe['id_prod']."'";
    $resultado_produto = mysqli_query($cn, $sql_produto);
    $row_produto = mysqli_fetch_array($resultado_produto);

    $html .= '
        <tr>
            <td>' . $row_produto['nome'] . '</td>
            <td>' . $row_detalhe['quantidade'] . '</td>
            <td>' . number_format($row_detalhe['preco_venda'], 2, ',', '.') . ' €</td>
            <td>' . number_format($subtotal, 2, ',', '.') . ' €</td>
        </tr>';
}

$iva = $subtotal_total * 0.23;
$total = $subtotal_total + $iva;

$html .= '
        </table>
    </div>

    <div class="total">
        <p>Subtotal: '. number_format($subtotal_total, 2, ',', '.') .' €</p>
        <p>IVA: '. number_format($iva, 2, ',', '.') .' €</p>
        <p><strong>Total: '. number_format($total, 2, ',', '.') .' €</strong></p>
    </div>
</body>
</html>
';

// Carrega o HTML no Dompdf
$dompdf->loadHtml($html);

// Renderiza o PDF
$dompdf->render();

// Saída do PDF para o navegador ou para um arquivo
$dompdf->stream("fatura.pdf", array("Attachment" => true)); // "Attachment" => true para download automático
?>
