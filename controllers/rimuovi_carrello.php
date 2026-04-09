<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $azione = $_POST['azione'] ?? 'rimuovi_singolo';
    
    if ($azione === 'svuota') {
        $_SESSION['carrello'] = [];
        header('Location: ../index.php?pagina=carrello&cleared=1');
        exit;
    }

    $id = $_POST['album_id'] ?? 0;
    foreach ($_SESSION['carrello'] as $key => $item) {
        if ($item['id'] == $id) {
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