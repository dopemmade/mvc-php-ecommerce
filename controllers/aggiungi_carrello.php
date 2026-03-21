<?php
session_start();

// Inizializza il carrello se non esiste
if (!isset($_SESSION['carrello'])) {
    $_SESSION['carrello'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $album = [
        'title'  => $_POST['album_title'] ?? '',
        'artist' => $_POST['album_artist'] ?? '',
        'image'  => $_POST['album_image'] ?? ''
    ];

    // Evita duplicati: aumenta qty se già presente
    $found = false;
    foreach ($_SESSION['carrello'] as &$item) {
        if ($item['title'] === $album['title']) {
            $item['qty'] = ($item['qty'] ?? 1) + 1;
            $found = true;
            break;
        }
    }

    // Aggiunge l'album se non trovato
    if (!$found) {
        $album['qty'] = 1;
        $_SESSION['carrello'][] = $album;
    }

    // Torna al catalogo con messaggio
    header('Location: ../index.php?pagina=catalogo&added=1');
    exit;
}
?>