<?php
include_once("templates/header.php");
?>
<div class="container">

  <!-- inclusão do botão voltar -->
  <?php include_once("templates/backbtn.html"); ?>

  <h1 id="main-title">Criar contato</h1>
  <!-- 
    Esse form dá um submit nesse formulário e popula a variável $data = $_POST; do arquivo config/process.php
    de acordo com as informações desse formulário ele adiciona, edita,exclui lá no config/process.php, como
    o input aqui é <input type="hidden" name="type" value="create">, como esse input é (create), ele vai cair no IF referente ao create lá no config/process.php
  -->
  <form id="create-form" action="<?= $BASE_URL ?>config/process.php" method="POST">
    <input type="hidden" name="type" value="create">
    <div class="form-group">
      <label for="name">Nome do contato:</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="Digite o nome" required>
    </div>
    <div class="form-group">
      <label for="phone">Telefone do contato:</label>
      <input type="text" class="form-control" id="phone" name="phone" placeholder="Digite o telefone" required>
    </div>
    <div class="form-group">
      <label for="observations">Observações:</label>
      <textarea type="text" class="form-control" id="observations" name="observations"
        placeholder="Insira as observações" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Cadastrar</button>
  </form>

</div>
<?php
include_once("templates/footer.php");
?>