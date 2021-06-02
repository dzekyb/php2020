<!DOCTYPE html>
<html>
    <head>
        <title>Proizvodi</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h1>Proizvodi</h1>
        <div class="svi-proizvodi">
            <?php
                $proizvodiTxt = file_get_contents("proizvodi.xml");
                $proizvodiXml = new SimpleXMLElement($proizvodiTxt);

                foreach($proizvodiXml as $proizvod){
                    echo "<div class='proizvod'>";
                        echo "<h2>" . $proizvod->naziv . "</h2>";

                        echo "<span class='proizvodac'>Proizvođač: " . $proizvod->proizvodac . "</span>";

                        echo "<span class='cijena'>Cijena: " . $proizvod->cijena . "</span>";

                        echo "<span class='kolicina'>Količina: " . $proizvod->kolicina . "</span>";

                        echo "<span class='popust'>Popust: " . $proizvod->popust . "</span>";

                        echo "<a href='https://" . $proizvod->link . "' target='_blank'>Pogledaj više</a>";
                    echo "</div>";
                }

            ?>
        </div>
        <h2>Odaberi svoj proizvod</h2>
        <form method="GET" action="#">
            <select name="proizvod" onchange="this.form.submit()">
                <option>Odaberi proizvod</option>
                <?php
                    foreach($proizvodiXml as $proizvod){
                        echo "<option value='";
                        echo $proizvod['id'];
                        echo "'>";
                        echo $proizvod->proizvodac . " ";
                        echo $proizvod->naziv;
                        echo "</option>";
                    }
                    // Prebaciti u for petlju ili dodati brojač
                    // Provjeriti GET['proizvod'] sa $proizvod['id']
                    // Gdje se poklapaju staviti atribut selected='selected'
                ?>
            </select>
            <!--<input type="submit" value="Odaberi proizvod">-->
            <!-- Sklonjen jer se forma submituje automatski -->
            <!-- Trebalo bi kreirati scroll nakon odabira proizvoda kako se stranica ne bi automatski vraćala na početak -->
        </form>
        <?php
            if(isset($_GET['proizvod']) && !empty($_GET['proizvod'])){
                $id = $_GET['proizvod'];

                for($i=0; $i < sizeof($proizvodiXml->proizvod); $i++){
                    if($proizvodiXml->proizvod[$i]['id'] == $id){
                        // Ispis samo jednog proizvoda ako se poklapa ID koji je proslijeđen i ID nad elementom
                        echo "<div class='jedan-proizvod'>";
                            echo "<h2>" . $proizvodiXml->proizvod[$i]->naziv . "</h2>";

                            echo "<span>Proizvođač: " . $proizvodiXml->proizvod[$i]->proizvodac . "</span>";

                            echo "<span>Cijena: " . $proizvodiXml->proizvod[$i]->proizvodac . "</span>";

                            echo "<span>Količina: " . $proizvodiXml->proizvod[$i]->kolicina . "</span>";

                            echo "<span>Popust: " . $proizvodiXml->proizvod[$i]->popust . "</span>";

                            echo "<a href='" . $proizvodiXml->proizvod[$i]->link . "'>Pogledaj više</a>";
                        echo "</div>";
                    }
                }
            }else{
                echo "<span class='warning'>Nije odabran nijedan proizvod!</span>";
            }
        ?>
    </body>
</html>