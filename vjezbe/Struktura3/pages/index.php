<!-- index landing page -->
<?php if(isset($_SESSION['id'])) { ?>
<main>
<?php } else { ?>
<main class="m-auto">
<?php } ?>
<?php if(isset($_SESSION['id'])) { ?>
    <div class="wrapper ai-c d-flex jc-sb gap-m">
<?php } else { ?>
    <div class="wrapper ai-c d-flex jc-sb gap-m index-wrapper">
<?php } ?>
        <div class="m-text-center">
            <h1 class="mb-xs weight-600">Izdavanje faktura brzo i sigurno</h1>
            <p class="mb-m">
                Da li izdajete račune prema modelu u Excelu?
                Naša faktura je mnogo više od običnog računa. Izdavanje je jednostavno, brzo, a izdana faktura
                je u Adobe PDF formatu - popularnom
                univerzalnom formatu dokumenta.
            </p>
            <button class="btn btn-primary">Registrujte se</button>
        </div>
        <div class="mm-d-none">
            <img src="images/hero.svg" alt="" class="w-100">
        </div>
    </div>
</main>
