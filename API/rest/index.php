<?php

use Symfony\Component\HttpFoundation\Request;

require_once 'B:/XAMPP/htdocs/vue_lab/vendor/autoload.php';
require_once "../classes/funerals.php";
require_once "../classes/plots.php";
$app = new Silex\Application();


$app->get('/funerals/list.json', function () use ($app) {
    $funerals = new Funerals();
    $needPlots = true;
    $list = $funerals->read($needPlots);
    return $app->json(array_values($list));
});

$app->post('/funerals/list-filtered', function (Request $request) use ($app){
    $funerals = new Funerals();
    $needPlots = true;
    $data = json_decode($request->getContent(), true);
    $list = $funerals->read($needPlots,$data["id"]);
    return $app->json(array_values($list));
});
$app->post('/funerals/upload-image', function () use ($app){
    $funerals = new Funerals();
    try {
        $response=$funerals->uploadImage();
    }catch (Exception $ex){
        return $app->json(["Exception" => $ex]);
    }
    return $app->json($response);
});
$app->post('/funerals/add-item', function (Request $request) use ($app) {
    $data = json_decode($request->getContent(), true);
    $name = $data["name"] ?? null;
    $surname = $data["surname"] ?? null;
    $age = $data["age"] ?? null;
    $img_path=$data["img_path"]??null;
    $plotId = intval($data["plot"]) ?? null;
    $plots = new Plots();
    if ($name &&$img_path&& $surname && $age && $plotId && $plots->exists($plotId)) {
        $funerals = new Funerals();
        try {
            $funerals->create(['name' => $name, "plot" => $plotId, "surname" => $surname, "age" => $age,"img_path"=>$img_path]);
            $lastId = $funerals->lastID();
            return $app->json(["create-funerals" => "yes", "create-id" => $lastId]);
        } catch (PDOException $e) {
            return $app->json(["error" => $e->getMessage(), "create-funeral" => "no"]);
        }
    } else {
        return $app->json(["create-funeral" => "no"]);
    }
});

$app->post('/funerals/update-item', function (Request $request) use ($app) {
    $data = json_decode($request->getContent(), true);
    $id = intval($data["id"]);
    $funerals = new Funerals();
    $funerals->deleteImage($id);
    $name = $data["name"] ?? null;
    $surname = $data["surname"] ?? null;
    $age = $data["age"] ?? null;
    $img_path=$data["img_path"]??null;
    $plotId = intval($data["plot"] ?? null);
    if ($funerals->exists($id) && $name && $surname && $age && $plotId) {
        try {
            $funerals->update(["id" => $id, "name" => $name, "surname" => $surname, "age" => $age,"img_path"=>$img_path, "plot" => $plotId]);
            return $app->json(["update-funeral" => "yes", "id_update" => $id]);
        } catch (PDOException $e) {
            return $app->json(["error" => $e->getMessage(), "update-funeral" => "no"]);
        }
    } else {
        return $app->json(["update-funeral" => "no"]);
    }
});

$app->post('/funerals/delete-item', function (Request $request) use ($app) {
    $data = json_decode($request->getContent(), true);

    $id = intval($data["id"]);
    $funerals = new Funerals();
    if ($funerals->exists($id)) {
        try {
            $funerals->deleteImage($id);
            $funerals->delete($id);
            return $app->json(["delete-funeral" => "yes", "id_delete" => $id]);
        } catch (PDOException $e) {
            return $app->json(["error" => $e->getMessage(), "delete-funeral" => "no"]);
        }
    } else {
        return $app->json(["delete-funeral" => "no"]);
    }
});

$app->get('/plots/list.json', function () use ($app) {
    $plots = new Plots();
    $list = $plots->read();
    return $app->json(array_values($list));
});

$app->post('/plots/add-item', function (Request $request) use ($app) {
    $data = json_decode($request->getContent(), true);
    $plot = $data['plot'] ?? null;
    $price = $data['price'] ?? null;

    if ($plot && $price) {
        $plots = new Plots();
        try {
            $plots->create(["plot" => $plot, "price" => $price]);
            $lastId = $plots->lastID();
            return $app->json(["create-plot" => "yes", "create-id" => $lastId]);
        } catch (PDOException $e) {
            return $app->json(["error" => $e->getMessage(), "create-plot" => "no"]);
        }
    } else {
        return $app->json(["create-plot" => "no"]);
    }
});
$app->post('/plots/update-item', function (Request $request) use ($app) {
    $data = json_decode($request->getContent(), true);

    $plots = new Plots();
    $plotId = intval($data["id"]  ?? null);
    $plot = $data['plot']  ?? null;
    $price = $data['price']  ?? null;

    if ($plots->exists($plotId) && $plot && $price) {
        try {
            $plots->update(["id" => $plotId, "plot" => $plot, "price" => $price]);
            return $app->json(["update-plot" => "yes", "id_update" => $plotId]);
        } catch (PDOException $e) {
            return $app->json(["error" => $e->getMessage(), "update-plot" => "no"]);
        }
    } else {
        return $app->json(["update-plot" => "no"]);
    }
});
$app->post('/plots/delete-item', function (Request $request) use ($app) {
    $data = json_decode($request->getContent(), true);
    $plots = new Plots();
    $id = intval($data["id"] ?? null);
    if ($plots->exists($id)) {
        try {
            $plots->delete($id);
            return $app->json(["delete-plot" => "yes", "id_delete" => $id]);
        } catch (PDOException $e) {
            return $app->json(["error" => $e->getMessage(), "delete-plot" => "no"]);
        }
    } else {
        return $app->json(["delete-plot" => "no"]);
    }
});


$app->run();