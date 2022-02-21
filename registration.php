<?php

if(session_id() == '') {
    session_start();
}

require_once 'dbconnect.php';

if (!empty($_POST['submit'])) {
    // Очищаем пришедшие данные от HTML и PHP тегов
    $firstName = strip_tags($_POST['firstName']);
    $lastName = strip_tags($_POST['lastName']);
    $email = strip_tags($_POST['email']);
    $password = strip_tags($_POST['password']);

    $query = "SELECT * FROM user WHERE login = '$email'";
    $res = mysqli_query($mysqli, $query);

    if($res->{'num_rows'} != 0) {
        echo '<h1>Почта занята!<h1>';
    }
    else {
        $query = "INSERT INTO user (first_name, last_name, email, password) VALUES ('$firstName', '$lastName', '$email', '$password')";
        $res = mysqli_query($mysqli, $query);
        if (!$res) die (mysqli_error($mysqli));
        header('Location:../html/index.php');

    }
}
