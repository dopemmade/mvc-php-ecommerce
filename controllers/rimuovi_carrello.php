<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['album_title'] ?? '';
    foreach ($_SESSION['carrello'] as $key => $item) {
        if ($item['title'] === $title) {
            unset($_SESSION['carrello'][$key]);
            break;
        }
    }
    // re-indice array
    $_SESSION['carrello'] = array_values($_SESSION['carrello']);
    header('Location: ../index.php?pagina=carrello&removed=1');
    exit;
}
?>