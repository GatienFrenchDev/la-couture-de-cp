<?php

function getCreation(int $id_creation): Creation | null
{
    $mysqli = new mysqli("localhost","root","","la_couture_de_cp");

    $stmt = $mysqli->prepare("SELECT c.*, ca.nom as nom_categorie, i.chemin
    FROM creation c
    JOIN categorie ca ON c.id_categorie=ca.id_categorie
    JOIN image i ON i.id_image=c.id_image
    WHERE id_creation = ?");
    $stmt->bind_param("i", $id_creation);
    $stmt->execute();
    $res = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    if(count($res) == 0){
        return null;
    }

    $res = $res[0];

    $creation = new Creation(
        $res["id_creation"], 
        $res["nom"], 
        $res["description"], 
        $res["taille"], 
        $res["tps_creation"], 
        $res["surface_tissu"], 
        new Categorie($res["id_categorie"], $res["nom_categorie"]), 
        new SplFileInfo($res["chemin"]), 
        getTags($res["id_creation"]));

    $stmt->close();
    $mysqli->close();

    return $creation;
}

function getTags(int $id_creation): array
{
    $mysqli = new mysqli("localhost","root","","la_couture_de_cp");
    
    $stmt = $mysqli->prepare("SELECT tag.*
    FROM creation c
    JOIN tagger t ON c.id_creation=t.id_creation
    JOIN tag ON t.id_tag=tag.id_tag
    WHERE c.id_creation = ?");
    $stmt->bind_param("i", $id_creation);
    $stmt->execute();
    $res = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        
    $liste_fin=[];
    
    foreach($res as $ligne)
    {
        $liste_fin[]= new Tag($ligne["id_tag"], $ligne["nom"]);
    }
    
    $stmt->close();
    $mysqli->close();
    
    return $liste_fin;
}

function getTissus(int $id_creation): array
{
    $mysqli = new mysqli("localhost","root","","la_couture_de_cp");

    $stmt = $mysqli->prepare("SELECT t.*
    FROM creation c
    JOIN realiser_en r ON c.id_creation=r.id_creation
    JOIN tissu t ON t.id_tissu=r.id_tissu
    WHERE c.id_creation = ?");
    $stmt->bind_param("i", $id_creation);
    $stmt->execute();
    $res = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    
    $liste_fin=[];

    foreach($res as $ligne)
    {
        $liste_fin[]= new Tissu($ligne["id_tissu"], $ligne["nom"]);
    }

    $stmt->close();
    $mysqli->close();

    return $liste_fin;
}

function getPrix(Creation $creation): int
{
    $mysqli = new mysqli("localhost","root","","la_couture_de_cp");

    $stmt = $mysqli->prepare("SELECT prix
    FROM offre
    WHERE id_creation = ?");
    $id=$creation->getIdCreation();
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    
    if (count($res)==0) return 0;
    else return $res[0]["prix"];
}

function getCreations(): array
{
    $mysqli = new mysqli("localhost","root","","la_couture_de_cp");

    $stmt = $mysqli->prepare("SELECT c.*, ca.nom as nom_categorie, i.chemin
    FROM creation c
    JOIN categorie ca ON c.id_categorie=ca.id_categorie
    JOIN image i ON i.id_image=c.id_image
    ORDER BY RAND()");
    $stmt->execute();
    $res = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    $creations=[];

    foreach($res as $ligne)
    {
        $creations[]=new Creation(
            $ligne["id_creation"], 
            $ligne["nom"], 
            $ligne["description"], 
            $ligne["taille"], 
            $ligne["tps_creation"], 
            $ligne["surface_tissu"],
            new Categorie($ligne["id_categorie"], $ligne["nom_categorie"]), 
            new SplFileInfo($ligne["chemin"]), 
            getTags($ligne["id_creation"]));
    }
    $stmt->close();
    $mysqli->close();

    return $creations;
}

function getAllTags(): array
{
    $mysqli = new mysqli("localhost","root","","la_couture_de_cp");
    
    $stmt = $mysqli->prepare("SELECT *
    FROM tag");
    $stmt->execute();
    $res = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    $liste_fin=[];

    foreach($res as $ligne)
    {
        $liste_fin[]= new Tag($ligne["id_tag"], $ligne["nom"]);
    }

    return $liste_fin;
}

function getCategories():array
{
    $mysqli = new mysqli("localhost","root","","la_couture_de_cp");
    
    $stmt = $mysqli->prepare("SELECT *
    FROM categorie");
    $stmt->execute();
    $res = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    $liste_fin=[];

    foreach($res as $ligne)
    {
        $liste_fin[]= new Categorie($ligne["id_categorie"], $ligne["nom"]);
    }

    return $liste_fin;
}

function getCategorieFromId(int $id_categorie): Categorie | null
{
    $mysqli = new mysqli("localhost","root","","la_couture_de_cp");
    
    $stmt = $mysqli->prepare("SELECT *
    FROM categorie
    WHERE id_categorie=?");
    $stmt->bind_param("i", $id_categorie);
    $stmt->execute();
    $res = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    if(count($res) == 0){
        return null;
    }

    $res = $res[0];

    return new Categorie($res["id_categorie"], $res["nom"]);
}

function getTagFromId(int $id_tag): Tag | null
{
    $mysqli = new mysqli("localhost","root","","la_couture_de_cp");
    
    $stmt = $mysqli->prepare("SELECT *
    FROM tag
    WHERE id_tag=?");
    $stmt->bind_param("i", $id_tag);
    $stmt->execute();
    $res = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    if(count($res) == 0){
        return null;
    }

    $res = $res[0];

    return new Tag($res["id_tag"], $res["nom"]);
}

function getFiltres():array
{
    $filtres=["categories"=>[],"tags"=>[]];
    foreach($_GET as $key=>$value)
    {
        if(str_starts_with($key, "categorie-"))
        {
            $filtres["categories"][]=getCategorieFromId(intval(substr($key,10)));
        }
        else if(str_starts_with($key, "tag-")) 
        {
            $filtres["tags"][]=getTagFromId(intval(substr($key,4)));
        }
    }
    return $filtres;
}

function getArticles():array
{
    $mysqli = new mysqli("localhost","root","","la_couture_de_cp");

    $stmt = $mysqli->prepare("SELECT a.*, i.chemin as chemin_img
    FROM article a
    JOIN image i ON i.id_image=a.id_image");
    $stmt->execute();
    $res = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    $articles=[];

    foreach($res as $ligne)
    {
        $articles[]=new Article(
            $ligne["id_article"], 
            $ligne["titre"], 
            $ligne["date_pub"],  
            new SplFileInfo($ligne["chemin_img"]),
            new SplFileInfo($ligne["chemin_page"]));
    }
    $stmt->close();
    $mysqli->close();

    return $articles;
}

?>