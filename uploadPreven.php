<?php
include '../db_connect.php';
include '../paths.php';

//Function to check if the request is an AJAX request
function is_ajax()
{
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

function validateDate($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

function convertiData($dataEur)
{
    $rsl = explode('/', $dataEur);
    if (!validateDate($dataEur)) {
        
        if (count($rsl) < 3) {
            $rsl = explode('-', $dataEur);
        }
        $rsl = array_reverse($rsl);
    }
    //  echo $dataEur."--".implode($rsl,'-');
    return implode($rsl, '-');
}

$ris           = Array();
$ris['status'] = 'error';
$ris['msg']    = "Inserimento abortito.";

//uploadPreven.php

if (is_ajax()) {
    
    //---------- inserimento preventivo
    
    $data      = $_POST['xdata'];
    $FName     = $_POST['inputFirstName'];
    $LName     = $_POST['inputLastName'];
    $Indirizzo = $_POST['inputAddress'];
    $PCode     = $_POST['inputPostCode'];
    $City      = $_POST['inputCity'];
    $Prov      = $_POST['inputProv'];
    $Stato     = $_POST['xselCountry'];
    $inputpiva = $_POST['inputpiva'];
    $email     = $_POST['inputEmail'];
    $conferma  = $_POST['conferma'];
    $nota      = $_POST['inputNote'];
    
    
    //inserting data order
    $sql1 = "INSERT INTO preventivi
			(CognomeAmm, NomeAmm, IndirizzoAmm, capAmm, cittaAmm, provAmm, statoAmm, pivaAmm, emailAmm, data, conferma, nota)
			VALUES
			( '$LName', '$FName', '$Indirizzo', '$PCode', '$City', '$Prov', '$Stato', '$inputpiva', '$email', '$data','$conferma', '$nota')";
    
    //declare in the order variable
    $result1 = mysqli_query($mysqli, $sql1); //order executes
    $link1   = mysqli_insert_id($mysqli);
    
    //------------ inserimento condomini
    
    
    $dt = $_POST['condomini'];
    if (isset($dt)) {
    } else {
        mysqli_close($mysqli);
        return false;
    }
    $ris['status'] = 'success';
    $ris['msg']    = "Inserimento effettuato con successo.";
    
    for ($i = 0, $n = max(array_map('count', $dt)); $i < $n; $i++) {
        
        $condominio = $dt['condominio'][$i];
        $indirizzo  = $dt['indirizzo'][$i];
        $cap        = $dt['cap'][$i];
        $citta      = $dt['citta'][$i];
        $prov       = $dt['prov'][$i];
        $codfisc    = $dt['codfisc'][$i];
        
        $sql2 = "INSERT INTO prev_condominio
			(ID_prev, condominio, indirizzo, cap, citta, prov, codfisc)
			VALUES
			('$link1', '$condominio', '$indirizzo', '$cap', '$citta', '$prov', '$codfisc')";
        
        $result2 = mysqli_query($mysqli, $sql2); //query executes
        $link2   = mysqli_insert_id($mysqli);
        
        
        $ds = $_POST['servizi'][$i];
        if (isset($ds)) {
        } else {
            $ris['status'] = 'error';
            $ris['msg']    = "Inserimento incompleto.";
            mysqli_close($mysqli);
            return false;
        }
        for ($xi = 0, $xn = max(array_map('count', $ds)); $xi < $xn; $xi++) {
            
            $servizio   = $ds['servizio'][$xi];
            $unita      = $ds['unita'][$xi];
            $tipocont   = $ds['tipocont'][$xi];
            $misuratori = $ds['misuratori'][$xi];
            
            $sql2 = "INSERT INTO prev_cond_servizi
			(prev_cond_ID, servizio, unita, tipocont, misuratori)
			VALUES
			('$link2', '$servizio', '$unita', '$tipocont', '$misuratori')";
            
            $result2 = mysqli_query($mysqli, $sql2); //query executes
        }
    }
    
    mysqli_close($mysqli);
    
    header('Content-Type: application/json');
    echo json_encode($ris);
    
    /*
    $refurl = explode("#", $_SERVER['HTTP_REFERER']); // ritorna al form
    header("Location: ".$refurl[0]."#".$_REQUEST['return']);
    */
}
?>