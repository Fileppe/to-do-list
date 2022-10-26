<?php

function query($sql)
{
    global $connessione;
    return mysqli_query($connessione, $sql);
}
function conferma($risultato)
{
    global $connessione;
    if (!$risultato) {
        die('Richiesta fallita' . mysqli_error($connessione));
    }
}
