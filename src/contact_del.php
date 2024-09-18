<?php
require_once('shared/db_connect.php');
require_once('shared/nav_tok.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $id         = $_GET['id'];
  $username   = $_SESSION['username'];

  $stmt = $conn->prepare("delete from contact WHERE id = ? and idUser = (select id from users where username=?)");
  $stmt->bind_param("is", $id,$username);
  if ($stmt->execute()) {
    $_SESSION['message'] = CONTACT_DEL_OK[$lang];
  } else {
    $_SESSION["message"] = CONTACT_DEL_ERR[$lang]." ". $stmt->error;
  }
  $stmt->close();
  $conn->close();
  header("Location: contact.php");
}
?>
