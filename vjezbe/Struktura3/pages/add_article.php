<?php 
if(!isset($_SESSION['id'])) {
    header('Location: index');
    exit();
}
require_once('include/autoloader.php');
$id = $_SESSION['id'];
$firms = Firm::findAllByQuery('userId', $id);
?>

<main>
<h2 class="card__header text-center card__header-border weight-500">Dodaj Artikal</h2>
<div class="wrapper d-flex jc-c ai-c">
    <div class="form-container m-auto mb-l">
    <form action="include/articles.inc.php" id="newArticle" method="POST">
        <div class="card-container">
                <div class="card-body">
                    <div class="mb-xm">
                        <label for="firma">Firma</label>
                        <select name="firma" class="form__input" id="firma">
                        
                            <?php foreach($firms as $firm) { ?>
                                <option value="<?php echo $firm['id']; ?>"><?php echo $firm['ime']; ?></option>
                            <?php } ?>
                        </select>
                        <span class="registration-form__error"></span>
                    </div>
                    <div class="mb-xm">
                        <label for="<?php echo $id; ?>-id">Šifra</label>
                        <input type="text" name="idArtikla"  class="form__input">
                        <span class="registration-form__error"></span>
                    </div>
                    <div class="mb-xm">
                        <label for="ime">Naziv</label>
                        <input type="text" name="ime" id="ime" class="form__input">
                        <span class="registration-form__error"></span>
                    </div>
                    <div class="mb-xm">
                        <label for="cijena">Cijena</label>
                        <input type="number" step="0.01" name="cijena" id="cijena"  class="form__input">
                        <span class="registration-form__error"></span>
                    </div>
                    <div class="mb-xm">
                        <label for="opis">Opis</label>
                        <textarea rows="3" name="opis" id="opis"  class="form__input h-auto"></textarea>
                        <span class="registration-form__error"></span>
                    </div>  
                    <p class="success-message mb-xm text-center"></p>
                    <button name="submit" class="btn btn-primary">Sačuvaj <i class="fas fa-save hide-icon"></i></button>
                </div>
        </div>
    </form>
    </div>
    </div>
</main>
