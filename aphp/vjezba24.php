<?php
    # Iz baze se dobavlja status (1 - nema promjena, 0 - ima promjene)
    $status = 1;

    if($status === 1){
        echo file_get_contents('cache.php');
    }else{
        ob_start();
        
        echo "Hello World";
        echo "<br>";
        echo "Test";
        echo "<br>";
        echo "Nešto novo";
        echo "<br>";
        echo "Test2";

        $content = ob_get_flush();
        file_put_contents('cache.php', $content);
        # Ode se u bazu i stavi status 1
    }

?>