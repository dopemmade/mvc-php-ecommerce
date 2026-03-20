<?php require_once 'headerView.php'; ?>

<div class="container">
    <h1>🔐 Accesso Utente</h1>
    <p>Inserisci le tue credenziali per accedere al tuo profilo</p>

    <?php if (isset($_GET['errore'])): ?>
        <p style="color: red; font-weight: bold; text-align: center;">
            ❌ Email o Password errate!
        </p>
    <?php endif; ?>

    <form action="index.php?pagina=autentica" method="POST">
        <fieldset>
            <legend>Credenziali</legend>
            
            <div class="form-group">
                <label for="em">Email</label>
                <input type="email" name="em" id="em" required placeholder="esempio@mail.it">
            </div>

            <div class="form-group">
                <label for="pw">Password</label>
                <input type="password" name="pw" id="pw" required placeholder="Inserisci la tua password">
            </div>
        </fieldset>

        <button type="submit">Accedi</button>
        
        <div style="margin-top: 15px; text-align: center;">
            <p>Non hai un account? <a href="index.php?pagina=registrazione" style="color: #2c3e50; font-weight: bold;">Registrati qui</a></p>
        </div>
    </form>
</div>

<?php require_once 'footerView.php'; ?>