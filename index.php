
<?php


$filename = __DIR__ . "/data/data.json";
$title = "PHP les bases dans une variable";
$error = "";
$fruits = [];

$file_exists = "";
if (file_exists($filename)) {
    $data = file_get_contents($filename);
    $fruits = json_decode($data, true);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    $fruit = $_POST['fruit'];
    if (!$fruit){
        $error = 'champ à renseigner';
    }

    if (!$error){
        $fruits = [...$fruits, [
            'fruit' => $fruit,
            'id' => time()
        ]];
        
        file_put_contents($filename, json_encode($fruits));
        $fruit = '';
        header('Location: '. $_SERVER['PHP_SELF']);
    }
}



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $title; ?>
    </title>
</head>
<body>
    <?php
    include_once './includes/header.php';
    
    ?>
   

    <div class="content">
        <h2>listes de produits</h2>

        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
        <label for="name">Nom du produit</label>
        <input type="text" name="fruit" id="fruit" placeholder="nouveau fruit">
        <button type="submit">Valider</button>
        <?php if ($error) : ?>
            <span><?= $error ?> </span>
            <?php endif; ?>
        </form>


        <ul>
           <?php foreach ($fruits as $fruit) : ?>
             <li><?= $fruit['fruit']  ?></li>
             <a href="edit-fruit.php?id=<?= $fruit['id'] ?>">modifier</a>
             <a href="delete-fruit.php?id=<?= $fruit['id'] ?>">Supprimer</a>

            <?php endforeach; ?>
        </ul>
    </div>

    <?php
    include_once './includes/footer.php';
    ?>


    
</body>
</html>