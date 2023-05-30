<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH."third_party/dompdf/autoload.inc.php";
// require_once(dirname(__FILE__) . 'third_party/dompdf/autoload.inc.php');
//use Dompdf \Dompdf;

// class Pdf
// {
//     public function __construct(){
        
//         // include autoloader
//         require_once APPPATH."third_party/dompdf/autoload.inc.php";
        
//         // instantiate and use the dompdf class
//         $pdf = new DOMPDF();
        
//         $CI =& get_instance();
//         $CI->dompdf = $pdf;
        
//     }
// class Pdf
// {
//     function createPDF($html, $filename='', $download=FALSE, $paper='A4', $orientation='portrait'){
//         $dompdf = new Dompdf \Dompdf();
//         $dompdf->load_html($html);
//         $dompdf->set_paper($paper, $orientation);
//         $dompdf->render();
//         if($download)
//             $dompdf->stream($filename.'.pdf', array('Attachment' => 1));
//         else
//             $dompdf->stream($filename.'.pdf', array('Attachment' => 0));
//     }


    
// }


use Dompdf \Dompdf;
class Pdf {
// por defecto, usaremos papel A4 en vertical, salvo que digamos otra cosa al momento de generar un PDF
public function generate($html, $filename='', $stream=TRUE, $paper = 'A4', $orientation = "portrait")
  {
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper($paper, $orientation);
    $dompdf->render();
if ($stream) {
        // "Attachment" => 1 hará que por defecto los PDF se descarguen en lugar de presentarse en pantalla.
        $dompdf->stream($filename.".pdf", array("Attachment" => 1));
    }
else 
    {
      return $dompdf->output();
    }
  }
}
?>