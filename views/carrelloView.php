<?php require_once 'headerView.php';?>
<?php
session_start();
$cart = $_SESSION['carrello'] ?? [];
?>

<div class="container">
    <h1>🛒 Il Mio Carrello</h1>
    <?php if (empty($cart)): ?>
        <p>Il carrello è vuoto.</p>
    <?php else: ?>
        <div class="prodotti">
            <?php foreach($cart as $item): ?>
                <div class="prodotto-card">
                    <img src="assets/images/<?php echo $item['image']; ?>" alt="<?php echo $item['title']; ?>">
                    <h3><?php echo $item['title']; ?><br><small><?php echo $item['artist']; ?></small></h3>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
<?php require_once 'footerView.php';?>