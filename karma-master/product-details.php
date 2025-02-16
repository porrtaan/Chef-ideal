<?php
session_start();
$nome_utilizador = isset($_SESSION['nome']) ? $_SESSION['nome'] : '';
?>
<!DOCTYPE html>
<html class="scroll-smooth overflow-x-hidden" lang="en">
  <head>
    <meta charset="utf-8">
    <title>Product Details Page</title>
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
  <body class="w-screen relative overflow-x-hidden min-h-screen bg-gray-100 scrollbar-hide product-details-page dark:bg-[#000]">
  <div class="wrapper mx-auto text-gray-900 font-normal grid scrollbar-hide grid-cols-[257px,1fr] grid-rows-[auto,1fr]" id="layout">
      <aside class="bg-white row-span-2 border-r border-neutral relative flex flex-col justify-between p-[25px] dark:bg-dark-neutral-bg dark:border-dark-neutral-border"> 
        <div class="absolute p-2 border-neutral right-0 border bg-white rounded-full cursor-pointer duration-300 translate-x-1/2 hover:opacity-75 dark:bg-dark-neutral-bg dark:border-dark-neutral-border" id="sidebar-btn"><img src="assets/images/icons/icon-arrow-left.svg" alt="left chevron icon"></div>
        <div><a class="mb-10" href="dashboard.php"> <img class="logo-maximize" src="assets/images/icons/icon-logo.svg" alt="Frox logo"><img class="logo-minimize ml-[10px]" src="assets/images/icons/icon-favicon.svg" alt="Frox logo"></a>
          <div class="pt-[106px] lg:pt-[35px] pb-[18px]">
            <div class="sidemenu-item rounded-xl relative">
              <input class="sr-only peer" type="checkbox" value="dashboard" name="sidemenu" id="dashboard">
              <label class="flex items-center justify-between w-full cursor-pointer py-[17px] px-[21px] focus:outline-none peer-checked:border-transparent active" for="dashboard">
                <div class="flex items-center gap-[10px]"><img src="assets/images/icons/icon-favorite-chart.svg" alt="side menu icon"><span class="text-normal font-semibold text-gray-500 sidemenu-title dark:text-gray-dark-500">Dashboard</span></div>
              </label><img class="absolute right-2 transition-all duration-150 caret-icon pointer-events-none peer-checked:rotate-180 top-[22px]" src="assets/images/icons/icon-arrow-down.svg" alt="caret icon">
              <div class="hidden peer-checked:block">
                <ul class="text-gray-300 child-menu z-10 pl-[53px]">
                  <li class="pb-2 transition-opacity duration-150 hover:opacity-75"><a class="text-normal" href="index.html">Dashboard</a></li>
                  <li class="pb-2 transition-opacity duration-150 hover:opacity-75"><a class="text-normal" href="clients-list.php">Listar Registos</a></li>
                  <li class="pb-2 transition-opacity duration-150 hover:opacity-75"><a class="text-normal" href="product-list.php">Listar produtos</a></li>
                  <li class="pb-2 transition-opacity duration-150 hover:opacity-75"><a class="text-normal" href="listar_categorias.php">Listar categorias</a></li>
                  <li class="pb-2 transition-opacity duration-150 hover:opacity-75"><a class="text-normal" href="listar_marca.php">Listar marcas</a></li>
                  <li class="pb-2 transition-opacity duration-150 hover:opacity-75"><a class="text-normal" href="listar_compras.php">Listar compras</a></li>
                  <li class="pb-2 transition-opacity duration-150 hover:opacity-75"><a class="text-normal" href="regiform.php">Introduzir produtos</a></li>
                  <li class="pb-2 transition-opacity duration-150 hover:opacity-75"><a class="text-normal" href="introduzir_marca.php">Introduzir marca</a></li>
                
                </ul>
              </div>
            </div>
           
          <div class="category-list">
            <div class="w-full bg-neutral h-[1px] mb-[21px] dark:bg-dark-neutral-border"></div>
            <h3 class="text-sm font-bold text-gray-1100 py-3 px-6 dark:text-gray-dark-1100">Marcas</h3>
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
          <h2 class="capitalize text-gray-1100 font-bold text-[28px] leading-[35px] dark:text-gray-dark-1100 mb-[13px]">product details</h2>
          <div class="flex items-center text-xs text-gray-500 gap-x-[11px] mb-[17px]">
            <div class="flex items-center gap-x-1"><img src="assets/images/icons/icon-home-2.svg" alt="home icon"><a class="capitalize" href="index.html">home</a></div><img src="assets/images/icons/icon-arrow-right.svg" alt="arrow right icon"><span class="capitalize text-color-brands">product details</span>
          </div>
          <div class="flex gap-x-12 border rounded-2xl justify-between flex-col gap-y-12 bg-white border-neutral pt-[50px] pb-[132px] px-[29px] dark:border-dark-neutral-border lg:flex-row lg:gap-y-0 dark:bg-[#1F2128]">
            <div class="lg:max-w-[610px]">
              <p class="text-gray-1100 text-base leading-4 font-medium capitalize mb-[10px] dark:text-gray-dark-1100">product name</p>
              <div class="input-group border rounded-lg border-[#E8EDF2] dark:border-[#313442] sm:min-w-[252px] mb-12">
                <input class="input bg-transparent text-sm leading-4 text-gray-400 h-fit min-h-fit py-4 focus:outline-none pl-[13px] dark:text-gray-dark-400 placeholder:text-inherit" type="text" placeholder="Type name here">
              </div>
              <p class="text-gray-1100 text-base leading-4 font-medium capitalize mb-[10px] dark:text-gray-dark-1100">Description</p>
              <div class="rounded-lg mb-12 border border-neutral dark:border-dark-neutral-border p-[13px]">
                <div class="flex items-center gap-y-4 flex-col gap-x-[27px] mb-[31px] xl:flex-row xl:gap-y-0">
                  <div class="flex items-center gap-x-[20px]"><img class="cursor-pointer" src="assets/images/icons/icon-bold.svg" alt="bold icon"><img class="cursor-pointer" src="assets/images/icons/icon-italicized.svg" alt="italicized icon"><img class="cursor-pointer" src="assets/images/icons/icon-underlined.svg" alt="underlined icon"><img class="cursor-pointer" src="assets/images/icons/icon-strikethrough.svg" alt="strikethrough icon"><img class="cursor-pointer" src="assets/images/icons/icon-textcolor.svg" alt="textcolor icon"><img class="cursor-pointer" src="assets/images/icons/icon-backgroundcolor.svg" alt="backgroundcolor icon"><img class="cursor-pointer" src="assets/images/icons/icon-smile.svg" alt="smile icon"></div>
                  <div class="flex items-center gap-x-[20px]">
                    <div class="flex items-center cursor-pointer gap-x-[1.5px]"><img src="assets/images/icons/icon-paragraphformat.svg" alt="paragraphformat icon"><img src="assets/images/icons/icon-arrow-down-triangle.svg" alt="arrow down triangle icon"></div>
                    <div class="flex items-center cursor-pointer gap-x-[1.5px]"><img src="assets/images/icons/icon-align-left.svg" alt="align left icon"><img src="assets/images/icons/icon-arrow-down-triangle.svg" alt="arrow down triangle icon"></div>
                    <div class="flex items-center cursor-pointer gap-x-[1.5px]"><img src="assets/images/icons/icon-ordered-list.svg" alt="ordered list icon"><img src="assets/images/icons/icon-arrow-down-triangle.svg" alt="arrow down triangle icon"></div>
                    <div class="flex items-center cursor-pointer gap-x-[1.5px]"><img src="assets/images/icons/icon-unordered-list.svg" alt="unordered list icon"><img src="assets/images/icons/icon-arrow-down-triangle.svg" alt="arrow down triangle icon"></div><img class="cursor-pointer" src="assets/images/icons/icon-indent.svg" alt="indent icon"><img class="cursor-pointer opacity-40" src="assets/images/icons/icon-indent.svg" alt="outdent icon">
                  </div>
                  <div class="flex items-center gap-x-[20px]"><img class="cursor-pointer" src="assets/images/icons/icon-insert-image.svg" alt="insert image icon"><img class="cursor-pointer" src="assets/images/icons/icon-insert-link.svg" alt="insert link icon"><img class="cursor-pointer" src="assets/images/icons/icon-insert-file.svg" alt="insert-file icon"><img class="cursor-pointer" src="assets/images/icons/icon-insert-video.svg" alt="insert video icon"><img class="cursor-pointer opacity-40" src="assets/images/icons/icon-undo.svg" alt="undo icon"><img class="cursor-pointer opacity-40" src="assets/images/icons/icon-redo.svg" alt="redo icon"></div>
                </div>
                <textarea class="textarea w-full p-0 text-gray-400 resize-none rounded-none bg-transparent min-h-[140px] focus:outline-none" placeholder="Type description here"></textarea>
              </div>
              <p class="text-gray-1100 text-base leading-4 font-medium capitalize mb-[10px] dark:text-gray-dark-1100">category</p>
              <select class="select w-full border rounded-lg font-normal text-sm leading-4 text-gray-400 py-4 h-fit min-h-fit border-[#E8EDF2] dark:border-[#313442] focus:outline-none pl-[13px] min-w-[252px] dark:text-gray-dark-400 mb-12">
                <option disabled="" selected="">Type Category here</option>
                <option>Homer</option>
                <option>Marge</option>
                <option>Bart</option>
              </select>
              <p class="text-gray-1100 text-base leading-4 font-medium capitalize mb-[10px] dark:text-gray-dark-1100">brand</p>
              <select class="select w-full border rounded-lg font-normal text-sm leading-4 text-gray-400 py-4 h-fit min-h-fit border-[#E8EDF2] dark:border-[#313442] focus:outline-none pl-[13px] min-w-[252px] dark:text-gray-dark-400 mb-12">
                <option disabled="" selected="">Type Brand name here</option>
                <option>Homer</option>
                <option>Marge</option>
                <option>Bart</option>
              </select>
              <div class="flex justify-between flex-col lg:flex-row">
                <div> 
                  <p class="text-gray-1100 text-base leading-4 font-medium capitalize mb-[10px] dark:text-gray-dark-1100">SKU</p>
                  <div class="input-group border rounded-lg border-[#E8EDF2] dark:border-[#313442] sm:min-w-[252px] mb-12">
                    <input class="input bg-transparent text-sm leading-4 text-gray-400 h-fit min-h-fit py-4 focus:outline-none pl-[13px] dark:text-gray-dark-400 placeholder:text-inherit" type="text" placeholder="FOX-2983">
                  </div>
                  <p class="text-gray-1100 text-base leading-4 font-medium capitalize mb-[10px] dark:text-gray-dark-1100">Regular Price</p>
                  <div class="input-group border rounded-lg border-[#E8EDF2] dark:border-[#313442] sm:min-w-[252px] mb-12">
                    <input class="input bg-transparent text-sm leading-4 text-gray-400 h-fit min-h-fit py-4 focus:outline-none pl-[13px] dark:text-gray-dark-400 placeholder:text-inherit" type="text" placeholder="$500">
                  </div>
                  <p class="text-gray-1100 text-base leading-4 font-medium capitalize mb-[10px] dark:text-gray-dark-1100">Tax status</p>
                  <select class="select w-full border rounded-lg font-normal text-sm leading-4 text-gray-400 py-4 h-fit min-h-fit border-[#E8EDF2] dark:border-[#313442] focus:outline-none pl-[13px] min-w-[252px] dark:text-gray-dark-400 mb-12">
                    <option disabled="" selected="">Taxable</option>
                    <option>Homer</option>
                    <option>Marge</option>
                    <option>Bart</option>
                  </select>
                </div>
                <div> 
                  <p class="text-gray-1100 text-base leading-4 font-medium capitalize mb-[10px] dark:text-gray-dark-1100">Stock quantity</p>
                  <div class="input-group border rounded-lg border-[#E8EDF2] dark:border-[#313442] sm:min-w-[252px] mb-12">
                    <input class="input bg-transparent text-sm leading-4 text-gray-400 h-fit min-h-fit py-4 focus:outline-none pl-[13px] dark:text-gray-dark-400 placeholder:text-inherit" type="text" placeholder="1258">
                  </div>
                  <p class="text-gray-1100 text-base leading-4 font-medium capitalize mb-[10px] dark:text-gray-dark-1100">Sale price</p>
                  <div class="input-group border rounded-lg border-[#E8EDF2] dark:border-[#313442] sm:min-w-[252px] mb-12">
                    <input class="input bg-transparent text-sm leading-4 text-gray-400 h-fit min-h-fit py-4 focus:outline-none pl-[13px] dark:text-gray-dark-400 placeholder:text-inherit" type="text" placeholder="$450">
                  </div>
                  <p class="text-gray-1100 text-base leading-4 font-medium capitalize mb-[10px] dark:text-gray-dark-1100">Tax class</p>
                  <select class="select w-full border rounded-lg font-normal text-sm leading-4 text-gray-400 py-4 h-fit min-h-fit border-[#E8EDF2] dark:border-[#313442] focus:outline-none pl-[13px] min-w-[252px] dark:text-gray-dark-400 mb-12">
                    <option disabled="" selected="">Standard</option>
                    <option>Homer</option>
                    <option>Marge</option>
                    <option>Bart</option>
                  </select>
                </div>
              </div>
              <p class="text-gray-1100 text-base leading-4 font-medium capitalize mb-[10px] dark:text-gray-dark-1100">tag</p>
              <div class="flex items-center border flex-wrap rounded-lg border-neutral gap-x-[10px] dark:border-dark-neutral-border pt-[15px] pl-[15px] pr-[23px] pb-[66px]">
                <div class="flex items-center py-1 px-2 gap-x-[5px] mb-[10px] bg-[#E8EDF2] dark:bg-[#313442] rounded-[5px]"><span class="text-xs text-gray-400">smartwatch</span><img class="cursor-pointer" src="assets/images/icons/icon-close.svg" alt="close icon"></div>
                <div class="flex items-center py-1 px-2 gap-x-[5px] mb-[10px] bg-[#E8EDF2] dark:bg-[#313442] rounded-[5px]"><span class="text-xs text-gray-400">Apple</span><img class="cursor-pointer" src="assets/images/icons/icon-close.svg" alt="close icon"></div>
                <div class="flex items-center py-1 px-2 gap-x-[5px] mb-[10px] bg-[#E8EDF2] dark:bg-[#313442] rounded-[5px]"><span class="text-xs text-gray-400">Watch</span><img class="cursor-pointer" src="assets/images/icons/icon-close.svg" alt="close icon"></div>
                <div class="flex items-center py-1 px-2 gap-x-[5px] mb-[10px] bg-[#E8EDF2] dark:bg-[#313442] rounded-[5px]"><span class="text-xs text-gray-400">smartphone</span><img class="cursor-pointer" src="assets/images/icons/icon-close.svg" alt="close icon"></div>
                <div class="flex items-center py-1 px-2 gap-x-[5px] mb-[10px] bg-[#E8EDF2] dark:bg-[#313442] rounded-[5px]"><span class="text-xs text-gray-400">iPhone13 max</span><img class="cursor-pointer" src="assets/images/icons/icon-close.svg" alt="close icon"></div>
                <div class="flex items-center py-1 px-2 gap-x-[5px] mb-[10px] bg-[#E8EDF2] dark:bg-[#313442] rounded-[5px]"><span class="text-xs text-gray-400">iPhone13 max</span><img class="cursor-pointer" src="assets/images/icons/icon-close.svg" alt="close icon"></div>
                <div class="flex items-center py-1 px-2 gap-x-[5px] mb-[10px] bg-[#E8EDF2] dark:bg-[#313442] rounded-[5px]"><span class="text-xs text-gray-400">iPhone13 max</span><img class="cursor-pointer" src="assets/images/icons/icon-close.svg" alt="close icon"></div>
                <div class="flex items-center py-1 px-2 gap-x-[5px] mb-[10px] bg-[#E8EDF2] dark:bg-[#313442] rounded-[5px]"><span class="text-xs text-gray-400">iPhone13 max</span><img class="cursor-pointer" src="assets/images/icons/icon-close.svg" alt="close icon"></div>
                <div class="flex items-center py-1 px-2 gap-x-[5px] mb-[10px] bg-[#E8EDF2] dark:bg-[#313442] rounded-[5px]"><span class="text-xs text-gray-400">iPhone13 max</span><img class="cursor-pointer" src="assets/images/icons/icon-close.svg" alt="close icon"></div>
                <div class="flex items-center py-1 px-2 gap-x-[5px] mb-[10px] bg-[#E8EDF2] dark:bg-[#313442] rounded-[5px]"><span class="text-xs text-gray-400">iPhone13 max</span><img class="cursor-pointer" src="assets/images/icons/icon-close.svg" alt="close icon"></div>
                <div class="flex items-center py-1 px-2 gap-x-[5px] mb-[10px] bg-[#E8EDF2] dark:bg-[#313442] rounded-[5px]"><span class="text-xs text-gray-400">iPhone13 max</span><img class="cursor-pointer" src="assets/images/icons/icon-close.svg" alt="close icon"></div>
              </div>
            </div>
            <div><img class="block border rounded-lg mb-12 mx-auto border-neutral dark:border-dark-neutral-border p-[23.8px]" src="assets/images/product-12.png" alt="product">
              <p class="text-gray-1100 text-base leading-4 font-medium capitalize mb-[10px] dark:text-gray-dark-1100">product gallery</p>
              <div class="border-dashed border-2 text-center mb-12 border-neutral py-[26px] dark:border-dark-neutral-border"><img class="mx-auto inline-block mb-[15px]" src="assets/images/icons/icon-image.svg" alt="image icon">
                <p class="text-sm leading-6 text-gray-500 font-normal mb-[5px]">Drop your image here, or browse</p>
                <p class="leading-6 text-gray-400 text-[13px]">JPG,PNG and GIF files are allowed</p>
              </div>
              <div class="flex flex-col mb-12 gap-y-[10px]">
                <div class="flex items-center justify-between py-3 border pl-3 pr-3 transition-all duration-300 border-[#E8EDF2] dark:border-[#313442] rounded-[5px] gap-x-[10px] hover:shadow-xl sm:pr-8 lg:pr-3 xl:pr-8"><img class="hidden sm:block lg:hidden xl:block" src="assets/images/product-1.png" alt="product">
                  <div class="flex flex-col flex-1 gap-y-[10px]">
                    <div class="flex items-center justify-between text-[13px]"> <span class="text-gray-1100 text-sm leading-4 dark:text-gray-dark-1100">Product_thumbnail_1.png</span><span class="text-xs text-gray-1100 dark:text-gray-dark-1100">1%</span></div>
                    <progress class="progress progress-accent" value="1" max="100"></progress>
                  </div><img src="assets/images/icons/icon-close-circle.svg" alt="close circle icon">
                </div>
                <div class="flex items-center justify-between py-3 border pl-3 pr-3 transition-all duration-300 border-[#E8EDF2] dark:border-[#313442] rounded-[5px] gap-x-[10px] hover:shadow-xl sm:pr-8 lg:pr-3 xl:pr-8"><img class="hidden sm:block lg:hidden xl:block" src="assets/images/product-2.png" alt="product">
                  <div class="flex flex-col flex-1 gap-y-[10px]">
                    <div class="flex items-center justify-between text-[13px]"><span class="text-gray-1100 text-sm leading-4 dark:text-gray-dark-1100">Product_thumbnail_2.png</span></div>
                    <progress class="progress progress-accent" value="100" max="100"></progress>
                  </div><img src="assets/images/icons/icon-check-circle.svg" alt="check circle icon">
                </div>
                <div class="flex items-center justify-between py-3 border pl-3 pr-3 transition-all duration-300 border-[#E8EDF2] dark:border-[#313442] rounded-[5px] gap-x-[10px] hover:shadow-xl sm:pr-8 lg:pr-3 xl:pr-8"><img class="hidden sm:block lg:hidden xl:block" src="assets/images/product-3.png" alt="product">
                  <div class="flex flex-col flex-1 gap-y-[10px]">
                    <div class="flex items-center justify-between text-[13px]"><span class="text-gray-1100 text-sm leading-4 dark:text-gray-dark-1100">Product_thumbnail_3.png</span></div>
                    <progress class="progress progress-accent" value="100" max="100"></progress>
                  </div><img src="assets/images/icons/icon-check-circle.svg" alt="check circle icon">
                </div>
                <div class="flex items-center justify-between py-3 border pl-3 pr-3 transition-all duration-300 border-[#E8EDF2] dark:border-[#313442] rounded-[5px] gap-x-[10px] hover:shadow-xl sm:pr-8 lg:pr-3 xl:pr-8"><img class="hidden sm:block lg:hidden xl:block" src="assets/images/product-4.png" alt="product">
                  <div class="flex flex-col flex-1 gap-y-[10px]">
                    <div class="flex items-center justify-between text-[13px]"><span class="text-gray-1100 text-sm leading-4 dark:text-gray-dark-1100">Product_thumbnail_4.png</span></div>
                    <progress class="progress progress-accent" value="100" max="100"></progress>
                  </div><img src="assets/images/icons/icon-check-circle.svg" alt="check circle icon">
                </div>
                <div class="flex items-center justify-between py-3 border pl-3 pr-3 transition-all duration-300 border-[#E8EDF2] dark:border-[#313442] rounded-[5px] gap-x-[10px] hover:shadow-xl sm:pr-8 lg:pr-3 xl:pr-8"><img class="hidden sm:block lg:hidden xl:block" src="assets/images/product-5.png" alt="product">
                  <div class="flex flex-col flex-1 gap-y-[10px]">
                    <div class="flex items-center justify-between text-[13px]"><span class="text-gray-1100 text-sm leading-4 dark:text-gray-dark-1100">Product_thumbnail_5.png</span></div>
                    <progress class="progress progress-accent" value="100" max="100"></progress>
                  </div><img src="assets/images/icons/icon-check-circle.svg" alt="check circle icon">
                </div>
              </div>
              <div class="flex items-center gap-x-4 flex-wrap gap-y-4">
                <button class="btn normal-case h-fit min-h-fit transition-all duration-300 border-4 bg-color-brands hover:bg-color-brands hover:border-[#B2A7FF] dark:hover:border-[#B2A7FF] border-neutral-bg px-6 dark:border-dark-neutral-bg py-[14px]">Update</button>
                <button class="btn normal-case h-fit min-h-fit transition-all duration-300 px-6 border-0 text-white bg-[#E23738] hover:!bg-[#ef6364] hover:text-white py-[14px]">Delete</button>
                <button class="btn normal-case h-fit min-h-fit transition-all duration-300 px-6 border-0 bg-[#E8EDF2] text-[#B8B1E4] hover:!bg-[#bdbec0] hover:text-white dark:bg-[#313442] dark:hover:!bg-[#424242] py-[14px]">Cancel</button>
              </div>
            </div>
          </div>
          <label class="btn modal-button absolute left-[-1000px]" for="details-modal">details</label>
          <input class="modal-toggle" type="checkbox" id="details-modal">
          <div class="modal">
            <div class="modal-box relative bg-neutral-bg scrollbar-hide dark:bg-dark-neutral-bg">
              <label class="absolute right-2 top-2 cursor-pointer" for="details-modal"><img src="assets/images/icons/icon-close-modal.svg" alt="close modal button"></label>
              <h6 class="text-header-6 font-semibold text-gray-500 dark:text-gray-dark-500 mb-[49px]">Transaction Details</h6>
              <div class="flex items-center gap-6 mb-10">
                <div> <img src="assets/images/nasa.png" alt="Nasa logo"></div>
                <div> 
                  <p class="text-header-7 font-bold text-gray-1100 mb-2 dark:text-gray-dark-1100">Transfer $68.25 to Nasa.,JSC</p>
                  <p class="text-sm leading-4 text-gray-500 dark:text-gray-dark-500 mb-[21px]">On 22 January 2022 At 15:39 GMT</p>
                  <div class="border border-neutral bg-transparent flex items-center gap-3 px-5 w-fit rounded-[72px] py-[12px]">
                    <div class="rounded-full w-[10px] h-[10px] bg-green"></div>
                    <p class="font-medium text-xs text-green">Active</p>
                  </div>
                </div>
              </div>
              <div class="flex items-end justify-between mb-[76px]">
                <div class="flex items-start gap-x-[10px]">
                  <div class="w-12 h-12 flex items-center justify-center rounded-full bg-[#E8EDF2] dark:bg-[#313442]"><img class="dark:invert" src="assets/images/icons/icon-user.svg" alt="user icon"></div>
                  <div class="flex flex-col gap-y-2">
                    <p class="text-sm leading-4 text-gray-1100 font-semibold dark:text-gray-dark-1100">Send to</p>
                    <p class="text-sm leading-4 text-gray-500 dark:text-gray-dark-500">Jane Cooper</p>
                    <p class="text-sm leading-4 text-gray-500 dark:text-gray-dark-500">E-mail: tim.jennings@example.com</p>
                    <p class="text-sm leading-4 text-gray-500 dark:text-gray-dark-500">Phone: +099 856 245</p>
                  </div>
                </div>
                <div class="capitalize text-xs text-color-brands py-2 rounded-lg px-[13.5px] bg-[#E8EDF2] dark:bg-[#313442] max-w-[114px]">$ 68,125.25</div>
              </div>
              <div class="flex items-end justify-between mb-2">
                <div class="flex items-start gap-x-[10px]">
                  <div class="w-12 h-12 flex items-center justify-center rounded-full bg-[#E8EDF2] dark:bg-[#313442]"><img class="dark:invert" src="assets/images/icons/icon-home-hashtag.svg" alt="home icon"></div>
                  <div class="flex flex-col gap-y-2">
                    <p class="text-sm leading-4 text-gray-1100 font-semibold dark:text-gray-dark-1100">Bank Details</p>
                    <p class="text-sm leading-4 text-gray-500 dark:text-gray-dark-500">967-400 026789758</p>
                    <p class="text-sm leading-4 text-gray-500 dark:text-gray-dark-500">Sparkasse credit</p>
                    <p class="text-sm leading-4 text-gray-500 dark:text-gray-dark-500">Invoice ID: #12546872</p>
                  </div>
                </div>
                <div class="capitalize text-xs text-color-brands py-2 rounded-lg px-[13.5px] bg-[#E8EDF2] dark:bg-[#313442] max-w-[114px]">$250</div>
              </div>
              <div class="w-full bg-neutral h-[1px] dark:bg-dark-neutral-border mb-[67px]"></div>
              <div class="flex items-center justify-between flex-wrap gap-3">
                <div class="flex items-center gap-[15px]">
                  <button class="border-0 capitalize font-semibold py-4 px-8 text-gray-500 bg-neutral flex items-center gap-2 text-[12px] leading-[21px] dark:text-gray-dark-500 dark:bg-dark-neutral-border hover:opacity-80 rounded-[10px]"> 
                    <p>Print</p><i> <img src="assets/images/icons/icon-printer.svg" alt="print icon"></i>
                  </button>
                  <button class="bg-transparent font-semibold flex items-center text-[12px] leading-[21px] dark:text-gray-dark-500 hover:opacity-80 rounded-[10px] gap-[10px]"> 
                    <p>Download Pdf</p><i> <img src="assets/images/icons/icon-down.svg" alt="down icon"></i>
                  </button>
                </div>
                <button class="border-0 capitalize font-semibold py-4 px-8 text-gray-500 bg-neutral flex items-center gap-2 text-[12px] leading-[21px] dark:text-gray-dark-500 dark:bg-dark-neutral-border hover:opacity-80 rounded-[10px]"> 
                  <p>Issue Refund</p><i> <img src="assets/images/icons/icon-refunds.svg" alt="print icon"></i>
                </button>
              </div>
            </div>
          </div>
          <label class="btn modal-button absolute left-[-1000px]" for="project-modal">project</label>
          <input class="modal-toggle" type="checkbox" id="project-modal">
          <div class="modal">
            <div class="modal-box relative bg-neutral-bg scrollbar-hide dark:bg-dark-neutral-bg pt-[53px]">
              <label class="absolute right-2 top-2 cursor-pointer" for="project-modal"><img src="assets/images/icons/icon-close-modal.svg" alt="close modal button"></label>
              <div class="flex items-center justify-center flex-col">
                <h6 class="text-header-6 font-semibold text-gray-500 text-center dark:text-gray-dark-500 mb-[38px]">Create a New Project</h6>
                <div class="cursor-pointer show-add-project-2"><img class="hover:opacity-80 mb-[29px] dark:hidden" src="assets/images/icons/add-project.svg" width="92" height="92" alt="add project icon"><img class="hidden hover:opacity-80 mb-[29px] dark:block" src="assets/images/icons/add-project-dark.svg" width="92" height="92" alt="add project icon"></div>
                <p class="text-sm leading-4 text-gray-1100 dark:text-gray-dark-1100 mb-[6px]">Blank project</p>
                <p class="text-desc text-gray-400 dark:text-gray-dark-400 mb-[61px]">Start from scratch</p>
                <div class="flex items-center gap-[6px]">
                  <button class="btn normal-case h-fit min-h-fit transition-all duration-300 border-4 bg-color-brands hover:bg-color-brands hover:border-[#B2A7FF] dark:hover:border-[#B2A7FF] border-neutral-bg w-fit dark:border-dark-neutral-bg py-[7px] px-[16.5px]">Templates</button>
                  <button class="btn normal-case h-fit min-h-fit transition-all duration-300 border-4 bg-gray-500 hover:bg-white hover:text-black hover:border-gray-300 dark:hover:border-gray-dark-300 border-neutral-bg w-fit dark:border-dark-neutral-bg py-[7px] px-[19px]">Cancel</button>
                </div>
              </div>
            </div>
          </div>
          <label class="btn modal-button absolute left-[-1000px]" for="add-modal">add</label>
          <input class="modal-toggle" type="checkbox" id="add-modal">
          <div class="modal">
            <div class="modal-box relative bg-neutral-bg scrollbar-hide w-full dark:bg-dark-neutral-bg pt-[53px] max-w-[794px]">
              <label class="absolute right-2 top-2 cursor-pointer" for="add-modal"><img src="assets/images/icons/icon-close-modal.svg" alt="close modal button"></label>
              <div class="flex items-center justify-center flex-col">
                <h6 class="text-header-6 font-semibold text-gray-500 text-center dark:text-gray-dark-500 mb-[50px]">Create a New Project</h6>
                <div class="w-full flex flex-col max-w-[531px] gap-[30px] mb-[60px] lg:mb-[166px]">
                  <div class="border-dashed border-2 text-center border-neutral mx-auto cursor-pointer py-[26px] dark:border-dark-neutral-border w-full max-w-[724px]"><img class="mx-auto inline-block mb-[15px]" src="assets/images/icons/icon-image.svg" alt="image icon">
                    <p class="text-sm leading-6 text-gray-500 font-normal mb-[5px]">Drop your image here, or browse</p>
                    <p class="leading-6 text-gray-400 text-[13px]">JPG,PNG and GIF files are allowed</p>
                  </div>
                  <div class="w-full"> 
                    <p class="text-gray-1100 text-base leading-4 font-medium capitalize mb-[10px] dark:text-gray-dark-1100">Project Name</p>
                    <div class="input-group border rounded-lg border-[#E8EDF2] dark:border-[#313442] sm:min-w-[252px]">
                      <input class="input bg-transparent text-sm leading-4 text-gray-400 h-fit min-h-fit py-4 focus:outline-none pl-[13px] dark:text-gray-dark-400 placeholder:text-inherit" type="text" placeholder="Type name here">
                    </div>
                  </div>
                  <div class="w-full">
                    <p class="text-gray-1100 text-base leading-4 font-medium capitalize mb-[10px] dark:text-gray-dark-1100">Description</p>
                    <div class="rounded-lg border border-neutral flex flex-col dark:border-dark-neutral-border p-[13px] h-[218px]">
                      <div class="flex items-center gap-y-4 flex-col gap-x-[22px] mb-[31px] xl:flex-row xl:gap-y-0">
                        <div class="flex items-center gap-x-[14px]"><img class="cursor-pointer" src="assets/images/icons/icon-bold.svg" alt="bold icon"><img class="cursor-pointer" src="assets/images/icons/icon-italicized.svg" alt="italicized icon"><img class="cursor-pointer" src="assets/images/icons/icon-underlined.svg" alt="underlined icon"><img class="cursor-pointer" src="assets/images/icons/icon-strikethrough.svg" alt="strikethrough icon"><img class="cursor-pointer" src="assets/images/icons/icon-textcolor.svg" alt="textcolor icon"><img class="cursor-pointer" src="assets/images/icons/icon-backgroundcolor.svg" alt="backgroundcolor icon"><img class="cursor-pointer" src="assets/images/icons/icon-smile.svg" alt="smile icon"></div>
                        <div class="flex items-center gap-x-[14px]">
                          <div class="flex items-center cursor-pointer gap-x-[1.5px]"><img src="assets/images/icons/icon-paragraphformat.svg" alt="paragraphformat icon"><img src="assets/images/icons/icon-arrow-down-triangle.svg" alt="arrow down triangle icon"></div>
                          <div class="flex items-center cursor-pointer gap-x-[1.5px]"><img src="assets/images/icons/icon-align-left.svg" alt="align left icon"><img src="assets/images/icons/icon-arrow-down-triangle.svg" alt="arrow down triangle icon"></div>
                          <div class="flex items-center cursor-pointer gap-x-[1.5px]"><img src="assets/images/icons/icon-ordered-list.svg" alt="ordered list icon"><img src="assets/images/icons/icon-arrow-down-triangle.svg" alt="arrow down triangle icon"></div>
                          <div class="flex items-center cursor-pointer gap-x-[1.5px]"><img src="assets/images/icons/icon-unordered-list.svg" alt="unordered list icon"><img src="assets/images/icons/icon-arrow-down-triangle.svg" alt="arrow down triangle icon"></div><img class="cursor-pointer" src="assets/images/icons/icon-indent.svg" alt="indent icon"><img class="cursor-pointer opacity-40" src="assets/images/icons/icon-indent.svg" alt="outdent icon">
                        </div>
                        <div class="flex items-center gap-x-[14px]"><img class="cursor-pointer" src="assets/images/icons/icon-insert-image.svg" alt="insert image icon"><img class="cursor-pointer" src="assets/images/icons/icon-insert-link.svg" alt="insert link icon"><img class="cursor-pointer" src="assets/images/icons/icon-insert-file.svg" alt="insert-file icon"><img class="cursor-pointer" src="assets/images/icons/icon-insert-video.svg" alt="insert video icon"><img class="cursor-pointer opacity-40" src="assets/images/icons/icon-undo.svg" alt="undo icon"><img class="cursor-pointer opacity-40" src="assets/images/icons/icon-redo.svg" alt="redo icon"></div>
                      </div>
                      <textarea class="textarea w-full p-0 text-gray-400 resize-none rounded-none bg-transparent flex-1 focus:outline-none dark:text-gray-dark-400 placeholder:text-inherit" placeholder="Type description here"></textarea>
                    </div>
                  </div>
                  <div class="w-full"> 
                    <p class="text-gray-1100 text-base leading-4 font-medium capitalize mb-[10px] dark:text-gray-dark-1100">Category</p>
                    <div class="input-group border rounded-lg border-[#E8EDF2] dark:border-[#313442] sm:min-w-[252px]">
                      <input class="input bg-transparent text-sm leading-4 text-gray-400 h-fit min-h-fit py-4 focus:outline-none pl-[13px] dark:text-gray-dark-400 placeholder:text-inherit" type="text" placeholder="Design system">
                    </div>
                  </div>
                  <div class="w-full"> 
                    <p class="text-gray-1100 text-base leading-4 font-medium capitalize mb-[10px] dark:text-gray-dark-1100">Priority</p>
                    <div class="input-group border rounded-lg border-[#E8EDF2] dark:border-[#313442] sm:min-w-[252px]">
                      <input class="input bg-transparent text-sm leading-4 text-gray-400 h-fit min-h-fit py-4 focus:outline-none pl-[13px] dark:text-gray-dark-400 placeholder:text-inherit" type="text" placeholder="Urgent">
                    </div>
                  </div>
                  <div class="w-full"> 
                    <p class="text-gray-1100 text-base leading-4 font-medium capitalize mb-[10px] dark:text-gray-dark-1100">Tag</p>
                    <div class="border bg-neutral-bg border-neutral dark:bg-dark-neutral-bg dark:border-dark-neutral-border rounded-lg p-[15px] mt-[10px] min-h-[107px]">
                      <div class="flex flex-wrap gap-[10px]">
                        <div class="flex items-center py-1 px-2 gap-x-[5px] mb-[10px] bg-[#E8EDF2] dark:bg-[#313442] rounded-[5px]"><span class="text-xs text-gray-400">smartwatch</span><img class="cursor-pointer" src="assets/images/icons/icon-close.svg" alt="close icon"></div>
                        <div class="flex items-center py-1 px-2 gap-x-[5px] mb-[10px] bg-[#E8EDF2] dark:bg-[#313442] rounded-[5px]"><span class="text-xs text-gray-400">Apple</span><img class="cursor-pointer" src="assets/images/icons/icon-close.svg" alt="close icon"></div>
                        <div class="flex items-center py-1 px-2 gap-x-[5px] mb-[10px] bg-[#E8EDF2] dark:bg-[#313442] rounded-[5px]"><span class="text-xs text-gray-400">Watch</span><img class="cursor-pointer" src="assets/images/icons/icon-close.svg" alt="close icon"></div>
                        <div class="flex items-center py-1 px-2 gap-x-[5px] mb-[10px] bg-[#E8EDF2] dark:bg-[#313442] rounded-[5px]"><span class="text-xs text-gray-400">smartphone</span><img class="cursor-pointer" src="assets/images/icons/icon-close.svg" alt="close icon"></div>
                        <div class="flex items-center py-1 px-2 gap-x-[5px] mb-[10px] bg-[#E8EDF2] dark:bg-[#313442] rounded-[5px]"><span class="text-xs text-gray-400">iPhone14 max</span><img class="cursor-pointer" src="assets/images/icons/icon-close.svg" alt="close icon"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <label class="btn modal-button absolute left-[-1000px]" for="share-modal">share</label>
          <input class="modal-toggle" type="checkbox" id="share-modal">
          <div class="modal">
            <div class="modal-box relative bg-neutral-bg scrollbar-hide w-full dark:bg-dark-neutral-bg pt-[53px] max-w-[738px] pr-[31px]">
              <label class="absolute right-2 top-2 cursor-pointer" for="share-modal"><img src="assets/images/icons/icon-close-modal.svg" alt="close modal button"></label>
              <div class="flex items-center justify-center flex-col">
                <h6 class="text-header-6 font-semibold text-gray-500 text-center dark:text-gray-dark-500 mb-[53px]">Share Duplicate of Creative requests</h6>
                <div class="w-full bg-neutral h-[1px] dark:bg-dark-neutral-border mb-10"></div>
                <div class="w-full mb-[65px]"> 
                  <p class="text-gray-1100 text-base leading-4 font-medium capitalize mb-[10px] dark:text-gray-dark-1100">Invite link</p>
                  <div class="flex items-center justify-between rounded-md bg-neutral py-[11px] px-[10px] dark:bg-dark-neutral-border">
                    <p class="text-sm leading-4 text-gray-400 dark:text-gray-dark-400">foxy.com/ZmRzYSBmZHMgc2RmIHNkYWZzZ</p>
                    <div class="flex items-center text-blue gap-[6px]"><img src="assets/images/icons/Icon-link.svg" alt="link icon">
                      <p class="text-desc">Copy link</p>
                    </div>
                  </div>
                </div>
                <div class="w-full mb-[24px]"> 
                  <p class="text-gray-1100 text-base leading-4 font-medium capitalize mb-[10px] dark:text-gray-dark-1100">Invite with email</p>
                  <div class="flex items-center gap-5"> 
                    <input class="bg-transparent text-sm leading-4 text-gray-400 border border-neutral flex-1 rounded-md focus:outline-none p-[10px] dark:text-gray-dark-400 placeholder:text-inherit dark:border-dark-neutral-border" type="text" placeholder="Add project members by name or email">
                    <button class="btn normal-case h-fit min-h-fit transition-all duration-300 border-4 bg-color-brands hover:bg-color-brands hover:border-[#B2A7FF] dark:hover:border-[#B2A7FF] border-neutral-bg dark:border-dark-neutral-bg py-[11px] px-[23px]">Invite</button>
                  </div>
                </div>
                <div class="w-full flex items-center justify-between mb-[30px]">
                  <div class="flex items-center gap-3"> <a class="block rounded-full border-neutral overflow-hidden border-[1.4px] dark:border-gray-dark-100 w-9 h-9 border-none" href="seller-details.html"><img class="w-full h-full object-cover" src="assets/images/avatar-layouts-1.png" alt="user avatar"></a>
                    <p class="text-sm leading-4 text-gray-400 dark:text-gray-dark-400">Theresa Webb</p>
                  </div>
                  <p class="text-sm leading-4 text-gray-400 dark:text-gray-dark-400">Owner</p>
                </div>
                <div class="w-full bg-neutral h-[1px] dark:bg-dark-neutral-border mb-[35px]"></div>
                <div class="w-full mb-[42px]">
                  <p class="text-subtitle font-medium text-gray-1100 mb-8 dark:text-gray-dark-1100">Members</p>
                  <div class="flex flex-col items-center gap-6 w-full">
                    <div class="flex items-center justify-between w-full">
                      <div class="flex items-center gap-3"><a class="block rounded-full border-neutral overflow-hidden border-[1.4px] dark:border-gray-dark-100 w-9 h-9 border-none" href="seller-details.html"><img class="w-full h-full object-cover" src="assets/images/avatar-layouts-2.png" alt="user avatar"></a>
                        <div>
                          <p class="text-normal text-gray-1100 mb-[2px] dark:text-gray-dark-1100">Bessie Cooper</p>
                          <p class="text-desc text-gray-400 dark:text-gray-dark-400">binhan628@gmail.com</p>
                        </div>
                      </div>
                      <select class="select text-gray-500 pl-1 font-normal h-fit min-h-fit dark:text-gray-dark-500 focus:outline-0 select-caret">
                        <option>Can Edit</option>
                        <option>Can View</option>
                      </select>
                    </div>
                    <div class="flex items-center justify-between w-full">
                      <div class="flex items-center gap-3"><a class="block rounded-full border-neutral overflow-hidden border-[1.4px] dark:border-gray-dark-100 w-9 h-9 border-none" href="seller-details.html"><img class="w-full h-full object-cover" src="assets/images/avatar-layouts-3.png" alt="user avatar"></a>
                        <div>
                          <p class="text-normal text-gray-1100 mb-[2px] dark:text-gray-dark-1100">Cameron Williamson</p>
                          <p class="text-desc text-gray-400 dark:text-gray-dark-400">trungkienspktnd@gamail.com</p>
                        </div>
                      </div>
                      <select class="select text-gray-500 pl-1 font-normal h-fit min-h-fit dark:text-gray-dark-500 focus:outline-0 select-caret">
                        <option>Can Edit</option>
                        <option>Can View</option>
                      </select>
                    </div>
                    <div class="flex items-center justify-between w-full">
                      <div class="flex items-center gap-3"><a class="block rounded-full border-neutral overflow-hidden border-[1.4px] dark:border-gray-dark-100 w-9 h-9 border-none" href="seller-details.html"><img class="w-full h-full object-cover" src="assets/images/avatar-layouts-4.png" alt="user avatar"></a>
                        <div>
                          <p class="text-normal text-gray-1100 mb-[2px] dark:text-gray-dark-1100">Jacob Jones</p>
                          <p class="text-desc text-gray-400 dark:text-gray-dark-400">manhhachkt08@gmail.com</p>
                        </div>
                      </div>
                      <select class="select text-gray-500 pl-1 font-normal h-fit min-h-fit dark:text-gray-dark-500 focus:outline-0 select-caret">
                        <option>Can Edit</option>
                        <option>Can View</option>
                      </select>
                    </div>
                    <div class="flex items-center justify-between w-full">
                      <div class="flex items-center gap-3"><a class="block rounded-full border-neutral overflow-hidden border-[1.4px] dark:border-gray-dark-100 w-9 h-9 border-none" href="seller-details.html"><img class="w-full h-full object-cover" src="assets/images/avatar-layouts-5.png" alt="user avatar"></a>
                        <div>
                          <p class="text-normal text-gray-1100 mb-[2px] dark:text-gray-dark-1100">Arlene McCoy</p>
                          <p class="text-desc text-gray-400 dark:text-gray-dark-400">tienlapspktnd@gmail.com</p>
                        </div>
                      </div>
                      <select class="select text-gray-500 pl-1 font-normal h-fit min-h-fit dark:text-gray-dark-500 focus:outline-0 select-caret">
                        <option>Can Edit</option>
                        <option>Can View</option>
                      </select>
                    </div>
                    <div class="flex items-center justify-between w-full">
                      <div class="flex items-center gap-3"><a class="block rounded-full border-neutral overflow-hidden border-[1.4px] dark:border-gray-dark-100 w-9 h-9 border-none" href="seller-details.html"><img class="w-full h-full object-cover" src="assets/images/avatar-layouts-1.png" alt="user avatar"></a>
                        <div>
                          <p class="text-normal text-gray-1100 mb-[2px] dark:text-gray-dark-1100">Brooklyn Simmons</p>
                          <p class="text-desc text-gray-400 dark:text-gray-dark-400">tranthuy.nute@gmail.com</p>
                        </div>
                      </div>
                      <select class="select text-gray-500 pl-1 font-normal h-fit min-h-fit dark:text-gray-dark-500 focus:outline-0 select-caret">
                        <option>Can Edit</option>
                        <option>Can View</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <label class="btn modal-button absolute left-[-1000px]" for="mail-modal">mail</label>
          <input class="modal-toggle" type="checkbox" id="mail-modal">
          <div class="modal">
            <div class="modal-box relative bg-neutral-bg scrollbar-hide w-full dark:bg-dark-neutral-bg pt-[38px] max-w-[650px] pl-[45px]">
              <label class="absolute right-2 top-2 cursor-pointer" for="mail-modal"><img src="assets/images/icons/icon-close-modal.svg" alt="close modal button"></label>
              <div class="flex items-center justify-center flex-col">
                <h6 class="w-full text-header-6 font-semibold text-gray-500 dark:text-gray-dark-500 mb-[39px]">New Mesage</h6>
                <div class="flex items-center gap-4 flex-col w-full">
                  <div class="flex items-center rounded-lg border border-neutral justify-between w-full flex-wrap gap-3 py-[13px] px-[10px] dark:border-dark-neutral-border">
                    <div class="flex items-center">
                      <p class="text-sm leading-4 text-gray-400 dark:text-gray-dark-400 pr-5">To:</p>
                      <div class="flex items-center flex-wrap gap-[5px]">
                        <div class="flex items-center rounded gap-[5px] py-[6px] pl-[10px] pr-[5px] bg-neutral dark:bg-dark-neutral-border"><img class="rounded-full w-4 h-4" src="assets/images/seller-avatar-2.png" alt="user avatar">
                          <p class="font-medium text-gray-400 text-[10px] leading-[15px] dark:text-gray-dark-400">Steven Job</p>
                          <svg class="fill-gray-400 cursor-pointer dark:fill-gray-dark-400" width="16" height="16" viewbox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.20003 8.00001L4.80003 10.4L5.60003 11.2L8.00002 8.80001L10.4 11.2L11.2 10.4L8.80002 8.00001L11.2 5.60001L10.4 4.80001L8.00002 7.20001L5.6 4.79999L4.8 5.59999L7.20003 8.00001Z"></path>
                          </svg>
                        </div>
                        <div class="flex items-center rounded gap-[5px] py-[6px] pl-[10px] pr-[5px] bg-neutral dark:bg-dark-neutral-border"><img class="rounded-full w-4 h-4" src="assets/images/seller-avatar-3.png" alt="user avatar">
                          <p class="font-medium text-gray-400 text-[10px] leading-[15px] dark:text-gray-dark-400">Hailen</p>
                          <svg class="fill-gray-400 cursor-pointer dark:fill-gray-dark-400" width="16" height="16" viewbox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.20003 8.00001L4.80003 10.4L5.60003 11.2L8.00002 8.80001L10.4 11.2L11.2 10.4L8.80002 8.00001L11.2 5.60001L10.4 4.80001L8.00002 7.20001L5.6 4.79999L4.8 5.59999L7.20003 8.00001Z"></path>
                          </svg>
                        </div>
                        <div class="flex items-center rounded gap-[5px] py-[6px] pl-[10px] pr-[5px] bg-neutral dark:bg-dark-neutral-border"><img class="rounded-full w-4 h-4" src="assets/images/seller-avatar-4.png" alt="user avatar">
                          <p class="font-medium text-gray-400 text-[10px] leading-[15px] dark:text-gray-dark-400">Azumi Rose</p>
                          <svg class="fill-gray-400 cursor-pointer dark:fill-gray-dark-400" width="16" height="16" viewbox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.20003 8.00001L4.80003 10.4L5.60003 11.2L8.00002 8.80001L10.4 11.2L11.2 10.4L8.80002 8.00001L11.2 5.60001L10.4 4.80001L8.00002 7.20001L5.6 4.79999L4.8 5.59999L7.20003 8.00001Z"></path>
                          </svg>
                        </div>
                      </div>
                    </div>
                    <div class="flex items-center gap-[6px]">
                      <p class="font-medium text-gray-400 cursor-pointer text-[10px] leading-[15px] dark:text-gray-dark-400 hover:text-color-brands dark:hover:text-color-brands">Cc</p>
                      <p class="font-medium text-gray-400 cursor-pointer text-[10px] leading-[15px] dark:text-gray-dark-400 hover:text-color-brands dark:hover:text-color-brands">Bcc</p>
                    </div>
                  </div>
                  <div class="rounded-lg border border-neutral justify-between w-full py-[16px] px-[13px] dark:border-dark-neutral-border">
                    <input class="input bg-transparent text-sm leading-4 text-gray-400 p-0 w-full h-4 rounded-none focus:outline-none dark:text-gray-dark-400 placeholder:text-inherit" type="text" placeholder="Subject">
                  </div>
                  <div class="rounded-lg border border-neutral flex flex-col dark:border-dark-neutral-border p-[13px] h-[262px] w-full">
                    <div class="flex items-center gap-y-4 flex-col gap-x-[22px] mb-[31px] xl:flex-row xl:gap-y-0">
                      <div class="flex items-center gap-x-[14px]"><img class="cursor-pointer" src="assets/images/icons/icon-bold.svg" alt="bold icon"><img class="cursor-pointer" src="assets/images/icons/icon-italicized.svg" alt="italicized icon"><img class="cursor-pointer" src="assets/images/icons/icon-underlined.svg" alt="underlined icon"><img class="cursor-pointer" src="assets/images/icons/icon-strikethrough.svg" alt="strikethrough icon"><img class="cursor-pointer" src="assets/images/icons/icon-textcolor.svg" alt="textcolor icon"><img class="cursor-pointer" src="assets/images/icons/icon-backgroundcolor.svg" alt="backgroundcolor icon"><img class="cursor-pointer" src="assets/images/icons/icon-smile.svg" alt="smile icon"></div>
                      <div class="flex items-center gap-x-[14px]">
                        <div class="flex items-center cursor-pointer gap-x-[1.5px]"><img src="assets/images/icons/icon-paragraphformat.svg" alt="paragraphformat icon"><img src="assets/images/icons/icon-arrow-down-triangle.svg" alt="arrow down triangle icon"></div>
                        <div class="flex items-center cursor-pointer gap-x-[1.5px]"><img src="assets/images/icons/icon-align-left.svg" alt="align left icon"><img src="assets/images/icons/icon-arrow-down-triangle.svg" alt="arrow down triangle icon"></div>
                        <div class="flex items-center cursor-pointer gap-x-[1.5px]"><img src="assets/images/icons/icon-ordered-list.svg" alt="ordered list icon"><img src="assets/images/icons/icon-arrow-down-triangle.svg" alt="arrow down triangle icon"></div>
                        <div class="flex items-center cursor-pointer gap-x-[1.5px]"><img src="assets/images/icons/icon-unordered-list.svg" alt="unordered list icon"><img src="assets/images/icons/icon-arrow-down-triangle.svg" alt="arrow down triangle icon"></div><img class="cursor-pointer" src="assets/images/icons/icon-indent.svg" alt="indent icon"><img class="cursor-pointer opacity-40" src="assets/images/icons/icon-indent.svg" alt="outdent icon">
                      </div>
                      <div class="flex items-center gap-x-[14px]"><img class="cursor-pointer" src="assets/images/icons/icon-insert-image.svg" alt="insert image icon"><img class="cursor-pointer" src="assets/images/icons/icon-insert-link.svg" alt="insert link icon"><img class="cursor-pointer" src="assets/images/icons/icon-insert-file.svg" alt="insert-file icon"><img class="cursor-pointer" src="assets/images/icons/icon-insert-video.svg" alt="insert video icon"><img class="cursor-pointer opacity-40" src="assets/images/icons/icon-undo.svg" alt="undo icon"><img class="cursor-pointer opacity-40" src="assets/images/icons/icon-redo.svg" alt="redo icon"></div>
                    </div>
                    <textarea class="textarea w-full p-0 text-gray-400 resize-none rounded-none bg-transparent flex-1 focus:outline-none dark:text-gray-dark-400 placeholder:text-inherit" placeholder="Content here"></textarea>
                  </div>
                  <div class="flex items-center w-full gap-[15px]">
                    <button class="btn normal-case h-fit min-h-fit transition-all duration-300 border-4 bg-color-brands hover:bg-color-brands hover:border-[#B2A7FF] dark:hover:border-[#B2A7FF] border-neutral-bg font-medium dark:border-dark-neutral-bg py-[7px] px-[24px] text-[12px] leading-[18px]">Send</button>
                    <button class="btn normal-case h-fit min-h-fit transition-all duration-300 border-4 border-neutral-bg bg-gray-200 font-medium text-gray-500 dark:border-dark-neutral-bg py-[7px] px-[17px] dark:bg-gray-dark-200 text-[12px] leading-[18px] dark:text-gray-dark-500 hover:bg-gray-200 dark:hover:bg-gray-dark-200 hover:border-gray-300 dark:hover:border-gray-dark-300">Save Darft</button>
                    <p class="text-desc text-gray-400 dark:text-gray-dark-400">Schedule</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <footer class="mt-[37px]">
          <div class="w-full bg-neutral h-[1px] dark:bg-dark-neutral-border mb-[25px]"></div>
          <div class="flex items-center justify-between text-desc text-gray-400 flex-wrap gap-5 dark:text-gray-dark-400">
            <div class="flex items-center gap-2 flex-wrap">
              <p> <span>© 2022 -</span><span class="text-color-brands">&nbsp;Frox</span><span>&nbsp;Dashboard</span></p>
              <div class="bg-color-brands rounded-full hidden w-[2px] h-[2px] md:block"></div>
              <p> <span>Made by</span><a class="text-color-brands" href="https://alithemes.com" target="_blank">&nbsp;AliThemes</a></p>
            </div>
            <div class="flex items-center gap-[15px]"><a class="transition-colors duration-300 hover:text-color-brands" href="#">About</a><a class="transition-colors duration-300 hover:text-color-brands" href="#">Careers</a><a class="transition-colors duration-300 hover:text-color-brands" href="#">Policy</a><a class="transition-colors duration-300 hover:text-color-brands" href="#">Contact</a></div>
          </div>
        </footer>
      </main>
    </div>
    <script type="text/javascript" src="assets/scripts/vendors/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="assets/scripts/chart-utils.min.js"></script>
    <script type="text/javascript" src="assets/scripts/chart.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/chartjs-chart-geo@3"></script>
    <script src="assets/scripts/app.js?v=5.0"></script>
  </body>
</html>