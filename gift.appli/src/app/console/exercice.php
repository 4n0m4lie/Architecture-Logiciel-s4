<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../../vendor/autoload.php';

use gift\appli\models\Prestation;
use gift\appli\models\Categorie;
use gift\appli\models\Box;
use gift\appli\models\User;

use Illuminate\Database\Capsule\Manager as DB;

$db = new DB();
$db->addConnection([
    'driver' => 'mysql',
    'host' => 'localhost:3306',
    'database' => 'giftbox',
    'username' => 'mathias',
    'password' => 'ringot',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => ''
]);

$db->setAsGlobal();
$db->bootEloquent();

//Q-1
echo "<br><br> ";
echo "----------------- Q-1 -----------------";
echo "<br><br>";

$prestations = Prestation::all();
foreach($prestations as $prestation){
    $aff = $prestation->libelle . "<br>";
    $aff.= $prestation->description . "<br>";
    $aff.= $prestation->tarif . "<br>";
    $aff.= $prestation->unite . "<br>";
    echo $aff;
}

//Q-2
echo "<br><br> ";
echo "----------------- Q-2 -----------------";
echo "<br><br>";

$prestations = Prestation::with('categorie')->get();
foreach($prestations as $prestation){
    $aff = $prestation->libelle . "<br>";
    $aff.= $prestation->description . "<br>";
    $aff.= $prestation->tarif . "<br>";
    $aff.= $prestation->unite . "<br>";
    $aff.= $prestation->categorie->libelle . "<br>";
    echo $aff;
}

//Q-3
echo "<br><br> ";
echo "----------------- Q-3 -----------------";
echo "<br><br>";

$categorie = Categorie::find(3);
$aff = $categorie->libelle . "<br>";
foreach($categorie->prestation as $prestation){
    $aff.= $prestation->libelle . "<br>";
    $aff.= $prestation->tarif . "<br>";
    $aff.= $prestation->unite . "<br>";
}
echo $aff;

//Q-4
echo "<br><br> ";
echo "----------------- Q-4 -----------------";
echo "<br><br>";

$box = Box::find('360bb4cc-e092-3f00-9eae-774053730cb2');
$aff = $box->libelle . "<br>";
$aff.= $box->description . "<br>";
$aff.= $box->montant . "<br>";

echo $aff;

//Q-5
echo "<br><br> ";
echo "----------------- Q-5 -----------------";
echo "<br><br>";

$box = Box::find('360bb4cc-e092-3f00-9eae-774053730cb2');
$aff = $box->libelle . "<br>";
$aff.= $box->description . "<br>";
$aff.= $box->montant . "<br>";

foreach($box->prestation as $prestation){
    $aff.= $prestation->libelle . "<br>";
    $aff.= $prestation->tarif . "<br>";
    $aff.= $prestation->unite . "<br>";
    $aff.= $prestation->pivot->quantite . "<br>";
}

echo $aff;

//Q-6

echo "<br><br> ";
echo "----------------- Q-6 -----------------";
echo "<br><br>";
/*
$box = new Box();
$box->id = Uuid::uuid4();
$box->libelle = "Box 1";
$box->description = "Description Box 1";
$box->montant = 100;
$box->save();
*/