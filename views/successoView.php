<?php require_once 'headerView.php'; ?>

<div class="hero">
    <h1 style="color:#2ecc71; font-size: 3em;">🎉 Ordine Completato!</h1>
    <p>Grazie per il tuo acquisto, <strong><?php echo $_SESSION['utente_loggato'] ?? 'Cliente'; ?></strong>.</p>
    
    <div style="background:#f4f6f5; padding: 20px; border-radius: 8px; display:inline-block; margin:20px 0;">
        <h3>Il tuo numero d'ordine è: <span style="color:#d7263d;">#<?php echo htmlspecialchars($_GET['order'] ?? '00000'); ?></span></h3>
    </div>
    
    <p>Abbiamo inviato un'email riepilogativa all'indirizzo associato al tuo profilo.</p>
    <p>La tua spedizione partirà nei prossimi 2 giorni lavorativi.</p>
    
    <br><br>
    <a href="index.php?pagina=catalogo" class="btn-explore">Torna al Catalogo per Nuovi Acquisti</a>
</div>

<?php require_once 'footerView.php'; ?>
