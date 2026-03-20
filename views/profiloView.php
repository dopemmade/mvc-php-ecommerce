<?php 
require_once 'headerView.php'; 
if (session_status() === PHP_SESSION_NONE) session_start();
?>

<div class="container" style="max-width: 800px;"> 
    <h1>👤 Il mio Profilo</h1>
    <p style="text-align: center; margin-bottom: 30px;">
        Gestisci le tue informazioni personali e la tua immagine
    </p>

    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
        <div class="profile-msg success">
            ✅ Profilo aggiornato con successo!
        </div>
    <?php elseif (isset($_GET['error']) && $_GET['error'] == 1): ?>
        <div class="profile-msg error">
            ❌ Errore durante l'aggiornamento della foto!
        </div>
    <?php endif; ?>

    <div style="display: flex; flex-wrap: wrap; gap: 40px; align-items: flex-start;">

        <!-- Sezione immagine profilo -->
        <div style="flex:1; min-width:250px; text-align:center; background:#fff; padding:20px; border-radius:12px; border:1px solid #eee;">
            <!-- Immagine anteprima -->
            <img id="profilePreview"
                 src="assets/images/<?php echo $_SESSION['user_photo'] ?? 'default.png'; ?>" 
                 style="width:180px;height:180px;border-radius:50%;object-fit:cover;border:4px solid #2c3e50;box-shadow:0 4px 10px rgba(0,0,0,0.1);margin-bottom:15px;">
            
            <form action="index.php?pagina=aggiorna_foto" method="POST" enctype="multipart/form-data">
                <!-- Pulsante scegli immagine -->
                <label for="nuova_pfp" class="custom-file-label">Scegli Immagine</label>
                <input type="file" name="nuova_pfp" id="nuova_pfp" accept="image/*">
                
                <!-- Mostra nome file -->
                <span id="nome_file_selezionato" style="display:block; margin:10px 0; font-size:0.9em; color:#34495e;"></span>
                
                <!-- Bottone Carica -->
                <button type="submit" name="upload_btn" class="btn-upload">Carica Foto</button>
            </form>
        </div>

        <!-- Sezione dati utente -->
        <div style="flex:1.5; min-width:300px;">
            <fieldset>
                <legend>Informazioni Personali</legend>

                <div class="form-group"><label>Nome:</label><input type="text" value="<?php echo $_SESSION['utente_loggato'] ?? ''; ?>" readonly></div>
                <div class="form-group"><label>Email:</label><input type="email" value="<?php echo $_SESSION['utente_email'] ?? ''; ?>" readonly></div>
                <div class="form-group"><label>Telefono:</label><input type="text" value="<?php echo $_SESSION['utente_telefono'] ?? ''; ?>" readonly></div>
                <div class="form-group"><label>Indirizzo:</label><input type="text" value="<?php echo $_SESSION['utente_indirizzo'] ?? ''; ?>" readonly></div>
                <div class="form-group"><label>Provincia:</label><input type="text" value="<?php echo $_SESSION['utente_provincia'] ?? ''; ?>" readonly></div>

                <p style="font-size:0.85em; color:#7f8c8d;">
                    💡 I dati non modificabili da qui per motivi di sicurezza. Contatta l'assistenza per cambiarli.
                </p>
            </fieldset>

            <!-- Bottone Esci -->
            <a href="logout.php" class="logout-link">🚪 Esci dall'account</a>
        </div>

    </div>
</div>

<script>
// Prendi elementi
const inputFile = document.getElementById('nuova_pfp');
const profilePreview = document.getElementById('profilePreview');
const nomeFile = document.getElementById('nome_file_selezionato');

// Evento cambio file
inputFile.addEventListener('change', function() {
    if (this.files && this.files[0]) {
        // Mostra nome file
        nomeFile.textContent = this.files[0].name;

        // Mostra anteprima immagine
        const reader = new FileReader();
        reader.onload = function(e) {
            profilePreview.src = e.target.result;
        }
        reader.readAsDataURL(this.files[0]);
    } else {
        // Se nessun file selezionato, torna all'immagine di sessione
        nomeFile.textContent = '';
        profilePreview.src = 'assets/images/<?php echo $_SESSION['user_photo'] ?? 'default.png'; ?>';
    }
});
</script>

<?php require_once 'footerView.php'; ?>