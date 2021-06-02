<?php 
    if(isset($_SESSION['id'])) {
        header('Location: index');
        exit();
    } 
?>
<div class="wrapper d-flex jc-c ai-c">
<div class="form-container">
<form action="" method="POST">
    <div class="card-body">
        <h2 class="card-body__heading">Prijava</h2>
        <div class="mb-s">
            <label for="email">Email</label>
            <input type="email" name="email" id="email"  class="form__input">
            <span class="registration-form__error"></span>
        </div>
        <div class="mb-s">
            <label for="password">Lozinka</label>
            <input type="password" name="password" id="password" class="form__input">
            <span class="registration-form__error"></span>
        </div>
        <button class="btn btn-primary" name="submit">Prijava</button>
    </form>
</div>
</div>
