<?php require_once 'headerView.php';?>
<?php
$carrello = $_SESSION['carrello'] ?? [];
?>

<div class="container-catalog">
    <h1>🛒 Il tuo carrello</h1>

    <?php if(empty($carrello)): ?>
        <p>Il carrello è vuoto.</p>
    <?php else: ?>
        <div class="prodotti">
            <?php foreach($carrello as $item): ?>
                <div class="prodotto-card">
                    <img src="assets/images/<?php echo $item['image']; ?>" alt="<?php echo $item['title']; ?>">
                    <h3><?php echo $item['title']; ?><br><small><?php echo $item['artist']; ?></small></h3>
                    <p>Quantità: <?php echo $item['qty'] ?? 1; ?></p>
                    <form method="POST" action="controllers/rimuovi_carrello.php">
                        <input type="hidden" name="album_title" value="<?php echo $item['title']; ?>">
                        <button type="submit" class="btn-cart">❌ Rimuovi</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
<?php require_once 'footerView.php';?>