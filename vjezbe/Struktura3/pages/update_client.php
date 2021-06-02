<?php 
    if(!isset($_SESSION['id'])) { 
        header('Location: login');
        exit();
    }
    if(isset($_GET['id'])) {
        require_once('include/autoloader.php');
        $id = $_GET['id'];
        Validate::validateString('id', $id);
        if(Message::getError()) {
            header('Location: ../index');
            exit();
        }
        $id = Sanitize::sanitizeString($id);
        $client = Client::findById($id);
    } else {
        header('Location: ../clients');
        exit();
    }
    require_once('section/town_array.php');
    require_once('section/bank_list.php');
?>
<main>
<h2 class="card__header text-center card__header-border weight-500">Uredi klijenta</h2>
<div class="wrapper">
<div class="form-container m-auto">
<form action="../include/update_client.inc.php" enctype="multipart/form-data" method="POST">
    <div class="card-body">
        <div class="mb-xm">
            <label for="ime">Ime klijenta(firme ili fizičkog lica)</label>
            <input type="text" name="<?php echo $client['id']; ?>-ime" id="ime"  class="form__input" value="<?php echo $client['ime']; ?>">
            <span class="registration-form__error"></span>
        </div>
        <div class="mb-xm">
            <label for="logo" class="file-label mb-xs">Dodaj logotip <i class="fas fa-upload hide-icon"></i></label>
            <i class="fas fa-times <?php echo $client['logo'] ? 'd-block' : 'd-none'; ?> remove-image pointer text-right mb-xs"></i>
            <input type="file" name="logo" id="logo" class="form__input-file">
            <img src="<?php base(); ?>images/<?php echo $client['logo'] ?? ''; ?>" alt="" class="firm-logo d-block m-auto">
            <span class="registration-form__error"></span>
        </div>
        <div class="mb-xm">
            <label for="jib">Jedinstveni identifikacioni broj</label>
            <input type="text" name="jib" id="jib"  class="form__input" value="<?php echo $client['jib']; ?>">
            <span class="registration-form__error"></span>
        </div>
        <div class="mb-xm">
            <p class="mb-xs">Da li je clienta u sistemu PDV-a?</p>
            <div class="d-flex">
                <div class="mb-xs w-100">
                    <input type="radio" <?php echo $client['pdv'] == '1' ? 'checked' : ''; ?> name="pdv" id="pdv-da" value="1">
                    <label for="pdv-da">Da</label>
                </div>
                <div class="w-100">
                    <input type="radio" <?php echo $client['pdv'] == '0' ? 'checked' : ''; ?> name="pdv" id="pdv-ne" value="0">
                    <label for="pdv-ne">Ne</label>
                </div>
            </div>
            <span class="registration-form__error"></span>
        </div>
        <?php if($client['pdv'] == '0') { ?>
        <div class="mb-xm d-none">
            <label for="pib">Poreski identifikacioni broj</label>
            <input type="text" name="pib" id="pib" disabled class="form__input pib"  value="<?php echo $client['pib']; ?>">
            <span class="registration-form__error"></span>
        </div>
        <?php } else { ?>
            <div class="mb-xm">
            <label for="pib">Poreski identifikacioni broj</label>
            <input type="text" name="pib" id="pib" class="form__input pib"  value="<?php echo $client['pib']; ?>">
            <span class="registration-form__error"></span>
        </div>
        <?php } ?>
        <div class="mb-xm">
            <label for="vlasnik">Ime vlasnika</label>
            <input type="text" name="vlasnik" id="vlasnik" class="form__input"  value="<?php echo $client['vlasnik']; ?>">
            <span class="registration-form__error"></span>
        </div>
        <div class="mb-xm">
            <label for="adresa">Adresa</label>
            <input type="text" name="adresa" id="adresa" class="form__input"  value="<?php echo $client['adresa']; ?>">
            <span class="registration-form__error"></span>
        </div>
        <div class="mb-xm">
            <label for="mjesto">Mjesto</label>
            <input type="text" name="mjesto" id="mjesto" class="form__input" value="<?php echo $client['mjesto']; ?>">                
            <span class="registration-form__error"></span>
        </div>
        <div class="mb-xm">
            <label for="broj">Broj telefona</label>
            <input type="text" name="telefon" id="broj" class="form__input"  value="<?php echo $client['telefon']; ?>">
            <span class="registration-form__error"></span>
        </div>
        <div class="mb-xm">
            <label for="email">Email adresa</label>
            <input type="text" name="email" id="email" class="form__input"  value="<?php echo $client['email']; ?>">
            <span class="registration-form__error"></span>
        </div>
        <div class="mb-xm">
            <label for="racun">Žiro račun klijenta</label>
            <input type="text" name="racun" id="racun" class="form__input"  value="<?php echo $client['racun']; ?>">
            <span class="registration-form__error"></span>
        </div>
        <div class="mb-xm">
            <label for="banka">Ime banke</label>
            <select name="banka" id="banka" class="form__input">
                <option value="<?php echo $client['banka']; ?>"><?php echo $client['banka']; ?></option>
                <?php foreach($bankArray as $bank) { ?>
                    <option value="<?php echo $bank ?>"><?php echo $bank ?></option>
                <?php } ?>
            </select>
            <span class="registration-form__error"></span>
        </div>
        <p class="success-message mb-xs text-center"></p>
        <button class="btn btn-primary" name="submit">Sačuvaj <i class="fas fa-save hide-icon"></i></button>
    </form>
</div>
</div>
</main>

