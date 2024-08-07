<?php

require "classes.php";
require "fonctions.php";

if (!isset($_GET["id_page"])) {
    header("Location: a_vendre.php?id_page=1");
    exit;
}

$id_page = $_GET["id_page"];

$creations = getCreations();
$alltags = getAllTags();
$alltissus = getAllTissus();
$categories = getCategories();
$filtres = getFiltres();
$vendre = true;
$page = 'a_vendre.php';

if (count($_GET) > 0) {
    foreach ($creations as $key => $creation) {
        if (getPrix($creation) == []) {
            unset($creations[$key]);
        } else {
            if (count($filtres["categories"]) != 0 and !in_array($creation->getCategorie(), $filtres["categories"])) {
                unset($creations[$key]);
            }
            if (count($filtres["tags"]) != 0) {
                $tag_in = false;
                foreach ($creation->getTags() as $tag) {
                    if (in_array($tag, $filtres["tags"])) {
                        $tag_in = true;
                    }
                }
                if (!$tag_in) {
                    unset($creations[$key]);
                }
            }
            if (count($filtres["tissus"]) != 0) {
                $tissu_in = false;
                foreach ($creation->getTissus() as $tissu) {
                    if (in_array($tissu, $filtres["tissus"])) {
                        $tissu_in = true;
                    }
                }
                if (!$tissu_in) {
                    unset($creations[$key]);
                }
            }
        }
    }
}
if (count($creations) % 18 == 0) {
    $nbr_page_total = count($creations) / 18;
} else {
    $nbr_page_total = intval(count($creations) / 18) + 1;
}
if ($nbr_page_total < $id_page - 1) {
    header("Location: a_vendre.php?id_page=1");
    exit;
}

$creations = array_slice($creations, 18 * ($id_page - 1), 18);
?>

<!DOCTYPE html>
<html lang="fr" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passer une commande | La Couture de CP</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <style>
        body {
            background: url(./img/blob.jpg);
            background-size: cover;
        }
    </style>
</head>

<body class="min-h-full relative">

    <?php
    require './components/navbar.php';
    require './components/filters.php';
    if ($nbr_page_total == 0) {
        require './components/error.php';
    } else {
        require './components/cards.php';
        require './components/pagination.php';
    }
    require './components/footer.php';
    ?>

</body>

</html>