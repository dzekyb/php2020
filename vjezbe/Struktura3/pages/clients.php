<!--  rendering  clients -->
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
$numberOfRows = Client::countRows('userId', $id);

if($limit > $numberOfRows) {
    $page = 1;
}

$paginate = new Paginate($page, $limit, $numberOfRows);

$clients = Client::findAllWithOffset('userId', $id, $paginate->limit, $paginate->offset);


?>

<main>
    <h1 class="card__header text-center weight-500 w-100">Klijenti</h1>
<div class="hero">
<?php 

    if(count($clients) > 0) { ?>
        <div class="d-flex gap-m wrap s-flex-column">
        <?php
         foreach($clients as $client) { 
        ?> 
            <div class="w-25-gap-m l-w-50-gap-m s-w-100 card">
                <div class="card-body text-center">
                <?php if($client['logo']) { ?>
                    <img src="<?php base(); ?>images/<?php echo $client['logo']; ?>"  class="d-block w-100 mb-s">
                <?php } ?>

                <h3 class="calculator__heading uppercase mb-s">
                    <?php echo $client['ime']; ?>
                </h3>
                <div class="text-left">
                    <span class="d-block mb-xs">JIB: <?php echo $client['jib']; ?></span>
                    <span class="d-block mb-xs">PIB: <?php echo $client['pib'] ?? ''; ?></span>
                    <span class="d-block mb-xs">Vlasnik: <?php echo $client['vlasnik']; ?></span>
                    <span class="d-block mb-xs">Adresa: <?php echo $client['adresa']; ?></span>
                    <span class="d-block mb-xs">Email: <?php echo $client['email']; ?></span>
                    <span class="d-block mb-xs">Telefon: <?php echo $client['telefon']; ?></span>
                </div>
                <a href="<?php base(); ?>update_client/<?php echo $client['id']; ?>" class="btn text-center btn-primary w-100">Uredi <i class="fas fa-edit hide-icon"></i></a>
            </div>
            </div>
    <?php } ?>
        </div>
        <?php if($paginate->page_total() > 1) { ?>
        <div class="mb-m mt-m">
            <ul class="d-flex jc-c list-style-none"> 
            <?php if($page > 1) { ?>
                <li><a class="page-link" href="<?php base(); ?>clients/<?php echo $paginate->previous(); ?>">«</a></li>
            <?php } ?>
            <?php  for($i = 1; $i <= $paginate->page_total(); $i++) { ?>
                <li><a class="page-link <?php echo $i == $page ? 'active' : '' ?>" href="<?php base(); ?>clients/<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php } ?>
            <?php if($paginate->has_next()) { ?>
                <li><a class="page-link" href="<?php base(); ?>clients/<?php echo $paginate->next(); ?>">»</a></li>
            <?php } ?>
            </ul>
        </div>
        <?php } ?>
    <?php } else { ?>
        <p>Niste dodali nijednu klijenta...</p>
    <?php } ?>
    <div class="mt-m">
        <a href="<?php base(); ?>add_client" class="btn btn-primary text-center btn-large">Dodaj klijenta <i class="fas fa-plus hide-icon"></i></a>
    </div>
</div>
</div>
</main>


