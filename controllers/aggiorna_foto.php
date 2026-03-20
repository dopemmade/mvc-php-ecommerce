<?php
if (session_status() === PHP_SESSION_NONE) session_start();

if (isset($_POST['upload_btn']) && isset($_FILES['nuova_pfp'])) {
    $file = $_FILES['nuova_pfp'];
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    
    if (in_array($ext, ['jpg', 'jpeg', 'png'])) {
        $nuovo_nome = "pfp_" . uniqid() . "." . $ext;
        
        if (move_uploaded_file($file['tmp_name'], "assets/images/" . $nuovo_nome)) {
            // USIAMO $connessione che arriva dall'index!
            $email = $_SESSION['utente_email'];
            $sql = "UPDATE utenti SET pfp = '$nuovo_nome' WHERE email = '$email'";
            
            if (mysqli_query($connessione, $sql)) {
                $_SESSION['user_photo'] = $nuovo_nome;
                header("Location: index.php?pagina=profilo&success=1");
                exit();
            }
        }
    }
}
header("Location: index.php?pagina=profilo&error=1");