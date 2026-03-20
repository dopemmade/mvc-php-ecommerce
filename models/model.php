<?php


function getDbconnection(){
static $connessione=null;
if($connessione===null){
    try{
        $connessione=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        if(!$connessione){
            throw new Exception();
        }
    }catch (Exception $e){
        echo "errore";
        exit;
    } 
    

}
return $connessione;
}

function isMaggiorenne(string $dataNascita): bool {
    // Se la stringa è vuota, non è maggiorenne
    if (empty($dataNascita)) {
        return false;
    }

    try {
        $nascita = new DateTime($dataNascita);
        $oggi = new DateTime();
        
        // Calcola la differenza tra oggi e la nascita
        $diff = $oggi->diff($nascita);
        
        // Ritorna vero solo se gli anni sono 18 o più
        return $diff->y >= 18;
        
    } catch (Exception $e) {
        // Se la data non è valida (es. formato sbagliato)
        return false;
    }
}

function emailEsiste($connessione, $email) {
    if (!$connessione) {
        return false;
    }

    // Pulizia input
    $emailPulita = mysqli_real_escape_string($connessione, $email);
    
    // ATTENZIONE: Controlla che la tabella si chiami 'utenti' 
    // e la colonna si chiami 'u_email' (o come l'hai nominata nel DB)
    $sql = "SELECT * FROM utenti WHERE email = '$emailPulita'";
    
    $risultato = mysqli_query($connessione, $sql);

    // Se la query fallisce (es. tabella inesistente), mysqli_query restituisce false
    if ($risultato === false) {
        // Questo ti dirà ESATTAMENTE cosa c'è di sbagliato nella query
        die("Errore nella query SQL: " . mysqli_error($connessione));
    }

    return mysqli_num_rows($risultato) > 0;
}

function getUtenteByEmail($connessione, $email) {
    $email = mysqli_real_escape_string($connessione, $email);
    $sql = "SELECT * FROM utenti WHERE email = '$email' LIMIT 1";
    $risultato = mysqli_query($connessione, $sql);
    
    if ($risultato && mysqli_num_rows($risultato) > 0) {
        return mysqli_fetch_assoc($risultato);
    }
    return false;
}