<?php 
require_once 'headerView.php'; 
if (session_status() === PHP_SESSION_NONE) session_start();
?>

<?php if(isset($_GET['added'])): ?>
        <div class="profile-msg success">
            ✅ Album aggiunto al carrello!
        </div>
<?php endif; ?>

<?php if(isset($_GET['admin_added'])): ?>
    <div class="profile-msg success">
        ✅ Prodotto salvato nel catalogo con successo!
    </div>
<?php endif; ?>

<div class="container-catalog">
    <h1>🎵 Catalogo Vinili Hip Hop & Rap</h1>
    <p style="text-align:center; margin-bottom:30px;">
        Scopri tutti i nostri vinili e aggiungili al carrello!
    </p>

    <?php if(isset($_SESSION['ruolo']) && $_SESSION['ruolo'] === 'admin'): ?>
    <div class="admin-panel mb-4">
        <h2>🛠️ Pannello Amministratore - Aggiungi Nuovo Vinile</h2>
        <form method="POST" action="index.php?pagina=catalogo" class="admin-form">
            <input type="hidden" name="azione" value="aggiungi_prodotto">
            
            <div class="form-group">
                <label>Titolo Album:</label>
                <input type="text" name="title" required placeholder="Es. The Blueprint">
            </div>
            <div class="form-group">
                <label>Artista:</label>
                <input type="text" name="artist" required placeholder="Es. Jay-Z">
            </div>
            <div class="form-group">
                <label>Prezzo (€):</label>
                <input type="number" step="0.01" name="price" required placeholder="19.99">
            </div>
            <div class="form-group">
                <label>Pezzi in Stock:</label>
                <input type="number" name="stock" required placeholder="10">
            </div>
            <div class="form-group">
                <label>Nome file immagine (es. blueprint.jpg):</label>
                <input type="text" name="image_name" placeholder="Lascia vuoto per default_album.jpg">
            </div>
            
            <button type="submit" class="btn-admin">➕ Aggiungi al DB</button>
        </form>
    </div>
    <?php endif; ?>

    <div class="prodotti">
        <?php 
        // $album_list arriva da catalogoController.php
        foreach($album_list as $album): 
            $outOfStock = ($album['stock'] <= 0);
            $lowStock = ($album['stock'] > 0 && $album['stock'] <= 3);
            
            // Retrocompatibiltà chiavi model
            $immagine = !empty($album['img']) ? $album['img'] : 'default_album.jpg';
        ?>
        <div class="prodotto-card <?php echo $outOfStock ? 'out-of-stock-card' : ''; ?>">
            <img src="assets/images/<?php echo htmlspecialchars($immagine); ?>" alt="<?php echo htmlspecialchars($album['title']); ?>">
            
            <h3><?php echo htmlspecialchars($album['title']); ?><br><small><?php echo htmlspecialchars($album['artist']); ?></small></h3>
            
            <div class="price-container">
                <p class="price-tag">€<?php echo number_format((float)$album['price'], 2); ?></p>
                <?php if($outOfStock): ?>
                    <span class="badge badge-stock-out">Esaurito</span>
                <?php elseif($lowStock): ?>
                    <span class="badge badge-stock-low">Solo <?php echo $album['stock']; ?> rimasti!</span>
                <?php else: ?>
                    <span class="badge badge-stock-ok">Disponibile (<?php echo $album['stock']; ?>)</span>
                <?php endif; ?>
            </div>

            <form method="POST" action="controllers/aggiungi_carrello.php">
                <input type="hidden" name="album_id" value="<?php echo htmlspecialchars($album['id']); ?>">
                <input type="hidden" name="album_title" value="<?php echo htmlspecialchars($album['title']); ?>">
                <input type="hidden" name="album_artist" value="<?php echo htmlspecialchars($album['artist']); ?>">
                <input type="hidden" name="album_image" value="<?php echo htmlspecialchars($immagine); ?>">
                <input type="hidden" name="album_price" value="<?php echo htmlspecialchars($album['price']); ?>">
                
                <?php if(!$outOfStock): ?>
                    <button type="submit" class="btn-cart">🛒 Aggiungi</button>           
                <?php else: ?>
                    <button type="button" class="btn-cart disabled" disabled style="background:#ccc;cursor:not-allowed;">Finito</button>
                <?php endif; ?>
            </form>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require_once 'footerView.php'; ?>