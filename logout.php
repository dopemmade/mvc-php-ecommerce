<?php
session_start(); // Accedi alla sessione attuale
session_unset(); // Rimuove tutte le variabili di sessione
session_destroy(); // Distrugge il file della sessione sul server

// Torna alla home
header("Location: index.php?pagina=home");
exit();