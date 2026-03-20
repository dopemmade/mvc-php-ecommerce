<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $album = [
        'title'  => $_POST['album_title'] ?? '',
        'artist' => $_POST['album_artist'] ?? '',
        'image'  => $_POST['album_image'] ?? ''
    ];

    // Evita duplicati: aggiunge solo se non presente
    $already_in_cart = false;
    foreach ($_SESSION['carrello'] as $item) {
        if ($item['title'] === $album['title']) {
            $already_in_cart = true;
            break;
        }
    }

    if (!$already_in_cart) {
        $_SESSION['carrello'][] = $album;
    }

    // Torna al catalogo (puoi aggiungere ?added=1 per messaggio)
    header('Location: index.php?pagina=catalogo&added=1');
    exit;
}
?>