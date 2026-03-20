<?php 
require_once 'headerView.php'; 
if (session_status() === PHP_SESSION_NONE) session_start();
?>

<div class="hero">
    <h1>🎵 Benvenuto su VinylFlow!</h1>
    <p>Scopri i migliori vinili di rap e hip hop, classici e nuove uscite.</p>
    <a href="index.php?pagina=catalogo" class="btn-explore">🎧 Sfoglia il Catalogo</a>
</div>

<div class="chi_siamo">
    <h2>Chi Siamo</h2>
    <p>
        VinylFlow nasce dalla passione per il rap e l’hip hop.  
        Amiamo i vinili, la musica autentica e vogliamo condividerla con tutti gli appassionati.
    </p>
</div>

<div class="prodotti">
    <div class="prodotto-card">
        <img src="assets\images\68b2be79042b3bd6a897541f90e2a2b8 (1).jpg" alt="Vinile 1">
        <h3>Kendrick Lamar – DAMN.</h3>
        <p>Edizione vinile classica, stampa 180g di alta qualità.</p>
        <a href="index.php?pagina=prodotto&id=1" class="btn-explore">Acquista</a>
    </div>
    <div class="prodotto-card">
        <img src="assets\images\9881bc31bc10e20eb2f76d4ca8e970fe.jpg" alt="Vinile 2">
        <h3>Nas – Illmatic</h3>
        <p>Vinile cult del 1994, ristampa limitata.</p>
        <a href="index.php?pagina=prodotto&id=2" class="btn-explore">Acquista</a>
    </div>
    <div class="prodotto-card">
        <img src="assets\images\1b925714fba43f122007a00ae539cb12.jpg" alt="Vinile 3">
        <h3>Kanye West – My Beautiful Dark Twisted Fantasy</h3>
        <p>Vinile con copertina deluxe e poster inclusi.</p>
        <a href="index.php?pagina=prodotto&id=3" class="btn-explore">Acquista</a>
    </div>
</div>

<?php require_once 'footerView.php'; ?>