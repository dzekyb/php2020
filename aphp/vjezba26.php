<?php
    # Iz baze se dobavlja status (1 - nema promjena, 0 - ima promjene)
    $status = 1;

    if($status === 1){
        $content = file_get_contents('cache3.php');
        $contents=gzencode($content,1);
        header('Content-Encoding: gzip');
        echo $contents;
    }else{
        ob_start();
        
        echo "Hello World";
        echo "<br>";
        echo "Test";
        echo "<br>";
        echo "Nešto novo";
        echo "<br>";
        echo "Test1";

        $content=ob_get_contents();
        ob_end_clean();
        $contents=gzencode($content,1);
        header('Content-Encoding: gzip');
        file_put_contents('cache3.php', $content);
        echo $contents;
        # Ode se u bazu i stavi status 1
    }

?>