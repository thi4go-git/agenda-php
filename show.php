<!-- incui o HEADER -->
<?php
include_once("templates/header.php");
?>

<div class="container" id="view-contact-container">
  <!-- incui o Botão de voltar -->
  <?php include_once("templates/backbtn.html"); ?>
  <h1 id="main-title">
    <?= $contact["name"] ?>
  </h1>
  <p class="bold">Telefone:</p>
  <p>
    <?= $contact["phone"] ?>
  </p>
  <p class="bold">Observações:</p>
  <p>
    <?= $contact["observations"] ?>
  </p>
</div>

<!-- Inclui o Rodapé -->
<?php
include_once("templates/footer.php");
?>