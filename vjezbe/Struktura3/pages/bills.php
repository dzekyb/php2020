<!--  rendering user bills -->
<?php
if(!isset($_SESSION['id'])) {
    header('Location: login');
    exit();
}
require_once('include/autoloader.php');
$id = Sanitize::sanitizeString($_SESSION['id']);
?>
<main>
    <h1 class="card__header text-center weight-500 w-100">Fiskalni računi</h1>
    <div class="hero">
<?php 

    $bills = Bill::findAllByQuery('userId', $id, 'DESC');
    if(count($bills) > 0) { ?>
        <div class="d-flex gap-m wrap s-flex-column">
        <?php
         foreach($bills as $bill) { 
             $firms = Firm::findAllByQuery('userId',$id);
             $currentFirm = Firm::findById($bill['firmaId']);
        ?> 
            <div class="w-25-gap-m l-w-50-gap-m s-w-100 card">
            <form action="include/update_bill.inc.php" enctype="multipart/form-data" method="POST">
                <div class="text-right d-flex jc-f-end">
                    <span class="edit icon-hover editing p-xs"> 
                        <i class="fas fa-edit d-iblock w-100"></i>
                    </span>
                    <?php 
                    $isBillInInvoice = Invoice::findAllByQuery('fiskalni', $bill['id']);
                    if(empty($isBillInInvoice)) {?>
                        <span class="delete__bill editing icon-hover-danger pointer p-xs">
                            <i class="fas fa-trash d-iblock w-100"></i>
                        </span>
                    <?php } ?>
                </div>
                <div class="p-xs">
                    <div class="mb-xs">
                        <label for="<?php echo $bill['id'] . '-broj'; ?>">Broj računa</label>
                        <input type="text" class="form__input" disabled name="<?php echo $bill['id'] . '-broj'; ?>" id="<?php echo $bill['id'] . '-broj'; ?>" value="<?php echo $bill['broj']; ?>">
                        <span class="registration-form__error"></span>
                    </div>
                    <div class="mb-xs">
                        <label for="<?php echo $bill['id'] . '-datum'; ?>">Datum računa</label>
                        <input type="date" class="form__input" disabled name="datum" id="<?php echo $bill['id'] . '-datum'; ?>" value="<?php echo $bill['datum']; ?>">
                        <span class="registration-form__error"></span>
                    </div>
                    <div class="mb-xm">
                        <label for="firmaId">Naziv firme</label>
                        <select name="firmaId" id="firmaId" disabled class="form__input">
                            <option value="<?php echo $bill['firmaId'] ?>"><?php echo $currentFirm['ime'] ?></option>
                            <?php foreach($firms as $firm) { ?>
                                <option value="<?php echo $firm['id']; ?>"><?php echo $firm['ime']; ?></option>
                            <?php } ?>
                        </select>
                        <span class="registration-form__error"></span>
                    </div>
                    <div class="text-center">
                        <input type="file" class="form__input-file" disabled name="slika" id="<?php echo $bill['id'] . '-slika'; ?>" value="<?php echo $bill['slika']; ?>">
                        <label for="<?php echo $bill['id'] . '-slika'; ?>" class="file-label mb-xs">Slika fiskalnog računa <i class="fas fa-upload hide-icon"></i></label>
                        <i class="fas fa-times <?php echo $bill['slika'] ? 'd-block' : 'd-none'; ?> remove-image pointer text-right mb-xs"></i>
                        <img src="<?php echo $bill['slika'] ? base() . 'images/' . $bill['slika'] : ''; ?>" class="w-100">
                        <span class="registration-form__error"></span>
                    </div>
                    <div>
                        <button class="btn btn-primary save w-100 mb-xs hide-buttons d-none" name="submit">Sačuvaj <i class="fas fa-save hide-icon"></i></button>
                        <span class="btn btn-secondary cancel w-100 hide-buttons text-center d-none">Poništi</span>
                    </div>
                </div>
                <div class="modal-overlay">
                <div class="modal p-none">
                    <div class="modal__heading">
                        <h3>POTVRDA O BRISANJU</h3>
                    </div>
                    <div class="modal__warning">
                        <p>Da li ste sigurni da želite da izbrišete fiskalni račun?</p>
                    </div>
                    <div class="mt-s text-right p-xs">
                        <a href="<?php base(); ?>include/delete_bill.inc.php?id=<?php echo $bill['id']; ?>" class="btn btn-danger">Izbriši</a>
                        <span class="btn btn-secondary cancel-modal">Odustani</span>
                    </div>
                </div>
            </div>
            </form>
            </div>
    <?php } ?>
        </div>
    <?php } else { ?>
        <p>Niste dodali nijedan fiskalni račun...</p>
    <?php } ?>
    <div class="mt-m">
        <a href="<?php base(); ?>add_bill" class="btn btn-primary btn-large text-center">Dodaj fiskalni <i class="fas fa-plus hide-icon"></i></a>
    </div>
</div>
</main>

