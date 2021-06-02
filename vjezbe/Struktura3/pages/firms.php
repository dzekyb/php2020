<!--  rendering user firms -->
<?php
if(!isset($_SESSION['id'])) {
    header('Location: login');
    exit();
}

require_once('include/autoloader.php');

$id = $_SESSION['id'];

$page = !empty($_GET['id']) ? (int)$_GET['id'] : 1;
Validate::validateString('id', $page);
if(Message::getError()) {
    header('Location: ../index');
    exit();
}


$limit = 10;
$numberOfRows = Firm::countRows('userId', $id);

if($limit > $numberOfRows) {
    $page = 1;
}

$paginate = new Paginate($page, $limit, $numberOfRows);

$firms = Firm::findAllWithOffset('userId', $id, $paginate->limit, $paginate->offset);


?>

<main>
    <h1 class="card__header text-center weight-500 w-100">Firme</h1>
<div class="hero">
<?php

    if(count($firms) > 0) { ?>
        <div class="d-flex gap-m wrap s-flex-column">
        <?php
         foreach($firms as $firm) { 
        ?> 
            <div class="w-25-gap-m l-w-50-gap-m s-w-100 card">
                <div class="card-body text-center">
                <?php if($firm['logo']) {?>
                    <img src="<?php base(); ?>images/<?php echo $firm['logo'] ?>" alt="business photo" class="d-block w-100 mb-s">
                <?php } ?>

                <h3 class="calculator__heading uppercase mb-s">
                    <?php echo $firm['ime']; ?>
                </h3>
                <div class="text-left">
                    <span class="d-block mb-xs">JIB: <?php echo $firm['jib'];?></span>
                    <span class="d-block mb-xs">PIB: <?php echo $firm['pib'] ?? ''; ?></span>
                    <span class="d-block mb-xs">Vlasnik: <?php echo $firm['vlasnik']; ?></span>
                    <span class="d-block mb-xs">Adresa: <?php echo $firm['adresa']; ?></span>
                    <span class="d-block mb-xs">Email: <?php echo $firm['email']; ?></span>
                    <span class="d-block mb-xs">Telefon: <?php echo $firm['telefon']; ?></span>
                </div>
                <a href="<?php base(); ?>update_firm/<?php echo $firm['id']; ?>" class="btn btn-primary text-center d-block w-100 mb-xs">Uredi <i class="fas fa-edit hide-icon"></i></a>
            </div>
            </div>
    <?php } ?>
        </div>
        <?php if($paginate->page_total() > 1) { ?>
        <div class="mb-m mt-m">
            <ul class="d-flex jc-c list-style-none"> 
            <?php if($page > 1) { ?>
                <li><a class="page-link" href="<?php base(); ?>firms/<?php echo $paginate->previous(); ?>">«</a></li>
            <?php } ?>
            <?php  for($i = 1; $i <= $paginate->page_total(); $i++) { ?>
                <li><a class="page-link <?php echo $i == $page ? 'active' : '' ?>" href="<?php base(); ?>firms/<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php } ?>
            <?php if($paginate->has_next()) { ?>
                <li><a class="page-link" href="<?php base(); ?>firms/<?php echo $paginate->next(); ?>">»</a></li>
            <?php } ?>
            </ul>
        </div>
        <?php } ?>
    <?php } else { ?>
        <p>Niste dodali nijednu firmu...</p>
    <?php } ?>
    <div class="mt-m">
        <a href="<?php base(); ?>add_firm" class="btn btn-primary btn-large text-center">Dodaj firmu <i class="fas fa-plus hide-icon"></i></a>
    </div>
</div>
</div>
</main>


