#!/usr/bin/php
<?php
$file = "3_0.tar.gz";
$dir = "html";
$extract = "sudo tar -xvf $file -C $dir/ ";
exec($extract);
?>
