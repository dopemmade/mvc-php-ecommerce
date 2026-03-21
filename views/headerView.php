<?php
// Avviamo la sessione se non è già attiva
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Bastianon">
    <meta name="description" content="Pagine e-commerce">
    <title>ShopOnline - Home</title>

    <link rel="shortcut icon" href="../images/ecommerce.png" type="png"> 
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <header>
        <h1>🛒 ShopOnline</h1>
        <span class="slogan">
            <p>I tuoi acquisti online, sempre convenienti!</p>
        </span>
    </header>
    <?php
        $pagina_corrente = $_GET['pagina'] ?? 'home';
        ?>

    <nav class="main_nav">
    <a href="index.php?pagina=home" class="<?php echo ($pagina_corrente == 'home') ? 'attivo' : ''; ?>">🏠Home</a>

    <a href="index.php?pagina=catalogo" class="<?php echo ($pagina_corrente == 'catalogo') ? 'attivo' : ''; ?>">🦃Catalogo</a>

    <a href="index.php?pagina=chi_siamo" class="<?php echo ($pagina_corrente == 'chi_siamo') ? 'attivo' : ''; ?>">👨🏻‍🦳Chi siamo</a>

    <a href="index.php?pagina=contatti" class="<?php echo ($pagina_corrente == 'contatti') ? 'attivo' : ''; ?>">📞Contatti</a>

    <a href="index.php?pagina=carrello" class="<?php echo ($pagina_corrente == 'carrello') ? 'attivo' : ''; ?>">🛒Carrello</a>

    <?php if (isset($_SESSION['utente_loggato'])): ?>
        <div class="user-dropdown">
            <a href="#" class="dropbtn">
                <img src="assets/images/<?php echo $_SESSION['user_photo'] ?? 'default.png'; ?>" alt="Profile" class="user-avatar">
                <?php echo $_SESSION['utente_loggato']; ?> ▾
            </a>
            <div class="dropdown-content">
                <a href="index.php?pagina=profilo">👤 I miei dati</a>
                <a href="index.php?pagina=ordini">📦 I miei ordini</a>
                <a href="logout.php" class="logout-red">🚪 Logout</a>
            </div>
        </div>
    <?php else: ?>
        <a href="index.php?pagina=login">Login</a>
        <a href="index.php?pagina=registrazione">Registrazione</a>
    <?php endif; ?>
</nav>