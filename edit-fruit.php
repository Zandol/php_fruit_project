<?php


$filename = __DIR__ . "/data/data.json";

$id = $_GET['id'] ?? '';

if ($id) {
    $data = file_get_contents($filename);
    $fruits = json_decode($data, true);
    $arrayColId = array_column($fruits, 'id');
    $fruitId = array_search($id, $arrayColId);   
}

if($_SERVER['REQUEST_METHOD'] === 'POST' ){

    $fruit = $_POST['fruit'];
    $fruits[$fruitId]['fruit'] = $fruit;
    file_put_contents($filename, json_encode($fruits));
    header('Location: /phpbase');
    
}

?>


<form action="" method="post">
        
      <input type="text" name="fruit" id="fruit" value="<?=$fruits[$fruitId]['fruit'] ?>">
      <button>confirmer</button>     

</form>


