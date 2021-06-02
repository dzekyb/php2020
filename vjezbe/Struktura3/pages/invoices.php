<!--  rendering  invoices -->
<?php
if(!isset($_SESSION['id'])) {
    header('Location: login');
    exit();
}

require_once('include/autoloader.php');
$id = Sanitize::sanitizeString($_SESSION['id']);
$invoices = Invoice::findAllByQuery('userId', $id, 'DESC');
?>

<main>
    <h1 class="card__header text-center weight-500 w-100">Fakture</h1>
<div class="hero">
    <?php if(count($invoices) > 0) { ?>
        <div class="d-flex gap-m wrap s-flex-column mb-m">
    <?php foreach($invoices as $invoice) { 
            $rok = strtotime($invoice['rok']);
            $rok = date('d.m.Y', $rok);
            $datum = strtotime($invoice['datum']);
            $datum = date('d.m.Y', $datum);
            $client = Client::findById($invoice['kupacId']);
            $firm = Firm::findById($invoice['firmaId']);
    ?>
        <div class="w-25-gap-m l-w-50-gap-m s-w-100 card relative">
            <span class="p-xs icon-hover-danger pointer delete__invoice">
                <i class="fas fa-trash d-iblock w-100"></i>
            </span>
            <div class="card-body">
                <span class="d-block">Firma: </span><span class="d-block mb-xs"> <?php echo $firm['ime'];?></span>
                <span class="d-block">Broj fakture: </span><span class="d-block mb-xs"> <?php echo $invoice['broj'];?></span>
                <span class="d-block">Klijent:</span> <span class="d-block mb-xs"> <?php echo $client['ime'];?></span>
                <span class="d-block">JIB klijenta: </span><span class="d-block mb-xs"> <?php echo $client['jib'];?></span>
                <span class="d-block">Adresa klijenta: </span><span class="d-block mb-xs"> <?php echo $client['adresa'];?></span>
                <span class="d-block">Mjesto izdavanja: </span><span class="d-block mb-xs"> <?php echo $invoice['mjesto'] ?? ''; ?></span>
                <span class="d-block">Datum izdavanja: </span><span class="d-block mb-xs"> <?php echo $datum; ?></span>
                <span class="d-block">Način plaćanja: </span><span class="d-block mb-xs"> <?php echo $invoice['nacin']; ?></span>
                <span class="d-block">Rok plaćanja: </span><span class="d-block mb-xs"> <?php echo $rok; ?></span>
                <span class="d-block">Fakturisao: <span class="d-block mb-xs"> <?php echo $invoice['fakturista']; ?></span></span>
                <a href="pdf_preview/<?php echo $invoice['id'] ?>" class="btn btn-primary w-100 text-center mb-xs">Pregled <i class="far fa-eye hide-icon"></i></a>
                <a href="render_pdf/<?php echo $invoice['id'] ?>"  target="_blank" rel="nooklijenta" class="btn btn-primary w-100 text-center mb-xs">Ispiši PDF <i class="fas fa-print hide-icon"></i></a>
                <a href="update_invoice/<?php echo $invoice['id'] ?>" class="btn btn-primary text-center w-100 text-center">Uredi <i class="fas fa-edit hide-icon"></i></a>
            </div>
            <div class="modal-overlay">
                <div class="modal p-none">
                    <div class="modal__heading">
                        <h3>POTVRDA O BRISANJU</h3>
                    </div>
                    <div class="modal__warning">
                        <p>Da li ste sigurni da želite da izbrišete fakturu?</p>
                    </div>
                    <div class="modal__button mt-s text-right p-xs">
                        <a href="<?php base(); ?>include/delete_invoice.inc.php?id=<?php echo $invoice['id']; ?>" class="btn btn-danger">Izbriši</a>
                        <span class="btn btn-secondary cancel">Odustani</span>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
        </div>
    <?php } else { ?>
        <p>Niste kreirali nijednu fakturu...</p>
    <?php } ?>
    <a href="add_invoice" class="btn btn-primary text-center btn-large mt-m">Kreiraj fakturu <i class="fas fa-plus hide-icon"></i></a>
</div>
</main>

