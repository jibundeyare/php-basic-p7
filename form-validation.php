<?php

use \DateTime;

require __DIR__.'/vendor/autoload.php';

$errors = [];

if ($_POST) {
    $minLength = 3;
    $maxLength = 10;

    if (empty($_POST['login'])) {
        // le champs est-il vide ?
        $errors['login'] = 'merci de renseigner ce champ';
    } elseif (strlen($_POST['login']) < 3 || strlen($_POST['login']) > 10) {
        // la longueur du login est-elle hors des limites ?
        $errors['login'] = "merci de renseigner un login dont la longueur est comprise entre {$minLength} et {$maxLength} inclus";
    } elseif (preg_match('/^[a-zA-Z]+$/', $_POST['login']) === 0) {
        // le login est-il composé exclusivement de lettres de a à z, majuscules ou mnisucules ?
        $errors['login'] = 'merci de renseigner un login composé uniquement de lettres de l\'alphabet sans accent';
    }

    $date = new DateTime();
    $maxYear = (int) $date->format('Y');
    $minYear = $maxYear - 100;

    if (empty($_POST['year'])) {
        // le champs est-il vide ?
        $errors['year'] = 'merci de renseigner ce champ';
    } elseif (!is_numeric($_POST['year'])) {
        // la valeur est-elle numérique ?
        $errors['year'] = 'merci de renseigner ce champ avec une année valide';
    } elseif ((float) $_POST['year'] - (int) $_POST['year'] != 0) {
        // la valeur possède-t-elle des chiffres après la virgule ?
        $errors['year'] = 'merci de renseigner ce champ avec une année valide';
    } elseif ($_POST['year'] <= $minYear || $_POST['year'] >= $maxYear) {
        // la valeur est-elle hors des limites ?
        $errors['year'] = "merci de renseigner une année comprise entre {$minYear} et {$maxYear} inclus";
    }

    if (empty($_POST['email'])) {
        $errors['email'] = 'merci de renseigner ce champ';
    } elseif (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == false) {
        $errors['email'] = 'merci de renseigner un email valide';
    }
}

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post" novalidate>
        <?php if (isset($errors['login'])): ?>
            <div class="error">
                <?= $errors['login'] ?>
            </div>
        <?php endif ?>
        <div>
            <input type="text" name="login" placeholder="login" required>
        </div>
        <?php if (isset($errors['year'])): ?>
            <div class="error">
                <?= $errors['year'] ?>
            </div>
        <?php endif ?>
        <div>
            <input type="number" name="year"placeholder="year" required>
        </div>
        <?php if (isset($errors['email'])): ?>
            <div class="error">
                <?= $errors['email'] ?>
            </div>
        <?php endif ?>
        <div>
            <input type="email" name="email" placeholder="email" required>
        </div>
        <div>
            <button type="submit">valider</button>
        </div>
    </form>
</body>
</html>