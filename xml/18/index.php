<?php

function show_form(){

$forma = <<<FORM
    <form action="obrada.php" method="POST">
        <table>
            <tr>
                <td colspan="2">Login forma</td>
            </tr>
            <tr>
                <td><label for="username">Username:</label></td>
                <td><input type="text" name="username"></td>
            </tr>
            <tr>
                <td><label for="password">Password</label></td>
                <td><input type="password" name="password"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Submit"></td>
            </tr>
        </table>
    </form>
FORM;
echo $forma;
}

show_form();
// Ovdje se ispiše forma