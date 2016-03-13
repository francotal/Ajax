<?php
include '../db_connect.php';
include '../paths.php';

//require KoolControlsFolder . "/KoolUIControl/KoolUIControl.php";
 
 $q = floatval($_GET['q']);
 
     if (!$mysqli)
  {
  die('Could not connect: ' . mysqli_error($mysqli));
  }

   $query = "SELECT ID,path,filename FROM francoah_boll.Files WHERE CondominioID=1 AND ID=1";

    $rs = mysqli_query($mysqli,$query);
    $row = mysqli_fetch_array($rs);
    $filename1 = IMGPATH.$row["path"].$row["filename"];

     if (!$mysqli)
  {
  die('Could not connect: ' . mysqli_error($mysqli));
  }

   $query = "SELECT ID,path,filename FROM francoah_boll.Files WHERE CondominioID=1 AND ID=1";

    $rs = mysqli_query($mysqli,$query);
    $row = mysqli_fetch_array($rs);
    $filename1 = IMGPATH.$row["path"].$row["filename"];

     if (!$mysqli)
  {
  die('Could not connect: ' . mysqli_error($mysqli));
  }
  
   $query = "SELECT ID,Cognome, Nome FROM francoah_boll.Anagrafica WHERE CondominioID=1";

    $rs = mysqli_query($mysqli,$query);
    $row = mysqli_fetch_array($rs);
    $Cognome = $row["Cognome"];
    $Nome = $row["Nome"];
    
    $query = "SELECT ID,Cognome, Nome FROM francoah_boll.Anagrafica WHERE CondominioID=1";

    $rs = mysqli_query($mysqli,$query);
    $row = mysqli_fetch_array($rs);
    $Cognome = $row["Cognome"];
    $Nome = $row["Nome"];
  

    
   $query = "SELECT ID,Denominazione, Indirizzo, CAP, Citta, Provincia, Banca, Agenzia, idLogo, IBAN FROM francoah_boll.Condominio WHERE ID=1";

    $rs = mysqli_query($mysqli,$query);
    $row = mysqli_fetch_array($rs);
    $Denominazione = $row["Denominazione"];
    $Indirizzo = $row["Indirizzo"];
    $CAP = $row["CAP"];
    $Citta = $row["Citta"];
    $Provincia = $row["Provincia"];
    $Banca = $row["Banca"];
    $Agenzia = $row["Agenzia"];
    $IBAN = $row["IBAN"];
    
    $query = "SELECT ID,path,filename FROM francoah_boll.Files WHERE CondominioID=1 AND ID=".$row["idLogo"];

    $rs = mysqli_query($mysqli,$query);
    $row = mysqli_fetch_array($rs);
    $filename2 = IMGPATH.$row["path"].$row["filename"];    
    mysqli_close($mysqli);     
	  
/*    $ui = KoolUI::newUI(
                array(
            'id' => 'KBarcode2',
            'KoolUIPath' => $KoolUIPath,
            'width' => '200px',
            'height' => '50px',
            'templateSelector' => 'KBarcode t0',
            'showChecksum' => false,
            'type' => ' ean8 ',
            'value' => '9638507',
        )
    );
    $ui->process();*/
    
$html = '<div id="invoice-page1" class="page">';
 $html .= '<table style="border: none"><tr>';
  if ($filename1!="") $html .= '<td style="vertical-align: top;"><img class="logo" src="'.$filename1.'"></td>';
 $html .= '<td style="padding-left: 5mm; width: 80mm; vertical-align:top;">Amministratore, Via Di Qua, 12<br>
            37038 Concordia (RO)<br>
            tel +39 388 399488 - info@ruoi.it<br></td>';
  if ($filename2!="") $html .= '<td style="vertical-align: top;"><img class="logo" src="'.$filename2.'"></td>';
 $html .= '<td style="padding-left: 5mm; width: 80mm; vertical-align: top;">'.$Denominazione.'<br>'.$Indirizzo.'<br>'.$CAP.' '.$Citta.' '.$Provincia.'<br>            
            <div class="banca">'.
            $Banca.'<br> Ag. di '.$Agenzia.'<br>
            Iban '.$IBAN.'</div></td>';
 $html .= '</tr></table>';   
     
 $html .= '<br>
        <br>
        <br>
        <div class="clearfix">          
          <div class="colsx">
            <h2 class="ilconto">Il Conto</h2>
            <p class="text-left">Bolletta# 10335</p>
            <p class="text-left">22 aprile 2015</p>
            <p class="text-left">Id @9638507</p>
            <br>
          </div>
        <div class="coldxx">    
          <div class="backcolor addcircle">
              <address class="address">
              <strong>Spett.le</strong><br>
              '.$Cognome." ".$Nome.'<br>
              Contrada degli Ebrei, 17<br>
              37038 SOAVE (VR)
              </address>
            </div>
          </div>
          </div>';
        /* $html .=  '<img src=<? php $ui->render() ?>'; */
          $html .=  '<br>	       
        <br>
        <br>
		<div class="clearfix">
          <div class="colsx">
          <address>
          Unità: 8B<br>
          Mappali: fg 25 mapp. 2788 sub 122<br>
          Scala: B<br>
          Interno: 8
          </address>
        </div>
		<div class="coldx">
        <div class="backcolor balcircle">
          <address class="text-black balance">
          <strong >Scadenza:</strong><br/>
          21 maggio 2015<br/>
          <strong>Importo da pagare:</strong><br/>
          <h2 class="mtn"><strong>';
          $formatter = new NumberFormatter('it_IT',  NumberFormatter::CURRENCY);
          $html .=  $formatter->formatCurrency($q, 'EUR');
          $html .=  '</strong></h2>
          </address>
		  </div>
        </div>
	  </div>	
        <br><br>
		<hr>
          <!--<hr class="mhr">-->
          <p>Riepilogo degli importi</p>
	
        <table class="ytable noborder" width="80%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
          <thead>
            <tr>
              <td class="backcolor" width="65%"><strong>Servizio</strong></td>
              <td class="backcolor" width="10%"><strong>Quota fissa</strong></td>
              <td class="backcolor" width="10%"><strong>Quota variabile</strong></td>
              <td class="backcolor" width="15%"><strong>Totale</strong></td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td >Riscaldamento</td>
              <td class="text-right">€10,16</td>
              <td class="text-right">€57,70</td>
              <td class="text-right">€67,86</td>
            </tr>
            <tr>
              <td >Condizionamento</td>
              <td class="text-right">€5,60</td>
              <td class="text-right">€12,70</td>
              <td class="text-right">€58,30</td>
            </tr>
            <tr>
              <td>Acqua Calda Sanitaria</td>
              <td class="text-right">€10,16</td>
              <td class="text-right">€57,70</td>
              <td class="text-right">€67,86</td>
            </tr>
            <tr>
              <td>Acqua Fredda Sanitaria</td>
              <td class="text-right">€0,00</td>
              <td class="text-right">€47,70</td>
              <td class="text-right">€47,70</td>
            </tr>
            <tr>
              <td>Addolcimento</td>
              <td class="text-right">€0,00</td>
              <td class="text-right">€27,30</td>
              <td class="text-right">€27,30</td>
            </tr>
          <br>
          <br>
          <tr>
            <td class="thick-line"></td>
            <td class="thick-line"></td>
            <td class="backcolor text-right"><strong>Parziale</strong></td>
            <td class="backcolor text-right">€343,00</td>
          </tr>
          <tr>
            <td class="no-line"></td>
            <td class="no-line"></td>
            <td class="backcolor text-right"><strong>Spese</strong></td>
            <td class="backcolor text-right">€1,50</td>
          </tr>
          <tr>
            <td class="no-line"></td>
            <td class="no-line"></td>
            <td class="backcolor text-right"><strong>Totale</strong></td>
            <td class="backcolor text-right">€344,50</td>
          </tr>
            </tbody>
          
        </table>
        <br>
        <!--<hr class="mhr">-->
        
        <p>I pagamenti precedenti risultano regolari. Grazie.</p>
        <div class="clearfix">
        <div class="coldxx">
          <h5 style="width:150mm; text-align:center;">L\'Amministratore<br>
            <a class="firma">Passavo Diqua</a></h5>
        </div>  
        </div>
        <div class="xfooter"> 
          <p style="float:left; padding-left: 10mm;">Report generato da <img src="../logo/logo-pos.png" height="25" ></p>
          <p style="text-align:right; padding-right:10mm;">Pag. 1/2</p>       
        </div>
      </div>
      <div id="separa" style="height:4mm;"></div>
      <!-- FINE PAGINA 1 E INIZIO PAGINA 2 -->
      <div id="invoice-page2" class="page">';
 $html .= '<table style="border: none"><tr>';
  if ($filename1!="") $html .= '<td style="vertical-align: top;"><img class="logo" src="'.$filename1.'"></td>';
 $html .= '<td style="padding-left: 5mm; width: 80mm; vertical-align:top;">Amministratore, Via Di Qua, 12<br>
            37038 Concordia (RO)<br>
            tel +39 388 399488 - info@ruoi.it<br></td>';
  if ($filename2!="") $html .= '<td style="vertical-align: top;"><img class="logo" src="'.$filename2.'"></td>';
 $html .= '<td style="padding-left: 5mm; width: 80mm; vertical-align: top;">'.$Denominazione.'<br>'.$Indirizzo.'<br>'.$CAP.' '.$Citta.' '.$Provincia.'<br>            
            <div class="banca">'.
            $Banca.'<br> Ag. di '.$Agenzia.'<br>
            Iban '.$IBAN.'</div></td>';
 $html .= '</tr></table>';   
     
 $html .= '<br>
        <br>
        <br>
        <br>
        <br>
          <div>
            <h2 class="ilconto">Il Conto</h2>
            <p class="text-left">Bolletta# 10335</p>
            <p class="text-left">22 aprile 2015</p>
            <br>
          </div>
          <div> 
          <br>
            <p ><b>Dettaglio quota consumo volontario (UNI 10200:2015)</b></p>
            <br>
          </div>
          <table class="ytable noborder" width="80%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
            <thead>
              <tr>
                <td class="backcolor" width="6%"><strong>Data</strong></td>
                <td class="backcolor" width="6%"><strong>gg</strong></td>
                <td class="backcolor" width="12%"><strong>Matricola</strong></td>
                <td class="backcolor" width="16%"><strong>Lettura prec.</strong></td>
                <td class="backcolor" width="16%"><strong>Lettura</strong></td>
                <td class="backcolor" width="13%"><strong>Consumo</strong></td>
                <td class="backcolor" width="5%"><strong>U.M.</strong></td>
                <td class="backcolor" width="10%"><strong>Prezzo</strong></td>
                <td class="backcolor" width="15%"><strong>Totale</strong></td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td colspan=9 class="servizi">Riscaldamento</td>
              </tr>
              <tr>
                <td >01/10/2015</td>
                <td style="text-align:center;">34</td>
                <td >77877544</td>
                <td class="text-right">654,87</td>
                <td class="text-right">79,73</td>
                <td class="text-right">22,45</td>
                <td style="text-align:center;">kWh</td>
                <td class="text-right">€0,110</td>
                <td class="text-right">€2,65</td>
              </tr>
              <tr>
                <td colspan=9 class="servizi">Condizionamento</td>
              </tr>
              <tr>
                <td >01/10/2015</td>
                <td style="text-align:center;">34</td>
                <td >77877544</td>
                <td class="text-right">555,87</td>
                <td class="text-right">79,73</td>
                <td class="text-right">12,45</td>
                <td style="text-align:center;">kWh</td>
                <td class="text-right">€0,140</td>
                <td class="text-right">€1,74</td>
              </tr>
              <tr>
                <td colspan=9 class="servizi">Acqua Calda Sanitaria</td>
              </tr>
              <tr>
                <td >01/10/2015</td>
                <td style="text-align:center;">34</td>
                <td >6237222</td>
                <td class="text-right">355,90</td>
                <td class="text-right">79,73</td>
                <td class="text-right">102,43</td>
                <td style="text-align:center;">kWh</td>
                <td class="text-right">€0,110</td>
                <td class="text-right">€11,27</td>
              </tr>
              <tr>
                <td >01/10/2015</td>
                <td style="text-align:center;">34</td>
                <td >6237222</td>
                <td class="text-right">355,90</td>
                <td class="text-right">79,73</td>
                <td class="text-right">102,43</td>
                <td style="text-align:center;">m3</td>
                <td class="text-right">€0,110</td>
                <td class="text-right">€11,27</td>
              </tr>
              <tr>
                <td colspan=9 class="servizi">Acqua Fredda Sanitaria</td>
              </tr>
              <tr>
                <td >01/10/2015</td>
                <td style="text-align:center;">34</td>
                <td >6237222</td>
                <td class="text-right">355,90</td>
                <td class="text-right">102,43</td>
                <td class="text-right">79,73</td>
                <td style="text-align:center;">m3</td>
                <td class="text-right">€0,110</td>
                <td class="text-right">€11,27</td>
              </tr>
              <tr>
                <td colspan=9 class="servizi">Addolcimento</td>
              </tr>
              <tr>
                <td >01/10/2015</td>
                <td style="text-align:center;">34</td>
                <td >6237223</td>
                <td class="text-right">355,90</td>
                <td class="text-right">102,43</td>
                <td class="text-right">79,73</td>
                <td style="text-align:center;">m3</td>
                <td class="text-right">€0,110</td>
                <td class="text-right">€11,27</td>
              </tr>
            </tbody>
          </table>
          <div> <br>
            <p ><b>Dettaglio quota consumo involontario (UNI 10200:2015)</b></p>
            <br>
          </div>
          <table class="ytable noborder" width="60%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
            <thead>
              <tr>
                <td class="backcolor" width="20%"><strong>Importo da ripartire</strong></td>
                <td class="backcolor" width="15%"><strong>Millesimi</strong></td>
                <td class="backcolor" width="10%"><strong>gg</strong></td>
                <td class="backcolor" width="20%"><strong>Totale</strong></td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td colspan=4 class="servizi">Riscaldamento</td>
              </tr>
              <tr>
                <td class="text-right">€2350,00</td>
                <td class="text-center">55,38</td>
                <td class="text-center">45</td>
                <td class="text-right">€16,05</td>
              </tr>
              <tr>
                <td colspan=4 class="servizi">Condizionamento</td>
              </tr>
              <tr>
                <td class="text-right">€1850,00</td>
                <td class="text-center">25,38</td>
                <td class="text-center">45</td>
                <td class="text-right">€5,78</td>
              </tr>
              <tr>
                <td colspan=4 class="servizi">Acqua Calda Sanitaria</td>
              </tr>
              <tr>
                <td class="text-right">€550,00</td>
                <td class="text-center">15,28</td>
                <td class="text-center">45</td>
                <td class="text-right">€1,04</td>
              </tr>
              <tr>
                <td colspan=4 class="servizi">Acqua Fredda Sanitaria</td>
              </tr>
              <tr>
                <td colspan=4 class="servizi">Addolcimento</td>
              </tr>
            </tbody>
          </table>
                  <div class="xfooter"> 
          <p style="float:left; padding-left: 10mm;">Report generato da <img src="../logo/logo-pos.png" height="25" ></p>
          <p style="text-align:right; padding-right:10mm;">Pag. 2/2</p>       
        </div>
          </div>
      </div>';
  
      ?>