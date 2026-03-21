<?php 
require_once 'headerView.php'; 
if (session_status() === PHP_SESSION_NONE) session_start();
?>

<div class="container-catalog">
    <h1>👨‍👩‍👧‍👦 Chi siamo</h1>
    <p style="text-align:center; margin-bottom:30px;">
        Benvenuti su ShopOnline! Siamo appassionati di vinili Hip Hop & Rap e ci impegniamo a portarvi la migliore selezione direttamente a casa vostra.
    </p>

    <div class="chi_siamo">
        <h2>La nostra missione</h2>
        <p>
            Offrire un’esperienza di acquisto semplice, sicura e veloce, con prodotti di qualità e un servizio clienti sempre disponibile.
        </p>

        <h2>Il nostro team</h2>
        <div class="team-cards">
            <div class="card">
                <img src="assets/images/team1.jpg" alt="Team member" style="height:200px; object-fit:cover;">
                <h3>Kanye West<br><small>Fondatore & CEO</small></h3>
            </div>
            <div class="card">
                <img src="assets/images/team2.jpg" alt="Team member" style="height:200px; object-fit:cover;">
                <h3>Kendrick Lamar<br><small>Responsabile Marketing</small></h3>
            </div>
            <div class="card">
                <img src="assets/images/team3.jpg" alt="Team member" style="height:200px; object-fit:cover;">
                <h3>Young Thug<br><small>Customer Care</small></h3>
            </div>
        </div>
    </div>
</div>

<?php require_once 'footerView.php'; ?>