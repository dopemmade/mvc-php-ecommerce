<?php 
require_once 'headerView.php'; 
if (session_status() === PHP_SESSION_NONE) session_start();

$carrello = $_SESSION['carrello'] ?? [];
$totale = 0;
foreach($carrello as $item) {
    $totale += ((float)$item['price'] * (int)$item['qty']);
}
?>

<div class="container" style="max-width: 800px;">
    <h1>💳 Completa il tuo Ordine</h1>
    <p>Stai per acquistare <?php echo count($carrello); ?> articoli per un totale di <strong>€<?php echo number_format($totale, 2); ?></strong></p>

    <form action="index.php?pagina=elabora_pagamento" method="POST" style="margin-top:20px;">
        
        <fieldset>
            <legend>📍 Indirizzo di Spedizione</legend>
            <div class="form-group">
                <label>Nome e Cognome sulla spedizione</label>
                <input type="text" name="nome_spedizione" value="<?php echo $_SESSION['utente_loggato']; ?>" required>
            </div>
            <div class="form-group">
                <label>Indirizzo Completo</label>
                <input type="text" name="indirizzo" value="<?php echo $_SESSION['utente_indirizzo'] ?? ''; ?>" required placeholder="Via Roma 10">
            </div>
            <div class="form-group">
                <label>Provincia/Città</label>
                <input type="text" name="provincia" value="<?php echo $_SESSION['utente_provincia'] ?? ''; ?>" required placeholder="Milano">
            </div>
        </fieldset>

        <fieldset>
            <legend>🔒 Dati Pagamento (Simulato)</legend>
            <div class="form-group">
                <label>Titolare Carta</label>
                <input type="text" required placeholder="Mario Rossi">
            </div>
            <div class="form-group">
                <label>Numero Carta di Credito</label>
                <input type="text" required placeholder="XXXX-XXXX-XXXX-XXXX" maxlength="19">
            </div>
            <div style="display:flex; gap:20px;">
                <div class="form-group" style="flex:1;">
                    <label>Scadenza (MM/YY)</label>
                    <input type="text" required placeholder="12/25" maxlength="5">
                </div>
                <div class="form-group" style="flex:1;">
                    <label>CVV</label>
                    <input type="text" required placeholder="123" maxlength="3">
                </div>
            </div>
        </fieldset>

        <div class="termini-box">
            <input type="checkbox" required id="termini">
            <label for="termini">Confermo l'ordine e pago <strong>€<?php echo number_format($totale, 2); ?></strong> in modo sicuro e simulato.</label>
        </div>

        <button type="submit" class="form-submit" style="background:#2ecc71; font-size:1.2em;">Conferma Ordine & Paga</button>
    </form>
</div>

<?php require_once 'footerView.php'; ?>
