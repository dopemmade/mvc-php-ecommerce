<?php
require_once 'headerView.php';
require_once __DIR__ . '/../models/model.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php?pagina=registrazione');
    exit();
}

$conn = getDbConnection();

// Recupero dati dal form
$nome        = trim($_POST["nome"] ?? '');
$cognome     = trim($_POST["cognome"] ?? '');
$dataNascita = trim($_POST["DataNascita"] ?? '');
$email       = trim($_POST["em"] ?? '');
$telefono    = trim($_POST["tel"] ?? '');
$indirizzo   = trim($_POST["sped"] ?? '');
$provincia   = trim($_POST["prov"] ?? '');
$password    = trim($_POST["pw"] ?? '');


// Controllo maggiorenne
if (!isMaggiorenne($dataNascita)) {
    ?>
    <section>
        <h1>✖️ Registrazione non completata!</h1>
        <h2><strong><?php echo $nome . " " . $cognome; ?></strong> SEI MINORENNE</h2>
        <a href="index.php?pagina=home">🏠 Vai alla Home</a>
    </section>
    <?php
    exit();
}

// Controllo email duplicata
if (emailEsiste($conn, $email)) {
    ?>
    <section>
        <h1>✖️ Email già registrata!</h1>
        <h2><strong><?php echo $nome . " " . $cognome; ?></strong> ACCEDI</h2>
        <a href="index.php?pagina=login">🏠 Vai al Login</a>
    </section>
    <?php
    exit();
}

// Hash della password
$pwd_hash = password_hash($password, PASSWORD_DEFAULT);

// Gestione upload foto profilo
$nome_file = 'default.png';
if (isset($_FILES['pfp']) && $_FILES['pfp']['error'] === UPLOAD_ERR_OK) {
    $file_tmp = $_FILES['pfp']['tmp_name'];
    $ext = strtolower(pathinfo($_FILES['pfp']['name'], PATHINFO_EXTENSION));
    if (in_array($ext, ['jpg','jpeg','png'])) {
        $nome_file = 'pfp_' . uniqid() . '.' . $ext;
        move_uploaded_file($file_tmp, "assets/images/" . $nome_file);
    }
}

// Inserimento dati nel DB
$nome_safe = mysqli_real_escape_string($conn, $nome);
$cognome_safe = mysqli_real_escape_string($conn, $cognome);
$email_safe = mysqli_real_escape_string($conn, $email);
$telefono_safe = mysqli_real_escape_string($conn, $telefono);
$indirizzo_safe = mysqli_real_escape_string($conn, $indirizzo);
$provincia_safe = mysqli_real_escape_string($conn, $provincia);
$nome_file_safe = mysqli_real_escape_string($conn, $nome_file);

$sql = "INSERT INTO utenti (nome, cognome, email, password, telefono, indirizzo, provincia, pfp)
        VALUES ('$nome_safe', '$cognome_safe', '$email_safe', '$pwd_hash', '$telefono_safe', '$indirizzo_safe', '$provincia_safe', '$nome_file_safe')";

if (mysqli_query($conn, $sql)) {
    $_SESSION['user_photo'] = $nome_file; // salva foto in sessione
    header("Location: index.php?pagina=login&msg=registrazione_ok");
    exit();
} else {
    ?>
    <section>
        <h1>✖️ Registrazione fallita!</h1>
        <p>Errore: <?php echo mysqli_error($conn); ?></p>
        <a href="index.php?pagina=registrazione">Riprova</a>
    </section>
    <?php
}

mysqli_close($conn);
require_once 'footerView.php';
?>