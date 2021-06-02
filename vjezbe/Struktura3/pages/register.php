<?php 
    if(isset($_SESSION['id'])) {
        header('Location: index');
        exit();
    } 
?>

<div class="wrapper d-flex jc-c ai-c">
    <div class="form-container">
        <form action=""  method="POST">
            <div class="card-body">
                <h2 class="card-body__heading">Napravi nalog</h2>
                <div class="mb-s">
                    <label for="username">Ime i prezime</label>
                    <input type="text" name="username" class="form__input">
                    <span class="registration-form__error username"></span>
                </div>
                <div class="mb-s">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" class="form__input">
                    <span class="registration-form__error email"></span>
                    
                </div>
                <div class="mb-s">
                    <label for="password">Lozinka</label>
                    <input type="password" name="password" id="password" class="form__input">
                    <span class="registration-form__error password"></span>
                </div>
                <div class="mb-s">
                    <label for="confirmPassword">Potvrdi lozinku</label>
                    <input type="password" name="confirmPassword" id="confirmPassword" class="form__input">
                    <span class="registration-form__error password"></span>
                </div>
                <button class="btn btn-primary" name="submit">Potvrdi</button>
            </div>
        </form>
    </div>
</div>
