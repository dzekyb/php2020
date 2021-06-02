<?php 
    if(!isset($_SESSION['id'])) { 
        header('Location: login');
        exit();
    }
    require_once('include/autoloader.php');
    $id = Sanitize::sanitizeString($_SESSION['id']);
    $firms = Firm::findAllByQuery('userId', $id);
?>
<main>
    <h2 class="card__header text-center card__header-border weight-500">Dodaj fiskalni račun</h2>
<div class="wrapper">
<div class="form-container m-auto">
<form action="include/add_bill.inc.php" enctype="multipart/form-data"  method="POST">
    <div class="card-body">
        <div class="mb-xm">
            <label for="broj">Broj fiskalnog računa</label>
            <input type="text" name="broj" id="broj"  class="form__input">
            <span class="registration-form__error"></span>
        </div>
        <div class="mb-xm">
            <label for="datum">Datum izdavanja računa</label>
            <input type="date" name="datum" id="datum"  class="form__input" value="<?php echo date('Y-m-d'); ?>">
            <span class="registration-form__error"></span>
        </div>
        <div class="mb-xm">
            <label for="firmaId">Naziv firme</label>
            <select name="firmaId" id="firmaId" class="form__input">
                <?php foreach($firms as $firm) { ?>
                    <option value="<?php echo $firm['id']; ?>"><?php echo $firm['ime']; ?></option>
                <?php } ?>
            </select>
            <span class="registration-form__error"></span>
        </div>
        <div class="mb-xm">
            <label for="logo" class="file-label mb-xs">Dodaj sliku računa <i class="fas fa-upload hide-icon"></i></label>
            <i class="fas fa-times d-none remove-image pointer text-right mb-xs"></i>
            <input type="file" name="slika" id="logo" class="form__input-file">
            <img src="" alt="" class="firm-logo d-block m-auto">
            <span class="registration-form__error"></span>
        </div>
        <p class="success-message mb-xs text-center"></p>
        <button class="btn btn-primary" name="submit">Sačuvaj <i class="fas fa-save hide-icon"></i></button>
    </div>
</form>
</div>
</div>
</main>

