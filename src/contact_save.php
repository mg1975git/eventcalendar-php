<?php
require_once('shared/db_connect.php');
require_once('shared/nav_tok.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  $idContact  = $_POST["idContact"]??null;
  $name       = $_POST['name'];
  $surname    = $_POST['surname'];
  $email      = $_POST['email'];
  $tel        = $_POST['tel'];
  $address    = $_POST['address'];
  $city       = $_POST['city'];
  $dataIns    = date('Y-m-d');
  $username   = $_SESSION['username'];

  if(isset($idContact)){
    $sql = "UPDATE contact SET name = ?, surname = ?, email = ?, tel = ?, address = ?, city = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $name, $surname, $email, $tel, $address, $city, $idContact);
    if ($stmt->execute()) {
      $_SESSION['message'] = CONTACT_UPD_OK[$lang];
    } else {
      $_SESSION["message"] = CONTACT_UPD_ERR[$lang]." ". $stmt->error;
    }
    header("Location: contact.php");
  }else{
    $sql="INSERT INTO contact (name, surname, email, tel, address, city, dataIns,idUser) ".
    "VALUES ('$name', '$surname', '$email', '$tel', '$address', '$city', now(), (select id from users where username='$username'))";
    if ($conn->query($sql) === TRUE) {
      $_SESSION['message'] = CONTACT_INS_OK[$lang];
      header("Location: contact.php");
    } else {
      $_SESSION["message"] = CONTACT_INS_ERR[$lang]." ". $conn->error;
      header("Location: contact.php");
    }
  }
}
$conn->close();
?>