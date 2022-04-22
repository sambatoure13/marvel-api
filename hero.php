<?php
    include './includes/config.php';
    include './includes/marvelApi.php';

    
    $url = "https://gateway.marvel.com:443/v1/public/characters/".$_GET['id']."?ts=" .$ts. "&apikey=" . $publicKey ."&hash=".$hash;
    $jsonResult = apiCall($url);

    $heroes = $jsonResult->data->results;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Marvel Hero</title>
</head>

<body>
    <?php foreach($heroes as $hero): ?>
    <div>
        <h2><?= $hero->name?><?= $hero->id?></h2>
        <img src="<?= $hero->thumbnail->path?>.<?=$hero->thumbnail->extension?>" width="200">
        <p><?= $hero->description?>
        <p class='comics'>he belongs in the following comics:</p>
        <?php foreach($hero->comics->items as $comic): ?>
        <div><?= $comic->name?></div>
        <?php endforeach ?>
        <?php foreach($hero->events->items as $eventsName): ?>
        <div><?= $eventsName->name?></div>
        <?php endforeach ?>
        <p class='series'>it is in the following series : </p>
        <?php foreach($hero->series->items as $seriesName): ?>
        <h4><?= $seriesName->name?></h4>
        <?php endforeach ?>
    </div>
    <?php endforeach ?>
</body>

</html>