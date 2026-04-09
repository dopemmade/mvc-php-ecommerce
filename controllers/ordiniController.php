<?php
if (session_status() === PHP_SESSION_NONE) session_start();

// Blocca se utente non loggato
if (!isset($_SESSION['utente_loggato'])) {
    header("Location: index.php?pagina=login");
    exit();
}

$email_utente = $_SESSION['utente_email'] ?? '';
$ordini = getOrdiniUtente($connessione, $email_utente);

require_once 'views/ordiniView.php';
?>
