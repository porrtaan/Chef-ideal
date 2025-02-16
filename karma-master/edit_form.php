<?php
    include("connect.php");

    $id = $_GET["id_prod"];

    $sql = "SELECT * FROM produto WHERE id_prod = $id";
    $resultado = mysqli_query($cn, $sql);
    
    $produto = mysqli_fetch_array($resultado);

    $sql_categorias = "SELECT id_categoria FROM Produto_Categoria WHERE id_prod = '$id'";
    $resultado_categorias = mysqli_query($cn, $sql_categorias);

    $categorias_associadas = [];
    while ($categoria = mysqli_fetch_array($resultado_categorias)) {
        $categorias_associadas[] = $categoria['id_categoria'];
    }

?>
<!DOCTYPE html>
<html class="scroll-smooth overflow-x-hidden" lang="en">
  <head>
    <meta charset="utf-8">
    <title>Create a new account</title>
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
    <style>
        
select {
  /* Reset Select */
  appearance: none;
  outline: 10px red;
  border: 0;
  box-shadow: none;
  /* Personalize */
  flex: 1;
  padding: 0 1em;
  color: #fff;
  background-color: var(--darkgray);
  background-image: none;
  cursor: pointer;
  color: black;
}

/* Custom Select wrapper */
.select {
  position: relative;
  display: flex;
  width: 20em;
  height: 3em;
  border-radius: .25em;
  overflow: hidden;
}
/* Arrow */
.select::after {
  content: '\25BC';
  position: absolute;
  top: 0;
  right: 0;
  padding: 1em;
  background-color: #34495e;
  transition: .25s all ease;
  pointer-events: none;
}

/* Estilo geral para o contêiner */
.form-group {
    margin-bottom: 20px;
}

/* Esconde o input de arquivo padrão */
input[type="file"] {
    display: none;
}

/* Estilo para o botão de upload */
.custom-file-label {
    display: inline-block;
    background-color: #28a745;
    color: #fff;
    padding: 10px 20px;
    font-size: 14px;
    font-weight: bold;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-align: center;
    transition: background-color 0.3s ease;
}

/* Alteração do estilo ao passar o mouse */
.custom-file-label:hover {
    background-color: #218838;
}

/* Estilo para a área de preview */
#preview, #preview2, #preview3 {
    margin-top: 10px;
    max-width: 100%;
    height: auto;
    border-radius: 5px;
    padding: 5px;
    text-align: center;
}

/* Botão de remover imagem */
button {
    background-color: #dc3545;
    color: #fff;
    border: none;
    padding: 8px 15px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
    font-weight: bold;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #c82333;
}
textarea {
  font-size: 0.8rem;
  letter-spacing: 1px;
}

textarea {
  padding: 10px;
  max-width: 100%;
  line-height: 1.5;
  border-radius: 5px;
  border: 1px solid #ccc;
  box-shadow: 1px 1px 1px #999;
  overflow: auto; 
  resize: vertical;
  color: white !important;
}

label {
  display: block;
  margin-bottom: 10px;
}


    </style>
    
  </head>
  <body class="w-screen relative overflow-x-hidden min-h-screen bg-gray-100 scrollbar-hide authentication-sign-in-page dark:bg-[#000]">
      <main class="overflow-x-scroll scrollbar-hide flex flex-col justify-between pt-[42px] px-[23px] pb-[28px]">
        <div>
        <form class="rounded-2xl bg-white mx-auto p-10 text-center max-w-[440px] my-[84px] dark:bg-[#1F2128]" action="edit_prod.php" method="post" enctype="multipart/form-data" onsubmit="return validar()">
    <a href="dashboard.php"><img src="img/home.png" alt=""></a>
    <div class="mb-4 text-center mx-auto"><img class="inline-block" src="assets/images/icons/icon-landing-success-1.svg" alt="landing success"></div>
    <h3 class="font-bold text-2xl text-gray-1100 capitalize mb-[5px] dark:text-gray-dark-1100">Editar produto</h3>
    <br>
    <input type="hidden" name="id_prod" value="<?php echo $produto["id_prod"] ?>">
    <div>
        <!-- Nome do Produto -->
        <label for="nome">
            <p class="text-left text-sm mb-2 text-gray-1100 dark:text-gray-dark-1100">Nome do produto</p>
        </label>
        <div class="form-control mb-[20px]">
            <div class="input-group border rounded-lg border-[#E8EDF2] dark:border-[#313442]">
                <input class="input flex-1 bg-transparent text-gray-300 focus:outline-none dark:text-gray-dark-300" type="text" placeholder="Digite aqui... " name="nome" id="nome" style="color: white;" value="<?php echo $produto["nome"] ?>">
            </div>
            <span id="error_nome" class="text-danger" style="color:red !important;"></span>
        </div>

        <!-- Descrição -->
        <label for="desc">
            <p class="text-left text-sm mb-2 text-gray-1100 dark:text-gray-dark-1100">Descrição</p>
        </label>
        <div class="form-control mb-[20px]">
            <div class="input-group border rounded-lg border-[#E8EDF2] dark:border-[#313442]">
                <textarea class="input flex-1 bg-transparent text-gray-300 focus:outline-none dark:text-gray-dark-300" id="desc" name="desc" cols="33" placeholder="Descrição aqui..." rows="5"><?php echo $produto["descricao"] ?></textarea>
            </div>
            <span id="error_desc" class="text-danger" style="color:red !important;"></span>
        </div>

        <!-- Preço -->
        <label for="preco">
            <p class="text-left text-sm mb-2 text-gray-1100 dark:text-gray-dark-1100">Preço unidade</p>
        </label>
        <div class="form-control mb-[20px]">
            <div class="input-group border rounded-lg border-[#E8EDF2] dark:border-[#313442]">
                <input class="input flex-1 bg-transparent text-gray-300 focus:outline-none dark:text-gray-dark-300" type="text" placeholder="Digite aqui..." name="preco" id="preco" style="color: white;" value="<?php echo $produto["preco_uni"] ?>">
            </div>
            <span id="error_preco" class="text-danger" style="color:red !important;"></span>
        </div>

        <!-- Stock -->
        <label for="stock">
            <p class="text-left text-sm mb-2 text-gray-1100 dark:text-gray-dark-1100">Stock</p>
        </label>
        <div class="form-control mb-[20px]">
            <div class="input-group border rounded-lg border-[#E8EDF2] dark:border-[#313442]">
                <input class="input flex-1 bg-transparent text-gray-300 focus:outline-none dark:text-gray-dark-300" type="text" placeholder="Digite aqui..." name="stock" id="stock" style="color: white;" value="<?php echo $produto["stock"] ?>">
            </div>
            <span id="error_stock" class="text-danger" style="color:red !important;"></span>
        </div>

        <!-- Categorias -->
        <label for="categ">
            <p class="text-left text-sm mb-2 text-gray-1100 dark:text-gray-dark-1100">Categorias</p>
        </label>
        <div class="select">
            <?php
                include("connect.php");

                $sql = "SELECT * FROM Categoria";
                $resultado = mysqli_query($cn, $sql);

                if (mysqli_num_rows($resultado) > 0) {
                    echo '<select name="categ[]" id="categ">';
                    while ($row = mysqli_fetch_assoc($resultado)) {
                        $selected = in_array($row['id_categoria'], $categorias_associadas) ? 'selected' : '';
                        echo '<option value="' . $row["id_categoria"] . '"' . $selected . '>' . $row["nome_categoria"] . '</option>';
                    }
                    echo '</select>';
                } else {
                    echo 'Nenhuma categoria encontrada.';
                }
            ?>
        </div>
        <span id="error_categ" class="text-danger" style="color:red !important;"></span>

        <br>

        <!-- Marca -->
        <label for="marca">
            <p class="text-left text-sm mb-2 text-gray-1100 dark:text-gray-dark-1100">Marca</p>
        </label>
        <div class="select">
            <?php
                include("connect.php");

                $sql = "SELECT * FROM marca";
                $resultado = mysqli_query($cn, $sql);

                if (mysqli_num_rows($resultado) > 0) {
                    echo '<select name="marca" id="marca">';
                    while ($row = mysqli_fetch_assoc($resultado)) {
                        $selected = ($row['id_marca'] == $produto['id_marca']) ? 'selected' : '';
                        echo '<option value="' . $row["id_marca"] . '" ' . $selected . '>' . $row["nome_marca"] . '</option>';
                    }
                    echo '</select>';
                } else {
                    echo 'Nenhuma marca encontrada.';
                }
            ?>
        </div>
        <span id="error_marca" class="text-danger" style="color:red !important;"></span>

        <br>

        <!-- Fotos -->
        <div class="row">
            <!-- Foto Principal -->
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="form-group">
                    <div class="nk-int-st">
                        <label for="foto_principal">
                            <p class="text-left text-sm mb-2 text-gray-1100 dark:text-gray-dark-1100">Foto Principal</p>
                        </label>
                        <label for="foto_principal" class="custom-file-label">Selecionar Foto</label>
                        <input type="file" id="foto_principal" name="foto_principal" accept="image/*" onchange="getImagePreview(event)">
                        <div id="preview" style="margin-left: 25px;"><img src="uploads/<?= $produto['imagem_principal']?>"></div>
                        <div id="removeButton" style="display: none; margin-left: -10px;">
                            <button type="button" onclick="removeImage()">Remover Imagem</button>
                        </div>
                        <span id="error_foto_principal" class="text-danger" style="color:red !important;"></span>
                    </div>
                </div>
            </div>

            <!-- Foto 2 -->
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="form-group">
                    <div class="nk-int-st">
                        <label for="foto_2">
                            <p class="text-left text-sm mb-2 text-gray-1100 dark:text-gray-dark-1100">Foto 2</p>
                        </label>
                        <label for="foto_2" class="custom-file-label">Selecionar Foto</label>
                        <input type="file" id="foto_2" name="foto_2" accept="image/*" onchange="getImagePreview2(event)">
                        <div id="preview2" style="margin-left: 25px;"><img src="uploads/<?= $produto['imagem_2']?>"></div>
                        <div id="removeButton2" style="display: none; margin-left: -10px;">
                            <button type="button" onclick="removeImage2()">Remover Imagem</button>
                        </div>
                        <span id="error_foto_2" class="text-danger" style="color:red !important;"></span>
                    </div>
                </div>
            </div>

            <!-- Foto 3 -->
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="form-group">
                    <div class="nk-int-st">
                        <label for="foto_3">
                            <p class="text-left text-sm mb-2 text-gray-1100 dark:text-gray-dark-1100">Foto 3</p>
                        </label>
                        <label for="foto_3" class="custom-file-label">Selecionar Foto</label>
                        <input type="file" id="foto_3" name="foto_3" accept="image/*" onchange="getImagePreview3(event)">
                        <div id="preview3" style="margin-left: 25px;"><img src="uploads/<?= $produto['imagem_3']?>"></div>
                        <div id="removeButton3" style="display: none; margin-left: -10px;">
                            <button type="button" onclick="removeImage3()">Remover Imagem</button>
                        </div>
                        <span id="error_foto_3" class="text-danger" style="color:red !important;"></span>
                    </div>
                </div>
            </div>
        </div>

        <br>

        <!-- Botão de Envio -->
        <button class="btn normal-case h-fit min-h-fit transition-all duration-300 border-4 w-full border-neutral-bg mb-[20px] py-[14px] dark:border-dark-neutral-bg">Adicionar</button>
    </div>
</form>
      </main>
    </div>
    <script type="text/javascript" src="assets/scripts/vendors/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="assets/scripts/chart-utils.min.js"></script>
    <script type="text/javascript" src="assets/scripts/chart.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/chartjs-chart-geo@3"></script>
    <script src="assets/scripts/app.js?v=5.0"></script>
    <script>
  function getImagePreview(event) {
    var image = URL.createObjectURL(event.target.files[0]);
    var imagediv = document.getElementById('preview');
    var newimg = document.createElement('img');
    newimg.src = image;
    newimg.width = 300;
    imagediv.innerHTML = '';
    imagediv.appendChild(newimg);
    document.getElementById('removeButton').style.display = 'block';
  }

  function removeImage() {
    document.getElementById('preview').innerHTML = '';
    document.getElementById('foto_principal').value = '';
    document.getElementById('removeButton').style.display = 'none';
  }

  function getImagePreview2(event) {
    var image = URL.createObjectURL(event.target.files[0]);
    var imagediv = document.getElementById('preview2');
    var newimg = document.createElement('img');
    newimg.src = image;
    newimg.width = 300;
    imagediv.innerHTML = '';
    imagediv.appendChild(newimg);
    document.getElementById('removeButton2').style.display = 'block';
  }

  function removeImage2() {
    document.getElementById('preview2').innerHTML = '';
    document.getElementById('foto_2').value = '';
    document.getElementById('removeButton2').style.display = 'none';
  }

  function getImagePreview3(event) {
    var image = URL.createObjectURL(event.target.files[0]);
    var imagediv = document.getElementById('preview3');
    var newimg = document.createElement('img');
    newimg.src = image;
    newimg.width = 300;
    imagediv.innerHTML = '';
    imagediv.appendChild(newimg);
    document.getElementById('removeButton3').style.display = 'block';
  }

  function removeImage3() {
    document.getElementById('preview3').innerHTML = '';
    document.getElementById('foto_3').value = '';
    document.getElementById('removeButton3').style.display = 'none';
  }
</script>
<script>
        const textarea = document.getElementById('textarea');

        // Função que ajusta a altura da textarea
        textarea.addEventListener('input', () => {
            textarea.style.height = 'auto'; // Reseta a altura antes de recalcular
            textarea.style.height = textarea.scrollHeight + 'px'; // Ajusta para a altura necessária
        });
    </script>

<script>
    function validar() {
        var nome = document.getElementById("nome").value.trim();
        var desc = document.getElementById("desc").value.trim();
        var preco = document.getElementById("preco").value.trim();
        var stock = document.getElementById("stock").value.trim();
        var categ = document.getElementById("categ").value;
        var marca = document.getElementById("marca").value;
        var foto_principal = document.getElementById("foto_principal").files[0];
        var foto_2 = document.getElementById("foto_2").files[0];
        var foto_3 = document.getElementById("foto_3").files[0];

        // Limpar mensagens de erro
        document.getElementById("error_nome").innerHTML = "";
        document.getElementById("error_desc").innerHTML = "";
        document.getElementById("error_preco").innerHTML = "";
        document.getElementById("error_stock").innerHTML = "";
        document.getElementById("error_categ").innerHTML = "";
        document.getElementById("error_marca").innerHTML = "";
        document.getElementById("error_foto_principal").innerHTML = "";
        document.getElementById("error_foto_2").innerHTML = "";
        document.getElementById("error_foto_3").innerHTML = "";

        // Validação do nome
        if (nome === "") {
            document.getElementById("error_nome").innerHTML = "Introduza um nome válido.";
            document.getElementById("nome").focus();
            return false;
        }

        // Validação da descrição
        if (desc === "") {
            document.getElementById("error_desc").innerHTML = "Introduza uma descrição válida.";
            document.getElementById("desc").focus();
            return false;
        }

        // Validação do preço
        if (preco === "" || isNaN(preco) || parseFloat(preco) <= 0) {
            document.getElementById("error_preco").innerHTML = "Introduza um preço válido.";
            document.getElementById("preco").focus();
            return false;
        }

        // Validação do stock
        if (stock === "" || isNaN(stock) || parseInt(stock) < 0) {
            document.getElementById("error_stock").innerHTML = "Introduza um stock válido.";
            document.getElementById("stock").focus();
            return false;
        }

        // Validação da categoria
        if (categ === "") {
            document.getElementById("error_categ").innerHTML = "Selecione uma categoria válida.";
            document.getElementById("categ").focus();
            return false;
        }

        // Validação da marca
        if (marca === "") {
            document.getElementById("error_marca").innerHTML = "Selecione uma marca válida.";
            document.getElementById("marca").focus();
            return false;
        }

        // Validação da foto principal
        if (!foto_principal) {
            document.getElementById("error_foto_principal").innerHTML = "Selecione uma foto principal.";
            document.getElementById("foto_principal").focus();
            return false;
        }

        return true;
    }

</script>
  </body>
</html>