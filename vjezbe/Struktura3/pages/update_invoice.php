<?php 
    if(!isset($_SESSION['id'])) { 
        header('Location: login');
        exit();
    }
    require_once('include/autoloader.php');
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
    
    $clients = Client::findAllByQuery('userid', $_SESSION['id']);
    $invoiceClient = Client::findById($invoice['kupacId']);
    $firms = Firm::findAllByQuery('userId', $_SESSION['id']);
    $invoiceFirm = Firm::findById($invoice['firmaId']);
    $articles = InvoiceArticle::findAllByQuery('fakturaId', $id);
    $bills = Bill::findAllByQuery('firmaId', $invoice['firmaId']);
    $currentBill = Bill::findById($invoice['fiskalni']);

    require_once('section/town_array.php');
?>
<main>
<h2 class="card__header text-center card__header-border weight-500">Uredi fakturu</h2>
<div class="wrapper">
<div class="m-auto visible">
<form action="../include/update_invoice.inc.php" autocomplete="off"  method="POST">
    <div class="card-body">
        <div class="d-flex gap-s mb-xm m-flex-column">
            <div class="w-100">
                <label for="firma">Naziv firme</label>
                <select class="form__input required" name="firma" id="firma">
                        <option selected value="<?php echo $invoiceFirm['id']; ?>"><?php echo $invoiceFirm['ime']; ?></option>
                    <?php foreach($firms as $firm) { ?>
                        <option value="<?php echo $firm['id']; ?>"><?php echo $firm['ime'] ?></option>
                    <?php } ?>
                </select>
                <span class="registration-form__error"></span>
            </div>
            <div class="w-100">
                <label for="tip">Tip fakture</label>
                <select name="tip" id="tip" class="form__input required">
                    <option value="<?php echo $invoice['tip']; ?>" selected><?php echo $invoice['tip']; ?></option>
                    <option value="Faktura">Faktura</option>
                    <option value="Predracun">Predračun</option>
                    <option value="Avansni predračun">Avansni predračun</option>
                    <option value="Ponuda">Ponuda</option>
                    <option value="Storno faktura">Storno faktura</option>
                </select>
                <span class="registration-form__error"></span>
            </div>
            <div class="w-100">
                <label for="broj">Broj fakture</label>
                <input type="text" name="<?php echo $invoice['id']; ?>-broj" id="broj"  class="form__input required" value="<?php echo $invoice['broj']; ?>">
                <span class="registration-form__error"></span>
            </div>
        </div>
        <div class="d-flex gap-s mb-xm m-flex-column">
            <div class="w-100">
                <label for="datum">Datum izdavanja</label>
                <input type="date" name="datum" id="datum" class="form__input required" value="<?php echo $invoice['datum']; ?>">
                <span class="registration-form__error"></span>
            </div>
            <div class="w-100">
                <label for="mjesto">Mjesto izdvananja</label>
                <select name="mjesto" id="mjesto" class="form__input required">
                        <option value="<?php echo $invoice['mjesto']; ?>"><?php echo $invoice['mjesto']; ?></option>
                        <?php foreach($town_array as $town) { 
                            if(!is_numeric($town[0])) { ?>
                                <option value="" disabled class="info"><?php echo $town ?></option>
                        <?php } else {?>
                            <option value="<?php echo $town ?>">&nbsp;<?php echo $town ?></option>
                            <?php } ?>
                        <?php } ?>
                </select>
                <span class="registration-form__error"></span>
            </div>
            <div class="w-100 relative">
                <label for="kupac">Ime klijenta</label>
                <select name="kupac" id="kupac" class="form__input required">
                    <?php if(count($clients) > 0) {
                        foreach($clients as $client) {?>
                            <option value="<?php echo $client['id']; ?>"><?php echo $client['ime']; ?></option>
                    <?php  }
                    } ?>
                </select>
                <span class="registration-form__error"></span>
            </div>
        </div>
        <div class="d-flex gap-s mb-xm m-flex-column">
            <div class="w-100">
                <label for="nacin">Način plaćanja</label>
                <select name="nacin" class="form__input" id="nacin">
                    <option value="<?php echo $invoice['nacin']; ?>" selected><?php echo $invoice['nacin']; ?></option>
                    <option value="Virman">Virman</option>
                    <option value="Gotovina">Gotovina</option>
                    <option value="Ček">Ček</option>
                    <option value="Kartica">Kartica</option>
                    <option value="">Drugo</option>
                </select>
                <span class="registration-form__error"></span>
            </div>
            <div class="w-100">
                <label for="fakturista">Fakturisao</label>
                <input type="text" name="fakturista" id="fakturista" class="form__input required" value="<?php echo $invoice['fakturista']; ?>">
                <span class="registration-form__error"></span>
            </div>
            <div class="w-100">
                <label for="rok">Rok plaćanja</label>
                <input type="date" name="rok" id="rok" class="form__input required" value="<?php echo $invoice['rok']; ?>">
                <span class="registration-form__error"></span>
            </div>
        </div>
        <div class="d-flex gap-s mb-xm m-flex-column">
            <div class="w-100">
            <label for="fiskalni">Broj fiskalnog računa</label>
                <select name="fiskalni" id="fiskalni" class="form__input">
                    <option value="<?php echo $invoice['fiskalni'] ?? ''; ?>"><?php echo $currentBill['broj'] ?? ''; ?></option>
                    <option value="dodajFiskalni">Dodaj novi fiskalni račun</option>
                    <?php foreach($bills as $bill) { ?>
                        <option value="<?php echo $bill['id']; ?>"><?php echo $bill['broj'] ?></option>
                    <?php } ?>
                </select>
                <span class="registration-form__error"></span>
            </div>
            <div class="w-100"></div>
            <div class="w-100"></div>
        </div>
        <div id="articles">
            <h2 class="card__header text-center card__header-border weight-500 m-d-block d-none mt-l">Artikli</h2>
            <div class="d-flex" class="articlesHeader">
                <span class="w-30 p-x border weight-500 hidden mm-d-none">Naziv</span>
                <span class="w-10 p-x border weight-500 hidden mm-d-none">Jed. cijena</span>
                <span class="w-10 p-x border weight-500 hidden mm-d-none">Količina</span>
                <span class="w-10 p-x border weight-500 hidden mm-d-none">Popust</span>
                <span class="w-15 p-x border weight-500 hidden mm-d-none">Cijena bez PDV</span>
                <span class="w-10 p-x border weight-500 hidden mm-d-none">PDV</span>
                <span class="w-15 p-x border weight-500 hidden mm-d-none">Ukupno</span>
            </div>
        <?php if(count($articles) > 0) { 
                $i = 0;
        ?>
            <?php foreach($articles as $article) { 
                $i++;    
            ?>
            <div class="d-flex articlesNumber m-w-100 m-flex-column m-card m-mb-m">
                <div class="w-30 border relative m-mb-xs m-border-none m-d-flex m-w-100">
                    <span class="w-30 p-x d-none m-d-block">Naziv</span>
                    <select id="<?php echo $i; ?>-artikli" name="<?php echo $i; ?>-imeArtikla" class="w-100 p-xs border-none m-border-input form__input h-100 imeArtikla dropdown ">
                        <option value="<?php echo $article['ime']; ?>" selected><?php echo $article['ime']; ?></option>
                    </select>
                    <span class="registration-form__error"></span>
                </div>
                <div class="w-10 border relative m-d-flex m-w-100 m-mb-xs m-border-none">
                    <span class="w-30 p-x d-none m-d-block">Cijena</span>
                    <input type="number" step="0.01" name="<?php echo $i; ?>-cijena-<?php echo $article['id']; ?>" class="w-100 p-xs m-border-input form__input border-none h-100 cijena" value="<?php echo $article['cijena']; ?>">
                    <span class="registration-form__error"></span>
                </div>
                <div class="w-10 border relative m-d-flex m-w-100 m-mb-xs m-border-none">
                    <span class="w-30 p-x d-none m-d-block">Količina</span>
                    <input type="number" step="0.01" name="<?php echo $i; ?>-kolicina" class="w-100 p-xs m-border-input form__input border-none h-100  kolicina" value="<?php echo $article['kolicina']; ?>">
                    <span class="registration-form__error"></span>
                </div>
                <div class="w-10 border relative m-d-flex m-w-100 m-mb-xs m-border-none">
                    <span class="w-30 p-x d-none m-d-block">Popust</span>
                    <select name="<?php echo $i; ?>-rabat" class="w-100 p-xs m-border-input border-none h-100 rabat form__input rabat required">
                        <option value="<?php echo $article['rabat']; ?>" selected><?php echo $article['rabat']; ?>%</option>
                        <?php for($j = 0; $j <= 100; $j++ ) { ?>
                            <option value="<?php echo $j ?>"><?php echo $j . '%'; ?></option>
                        <?php } ?>
                    </select>
                    <span class="registration-form__error"></span>
                </div>
                <div class="w-15 border m-d-flex m-w-100 m-mb-xs m-border-none">
                    <span class="w-30 p-x d-none m-d-block">Cijena bez PDV</span>
                    <input type="text" name="<?php echo $i; ?>-bezPdv" <?php echo $invoiceFirm['pdv'] !== '0' ? '' : 'disabled' ?> class="w-100 p-xs m-border-input form__input border-none h-100 bezPDV" value="<?php echo $invoiceFirm['pdv'] !== '0' ? $article['bezPdv'] . 'KM' : ''; ?>">
                    <span class="registration-form__error"></span>
                </div>
                <div class="w-10 border m-d-flex m-w-100 m-mb-xs m-border-none">
                    <span class="w-30 p-x d-none m-d-block">PDV</span>
                    <input type="text" name="<?php echo $i; ?>-pdv" <?php echo $invoiceFirm['pdv'] !== '0' ? '' : 'disabled' ?> class="w-100 p-xs m-border-input form__input border-none h-100 PDV" value="<?php echo $invoiceFirm['pdv'] !== '0' ? $article['pdv'] . 'KM' : ''; ?>">
                    <span class="registration-form__error"></span>
                </div>
                <div class="w-10 border m-d-flex m-w-100 m-mb-xs m-border-none">
                    <span class="w-30 p-x d-none m-d-block">Ukupno</span>
                    <input type="text" name="<?php echo $i; ?>-ukupno" class="w-100 p-xs m-border-input form__input border-none h-100 ukupno" value="<?php echo $article['ukupno'] . 'KM'; ?>">
                    <span class="registration-form__error"></span>
                </div>
                    <i class="fas fa-times remove-icon w-5 border d-flex jc-c ai-c m-d-flex pointer m-p-xs m-w-100"></i>
                <div class="modal-overlay">
                    <div class="modal">
                        <div class="modal__heading">
                            <h3>POTVRDA O BRISANJU</h3>
                        </div>
                        <div class="modal__warning">
                            <p>Da li ste sigurni da želite da izbrišete artikal?</p>
                        </div>
                        <div class="modal__button mt-s text-right p-xs">
                            <a href="<?php base(); ?>include/delete_article.inc.php?id=<?php echo $article['id']; ?>" class="btn btn-danger deleteArticle">Izbriši</a>
                            <span class="btn btn-secondary cancelRemoveArticle">Odustani</span>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
            
        <?php } ?>
        </div>
        <div class="w-40 m-w-100 mt-s card ml-auto">
            <div class="card-body">
                <h4 class="d-flex jc-sb ai-c <?php echo $invoiceFirm['pdv'] !== '0' ? '' : 'd-none'; ?>"><span>Ukupno bez PDV:</span> <span class="ukupnoBezPdv"></span> </h4>
                <h4 class="d-flex jc-sb ai-c <?php echo $invoiceFirm['pdv'] !== '0' ? '' : 'd-none'; ?>"><span>PDV:</span> <span class="ukupnoPDV"></span> </h4>
                <h4 class="d-flex jc-sb ai-c"><span>Ukupno:</span> <span class="ukupnoSve"></span> </h4>
            </div>
        </div>
        <p class="success-message mb-xs text-center"></p>
        <div class="mt-m">
            <button class="btn btn-primary btn-large add">Dodaj artikal <i class="fas fa-plus hide-icon"></i></button>
            <button class="btn btn-primary" name="submit">Sačuvaj <i class="fas fa-save hide-icon"></i></button>
        </div>
    </form>
</div>
</div>
<div class="modal-overlay-article">
<div class="modal">
<form action="include/articles.inc.php" id="newArticle" method="POST">
    <div class="card-container">
    <h2 class="card__header text-center card__header-border weight-500 mb-xs">Dodaj Artikal</h2>
        <div class="remove__modal">
                <i class="fas fa-times cancel"></i>
            </div>
            <div class="card-body">
                <div class="mb-xs">
                    <label for="firma-artikla">Firma</label>
                    <select name="firma" class="form__input" id="firma-artikla">
                    
                        <?php foreach($firms as $firm) { ?>
                            <option value="<?php echo $firm['id']; ?>"><?php echo $firm['ime']; ?></option>
                        <?php } ?>
                    </select>
                    <span class="registration-form__error"></span>
                </div>
                <div class="mb-xs">
                    <label for="sifra">Šifra</label>
                    <input type="text" name="idArtikla" id="sifra" class="form__input">
                    <span class="registration-form__error"></span>
                </div>
                <div class="mb-xs">
                    <label for="ime-artikla">Naziv</label>
                    <input type="text" name="ime" id="ime-artikla" class="form__input">
                    <span class="registration-form__error"></span>
                </div>
                <div class="mb-xs">
                    <label for="cijena-artikla">Cijena</label>
                    <input type="number" step="0.01" name="cijena" id="cijena-artikla"  class="form__input">
                    <span class="registration-form__error"></span>
                </div>
                <div class="mb-xs">
                    <label for="opis">Opis</label>
                    <textarea rows="3" name="opis" id="opis"  class="form__input h-auto"></textarea>
                    <span class="registration-form__error"></span>
                </div>  
                <p class="success-message mb-xs text-center"></p>
                <button name="submit" class="btn btn-primary">Sačuvaj <i class="fas fa-save hide-icon"></i></button>
                <button class="btn btn-secondary cancel">Odustani</button>
            </div>
    </div>
</form>
</div>
</div>
<div class="modal-overlay-bill">
<div class="modal">
<form action="include/add_bill.inc.php" enctype="multipart/form-data"  method="POST" id="add-bill-form">
    <h2 class="card__header text-center card__header-border weight-500 mb-xs">Dodaj fiskalni račun</h2>
    <div class="remove__modal">
        <i class="fas fa-times cancel pointer"></i>
    </div>
    <div class="card-body">
        <div class="mb-xm">
            <label for="broj-fiskalnog">Broj fiskalnog računa</label>
            <input type="text" name="broj" id="broj-fiskalnog"  class="form__input">
            <span class="registration-form__error"></span>
        </div>
        <div class="mb-xm">
            <label for="datum-fiskalnog">Datum izdavanja računa</label>
            <input type="date" name="datum" id="datum-fiskalnog"  class="form__input" value="<?php echo date('Y-m-d'); ?>">
            <span class="registration-form__error"></span>
        </div>
        <div class="mb-xm">
            <label for="firmaId">Naziv firme</label>
            <select name="firmaId" id="firmaId" class="form__input">
                <option value="<?php echo $invoiceFirm['id']; ?>"><?php echo $invoiceFirm['ime']; ?></option>
                <?php foreach($firms as $firm) { ?>
                    <option value="<?php echo $firm['id']; ?>"><?php echo $firm['ime']; ?></option>
                <?php } ?>
            </select> 
            <span class="registration-form__error"></span>
        </div>
        <div class="mb-xm">
            <label for="logo-fiskalnog" class="file-label mb-xs">Dodaj sliku računa <i class="fas fa-upload hide-icon"></i></label>
            <i class="fas fa-times d-none remove-image pointer text-right mb-xs"></i>
            <input type="file" name="slika" id="logo-fiskalnog" class="form__input-file">
            <img src="" alt="" class="firm-logo d-block m-auto">
            <span class="registration-form__error"></span>
        </div>
        <p class="success-message mb-xs text-center"></p>
        <button class="btn btn-primary" name="submit">Sačuvaj <i class="fas fa-save hide-icon"></i></button>
        <button class="btn btn-secondary cancel">Odustani</button>
    </div>
</form>
</div>
</div>
</main>

