<?php

if(!isset($_SESSION['id'])) {
    header('Location: ../index');
    exit();
}
function base() {
    return str_replace('index.php', '',$_SERVER['PHP_SELF']);
}
// include autoloader
require_once 'dompdf/autoload.inc.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class

$dompdf = new Dompdf();

require_once('include/autoloader.php');
//html
if(!isset($_GET['id'])) {
    header('Location: index');
    exit();
}

$id = $_GET['id'];
Validate::validateString('id', $id);
if(Message::getError()) {
    header('Location: ../index');
    exit();
}

$invoice = Invoice::findById($id);
if($invoice['userId'] !== $_SESSION['id']) {
    header('Location: ../index');
    exit();
}

if($invoice['fiskalni']) {
    $bill = Bill::findById($invoice['fiskalni']);
    $billDate = strtotime($bill['datum']);
    $billDate = date('d.m.Y', $billDate);
}
$firm = Firm::findById($invoice['firmaId']);
$client = Client::findById($invoice['kupacId']);

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]" . base();
$date = strtotime($invoice['datum']);
$datum = date('d.m.Y', $date);
$rok = strtotime($invoice['rok']);
$rok = date('d.m.Y', $rok);
if($firm['logo']) {
    $path = $actual_link . 'images/' . $firm['logo'];
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
}
if(isset($bill)) {
    $path = $actual_link . 'images/' . $bill['slika'];
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $fiskalniImage = 'data:image/' . $type . ';base64,' . base64_encode($data);
}

$pdfName = $firm['ime'] . '-' . $invoice['broj'] . '-' . $datum;
$pdfName = str_replace(' ', '_', $pdfName); 
$pdfName = str_replace(['/', '?'], '', $pdfName);

$articles = InvoiceArticle::findAllByQuery('fakturaId', $id);
$articlesWithDescription = array();

for($redniBroj = 0; $redniBroj < count($articles); $redniBroj++) {
    $foundArticle = Article::findAllByQuery2('ime', $articles[$redniBroj]['ime'], 'userId', $invoice['userId']);
    if($foundArticle['opis']) {
        $articlesWithDescription[$redniBroj] = $foundArticle;
        $articlesWithDescription[$redniBroj]['redniBroj'] = $redniBroj + 1;
    }
}


$popust = 0;
foreach($articles as $article) {
    if($article['rabat'] != '0') {
        $popust += 1;
        break;
    }
}

ob_start();
?>
<style>
* { 
    font-family: DejaVu Sans;
    font-size: 12px;
}
p, div {
    margin: 0px;
    padding: 0px;
}
.pdf-header__logo {
  float: left;
  height: 100px;
}
.pdf-header__logo img {
  height: 100px;
}
.pdf-header__info {
  float: right;
  font-size: 14px;
}

.pdf-line {
  clear: both;
  height: 2px;
  background-color: #007bff;
  margin-bottom: 25px;
}
.pdf-invoice-info {
  float: left;
  margin-bottom: 20px;
}
.pdf-wrapper p {
  margin-bottom: 5px;
}
.pdf-client-info {
  float: right;
}
.pdf-invoice-number {
  clear: both;
  background-color: #007bff;
  color: #fff;
  text-align: center;
  margin-bottom: 25px;
}
.pdf-invoice-number h2 {
    padding: 2px;
}
.pdf-invoice-articles {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 50px;
  text-align: right;
}
.pdf-invoice-articles td {
  border-bottom: 1px solid #000;
  padding: 0px 5px;
}
td.pdf-invoice-last {
  padding-right: 0px;
}
td.pdf-invoice-first {
  text-align: left;
  width: 10%;
}
.pdf-signature {
  float: left;
  width: 20%;
}
.pdf-signature__line {
  width: 100%;
  height: 1px;
  background-color: #000;
  margin-top: 25px;
}
.pdf-total-info {
  float: right;
  border: 1px solid #000;
  padding: 5px;
}
.pdf-total-info td {
  padding: 0 5px;
}
.text-center {
    text-align: center;
}
.text-left {
    text-align: left;
}
.text-right {
    text-align: right;
}
.w-30 {
    width: 30%;
}
.mb-s {
    margin-bottom: 20px;
}
.mb-m {
    margin-bottom: 40px;
}
.mr-m {
    margin-right: 40px;
}
.page-break {
    page-break-before: always;
}
.fiskalni__image {
    max-height: 300px;
    max-width: 90%;
}
</style>
<div class="pdf-header">
    <div class="pdf-header__logo">
        <?php if($firm['logo']) { ?>
            <img src="<?php echo $base64 ?>" alt="" >
        <?php } ?>
    </div>
    <div class="pdf-header__info">
        <p>Firma: <?php echo $firm['ime']; ?></p>      
        <?php if($firm['adresa']) { ?>
            <p>Adresa: <?php echo $firm['adresa']; ?>
            <?php if($firm['mjesto']) { ?>
                <?php echo ', ' . $firm['mjesto']; ?>
            <?php } ?>
            </p>
        <?php } ?>
        <?php if($firm['telefon']) { ?>
            <p>Telefon: <?php echo $firm['telefon']; ?></p>
        <?php } ?>
        <?php if($firm['email']) { ?>
            <p>Email: <?php echo $firm['email']; ?></p>
        <?php } ?>
        <?php if($firm['jib']) { ?>
            <p>JIB: <?php echo $firm['jib']; ?></p>
        <?php } ?>
        <?php if($firm['pib']) { ?>
            <p>PIB: <?php echo $firm['pib']; ?></p>
        <?php } ?>
        <?php if($firm['racun']) { ?>
            <p>TR: <?php echo $firm['racun'] ?></p>
            <?php if($firm['banka']) { ?>
                <p>Banka: <?php echo $firm['banka']; ?></p>
            <?php } ?>
        <?php } ?>
    </div>
</div>
<div class="pdf-line"></div>
<div class="pdf-invoice-info">
    <p>Datum izdavanja: <?php echo $datum ?></p>
    <p>Mjesto izdavanja: <?php echo $invoice['mjesto'] ?></p>
    <p>Način plaćanja: <?php echo $invoice['nacin'] ?></p>
    <p>Rok za plaćanje: <?php echo $rok ?></p>
    <?php if($invoice['fiskalni']) { ?>
        <p> Fiskalni račun broj: <?php echo $bill['broj']; ?></p>
    <?php }?>
</div>
<div class="pdf-client-info">
    <p>Klijent: <?php echo $client['ime'] ?></p>
    <?php if($client['adresa']) { ?>
        <p>Adresa: <?php echo $client['adresa']; ?>
            <?php if($client['mjesto']) { ?>
                <?php echo ', ' . $client['mjesto']; ?>
            <?php } ?>
        </p>
    <?php } ?>
    <?php if($client['telefon']) { ?>
        <p>Telefon: <?php echo $client['telefon']; ?></p>
    <?php } ?>
    <?php if($client['email']) { ?>
        <p>Email: <?php echo $client['email']; ?></p>
    <?php } ?>
    <?php if($client['jib']) { ?>
        <p>JIB: <?php echo $client['jib']; ?></p>
    <?php } ?>
    <?php if($client['pib']) { ?>
        <p>PIB: <?php echo $client['pib']; ?></p>
    <?php } ?>
    <?php if($client['racun']) { ?>
        <p>Račun: <?php echo $client['racun']; ?></p>
        <?php if($client['banka']) { ?>
            <p>Banka: <?php echo $firm['banka']; ?></p>
        <?php } ?>
    <?php } ?>
</div>
<div class="pdf-invoice-number">
        <h2><?php echo $invoice['tip'] . ' broj: ' . $invoice['broj']; ?></h2>
</div>
<table class="pdf-invoice-articles">
    <tr>
        <td class="pdf-invoice-first">Redni broj</td>
        <td class="text-left w-30">Naziv robe</td>
        <td>Količina</td>
        <td>Cijena</td>
        <?php if($popust > 0) { ?>
            <td>Popust</td>
        <?php } ?>
        <?php if($firm['pdv'] == '1') { ?>
            <td>Ukupno bez PDV</td>
            <td>PDV</td>
        <?php } ?>
        <td class="pdf-invoice-last">Ukupno</td>
    </tr>
    <?php
        $i = 1;
        $ukupno = 0;
        $ukupnoPdv = 0;
        $ukupnoBezPdv = 0;
        foreach($articles as $article) {
    ?>
    <tr>
        <td class="pdf-invoice-first"><?php echo $i; ?></td>
        <td class="text-left w-30"><?php echo $article['ime']; ?></td>
        <td><?php echo $article['kolicina']; ?></td>
        <td><?php echo $article['cijena']; ?>KM</td>
        <?php if($popust > 0) { ?>
            <td><?php echo $article['rabat']; ?>%</td>
        <?php } ?>
        <?php if($firm['pdv'] == '1') { ?>
            <td><?php echo $article['bezPdv']; ?>KM</td>
            <td><?php echo $article['pdv']; ?>KM</td>
        <?php
            $ukupnoPdv += $article['pdv'];
            $ukupnoBezPdv += $article['bezPdv'];
        } ?>
        <td class="pdf-invoice-last"><?php echo $article['ukupno']; ?>KM</td>
        <?php $ukupno += $article['ukupno']; $i++; ?>
    </tr>
    <?php } ?>
</table>
<div class="pdf-signature">
    <p>Fakturisao:</p>
    <p><?php echo $invoice['fakturista']; ?></p>
    <p class="pdf-signature__line"></p>
</div>
<table class="pdf-total-info">
    <?php if($firm['pdv'] == '1') { ?>
        <tr>
        <td>Ukupno bez PDV: </td>
        <td class="text-right"><?php echo sprintf("%.2f", $ukupnoBezPdv) . 'KM'; ?></td>
        </tr>
        <tr>
            <td>Ukupno PDV:</td>
            <td class="text-right"><?php echo sprintf("%.2f", $ukupnoPdv) . 'KM'; ?></td>
        </tr>
    <?php }?>
    <tr>
        <td>Ukupno:</td>
        <td class="text-right" ><?php echo sprintf("%.2f", $ukupno) . 'KM'; ?></td>
    </tr>
</table>
</div>
<?php if(isset($bill['slika']) && $bill['slika']) { ?>
<div class="page-break"></div>
<div class="fiskalni">
    <h2 class="mb-m text-center">Fiskalni račun</h2>
    <p class="mb-s">Broj fiskalnog računa: <?php echo $bill['broj']; ?></p>
    <p class="mb-s">Datum fiskalnog računa: <?php echo $billDate; ?></p>
    <img src="<?php echo $fiskalniImage; ?>" class="fiskalni__image" alt="">
</div>
<?php } ?>
<?php if($articlesWithDescription) { ?>
<div class="page-break"></div>
<h2 class="mb-m text-center">Opisi artikala</h2>
<?php foreach($articlesWithDescription as $article) { ?>
<div class="article-description mb-s">
    <p class="mb-s">Redni broj artikla: <?php echo $article['redniBroj']; ?></p>
    <p class="mb-s">Naziv artikla: <?php echo $article['ime']; ?></p>
    <p class="mb-s">Opis artikla: <?php echo $article['opis']; ?></p>
</div>
<?php } ?>
<?php } ?>

<?php 
$html = ob_get_clean();


$html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');


$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream($pdfName, array('Attachment' => '0'));