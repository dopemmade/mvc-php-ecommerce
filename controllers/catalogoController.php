<?php
// Avvia sessione se inesistente per accesso al DB o messaggi
if (session_status() === PHP_SESSION_NONE) session_start();
$connessione = getDbconnection();

// Se l'admin sta aggiungendo un prodotto
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['azione']) && $_POST['azione'] === 'aggiungi_prodotto') {
    // Controllo permessi
    if(isset($_SESSION['ruolo']) && $_SESSION['ruolo'] === 'admin') {
        $title = trim($_POST['title'] ?? '');
        $artist = trim($_POST['artist'] ?? '');
        $price = trim($_POST['price'] ?? 0);
        $stock = trim($_POST['stock'] ?? 0);
        $image = 'default_album.jpg';

        // Gestione semplice dell'immagine tramite testo, o default
        if(isset($_POST['image_name']) && !empty(trim($_POST['image_name']))) {
            $image = trim($_POST['image_name']);
        }

        if(!empty($title) && !empty($artist)) {
            aggiungiProdottoCatalogo($connessione, $title, $artist, $image, $price, $stock);
        }
    }
    // Ricarica la pagina impedendo il reinvio del form
    header("Location: index.php?pagina=catalogo&admin_added=1");
    exit();
}

// Recuperiamo tutti i prodotti dal db
$album_list = getCatalogo($connessione);

require_once 'views/catalogoView.php';
?>