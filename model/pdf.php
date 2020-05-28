<?php
require_once('tcpdf/tcpdf_include.php');
require_once('selectTPI.php');

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        // $image_file = K_PATH_IMAGES.'logo_example.jpg';
        // $this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        // $this->SetFont('helvetica', 'B', 20);
        // Title
        $this->Cell(0, 15, '', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        //Cell( $w, $h = 0, $txt = '', $border = 0, $ln = 0, $align = '', $fill = false, $link = '', $stretch = 0, $ignore_min_height = false, $calign = 'T', $valign = 'M' )
        $this->Cell(1, 10, 'Page '. $this->getAliasNumPage() .' sur ' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
// $pdf->SetCreator(PDF_CREATOR);
// $pdf->SetAuthor('Nicola Asuni');
// $pdf->SetTitle('TCPDF Example 003');
// $pdf->SetSubject('TCPDF Tutorial');
// $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
// $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('times', 'BI', 12);

// add a page
$pdf->AddPage();

// set some text to print
// $html = file_get_contents('model/print_validation.php');

$html = <<<PDF
<style>
* {
    font-family: Arial, sans-serif
}

td {
    vertical-align: top;
    padding: 2mm;
}

th {
    vertical-align: top;
    text-align: left;
    padding: 2mm;
}

.attention {
    color: red;
}

.cartouche,
.cartouche td,
.cartouche th {
    border: 1px solid black;
    border-collapse: collapse;
}

.lowerline {
    border-bottom: 1px solid black;
    border-collapse: collapse;
}


h4 {
    margin: 0;
}

p {
    margin-top: 1mm;
    margin-bottom: 1mm;
}

table.page_footer {
    width: 100%;
    border: none;
    border-top: solid 1px black;
    padding: 2mm
}

table.page_header {
    width: 100%;
    border: none;
    border-bottom: solid 1px black;
    padding: 2mm
}
</style>

<page backtop="10mm" backbottom="10mm" backleft="10mm" backright="10mm">


    <table>
        <tr>
            <td width="60"><img src="img/GE50px.png" alt="logo GE"></td>
            <td width="460">
                <p>République et canton de Genève<br>Département de l'instruction publique, <br>de la formation et de la jeunesse<br><strong>Office pour l'orientation, <br>la formation professionnelle et continue</strong>
                </p>
            </td>
            <td width="100"><img src="img/LogoExpertsDev100px.png" alt="logo Expert"></td>
        </tr>
    </table>

    <h2 style="text-align:center">Travail pratique individuel (TPI)</h2>
    <h4 style="text-align:center">Informaticien-ne CFC<br> Validation de l'énoncé (<span class="attention">sans la présence du candidat</span>)</h4>

    <table class="cartouche">
        <tr>
            <td width="310">
                <h4>Entreprise formatrice, chef de projet</h4>
                <p>
                    $managerCompagny<br>
                    $managerLastName $managerFirstName<br>
                    $managerPhone<br>
                    $managerMail
                </p>
            </td>
            <td width="310">
                <h4>Candidat</h4>
                <p><br>
                    $candLastName$candLastName $candFirstName<br>
                    $candPhone<br>
                    $candMail
                </p>
            </td>

        </tr>
        <tr>
            <td>
                <h4>1<sup>er</sup> Expert</h4>
                <p>
                    $expert1LastName $expert1FirstName<br>
                    $expert1Phone<br>
                    $expert1Mail
                </p>
            </td>
            <td>
                <h4>2<sup>ème</sup> Expert</h4>
                <p>
                    $expert2LastName $expert2FirstName<br>
                    $expert2Phone<br>
                    $expert2Mail
                </p>
            </td>
        </tr>
    </table>
    <p><br></p>

    <table>
        <tr>
            <th width="100" class="lowerline">Titre du travail</th>
            <td width="510" class="lowerline">
                <h4>$title</h4>
            </td>
        </tr>

        <tr>
            <th width="100" class="lowerline">Domaine</th>
            <td width="510" class="lowerline">$domain</td>
        </tr>
        <tr>
            <th width="100" class="lowerline">Dates</th>
            <td width="510" class="lowerline">du $start au $end, de $hourStart à $hourEnd</td>
        </tr>
        <tr>
            <th width="100" class="lowerline">Lieu où se déroule le travail</th>
            <td width="510" class="lowerline">$workplace</td>
        </tr>
    </table>

    <table class="cartouche">
        <thead>
            <tr>
                <th width="520">Critère</th>
                <th width="100">Rempli</th>
            </tr>
        </thead>
        <tbody>
PDF;

foreach ($criterions as $key => $value) {
    $html .= '<tr><td width="500">' . $value['criterionDescription'] .'</td>';
    $html .= '<td width="100"> NON </td></tr>';
}

$html .= <<<PDF
            <tr>
                <td colspan="2" width="640">
                    <h4>Remarques, mesures de correction</h4>
                    <p>COMMENT</p>
                </td>
            </tr>
        </tbody>

    </table>
    <h2>Validation</h2>

    <table class="cartouche">
        <tbody>
            <tr>
                <td width="640">
                    $expert1Valid
                    <br>
                    $expert2Valid
                </td>
            </tr>
        </tbody>
    </table>
</page>
PDF;

// print a block of text using Write()
// $pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);
$pdf->writeHTML($html, true, false, true, false, '');

// ---------------------------------------------------------

// $format = 'Enonce_TPI_%s_%d_%s_%s.pdf';
// echo sprintf($format, $year, $tpiChoosen, $candLastName, $candFirstName);
//Close and output PDF document

$format = 'Enonce_TPI_' . $year . '_' . $tpiChoosen . '_' . $candLastName . '_' . $candFirstName . '.pdf';
// $format = 'Enonce_TPI_2020.pdf';

$pdf->Output($format, 'I');

//============================================================+
// END OF FILE
//============================================================+
