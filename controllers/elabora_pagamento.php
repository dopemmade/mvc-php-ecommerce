<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once 'getdbConnection.php';
require_once 'models/model.php';

if (!isset($_SESSION['utente_loggato']) || empty($_SESSION['carrello'])) {
    header("Location: index.php?pagina=carrello");
    exit();
}

$conn = getDbconnection();

// Simula logica di controllo finale prima di scalare soldi
$carrello_valido = true;
$totale = 0;
foreach($_SESSION['carrello'] as $item) {
    if(!isset($item['id']) || $item['id'] == 0) continue; 
    
    $prodotto = getProdottoById($conn, $item['id']);
    if(!$prodotto || $prodotto['stock'] < $item['qty']) {
        $carrello_valido = false;
        break;
    }
    $totale += ((float)$item['price'] * (int)$item['qty']);
}

if(!$carrello_valido) {
    header("Location: index.php?pagina=carrello&error=nostock");
    exit();
}

// Riduzione effettiva dello stock
$success = aggiornaStockPagamento($conn, $_SESSION['carrello']);

if($success) {
    // Genera finto ordine ID e SALVA NEL DB
    $orderId = "ORD-" . date('Ymd') . "-" . rand(1000, 9999);
    $email_utente = $_SESSION['utente_email'] ?? '';
    
    if(!empty($email_utente)) {
        salvaOrdine($conn, $email_utente, $_SESSION['carrello'], $totale, $orderId);
    }

    // Svuotiamo il carrello
    $_SESSION['carrello'] = [];
    
    header("Location: index.php?pagina=successo&order=$orderId");
    exit();
} else {
    // Errore DB
    header("Location: index.php?pagina=carrello&error=dberror");
    exit();
}
?>
