<?php
    include './includes/config.php';
    include './includes/marvelApi.php';

    $url = "https://gateway.marvel.com:443/v1/public/characters?ts=$ts&apikey=$publicKey&hash=$hash&limit=75";
    $jsonResult = apiCall($url);
    
    $characters = $jsonResult->data->results;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Marvel Comics API - Character</title>
</head>

<body>
    <h1 class='title'>Marvel Comics Character</h1>
    <div class="wrapper">
        <?php foreach($characters as $character): ?>
        <div class='card'>
            <h2><?= $character->name?> <?= $character->id?></h2>
            <div class="image">
                <a href="./hero.php?id=<?= $character->id?>">
                    <img class="heroImage" src="<?= $character->thumbnail->path?>.<?=$character->thumbnail->extension?>"
                        width="150">
                </a>
            </div>
        </div>
        <?php endforeach ?>
    </div>
    <script src="script.js"></script>
</body>

</html>