#!/usr/bin/php
<?php
$response = Unirest\Request::get("https://gold-standard-sports.p.mashape.com/leagues/all/",
  array(
    "X-Mashape-Key" => "IYe9JbQgTPmshkpNNE1wG2XOc1Npp1Bh91hjsnarTuFT77ACVM",
    "X-Mashape-Host" => "gold-standard-sports.p.mashape.com"
  )
);
?>
