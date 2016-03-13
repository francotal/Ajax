<?php
define('_MPDF_PATH','../mpdf60/');

include(_MPDF_PATH."mpdf.php");

include 'invoicetemplate.php';


//$mpdf=new mPDF('c','A4','','',20,15,48,25,10,10); 
$mpdf=new mPDF('c','A4','','',0,0,0,0); 
$mpdf->SetProtection(array('print'));

$mpdf->SetTitle("Bolletta num337");

$mpdf->SetAuthor("bollettamia.it");

$mpdf->SetWatermarkText("Pagato");

$mpdf->showWatermarkText = false;

$mpdf->watermark_font = 'DejaVuSansCondensed';

$mpdf->watermarkTextAlpha = 0.1;

$mpdf->SetDisplayMode('fullpage');

$mpdf->shrink_tables_to_fit=0;

$mpdf->SetHTMLFooter('<div> 
          <p style="float:left; padding-left: 10mm;">Report generato da <img src="../logo/logo-pos.png" height="25" ></p>
          <p style="text-align:right; padding-right:10mm;">Pag. {PAGENO}</p>
         
        </div>');




// LOAD a stylesheet
$stylesheet=file_get_contents("../vendors/font-awesome/css/font-awesome.min.css");
$mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text
$stylesheet = file_get_contents("../vendors/bootstrap/css/bootstrap.min.css" );
$mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text
$stylesheet = file_get_contents("../invoicepdf.css");
$mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text
$stylesheet = file_get_contents("../css/themes/style1/orange-blue.css");
$mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text


$mpdf->WriteHTML($html);

$mpdf->Output(); 

    ?>