<?php
include 'connect.php';
session_start();
$nome_utilizador = isset($_SESSION['nome']) ? $_SESSION['nome'] : '';

$id_pedido = $_GET['id_venda'];
$id = $_SESSION['id_utilizador'];

// Consulta da venda
$sql_venda = "SELECT * FROM venda WHERE id_venda = $id_pedido";
$stmt_venda = mysqli_query($cn, $sql_venda);
$campo_venda = mysqli_fetch_array($stmt_venda);

// Consulta dos detalhes da venda
$sql_morada = "SELECT * FROM detalhe_venda WHERE id_venda = $id_pedido";
$stmt_morada = mysqli_query($cn, $sql_morada);
$detalhe = mysqli_fetch_array($stmt_morada);

// Consulta do cliente
$sql_cliente = "SELECT * FROM utilizador WHERE id_user = '" . $campo_venda['id_user'] . "'";
$stmt_cliente = mysqli_query($cn, $sql_cliente);

$campo_cliente = mysqli_fetch_array($stmt_cliente);

$total_geral = 0;
$subtotal_geral = 0;
$iva_geral = 0;
?>
<!DOCTYPE html>
<html class="scroll-smooth overflow-x-hidden" lang="en">
  <head>
    <meta charset="utf-8">
    <title>Order Details Page</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="robots" content="index, follow">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
    <link rel="icon" href="assets/images/icons/icon-favicon.svg" type="image/x-icon" sizes="16x16">
    <link rel="stylesheet" href="assets/styles/tailwind.min.css?v=5.0">
    <link rel="stylesheet" href="assets/styles/style.min.css?v=5.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Chivo:wght@400;700;900&amp;family=Noto+Sans:wght@400;500;600;700;800&amp;display=swap">
  </head>
  <body class="w-screen relative overflow-x-hidden min-h-screen bg-gray-100 scrollbar-hide order-details-page dark:bg-[#000]">
    <div class="wrapper mx-auto text-gray-900 font-normal grid scrollbar-hide grid-cols-[257px,1fr] grid-rows-[auto,1fr]" id="layout">
      
    <aside class="bg-white row-span-2 border-r border-neutral relative flex flex-col justify-between p-[25px] dark:bg-dark-neutral-bg dark:border-dark-neutral-border"> 
        <div class="absolute p-2 border-neutral right-0 border bg-white rounded-full cursor-pointer duration-300 translate-x-1/2 hover:opacity-75 dark:bg-dark-neutral-bg dark:border-dark-neutral-border" id="sidebar-btn"><img src="assets/images/icons/icon-arrow-left.svg" alt="left chevron icon"></div>
        <div><a class="mb-10" href="dashboard.php"> <img class="logo-maximize" src="assets/images/icons/icon-logo.svg" alt="Frox logo"><img class="logo-minimize ml-[10px]" src="assets/images/icons/icon-favicon.svg" alt="Frox logo"></a>
          <div class="pt-[106px] lg:pt-[35px] pb-[18px]">
            <div class="sidemenu-item rounded-xl relative">
              <input class="sr-only peer" type="checkbox" value="dashboard" name="sidemenu" id="dashboard">
              <label class="flex items-center justify-between w-full cursor-pointer py-[17px] px-[21px] focus:outline-none peer-checked:border-transparent active" for="dashboard">
                <div class="flex items-center gap-[10px]"><img src="assets/images/icons/icon-favorite-chart.svg" alt="side menu icon"><span class="text-normal font-semibold text-gray-500 sidemenu-title dark:text-gray-dark-500">Opções</span></div>
              </label><img class="absolute right-2 transition-all duration-150 caret-icon pointer-events-none peer-checked:rotate-180 top-[22px]" src="assets/images/icons/icon-arrow-down.svg" alt="caret icon">
              <div class="hidden peer-checked:block">
                <ul class="text-gray-300 child-menu z-10 pl-[53px]">
                  <li class="pb-2 transition-opacity duration-150 hover:opacity-75"><a class="text-normal" href="clients-list.php">Listar Registos</a></li>
                  <li class="pb-2 transition-opacity duration-150 hover:opacity-75"><a class="text-normal" href="product-list.php">Listar produtos</a></li>
                  <li class="pb-2 transition-opacity duration-150 hover:opacity-75"><a class="text-normal" href="listar_categorias.php">Listar categorias</a></li>
                  <li class="pb-2 transition-opacity duration-150 hover:opacity-75"><a class="text-normal" href="listar_marca.php">Listar marcas</a></li>
                  <li class="pb-2 transition-opacity duration-150 hover:opacity-75"><a class="text-normal" href="listar_compras.php">Listar compras</a></li>
                
                </ul>
              </div>
            </div>
            
           
          
         
          
          
          <div class="category-list">
            <div class="w-full bg-neutral h-[1px] mb-[21px] dark:bg-dark-neutral-border"></div>
            <h3 class="text-sm font-bold text-gray-1100 py-3 px-6 dark:text-gray-dark-1100">Categorias</h3>
            <?php
              include("connect.php");

              $sql = "
                  SELECT c.id_categoria, c.nome_categoria, COUNT(pc.id_prod) AS quantidade_produtos
                  FROM Categoria c, Produto_Categoria pc
                  WHERE c.id_categoria = pc.id_categoria
                  GROUP BY c.id_categoria, c.nome_categoria;
              ";

              $resultado = mysqli_query($cn, $sql);

              if (mysqli_num_rows($resultado) > 0) {
                  while ($row = mysqli_fetch_assoc($resultado)) {
                      echo '<div><a class="flex items-center justify-between py-3 pl-6" href="#">';
                      echo '<span class="text-gray-500 text-normal dark:text-gray-dark-500">' . $row["nome_categoria"] . '</span>';
                      echo '<div class="grid place-items-center rounded w-[18px] h-[18px] bg-yellow">';

                      echo '<p class="font-medium text-gray-1100 text-[11px] leading-[11px]">' . $row["quantidade_produtos"] . '</p>';
                      echo '</div>';
                      echo '</a></div>';
                  }
              } else {
                  echo 'Nenhuma categoria encontrada.';
              }
            ?>
              <div class="flex items-center gap-3 py-3 px-6 mb-[22px]"><img src="assets/images/icons/icon-add-square.svg" alt="add icon">
              <p class="text-sm font-bold text-gray-1100 dark:text-gray-dark-1100"><a href="regicateg.php">Adicionar categoria</a></p>
            </div>
<div class="brand-list">
    <div class="w-full bg-neutral h-[1px] mb-[21px] dark:bg-dark-neutral-border"></div>
    <h3 class="text-sm font-bold text-gray-1100 py-3 px-6 dark:text-gray-dark-1100">Marcas</h3>
    <?php
        include("connect.php");

        $sql = "
            SELECT m.id_marca, m.nome_marca, COUNT(p.id_prod) AS quantidade_produtos
            FROM Marca m
            LEFT JOIN Produto p ON m.id_marca = p.id_marca
            GROUP BY m.id_marca, m.nome_marca;
        ";

        $resultado = mysqli_query($cn, $sql);

        if (mysqli_num_rows($resultado) > 0) {
            while ($row = mysqli_fetch_assoc($resultado)) {
                echo '<div><a class="flex items-center justify-between py-3 pl-6" href="#">';
                echo '<span class="text-gray-500 text-normal dark:text-gray-dark-500">' . $row["nome_marca"] . '</span>';
                echo '<div class="grid place-items-center rounded w-[18px] h-[18px] bg-yellow">';
                echo '<p class="font-medium text-gray-1100 text-[11px] leading-[11px]">' . $row["quantidade_produtos"] . '</p>';
                echo '</div>';
                echo '</a></div>';
            }
        } else {
            echo 'Nenhuma marca encontrada.';
        }
    ?>
</div>
<div class="flex items-center gap-3 py-3 px-6 mb-[22px]"><img src="assets/images/icons/icon-add-square.svg" alt="add icon">
              <p class="text-sm font-bold text-gray-1100 dark:text-gray-dark-1100"><a href="introduzir_marca.php">Adicionar marca</a></p>
            </div>
          </div>

              
                 

            <div class="flex items-center gap-3 py-3 px-6 mb-[22px]"><img src="assets/images/icons/icon-add-square.svg" alt="add icon">
              <p class="text-sm font-bold text-gray-1100 dark:text-gray-dark-1100"><a href="regiform.php">Adicionar produto</a></p>
            </div>
            
            

        
        
      </aside>
      <header class="flex items-center justify-between flex-wrap bg-neutral-bg p-5 gap-5 md:py-6 md:pl-[25px] md:pr-[38px] lg:flex-nowrap dark:bg-dark-neutral-bg lg:gap-0"><a class="hidden logo" href="dashboard.php"><img class="md:mr-[100px] lg:mr-[133px]" src="assets/images/icons/icon-logo.svg" alt="Frox logo"></a>
 
        <div class="flex items-center order-2 user-noti gap-[30px] xl:gap-[48px] lg:order-3 lg:mr-0">
          <div class="dropdown dropdown-end">
            <label class="cursor-pointer dropdown-label" tabindex="0"><img src="uploads/user48.png" alt="user avatar">
            </label>
            <ul class="dropdown-content" tabindex="0" >
              <div class="relative menu rounded-box dropdown-shadow p-[25px] pb-[10px] bg-neutral-bg mt-[25px] md:mt-[40px] min-w-[237px] dark:text-gray-dark-500 dark:border-dark-neutral-border dark:bg-dark-neutral-bg">
                <div class="border-solid border-b-8 border-x-transparent border-x-8 border-t-0 absolute w-[14px] top-[-7px] border-b-neutral-bg dark:border-b-dark-neutral-bg right-[18px]"></div>
                <li class="text-gray-500 hover:text-gray-1100 hover:bg-gray-100 dark:text-gray-dark-500 dark:hover:text-gray-dark-1100 dark:hover:bg-gray-dark-100 rounded-lg group p-[15px] pl-[21px]"><a class="flex items-center bg-transparent p-0 gap-[7px]" href="editar_perfil.php?id_user=<?php echo $_SESSION['id_utilizador']?>"> <i class="w-4 h-4 grid place-items-center"><img class="group-hover:filter-black dark:group-hover:filter-white" src="assets/images/icons/icon-user.svg" alt="icon"></i><span>Editar</span></a>
                </li>
               
                <div class="w-full bg-neutral h-[1px] my-[7px] dark:bg-dark-neutral-border"></div>
                <li class="text-gray-500 hover:text-gray-1100 hover:bg-gray-100 dark:text-gray-dark-500 dark:hover:text-gray-dark-1100 dark:hover:bg-gray-dark-100 rounded-lg group p-[15px] pl-[21px]"><a class="flex items-center bg-transparent p-0 gap-[7px]" href="logout.php"> <i class="w-4 h-4 grid place-items-center"><img class="group-hover:filter-black dark:group-hover:filter-white" src="assets/images/icons/icon-logout.svg" alt="icon"></i><span>Log out</span></a>
                </li>
              </div>
            </ul>
          </div>
        </div>
        <h4 style="margin-top: 15px; color: white;">Bem-vindo(a), <?php echo $nome_utilizador; ?>!</h4>
        </header>
      <main class="overflow-x-scroll scrollbar-hide flex flex-col justify-between pt-[42px] px-[23px] pb-[28px]">
        <div>
          <h2 class="capitalize text-gray-1100 font-bold text-[28px] leading-[35px] dark:text-gray-dark-1100 mb-[13px]">dashboard</h2>
          <div class="flex items-center text-xs text-gray-500 gap-x-[11px] mb-[32px]">
            <div class="flex items-center gap-x-1"><img src="assets/images/icons/icon-home-2.svg" alt="home icon"><a class="capitalize" href="index.html">home</a></div><img src="assets/images/icons/icon-arrow-right.svg" alt="arrow right icon"><span class="capitalize text-color-brands">dashboard</span>
          </div>
          <div class="border rounded-2xl pt-5 pl-5 pr-6 bg-white border-neutral pb-[20px] dark:border-dark-neutral-border dark:bg-[#1F2128] mb-[39px]">
            <h3 class="font-normal text-gray-1100 text-base leading-4 mb-[23px] dark:text-gray-dark-1100">ID da venda: #<?=$id_pedido?></h3>
            <div class="flex justify-between flex-col gap-y-4 mb-[10px] lg:mb-[2px] lg:flex-row">
              <div class="flex items-center gap-x-2"> 
              </div>
              <div class="flex gap-4 flex-col sm:flex-row"> 
                
                           
              <br>
              </div>
            </div>
            <div class="w-full mb-5 bg-[#E8EDF2] dark:bg-[#313442] h-[1px]"></div>
            <div class="flex justify-between mb-12 flex-col gap-y-10 lg:flex-row">
              <div class="flex items-start gap-x-[10px]">
                <div class="w-12 h-12 flex items-center justify-center rounded-full bg-[#E8EDF2] dark:bg-[#313442]"><img class="dark:invert" src="assets/images/icons/icon-user.svg" alt="user icon"></div>
                <div class="flex flex-col gap-y-2">
                  <p class="text-sm leading-4 text-gray-1100 font-semibold dark:text-gray-dark-1100">Utilizador</p>
                  <p class="text-sm leading-4 text-gray-500 dark:text-gray-dark-500">Nome: <?= $campo_cliente['nome']?></p>
                  <p class="text-sm leading-4 text-gray-500 dark:text-gray-dark-500">E-mail: <?= $campo_cliente['email']?></p>
                  <p class="text-sm leading-4 text-gray-500 dark:text-gray-dark-500">Telefone: <?= $campo_cliente['telefone']?></p>
                  <p class="text-sm leading-4 text-gray-500 dark:text-gray-dark-500">Nif: <?= $campo_cliente['nif']?></p>
                </div>
              </div>
              <div class="flex items-start gap-x-[10px]">
                <div class="w-12 h-12 flex items-center justify-center rounded-full bg-[#E8EDF2] dark:bg-[#313442]"><img class="dark:invert" src="assets/images/icons/icon-bag-2.svg" alt="bag icon"></div>
                <div class="flex flex-col gap-y-2">
                  <p class="text-sm leading-4 text-gray-1100 font-semibold dark:text-gray-dark-1100">Informações da compra</p>
                  <?php 
                    $subtotal = $detalhe['preco_venda'] * $detalhe['quantidade'];
                    $total = $subtotal *1.23;
                  ?>
                  <p class="text-sm leading-4 text-gray-500 dark:text-gray-dark-500">Total: <?=number_format($total, 2, ',', '.')?></p>
                  <p class="text-sm leading-4 text-gray-500 dark:text-gray-dark-500">Data: <?= date('d/m/Y', strtotime($campo_venda['data_venda'])) ?></p>
                  
                </div>
              </div>
              <div class="flex items-start gap-x-[10px]">
                <div class="w-12 h-12 flex items-center justify-center rounded-full bg-[#E8EDF2] dark:bg-[#313442]"><img class="dark:invert" src="assets/images/icons/icon-send-2.svg" alt="send icon"></div>
                <div class="flex flex-col gap-y-2">
                  <p class="text-sm leading-4 text-gray-1100 font-semibold dark:text-gray-dark-1100">Entregue para:</p>
                  <p class="text-sm leading-4 text-gray-500 dark:text-gray-dark-500">Endereço: <?=$detalhe['endereco']?></p>
                  <p class="text-sm leading-4 text-gray-500 dark:text-gray-dark-500"><?=$detalhe['cidade']?></p>
                  <p class="text-sm leading-4 text-gray-500 dark:text-gray-dark-500"><?=$detalhe['cod_post']?></p>
                </div>
              </div>
            </div>
            
            <div class="w-full mb-10 bg-[#E8EDF2] dark:bg-[#313442] h-[1px]"></div>
            <p class="text-xl pl-5 text-gray-1100 font-semibold dark:text-gray-dark-1100 leading-[18px] mb-[28px] xl:pl-7">Products</p>
            <div class="overflow-x-scroll scrollbar-hide xl:overflow-x-hidden">
              <table class="w-full mb-6 min-w-[900px]"> 
                <tr class="border-b border-neutral dark:border-dark-neutral-border dark:border-[#313442] pb-[15px]"> 
                  <th class="font-medium text-base text-gray-1000 text-left pb-[15px] w-[342px] dark:text-gray-dark-1000">Produto</th>
                  <th class="font-medium text-base text-gray-1000 text-left pb-[15px] dark:text-gray-dark-1000">Quantidade</th>
                  <th class="font-medium text-base text-gray-1000 text-right pr-6 pb-[15px] dark:text-gray-dark-1000">Total</th>
                </tr>
                <?php
// Proteção contra SQL Injection
$id_pedido = isset($_GET['id_venda']) ? (int)$_GET['id_venda'] : 0;

// Verifica se há um ID válido
if ($id_pedido > 0) {
    // Consulta da venda
    $sql_venda = "SELECT * FROM venda WHERE id_venda = ?";
    $stmt_venda = mysqli_prepare($cn, $sql_venda);
    mysqli_stmt_bind_param($stmt_venda, "i", $id_pedido);
    mysqli_stmt_execute($stmt_venda);
    $result_venda = mysqli_stmt_get_result($stmt_venda);
    $campo_venda = mysqli_fetch_array($result_venda);

    // Consulta do cliente
    $sql_cliente = "SELECT * FROM utilizador WHERE id_user = ?";
    $stmt_cliente = mysqli_prepare($cn, $sql_cliente);
    mysqli_stmt_bind_param($stmt_cliente, "i", $campo_venda['id_user']);
    mysqli_stmt_execute($stmt_cliente);
    $result_cliente = mysqli_stmt_get_result($stmt_cliente);
    $campo_cliente = mysqli_fetch_array($result_cliente);

    // Consulta dos detalhes da venda
    $sql_detalhes = "SELECT dv.*, p.nome, p.preco_uni FROM detalhe_venda dv 
                     JOIN produto p ON dv.id_prod = p.id_prod 
                     WHERE dv.id_venda = ?";
    $stmt_detalhes = mysqli_prepare($cn, $sql_detalhes);
    mysqli_stmt_bind_param($stmt_detalhes, "i", $id_pedido);
    mysqli_stmt_execute($stmt_detalhes);
    $result_detalhes = mysqli_stmt_get_result($stmt_detalhes);

}

    // Calcular totais
    $total_geral = 0;
    ?>
              <?php while ($detalhe = mysqli_fetch_array($result_detalhes)) {
            $total = $detalhe['quantidade'] * $detalhe['preco_venda'];
            $total_geral += $total;
            ?>
                <tr class="border-b border-[#E8EDF2] dark:border-[#313442] pb-[15px]">
                  <td class="flex items-center gap-x-[30px] py-[15px]"><span class="text-base text-gray-500"><?= htmlspecialchars($detalhe['nome']) ?></span></td>
                  <td class="text-base text-gray-500">X <?= $detalhe['quantidade'] ?></td>
                  <td class="text-base text-gray-500 text-right pr-3">€ <?= number_format($detalhe['preco_venda'], 2, ',', '.') ?></td>
                </tr>
                <?php } ?>

              </table>
            </div>
            <?php
                $iva = $total_geral * 0.23; 
                $total = $total_geral + $iva;
            ?>
            <div class="flex items-center gap-x-36 justify-start lg:gap-x-48 sm:justify-end">
              <div class="flex flex-col gap-y-[15px]"> 
                <p class="text-sm leading-4 text-gray-500 dark:text-gray-dark-500">Subtotal:</p>
                <p class="text-sm leading-4 text-gray-500 dark:text-gray-dark-500">IVA(23%):</p>
                <p class="text-gray-500 font-semibold text-[20px] leading-[18px]">Total:</p>
              </div>
              <div class="flex flex-col text-right gap-y-[15px]"> 
                <p class="text-sm leading-4 text-gray-500 dark:text-gray-dark-500">€ <?=number_format($total_geral, 2, ',', '.')?></p>
                <p class="text-sm leading-4 text-gray-500 dark:text-gray-dark-500">€ <?=number_format($iva, 2, ',', '.')?></p>
                <p class="text-gray-500 font-semibold text-[20px] leading-[18px] dark:text-gray-dark-500">€ <?=number_format($total, 2, ',', '.')?></p>
              </div>
            </div>
          </div>
          
      </main>
    </div>
    <script type="text/javascript" src="assets/scripts/vendors/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="assets/scripts/chart-utils.min.js"></script>
    <script type="text/javascript" src="assets/scripts/chart.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/chartjs-chart-geo@3"></script>
    <script src="assets/scripts/app.js?v=5.0"></script>
  </body>
</html>