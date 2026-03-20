<?php 
  require_once 'headerView.php';
  require_once "models/model.php";
  
?>
<body>


<?php
// $_SERVER['REQUEST_METHOD'] contiene il metodo usato: 'GET', 'POST', ecc.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../index.php?pagina=registrazione');
    exit(); // IMPORTANTE: ferma l'esecuzione dopo il redirect
}

// Recupero dati correggendo i nomi in base al tuo form HTML
    $nome        = trim($_POST["nome"] ?? '');
    $cognome     = trim($_POST["cognome"] ?? '');
    $dataNascita = trim($_POST["DataNascita"] ?? ''); // MAIUSCOLA come nel form!
    $email       = trim($_POST["em"] ?? '');          // Nel form è name="em"
    $telefono    = trim($_POST["tel"] ?? '');         // Nel form è name="tel"
    $indirizzo   = trim($_POST["sped"] ?? '');        // Nel form è name="sped"
    $provincia   = trim($_POST["prov"] ?? '');        // Nel form è name="prov"
    $password    = trim($_POST["pw"] ?? '');          // Nel form è name="pw"

if (!isMaggiorenne($dataNascita)) {
    // ... tuo codice per errore minorenne ...
}
  if (!isMaggiorenne($dataNascita)) {?>
    <section>
    <h1>✖️Registrazione non completata!  </h1>
    <h1><strong> <?php echo $nome." ".$cognome; ?> </strong> SEI MINORENNE </h2>
    <a href="index.php?pagina=home" > 🏠 Vai alla Home</a>
    </section>
<?php 
    }
    else if (emailEsiste($connessione, $email)){?>
    <section>
    <h1>✖️Email già registrata!  </h1>
    <h1><strong> <?php echo $nome." ".$cognome; ?> </strong> ACCEDI </h2>
    <a href="index.php?pagina=login" > 🏠 Vai al Login</a>
    </section>
    <?php
    } else {
    



    
$pwd_hash = password_hash($password, PASSWORD_DEFAULT);
// Inserimento nel database -------------------------------
// I valori testuali nella query SQL vanno racchiusi tra apici singoli.
$sql = "INSERT INTO utenti (nome, cognome, email, password, pfp) 
        VALUES ('$nome', '$cognome', '$email', '$pwd_hash', 'default.png')";// mysqli_query() restituisce TRUE se l'INSERT riesce
if (mysqli_query($connessione, $sql)) {
    mysqli_close($connessione); // Chiude la connessione
?>
    <section>
    <h1>✅Registrazione completata! </h1>
    <h2>Benvenuto <strong> <?php echo $nome." ".$cognome; ?> </strong></h2>
    <fieldset>
      <legend>Riepilogo dei dati:</legend>
      <p><strong>Nome completo:</strong><?php echo $nome." ".$cognome; ?></p>
      <p><strong>Data di nascita:</strong><?php echo $dataNascita; ?></p>
      <p><strong>Email:</strong><?php echo $email; ?></p>
      <p><strong>Telefono:</strong><?php echo $telefono; ?></p>
      <p><strong>Indirizzo:</strong><?php echo $indirizzo.", ".$provincia; ?></p>
      <a href="index.php?pagina=login" >  Vai al Login</a>   

    </fieldset>
  </section>
<?php
} else {
?>
    <section>
    <h1>✖️Registrazione fallita  </h1>
    
    <a href="index.php?pagina=registrazione" > Registrati</a>
    </section>
<?php
}
?>

  
  <?php 
    }
  require_once 'footerView.php';?>
  
