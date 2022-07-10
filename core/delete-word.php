<?php
$conn = require_once 'connectDB.php';
$id = $_GET['id'];

$sql_del = 'DELETE FROM dictionary WHERE id=?';

$query = $conn->prepare($sql_del);
$query->execute([$id]);
//exit("Запись удалена");
header("Location: /dictionary-list.php");
?>