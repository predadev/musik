<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"]);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: index.html?error=1");
        exit;
    }

    $fichier = "abonnes.txt";
    $existeDeja = false;

    if (file_exists($fichier)) {
        $emails = file($fichier, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if (in_array($email, $emails)) {
            $existeDeja = true;
        }
    }

    if (!$existeDeja) {
        file_put_contents($fichier, $email . PHP_EOL, FILE_APPEND | LOCK_EX);
        header("Location: index.html?success=1");
    } else {
        header("Location: index.html?exists=1");
    }
    exit;
}
?>
