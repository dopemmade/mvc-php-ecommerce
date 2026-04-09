<?php


/**
 * Ritorna l'istanza della connessione al database
 * 
 * @return \mysqli|false
 */
function getDbconnection() {
    static $connessione = null;
    if ($connessione === null) {
        try {
            $connessione = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            if (!$connessione) {
                throw new Exception();
            }
        } catch (Exception $e) {
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

function getCatalogo($connessione) {
    if (!$connessione) return [];
    $sql = "SELECT * FROM catalogo ORDER BY id DESC";
    $risultato = mysqli_query($connessione, $sql);
    $prodotti = [];
    if($risultato) {
        while($row = mysqli_fetch_assoc($risultato)) {
            $prodotti[] = $row;
        }
    }
    return $prodotti;
}

function aggiungiProdottoCatalogo($connessione, $title, $artist, $image, $price, $stock) {
    if (!$connessione) return false;
    $title = mysqli_real_escape_string($connessione, $title);
    $artist = mysqli_real_escape_string($connessione, $artist);
    $image = mysqli_real_escape_string($connessione, $image);
    $price = (float)$price;
    $stock = (int)$stock;

    $sql = "INSERT INTO catalogo (title, artist, img, price, stock) VALUES ('$title', '$artist', '$image', $price, $stock)";
    return mysqli_query($connessione, $sql);
}

function getProdottoById($connessione, $id) {
    if (!$connessione) return false;
    $id = (int)$id;
    $sql = "SELECT * FROM catalogo WHERE id = $id LIMIT 1";
    $risultato = mysqli_query($connessione, $sql);
    if($risultato && mysqli_num_rows($risultato) > 0) {
        return mysqli_fetch_assoc($risultato);
    }
    return false;
}

function aggiornaStockPagamento($connessione, $carrello) {
    if (!$connessione || empty($carrello)) return false;
    // Iniziamo una piccola transaction (se InnoDB) per sicurezza
    mysqli_begin_transaction($connessione);
    try {
        foreach($carrello as $item) {
            $id = (int)$item['id'];
            $qty = (int)$item['qty'];
            $sql = "UPDATE catalogo SET stock = stock - $qty WHERE id = $id";
            mysqli_query($connessione, $sql);
        }
        mysqli_commit($connessione);
        return true;
    } catch (Exception $e) {
    } catch (Exception $e) {
        mysqli_rollback($connessione);
        return false;
    }
}

function salvaOrdine($connessione, $email, $carrello, $totale, $numero_ordine) {
    if (!$connessione) return false;
    
    $email = mysqli_real_escape_string($connessione, $email);
    $totale = (float)$totale;
    $numero_ordine = mysqli_real_escape_string($connessione, $numero_ordine);
    
    mysqli_begin_transaction($connessione);
    try {
        // Inserisci l'ordine principale
        $sql_ord = "INSERT INTO ordini (email_utente, totale, numero_ordine) VALUES ('$email', $totale, '$numero_ordine')";
        mysqli_query($connessione, $sql_ord);
        $id_ordine = mysqli_insert_id($connessione);
        
        // Inserisci i dettagli
        foreach ($carrello as $item) {
            $id_prodotto = (int)$item['id'];
            $quantita = (int)$item['qty'];
            $prezzo = (float)$item['price'];
            $titolo = mysqli_real_escape_string($connessione, $item['title']);
            $img = mysqli_real_escape_string($connessione, $item['image']);
            
            $sql_det = "INSERT INTO dettagli_ordine (id_ordine, id_prodotto, quantita, prezzo_unitario, titolo_prodotto, img_prodotto) 
                        VALUES ($id_ordine, $id_prodotto, $quantita, $prezzo, '$titolo', '$img')";
            mysqli_query($connessione, $sql_det);
        }
        
        mysqli_commit($connessione);
        return true;
    } catch (Exception $e) {
        mysqli_rollback($connessione);
        return false;
    }
}

function getOrdiniUtente($connessione, $email) {
    if (!$connessione) return [];
    
    $email = mysqli_real_escape_string($connessione, $email);
    $sql = "SELECT * FROM ordini WHERE email_utente = '$email' ORDER BY data DESC";
    $risultato = mysqli_query($connessione, $sql);
    
    $ordini = [];
    if($risultato) {
        while($row = mysqli_fetch_assoc($risultato)) {
            $id_ordine = $row['id'];
            // Estrai i dettagli
            $sql_dettagli = "SELECT * FROM dettagli_ordine WHERE id_ordine = $id_ordine";
            $res_det = mysqli_query($connessione, $sql_dettagli);
            $dettagli = [];
            if($res_det) {
                while($det = mysqli_fetch_assoc($res_det)) {
                    $dettagli[] = $det;
                }
            }
            $row['dettagli'] = $dettagli;
            $ordini[] = $row;
        }
    }
    return $ordini;
}