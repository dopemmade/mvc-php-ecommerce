<?php
require_once "models/model.php"; // Qui deve esserci la tua $connessione al DB esercizio_utenti

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($connessione, $_POST['em']);
    $password = $_POST['pw'];

    // Recuperiamo l'utente cercando per email
    $sql = "SELECT * FROM utenti WHERE email = '$email'";
    $risultato = mysqli_query($connessione, $sql);

    if ($risultato && mysqli_num_rows($risultato) > 0) {
        $utente = mysqli_fetch_assoc($risultato);

        // Verifichiamo la password hashata
        if (password_verify($password, $utente['password'])) {
            if (session_status() === PHP_SESSION_NONE) session_start();

            // SALVIAMO I DATI IN SESSIONE
            $_SESSION['utente_loggato'] = $utente['nome'];
            $_SESSION['utente_email']   = $utente['email']; // <--- AGGIUNGI QUESTA RIGA
            // Fondamentale: salviamo il nome della foto (pfp) nella sessione
            // Se è vuoto nel DB, usiamo 'default.png'
            $_SESSION['user_photo'] = !empty($utente['pfp']) ? $utente['pfp'] : 'default.png';

            header("Location: index.php?pagina=home");
            exit();
        } else {
            // Password errata
            header("Location: index.php?pagina=login&errore=1");
            exit();
        }
    } else {
        // Utente non trovato
        header("Location: index.php?pagina=login&errore=1");
        exit();
    }
}