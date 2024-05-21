<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../../vendor/autoload.php';

use gift\appli\models\Prestation;
use gift\appli\models\Categorie;
use gift\appli\models\Box;
use gift\appli\models\User;
use Ramsey\Uuid\Uuid;

use Illuminate\Database\Capsule\Manager as DB;

$conf = parse_ini_file('../../conf/gift.db.conf.ini.dist');

$db = new DB();
$db->addConnection($conf);
$db->setAsGlobal();
$db->bootEloquent();

//testConnection

if($db->connection()->getDatabaseName()){
    echo "Connected to the database \n";
}


//Q-1
echo "\n\n";
echo "----------------- Q-1 -----------------";
echo "\n\n";

$i = 0;
$prestations = Prestation::all();
foreach($prestations as $prestation){
    $i++;
    $aff = $i .' - '. $prestation->libelle . "\n";
    $aff.= $prestation->description . "\n";
    $aff.= $prestation->tarif . "\n";
    $aff.= $prestation->unite . "\n";
    echo $aff;
}

//Q-2
echo "\n";
echo "----------------- Q-2 -----------------";
echo "\n";

$i = 0;
$prestations = Prestation::with('categorie')->get();
foreach($prestations as $prestation){
    $i++;
    $aff =$i. ' - ' . $prestation->libelle . "\n";
    $aff.= $prestation->description . "\n";
    $aff.= $prestation->tarif . "\n";
    $aff.= $prestation->unite . "\n";
    $aff.= $prestation->categorie->libelle . "\n";
    echo $aff;
}

//Q-3
echo "\n";
echo "----------------- Q-3 -----------------";
echo "\n";

$categorie = Categorie::find(3);
$aff = $categorie->libelle . "\n";
$aff.="\n";
$i =0;
foreach($categorie->prestation as $prestation){
    $i++;
    $aff.= $i .' - '. $prestation->libelle . "\n";
    $aff.= $prestation->tarif . "\n";
    $aff.= $prestation->unite . "\n";
}
echo $aff;

//Q-4
echo "\n\n";
echo "----------------- Q-4 -----------------";
echo "\n\n";

$box = Box::find('360bb4cc-e092-3f00-9eae-774053730cb2');
$aff = $box->libelle . "\n";
$aff.= $box->description . "\n";
$aff.= $box->montant . "\n";

echo $aff;

//Q-5
echo "\n\n";
echo "----------------- Q-5 -----------------";
echo "\n\n";

$box = Box::find('360bb4cc-e092-3f00-9eae-774053730cb2');
$aff = $box->libelle . "\n";
$aff.= $box->description . "\n";
$aff.= $box->montant . "\n";

$aff.="\n";

$i=0;
foreach($box->box2presta as $prestation){
    $i++;
    $aff.= $i.' - '. $prestation->libelle . "\n";
    $aff.= $prestation->tarif . "\n";
    $aff.= $prestation->unite . "\n";
    $aff.= $prestation->pivot->quantite . "\n";
}

echo $aff;

//Q-6

echo "\n\n ";
echo "----------------- Q-6 -----------------";
echo "\n\n";

$res = Box::where('libelle', 'Box 1')->first();

if($res) {
    echo "Box 1 existe \n";
}else{
    echo "Box 1 n'existe pas \n";
    $box = new Box();
    $box->id = Uuid::uuid4();
    //pas pécisée dans le sujet donc je la génère aléatoirement
    $box->token = Uuid::uuid4();
    $box->libelle = "Box 1";
    $box->description = "Description Box 1";
    $box->montant = 100;
    $box->save();

    $prestation = Prestation::find(1);
    $box->box2presta()->attach($prestation, ['quantite' => 2]);

    $prestation = Prestation::find(2);
    $box->box2presta()->attach($prestation, ['quantite' => 1]);

    $prestation = Prestation::find(3);
    $box->box2presta()->attach($prestation, ['quantite' => 3]);
}


