<?php
    include 'connect.php';

    $id = $_GET['id'];

    $sql = "SELECT * FROM categoria WHERE id_categoria = $id";
    $resultado = mysqli_query($cn, $sql);

    $categoria = mysqli_fetch_assoc($resultado); 
?>

<!DOCTYPE html>
<html class="scroll-smooth overflow-x-hidden" lang="en">
  <head>
    <meta charset="utf-8">
    <title> Adicionar categoria</title>
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.2.3/css/flag-icons.min.css">

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
            
        <form class="rounded-2xl bg-white mx-auto p-10 text-center max-w-[440px] my-[84px] dark:bg-[#1F2128]" action="editar_categoria_php.php" method="post" onsubmit="return validar()" name="form1">
        <a href="dashboard.php"><img src="img/home.png" alt=""></a>
    <div class="mb-4 text-center mx-auto">
        <img class="inline-block" src="assets/images/icons/icon-landing-success-1.svg" alt="landing success">
    </div>
    <h3 class="font-bold text-2xl text-gray-1100 capitalize mb-[5px] dark:text-gray-dark-1100">Editar categoria</h3>
    <br>
    <input type="hidden" name="id" value="<?php echo $categoria['id_categoria']; ?>">
    <div>
        <label for="nome">
            <p class="text-left text-sm mb-2 text-gray-1100 dark:text-gray-dark-1100">Nome da categoria</p>
        </label>
        <div class="form-control mb-[20px]">
            <div class="input-group border rounded-lg border-[#E8EDF2] dark:border-[#313442]">
                <input class="input flex-1 bg-transparent text-gray-300 focus:outline-none dark:text-gray-dark-300" type="text" placeholder="Digite aqui..." name="nome" id="nome" style="color:white;" value="<?php echo $categoria['nome_categoria']; ?>">
            </div>
        </div>

        <label for="desc">
            <p class="text-left text-sm mb-2 text-gray-1100 dark:text-gray-dark-1100">Descrição</p>
        </label>
        <div class="form-control mb-[20px]">
            <div class="input-group border rounded-lg border-[#E8EDF2] dark:border-[#313442]">
                <textarea class="input flex-1 bg-transparent text-gray-300 focus:outline-none dark:text-gray-dark-300" name="desc" id="desc" cols="33" placeholder="Descrição aqui..." ><?php echo $categoria['descricao']; ?></textarea>
            </div>
        </div>

        <div>
            <button type="submit" 
                    class="btn normal-case h-fit min-h-fit transition-all duration-300 border-4 w-full border-neutral-bg mb-[20px] py-[14px] dark:border-dark-neutral-bg">
                Editar
            </button>
        </div>
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
    function validar() {
        var nome = document.getElementById("nome").value.trim();
        var desc = document.getElementById("desc").value.trim();

        if(nome === ""){
            alert('Preencha o campo nome');
            document.getElementById("nome").focus();
            return false;
        }
        if(desc === ""){
            alert('Preencha o campo descrição');
            document.getElementById("desc").focus();
            return false;
        }
        if(nome.length > 19){
            alert('Nome muito grande');
            document.getElementById("nome").focus();
            return false;
        }
        return true;
    }
</script>
   
  </body>
</html>