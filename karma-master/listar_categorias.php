<?php
session_start();
$nome_utilizador = isset($_SESSION['nome']) ? $_SESSION['nome'] : '';
?>
<!DOCTYPE html>
<html class="scroll-smooth overflow-x-hidden" lang="en">
  <head>
    <meta charset="utf-8">
    <title>Product List Page</title>
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
        .fa-arrows-up-down {
            display: none;
        }

        .fa-arrow-up {
            color: #0d6efd;
        }

        .fa-arrow-down {
            color: #dc3545;
        }

        th {
            cursor: pointer;
        }
      
        th span {
            font-size: 0.8em;
        }

        th span i {
            font-size: 0.8em;
        }
        
        .delete-produto {
            color: #dc3545;
            cursor: pointer;
        }

        .delete-produto:hover {
            color: #a71d2a;
        }

        .edit-produto:hover {
            color:rgb(145, 13, 253);
        }

        .delete-produto:active {
            color: #6c757d;
        }

        .delete-produto:focus {
            color: #dc3545;
        }

        .delete-produto, .edit-produto i {
            font-size: 1.2em;

        }
        table tbody tr {
        line-height: 2 !important;/* Ajuste conforme necessário */
    }

    table tbody tr td {
        padding: 12px 8px !important;/* Ajuste conforme necessário */
    }
        
    </style>
  </head>
  <body class="w-screen relative overflow-x-hidden min-h-screen bg-gray-100 scrollbar-hide product-list-page dark:bg-[#000]">
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
          <div class="flex items-center justify-between mb-[19px]">
            <div>
              <h2 class="capitalize text-gray-1100 font-bold text-[28px] leading-[35px] dark:text-gray-dark-1100 mb-[13px]">Todas Categorias</h2>
              <div class="flex items-center justify-between">
                <div class="flex items-center text-xs text-gray-500 gap-x-[11px]">
                  <div class="flex items-center gap-x-1"><img src="assets/images/icons/icon-home-2.svg" alt="home icon"><span class="capitalize">home</span></div><img src="assets/images/icons/icon-arrow-right.svg" alt="arrow right icon"><span class="capitalize text-color-brands">Todas categorias</span>
                </div>
              </div>
            </div>
          </div>
          <div class="border p-6 bg-neutral-bg rounded-2xl border-neutral pb-0 overflow-x-scroll scrollbar-hide dark:bg-dark-neutral-bg dark:border-dark-neutral-border mb-[52px] xl:overflow-x-hidden">
    <div class="text-base leading-5 text-gray-1100 font-semibold mb-6 dark:text-gray-dark-1100">Categorias</div>
    <table class="w-full min-w-[900px]">
        <thead>
            <tr class="border-b border-neutral dark:border-dark-neutral-border pb-[15px]"> 
                <th class="font-normal text-normal text-gray-400 text-left pb-[15px] dark:text-gray-dark-400" onclick="sortTable(0)">ID<span id="arrow-0"><i class="fa-solid fa-arrows-up-down"></i></span></th>
                <th class="font-normal text-normal text-gray-400 text-left pb-[15px] dark:text-gray-dark-400" onclick="sortTable(1)">Nome<span id="arrow-1"><i class="fa-solid fa-arrows-up-down"></i></span></th>
                <th class="font-normal text-normal text-gray-400 text-left pb-[15px] dark:text-gray-dark-400" onclick="sortTable(2)">Descrição<span id="arrow-2"><i class="fa-solid fa-arrows-up-down"></i></span></th>
                <th class="font-normal text-normal text-gray-400 text-left pb-[15px] dark:text-gray-dark-400" onclick="sortTable(3)">Número de produtos<span id="arrow-3"><i class="fa-solid fa-arrows-up-down"></i></span></th>
                <th class="font-normal text-normal text-gray-400 text-left pb-[15px] dark:text-gray-dark-400">Editar</th>
                <th class="font-normal text-normal text-gray-400 text-center pb-[15px] dark:text-gray-dark-400">Eliminar</th>
            </tr>
        </thead>
        <tbody> 
        <?php
include 'connect.php';

// Consulta para buscar categorias e quantidade de produtos relacionados
$sql = "
SELECT c.id_categoria, c.nome_categoria, c.descricao, 
       COUNT(pc.id_prod) AS quantidade_produtos
FROM Categoria c
LEFT JOIN Produto_Categoria pc ON c.id_categoria = pc.id_categoria
GROUP BY c.id_categoria, c.nome_categoria, c.descricao;
";

$resultado = mysqli_query($cn, $sql);

if (!$resultado) {
    error_log("Erro na consulta: " . mysqli_error($cn));
    echo '<tr><td colspan="6">Erro ao carregar dados.</td></tr>';
    exit;
}

if (mysqli_num_rows($resultado) > 0) {
    while ($row = mysqli_fetch_assoc($resultado)) {
       
      $descricao = htmlspecialchars($row["descricao"], ENT_QUOTES, 'UTF-8');
      $descricao_formatada = mb_strimwidth($descricao, 0, 40, "...");
        echo '<tr>';
        echo '<td class="text-gray-1100 text-normal dark:text-gray-dark-1100">' . htmlspecialchars($row["id_categoria"], ENT_QUOTES, 'UTF-8') . '</td>';
        echo '<td class="text-gray-1100 text-normal dark:text-gray-dark-1100">' . htmlspecialchars($row["nome_categoria"], ENT_QUOTES, 'UTF-8') . '</td>';
        echo '<td class="text-gray-1100 text-normal dark:text-gray-dark-1100">' . $descricao_formatada . '</td>';
        echo '<td class="text-gray-1100 text-normal dark:text-gray-dark-1100">' . intval($row["quantidade_produtos"]) . '</td>';
        echo '<td class="text-gray-1100 text-normal dark:text-gray-dark-1100"><a href="editar_categoria.php?id=' . urlencode($row["id_categoria"]) . '"><i class="fas fa-edit edit-produto"></i></a></td>';
        echo '<td class="text-gray-1100 text-normal dark:text-gray-dark-1100" style="text-align: center;"><a href="eliminar_categoria.php?id=' . urlencode($row["id_categoria"]) . '"><i class="fas fa-trash-alt delete-produto"></i></a></td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="6">Nenhuma categoria encontrada.</td></tr>';
}
?>

        </tbody>
    </table>
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