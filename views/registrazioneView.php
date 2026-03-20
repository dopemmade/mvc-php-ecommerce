<?php require_once 'headerView.php'; ?>

<div class="container">
    <h1>🛒ShopOnline - Registrazione</h1>
    <p>Compila il form per creare il tuo account</p>
    <p>I campi * sono obbligatori</p>

    <form action="index.php?pagina=elabora" method="POST">
        
        <fieldset>
            <legend>Dati Anagrafici</legend>
            <div class="form-group">
                <label for="nome">Nome*</label>
                <input type="text" id="nome" name="nome" required>
            </div>

            <div class="form-group">
                <label for="cognome">Cognome*</label>
                <input type="text" id="cognome" name="cognome" required>
            </div>

            <div class="form-group">
                <label for="DataNascita">Data di nascita*</label>
                <input type="date" id="DataNascita" name="DataNascita" required><br>
                <small>devi essere maggiorenne per registrarti</small>
            </div>

            <div class="form-group">
                <label for="genere">Genere</label>
                <div class="radio-group">
                    <label><input type="radio" name="genere" value="maschio">♂️ Maschio</label>
                    <label><input type="radio" name="genere" value="femmina">♀️ Femmina</label>
                    <label><input type="radio" name="genere" value="nd">🏳️‍⚧️ Preferisco non rispondere</label>
                </div>
            </div>
        </fieldset> <fieldset>  
            <legend>Contatti e Indirizzo</legend>
            <div class="form-group">
                <label for="em">Email*</label>
                <input type="email" name="em" id="em" required placeholder="tuaemail@esempio.com">
            </div>
            <div class="form-group">
                <label for="tel">Numero di telefono*</label>
                <input type="tel" name="tel" id="tel" required placeholder="Es. 331234567">
            </div>
            <div class="form-group">
                <label for="sped">Indirizzo di Spedizione*</label>
                <input type="text" name="sped" id="sped" required placeholder="Via, numero civico">
            </div>
            <div class="form-group">
                <label for="prov">Provincia*</label>
                <select name="prov" id="prov">
                    <option value="treviso">treviso</option>
                    <option value="belluno">belluno</option>
                    <option value="sassari">sassari</option>
                    <option value="piacenza">piacenza</option>
                    <option value="campobasso">campobasso</option>
                </select>
            </div>
        </fieldset>

        <fieldset>
            <legend>Password</legend>
            <div class="form-group">
                <label for="pw">Password:</label>
                <input type="password" name="pw" id="pw">
                <small>Minimo 8 caratteri</small>
            </div>
        </fieldset>

        <fieldset>
            <legend>Dati facoltativi</legend>
            <div class="form-group">
                <label for="col">Colore preferito</label>
                <input type="color" name="col" id="col">
            </div>
            <div class="form-group">
                <label>Interessi:</label><br>
                <input type="checkbox" name="Musica" id="Musica"> Musica
                <input type="checkbox" name="Cinema" id="Cinema"> Cinema
                <input type="checkbox" name="Teatro" id="Teatro"> Teatro
                <input type="checkbox" name="Letteratura" id="Letteratura"> Letteratura
                <input type="checkbox" name="Giardinaggio" id="Giardinaggio"> Giardinaggio
            </div>
        </fieldset>

        <div class="termini-box">
            <label>
                <input type="checkbox" name="termini" id="termini" required>
                Dichiaro di aver letto e di accettare i <a href="termini.html" target="_blank">Termini e Condizioni</a>
            </label>
        </div>

        <button type="submit">Invia</button>
    </form>
</div> <?php require_once 'footerView.php'; ?>