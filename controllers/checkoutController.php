<?php
if (session_status() === PHP_SESSION_NONE) session_start();

// Blocca se utente non loggato o carrello vuoto
if (!isset($_SESSION['utente_loggato'])) {
    header("Location: index.php?pagina=login&errore=Devi essere loggato per pagare");
    exit();
}

if (empty($_SESSION['carrello'])) {
    header("Location: index.php?pagina=carrello");
    exit();
}

require_once 'views/checkoutView.php';
?>
