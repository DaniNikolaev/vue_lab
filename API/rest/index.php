<?php
require_once "./vendor/autoload.php";
require_once "../classes/plots.php";
require_once "../classes/funerals.php";
$app = new Silex\Application();


$app->get('/plots/list', function () use ($app){
    $plot = new Plots();
    $list = $plot->read();
    return $app->json($list);
});

$app->post('/plots/add-item', function () use ($app){
    if (strlen($_POST['plot']) && strlen($_POST['price'])) {
        $plotNumber = $_POST['plot'];
        $price = $_POST['price'];
        $plot = new Plots;
        try {
            $plot->create(array("plot" => $plotNumber, "price" => $price));
            $lastid = $plot->lastID();
            return $app->json(array("create-plot" => "yes", "create-id" => $lastid));
        } catch (PDOException $e) {
            return $app->json(array("error" => $e->getMessage(), "create-plot" => "no"));
        }
    } else {
        return $app->json(array("create-plot" => "no"));
    }
});
$app->post('/plots/update-item', function ()use ($app) {
    $plot = new Plots;
    $idPlot = intval($_POST["idPlot"]);
    $plotNumber = $_POST["plot"];
    $price = $_POST["price"];
    if ($plot->exists($idPlot) && strlen($plotNumber)) {
        try {
            $plot->update(array("price" => $price, "id" => $idPlot, "plot" => $plotNumber));
            return $app->json(array("update-plot" => "yes", "id_update" => $idPlot));
        } catch (PDOException $e) {
            return $app->json(array("error" => $e->getMessage(), "update-plot" => "no"));
        }
    } else {
        return $app->json(array("update-plot" => "no"));
    }
});

$app->post('/plots/delete-item', function ()use ($app) {
    $plot = new Plots;
    $id = intval($_POST["id"]);
    if ($plot->exists($id)) {
        try {
            $plot->delete($id);
            return $app->json(array("delete-plot" => "yes", "id_delete" => $id));
        } catch (PDOException $e) {
            return $app->json(array("error" => $e->getMessage(), "delete-plot" => "no"));
        }
    } else {
        return $app->json(array("delete-plot" => "no"));
    }
});



$app->get('/funerals/list', function () use ($app){
    $funeral = new Funerals;
    $list = $funeral->read();
    return $app->json($list);
});
$app->post('/funerals/add-item', function () use ($app) {
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $age= $_POST["age"];
    $idPlot= intval($_POST["idPlot"]);
    $plot = new Plots;
    if (strlen($name) && $plot->exists($idPlot)) {
        $funeral = new Funerals;
        try {
            $funeral->create(array('name' => $name, "idPlot" => $idPlot, "surname" => $surname, "age" => $age));
            $lastid = $funeral->lastID();
            return $app->json(array("create-funeral" => "yes", "create-id" => $lastid));
        } catch (PDOException $e) {
            return $app->json(array("error" => $e->getMessage(), "create-funeral" => "no"));
        }
    } else {
        return $app->json(array("create-funeral" => "no"));
    }
});
$app->post('/funerals/update-item', function () use ($app){
    $id = intval($_POST["id"]);
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $age = $_POST["age"];
    $idPlot = intval($_POST["idPlot"]);
    $funeral = new Funerals;
    if ($funeral->exists($id) && strlen($name)) {
        try {
            $funeral->update(array("id" => $id, "name" => $name, "surname" => $surname, "age" => $age, "idPlot" => $idPlot));
            return $app->json(array("update-funeral" => "yes", "id_update" => $id));
        } catch (PDOException $e) {
            return $app->json(array("error" => $e->getMessage(), "update-funeral" => "no"));
        }
    } else {
        return $app->json(array("update-funeral" => "no"));
    }
});

$app->post('/funerals/delete-item', function () use ($app) {
    $id = intval($_POST["id"]);
    $funeral = new Funerals;
    if ($funeral->exists($id)) {
        try {
            $funeral->delete($id);
            return $app->json(array("delete-funeral" => "yes", "id_delete" => $id));
        } catch (PDOException $e) {
            return $app->json(array("error" => $e->getMessage(), "delete-funeral" => "no"));
        }
    } else {
        return $app->json(array("delete-funeral" => "no"));
    }
});

$app->post('/funerals/list-filtered', function () use ($app){
    $funeral = new Funerals;
    $needPlots = true;
    $message = json_decode(file_get_contents('php://input'),true);
    $list = $funeral->read($needPlots,$message["id"]);
    return $app->json($list);
});

$app->run();