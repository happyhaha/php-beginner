<?php
session_start();

$allowed_types = ["png", "jpg"];

$file_extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

if(empty($_FILES['file']['name'])) {
    $_SESSION['error'] = "Загрузите файл.";
    header("Location: /");
    exit;
}

if(!in_array($file_extension, $allowed_types)) {
    $_SESSION['error'] = "Можно загрузать файлы только в формате: jpg, png";
    header("Location: /");
    exit;
}


$filename = uniqid() . "." . $file_extension;


move_uploaded_file($_FILES['file']['tmp_name'], "uploads/" . $filename);

$pdo = new PDO("mysql:host=MySQL-8.0;dbname=student;", "root", "");

$statement = $pdo->prepare("INSERT INTO images (image) VALUES (:filename)");
$statement->execute(['filename' => $filename]);

$_SESSION['success'] = "Изображение загружено";

header("Location: /");
exit;





















// session_start();

// $allowed_types = ["jpg", "png"];

// $file_extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

// if(empty($_FILES['file']['name'])) {
//     $_SESSION['error'] = "Загрузите картинку.";
//     header("Location: /");
//     exit;
// }


// if(!in_array($file_extension, $allowed_types)) {
//     $_SESSION['error'] = "Можно загрузать файлы только в формате: jpg, png";
//     header("Location: /");
//     exit;
// }

// $filename = uniqid() . "." . $file_extension;

// move_uploaded_file($_FILES['file']['tmp_name'], "uploads/" . $filename);

// $pdo = new PDO("mysql:host=MySQL-8.0;dbname=student;", "root", "");

// $statement = $pdo->prepare("INSERT INTO images (filename) VALUES (:filename)");
// $statement->execute(['filename' => $filename]);

// $_SESSION['success'] = "Изображение загружено";

// header("Location: /");
// exit;

