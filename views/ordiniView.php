<?php require_once 'headerView.php'; ?>

<div class="container-catalog">
    <h1>📦 I Miei Ordini</h1>
    <p style="text-align:center; margin-bottom: 30px;">
        Ecco lo storico di tutti i tuoi acquisti completati con successo.
    </p>

    <?php if(empty($ordini)): ?>
        <div style="text-align:center; padding: 40px; background:#f4f6f5; border-radius: 8px;">
            <p style="font-size: 1.2em; color: #555;">Non hai ancora effettuato nessun ordine.</p>
            <br>
            <a href="index.php?pagina=catalogo" class="btn-explore">Sfoglia il catalogo</a>
        </div>
    <?php else: ?>
        <div style="display:flex; flex-direction:column; gap: 30px;">
            <?php foreach($ordini as $ordine): ?>
                <div style="background:#fff; border: 1px solid #ddd; border-radius: 8px; overflow:hidden; box-shadow:0 4px 10px rgba(0,0,0,0.05);">
                    <!-- Header Ordine -->
                    <div style="background:#222831; padding: 15px 20px; color:white; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap;">
                        <div>
                            <span style="display:block; font-size:0.85em; color:#bbb;">ORDINE EFFETTUATO IL</span>
                            <strong><?php echo date('d/m/Y - H:i', strtotime($ordine['data'])); ?></strong>
                        </div>
                        <div>
                            <span style="display:block; font-size:0.85em; color:#bbb;">TOTALE</span>
                            <strong>€<?php echo number_format($ordine['totale'], 2); ?></strong>
                        </div>
                        <div style="text-align:right;">
                            <span style="display:block; font-size:0.85em; color:#bbb;">NUMERO ORDINE</span>
                            <strong><?php echo htmlspecialchars($ordine['numero_ordine']); ?></strong>
                        </div>
                    </div>
                    
                    <!-- Dettagli Ordine -->
                    <div style="padding: 20px; background:#fafafa;">
                        <h4 style="margin-bottom:15px; border-bottom:1px solid #ccc; padding-bottom:5px;">Articoli Acquistati:</h4>
                        <div style="display:flex; flex-wrap:wrap; gap: 20px;">
                            <?php foreach($ordine['dettagli'] as $dettaglio): ?>
                                <div style="display:flex; align-items:center; gap:15px; background:#fff; padding:10px; border:1px solid #eee; border-radius:6px; flex:1; min-width:250px;">
                                    <img src="assets/images/<?php echo htmlspecialchars($dettaglio['img_prodotto']); ?>" style="width:60px; height:60px; object-fit:cover; border-radius:4px;" alt="copertina">
                                    <div>
                                        <p style="margin:0; font-weight:bold; color:#222831;"><?php echo htmlspecialchars($dettaglio['titolo_prodotto']); ?></p>
                                        <p style="margin:0; font-size:0.9em; color:#666;">Qtà: <?php echo $dettaglio['quantita']; ?></p>
                                        <p style="margin:0; font-size:0.9em; color:#d7263d;">€<?php echo number_format($dettaglio['prezzo_unitario'], 2); ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php require_once 'footerView.php'; ?>
