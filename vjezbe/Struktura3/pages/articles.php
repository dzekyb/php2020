<?php 
if(!isset($_SESSION['id'])) {
    header('Location: index');
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
$numberOfRows = Article::countRows('userId', $id);

if($limit > $numberOfRows) {
    $page = 1;
}

$paginate = new Paginate($page, $limit, $numberOfRows);

$articles = Article::findAllWithOffset('userId', $id, $paginate->limit, $paginate->offset);
?>

<main>
    <h1 class="card__header text-center weight-500 w-100">Artikli</h1>
<div class="hero">  
        <?php if(!empty($articles)) { ?>
            <div class="card mb-s m-card-unset">
                <div class="d-flex articlesHeader mm-d-none">
                    <span class="w-10 p-xs border weight-600 m-d-none">Šifra</span>
                    <span class="w-25 p-xs border weight-600 m-d-none">Naziv</span>
                    <span class="w-10 p-xs border weight-600 m-d-none">Cijena</span>
                    <span class="w-55 p-xs border weight-600 m-d-none">Opis</span>
                </div>
        <?php foreach($articles as $article) { ?>
                <form action="" method="POST" class="update-article m-card m-mb-m">
                <div class="d-flex m-flex-column">
                    <div class="w-10 border m-d-flex m-w-100 m-mb-xs m-border-none">
                        <span class="w-30 p-xs  d-none m-d-block">Id</span>
                        <input type="text" name="<?php echo $article['id']; ?>-idArtikla-<?php echo $id; ?>" disabled class="w-100 p-xs m-border-input form__input border-none h-100" value="<?php echo $article['idArtikla']; ?>" >
                        <span class="registration-form__error"></span>
                    </div>
                    <div class="w-25 border m-d-flex m-w-100 m-mb-xs m-border-none">
                        <span class="w-30 d-none p-xs  d-none m-d-block">Naziv</span>
                        <input type="text" name="ime" disabled class="w-100 p-xs m-border-input form__input border-none h-100" value="<?php echo $article['ime']; ?>" >
                        <span class="registration-form__error"></span>
                    </div>
                    <div class="w-10 border m-d-flex m-w-100 m-mb-xs m-border-none">
                        <span class="w-30 p-xs d-none m-d-block">Cijena</span>
                        <input type="number" name="cijena" step="0.01" disabled class="w-100 p-xs m-border-input form__input border-none h-100" value="<?php echo $article['cijena']; ?>" >
                        <span class="registration-form__error"></span>
                    </div>
                    <div class="w-45 border m-d-flex m-w-100 m-mb-xs m-border-none">
                        <span class="w-30 p-xs d-none m-d-block">Opis</span>
                        <textarea type="text" name="opis" disabled class="w-100 p-xs m-border-input form__input border-none h-100" value="<?php echo $article['opis']; ?> "><?php echo $article['opis']; ?></textarea>
                        <span class="registration-form__error"></span>
                    </div>
                    <div class="w-10 d-flex jc-c ai-c text-center border m-w-100 m-p-xs">
                        <span class="w-100 edit icon-hover editing">
                            <i class="fas fa-edit d-iblock w-100"></i>
                        </span>
                        <button class="w-100 saving icon-hover d-none btn-transparent" name="submit">
                            <i class="fas fa-check d-iblock w-100 pointer"></i>
                        </button>
                        <span class="w-100 saving cancel icon-hover d-none">
                            <i class="fas fa-times d-iblock w-100 pointer"></i>
                        </span>
                    </div>
                </div>
                </form>
        <?php } ?>
    </div>
    <?php if($paginate->page_total() > 1) { ?>
        <div class="mb-m mt-m">
            <ul class="d-flex jc-c list-style-none"> 
            <?php if($page > 1) { ?>
                <li><a class="page-link" href="<?php base(); ?>articles/<?php echo $paginate->previous(); ?>">«</a></li>
            <?php } ?>
            <?php  for($i = 1; $i <= $paginate->page_total(); $i++) { ?>
                <li><a class="page-link <?php echo $i == $page ? 'active' : '' ?>" href="<?php base(); ?>articles/<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php } ?>
            <?php if($paginate->has_next()) { ?>
                <li><a class="page-link" href="<?php base(); ?>articles/<?php echo $paginate->next(); ?>">»</a></li>
            <?php } ?>
            </ul>
        </div>
    <?php } ?>
        <?php } else { ?>
            <div class="mb-m">
                <p>Niste dodali nijedan artikal...</p>
            </div>
        <?php } ?>
        <a href="<?php base(); ?>add_article" class="btn btn-primary btn-large text-center mt-s">Dodaj artikal <i class="fas fa-plus hide-icon"></i></a>
    </div>
</main>
