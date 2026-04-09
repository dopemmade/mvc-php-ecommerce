<?php require_once 'headerView.php';?>
<?php
$carrello = $_SESSION['carrello'] ?? [];
$totale_carrello = 0;
?>

<div class="container-catalog">
    <h1>🛒 Il tuo carrello</h1>

    <?php if(isset($_GET['error']) && $_GET['error'] == 'nostock'): ?>
        <div class="profile-msg error">
            ⚠️ Impossibile aggiungere al carrello: Stock insufficiente per questo prodotto.
        </div>
    <?php endif; ?>

    <?php if(isset($_GET['removed'])): ?>
        <div class="profile-msg success">
            ✅ Prodotto rimosso dal carrello.
        </div>
    <?php endif; ?>
    <?php if(isset($_GET['cleared'])): ?>
        <div class="profile-msg success">
            🧹 Carrello svuotato con successo.
        </div>
    <?php endif; ?>

    <?php if(empty($carrello)): ?>
        <p style="text-align:center; margin-top:30px; font-size:1.1em;">Il carrello è tristemente vuoto! <br><br> <a href="index.php?pagina=catalogo" class="btn-explore">Vai al Catalogo</a></p>
    <?php else: ?>
        <table class="cart-table" style="width: 100%; border-collapse: collapse; margin-top: 20px;">
            <thead>
                <tr style="background-color: #222831; color: white;">
                    <th style="padding:15px; text-align:left;">Prodotto</th>
                    <th style="padding:15px; text-align:center;">Prezzo Unit.</th>
                    <th style="padding:15px; text-align:center;">Quantità</th>
                    <th style="padding:15px; text-align:center;">Subtotale</th>
                    <th style="padding:15px; text-align:center;">Azione</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($carrello as $item): 
                    $subtotale = (float)$item['price'] * (int)$item['qty'];
                    $totale_carrello += $subtotale;
                ?>
                <tr style="border-bottom: 1px solid #ccc;">
                    <td style="padding:15px; display:flex; align-items:center; gap:15px;">
                        <img src="assets/images/<?php echo htmlspecialchars($item['image']); ?>" alt="img" style="width:50px; height:50px; object-fit:cover; border-radius:5px;">
                        <div>
                            <strong><?php echo htmlspecialchars($item['title']); ?></strong><br>
                            <small><?php echo htmlspecialchars($item['artist']); ?></small>
                        </div>
                    </td>
                    <td style="padding:15px; text-align:center;">€<?php echo number_format($item['price'], 2); ?></td>
                    <td style="padding:15px; text-align:center;"><strong><?php echo $item['qty']; ?></strong></td>
                    <td style="padding:15px; text-align:center; font-weight:bold; color:#d7263d;">€<?php echo number_format($subtotale, 2); ?></td>
                    <td style="padding:15px; text-align:center;">
                        <form method="POST" action="controllers/rimuovi_carrello.php">
                            <input type="hidden" name="azione" value="rimuovi_singolo">
                            <input type="hidden" name="album_id" value="<?php echo $item['id']; ?>">
                            <button type="submit" class="btn-small" style="background:#e74c3c;">❌ Elimina</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div style="margin-top: 30px; text-align: right; padding: 20px; background-color: #f8f9fa; border-radius: 8px;">
            <h2 style="font-size:1.8em; margin-bottom: 20px;">Totale: <span style="color:#222831;">€<?php echo number_format($totale_carrello, 2); ?></span></h2>
            
            <div style="display:flex; justify-content: flex-end; gap: 15px;">
                <form method="POST" action="controllers/rimuovi_carrello.php">
                    <input type="hidden" name="azione" value="svuota">
                    <button type="submit" class="btn-explore" style="background:#788585;">🧹 Svuota Carrello</button>
                </form>
                
                <?php if (isset($_SESSION['utente_loggato'])): ?>
                    <a href="index.php?pagina=checkout" class="btn-explore" style="background:#2ecc71;">💳 Procedi al Checkout</a>
                <?php else: ?>
                    <a href="index.php?pagina=login&redirect=checkout" class="btn-explore" style="background:#f39c12;">Effettua il Login per Pagare</a>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php require_once 'footerView.php';?>