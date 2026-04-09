<?php
session_start();
require_once '../config.php';
require_once '../getdbConnection.php';
require_once '../models/model.php';

// Inizializza il carrello se non esiste
if (!isset($_SESSION['carrello'])) {
    $_SESSION['carrello'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $album = [
        'id'     => $_POST['album_id'] ?? 0,
        'title'  => $_POST['album_title'] ?? '',
        'artist' => $_POST['album_artist'] ?? '',
        'image'  => $_POST['album_image'] ?? '',
        'price'  => $_POST['album_price'] ?? 0
    ];

    // Verifica la reale disponibilità nel DB
    $prodotto_db = getProdottoById($conn, $album['id']);
    $stock_disponibile = $prodotto_db ? (int)$prodotto_db['stock'] : 0;

    // Quanti ne abbiamo già nel carrello?
    $qty_in_cart = 0;
    $found_key = -1;
    foreach ($_SESSION['carrello'] as $key => $item) {
        if ($item['id'] == $album['id']) {
            $qty_in_cart = $item['qty'];
            $found_key = $key;
            break;
        }
    }

    if (($qty_in_cart + 1) > $stock_disponibile) {
        // Stock insufficiente
        header('Location: ../index.php?pagina=carrello&error=nostock');
        exit;
    }

    // Aggiunge l'album se non trovato
    if ($found_key === -1) {
        $album['qty'] = 1;
        $_SESSION['carrello'][] = $album;
    } else {
        // Incrementa la voce esistente
        $_SESSION['carrello'][$found_key]['qty']++;
    }

    // Torna al catalogo con messaggio
    header('Location: ../index.php?pagina=catalogo&added=1');
    exit;
}
?>