<?php

#var_dump($_SERVER);

echo "<br><hr>";
echo $_SERVER['HTTP_HOST'];
echo "<br>";
echo $_SERVER['REQUEST_URI'];
echo "<br>";
echo basename(__FILE__);
echo "<br>";
echo basename(__DIR__);
echo "<br>";
echo dirname(__FILE__);
echo "<br>";
echo dirname(__DIR__);
echo "<br>";
echo str_replace('/', '', $_SERVER['REQUEST_URI']);
