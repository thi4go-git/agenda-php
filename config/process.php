<?php

/*
session_start();
É usada para iniciar uma nova sessão ou continuar a sessão existente, dependendo se já existe uma sessão ativa para o usuário atual.
session_start(), o PHP verifica se uma sessão já está iniciada para o usuário atual (com base no cookie de sessão ou em um ID de sessão passado via URL). 
Se não houver uma sessão existente, uma nova será iniciada. Isso geralmente envolve a criação de um identificador de sessão único, que é então armazenado no 
servidor e enviado ao cliente (geralmente como um cookie) para identificar a sessão nas solicitações subsequentes.
Uma vez que session_start() é chamado com sucesso, você pode acessar e modificar as variáveis de sessão usando a superglobal $_SESSION. 
Essas variáveis persistirão durante toda a sessão do usuário, ou seja, elas estarão disponíveis em diferentes páginas do seu site enquanto a sessão estiver ativa.
*/
session_start();

/*
include_once: Inclui um código de um arquivo no arquivo atual, por exemplo a variável $conn que é usada nesse arquivo está vindo do arquivo connection.php
que foi incluído nesse arquivo atual.
*/
include_once("connection.php");
include_once("url.php");

$data = $_POST;//Recebe o que vem do formulário HTML através do POST

// MODIFICAÇÕES NO BANCO
if (!empty($data)) {

  //----------------------Criar contato
  if ($data["type"] === "create") {
    $name = $data["name"];
    $phone = $data["phone"];
    $observations = $data["observations"];

    $query = "INSERT INTO contacts (name, phone, observations) VALUES (:name, :phone, :observations)";

    $stmt = $conn->prepare($query);

    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":phone", $phone);
    $stmt->bindParam(":observations", $observations);
    try {

      $stmt->execute();
      $_SESSION["msg"] = "Contato criado com sucesso!";

    } catch (PDOException $e) {
      // erro na conexão
      $error = $e->getMessage();
      echo "Erro: $error";
    }

  } else if ($data["type"] === "edit") {

    //----------------------Editar contato
    $name = $data["name"];
    $phone = $data["phone"];
    $observations = $data["observations"];
    $id = $data["id"];

    $query = "UPDATE contacts 
                SET name = :name, phone = :phone, observations = :observations 
                WHERE id = :id";

    $stmt = $conn->prepare($query);

    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":phone", $phone);
    $stmt->bindParam(":observations", $observations);
    $stmt->bindParam(":id", $id);

    try {
      $stmt->execute();
      $_SESSION["msg"] = "Contato atualizado com sucesso!";
    } catch (PDOException $e) {
      $error = $e->getMessage();
      echo "Erro: $error";
    }

  } else if ($data["type"] === "delete") {

    //----------------------Deletar contato
    $id = $data["id"];
    $query = "DELETE FROM contacts WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":id", $id);

    try {
      $stmt->execute();
      $_SESSION["msg"] = "Contato removido com sucesso!";
    } catch (PDOException $e) {
      $error = $e->getMessage();
      echo "Erro: $error";
    }
  }

  // Redirecionar para a URL inicial HOME
  header("Location:" . $BASE_URL . "../index.php");
} else {

  //Retornar dados
  $id;
  if (!empty($_GET)) {
    $id = $_GET["id"];
  }

  // Retorna o dado de um contato
  if (!empty($id)) {
    $query = "SELECT * FROM contacts WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $contact = $stmt->fetch();
  } else {
    // Retorna todos os contatos
    $contacts = [];
    $query = "SELECT * FROM contacts";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $contacts = $stmt->fetchAll();
  }
}

// FECHAR CONEXÃO
$conn = null;