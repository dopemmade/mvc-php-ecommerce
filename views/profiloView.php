<?php require_once 'headerView.php'; ?>

<div class="container" style="max-width: 800px;"> <h1>👤 Il mio Profilo</h1>
    <p style="text-align: center; margin-bottom: 30px;">Gestisci le tue informazioni personali e la tua immagine</p>

    <?php if (isset($_GET['msg']) && $_GET['msg'] == 'success'): ?>
        <div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 8px; text-align: center; margin-bottom: 20px;">
            ✅ Profilo aggiornato con successo!
        </div>
    <?php endif; ?>

    <div style="display: flex; flex-wrap: wrap; gap: 40px; align-items: flex-start;">
        
        <div style="flex: 1; min-width: 250px; text-align: center; background: #fdfdfd; padding: 20px; border-radius: 12px; border: 1px solid #eee;">
            <div style="margin-bottom: 20px;">
                <img src="assets/images/<?php echo $_SESSION['user_photo'] ?? 'default.png'; ?>" 
                     style="width: 180px; height: 180px; border-radius: 50%; object-fit: cover; border: 4px solid #2c3e50; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
            </div>
            
            <form action="index.php?pagina=aggiorna_foto" method="POST" enctype="multipart/form-data">
                <label for="nuova_pfp" style="display: block; margin-bottom: 10px; font-weight: bold; color: #2c3e50;">Cambia immagine:</label>
                <input type="file" name="nuova_pfp" id="nuova_pfp" accept="image/*" style="font-size: 12px; margin-bottom: 15px;">
                <button type="submit" name="upload_btn" style="background: #e74c3c; font-size: 0.9em; padding: 10px;">Carica Foto</button>
            </form>
        </div>

        <div style="flex: 1.5; min-width: 300px;">
            <fieldset>
                <legend>Informazioni Personali</legend>
                
                <div class="form-group">
                    <label>Nome:</label>
                    <input type="text" value="<?php echo $_SESSION['utente_loggato']; ?>" readonly style="background: #f1f1f1; cursor: not-allowed;">
                </div>

                <div class="form-group">
                    <label>Indirizzo Email:</label>
                    <input type="email" value="<?php echo $_SESSION['utente_email'] ?? 'Non disponibile'; ?>" readonly style="background: #f1f1f1; cursor: not-allowed;">
                </div>

                <div class="form-group" style="margin-top: 20px;">
                    <p style="text-align: left; font-size: 0.85em; color: #7f8c8d;">
                        💡 I dati come nome ed email non sono modificabili da qui per motivi di sicurezza. 
                        Contatta l'assistenza per cambiarli.
                    </p>
                </div>
            </fieldset>

            <a href="logout.php" style="display: inline-block; margin-top: 10px; color: #e74c3c; text-decoration: none; font-weight: bold;">
                🚪 Esci dall'account
            </a>
        </div>

    </div>
</div>

<?php require_once 'footerView.php'; ?>