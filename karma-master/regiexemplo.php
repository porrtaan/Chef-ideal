<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form | CodingLab</title>
    <link rel="stylesheet" href="css/regiform.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
  </head>
  <body>
    <div class="container">
      <div class="wrapper">
        <div class="title"><span>Registo</span></div>
        <form action="registar.php" method="post" onsubmit="return validar_registo()" enctype="multipart/form-data">
          <div class="row">
            <i class="fas fa-asterisk"></i>
            <input type="text" placeholder="Id" name="id" id="id_professor">
          </div>
          <span id="error_registar_id" style="color:red;"></span>
          <div class="row">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="Nome" name="nome" id="nome">
          </div>
          <span id="error_registar_nome" style="color:red;"></span>
          <div class="row">
            <i class="fas fa-lock"></i>
            <input type="email" placeholder="Email" name="email" id="email"> 
          </div>
          <span id="error_registar_email" style="color:red;"></span>
          <div class="row">
            <select name="departamento" id="departamento">
              <option value="" disabled selected>Selecione o Departamento</option>
              <option value="informatica">Informática</option>
              <option value="matematica">Matemática</option>
              <option value="fisica">Física</option>
              <option value="quimica">Química</option>
              <option value="biologia">Biologia</option>
            </select>
          </div>
          <span id="error_registar_departamento" style="color:red;"></span>
          <input id="foto" type="file" placeholder="Foto" accept="image/*" onchange="getImagePreview(event)" name="image">
          <div id="preview"></div>
          <div id="removeButton" style="display: none;">
            <button type="button" onclick="removeImage()">Remover Imagem</button>
          </div>
          <span id="error_registar_foto" style="color:red;"></span>
          <br>
          <div class="row button">
            <input type="submit" value="Registar">
          </div>
        </form>
      </div>
    </div>

    <script>
      function getImagePreview(event) {
        var image = URL.createObjectURL(event.target.files[0]);
        var imagediv = document.getElementById('preview');
        var newimg = document.createElement('img');
        newimg.src = image;
        newimg.width = "100";
        imagediv.innerHTML = '';
        imagediv.appendChild(newimg);
        document.getElementById('removeButton').style.display = 'block'; // Mostra o botão de remover
      }

      function removeImage() {
        document.getElementById('preview').innerHTML = ''; // Remove a imagem da pré-visualização
        document.getElementById('foto').value = ''; // Limpa o campo de seleção de arquivo
        document.getElementById('removeButton').style.display = 'none'; // Esconde o botão de remover
      }

      function validar_registo() {
        var registo_id = document.getElementById("id_professor").value;
        var registo_nome = document.getElementById("nome").value;
        var registo_departamento = document.getElementById("departamento").value;
        var registo_email = document.getElementById("email").value;
        var registo_foto = document.getElementById("foto").value;

        document.getElementById("error_registar_id").innerHTML = "";
        document.getElementById("error_registar_nome").innerHTML = "";
        document.getElementById("error_registar_departamento").innerHTML = "";
        document.getElementById("error_registar_email").innerHTML = "";
        document.getElementById("error_registar_foto").innerHTML = "";

        if (registo_id == "" || registo_id.length != 4 || isNaN(registo_id)) {
          document.getElementById("error_registar_id").innerHTML = "Introduza um id válido";
          document.getElementById("id_professor").focus();
          return false;
        }
        if (registo_nome == "" || !isNaN(registo_nome)) {
          document.getElementById("error_registar_nome").innerHTML = "Introduza um nome válido";
          document.getElementById("nome").focus();
          return false;
        }
        if (registo_email == "" || registo_email.indexOf("@") == -1) {
          document.getElementById("error_registar_email").innerHTML = "Introduza um email válido";
          document.getElementById("email").focus();
          return false;
        }
        if (registo_departamento == "") {
          document.getElementById("error_registar_departamento").innerHTML = "Selecione um departamento válido";
          document.getElementById("departamento").focus();
          return false;
        }
        if (registo_foto == "") {
          document.getElementById("error_registar_foto").innerHTML = "Introduza uma foto válida";
          document.getElementById("foto").focus();
          return false;
        }

        return true;
      }
    </script>
  </body>
</html>
