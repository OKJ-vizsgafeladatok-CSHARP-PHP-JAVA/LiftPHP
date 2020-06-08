<?php
include 'Lift.php';

function beolvas(){
    $tomb=array();
    try{
        $fajl= file_get_contents("lift.txt");
        $sorok= explode("\n", $fajl);
//        array_shift($sorok);//most nem kell shiftelni, mert az első sor is adat. 
        for ($i = 0; $i < count($sorok); $i++) {
            if(!empty($sorok[$i])){
                $split= explode(" ", $sorok[$i]);
                $o=new Lift($split[0], $split[1], $split[2], $split[3]);
                $tomb[]=$o;
            }
        }
    } catch (Exception $ex) {
        die("hiba a beolvasáskor. "+$ex);
    }
    return $tomb;
}

$a=beolvas();

echo'3. feladat: Összes lifthasználat: '.count($a).'<br>';
//4. feladat
$eleje= substr($a[0]->getDatum(),0, strlen($a[0]->getDatum())-1);
$utolsoIndex=count($a)-1;
$vege= substr($a[$utolsoIndex]->getDatum(),0, strlen($a[$utolsoIndex]->getDatum())-1);

echo '4. feladat: Időszak: '.$eleje." - ".$vege.'<br>';

//5. feladat:
$legn=0;
foreach ($a as $item){
    if($item->getCel()>$legn){
        $legn=$item->getCel();
    }
}
echo '5. feladat: Célszint max: '.$legn."<br>";
//6. feladat: 
$behuzas="&nbsp&nbsp&nbsp&nbsp&nbsp";
echo '6. feladat: <br>';
echo      "<div style='margin-left:15px;'><form method='POST' action='#'>"
            .$behuzas."Kártya száma: <input type='text' name='kartya' required><br>"
            .$behuzas."Emelet:<input type='text' name='emelet' required><br>"
            .$behuzas."<input type='submit' value='Küldés'><br>"
        . "</form></div>";

if(isset($_POST['kartya'])&&isset($_POST['emelet'])&&!empty($_POST['kartya'])&&!empty($_POST['emelet'])){
    try {
        $kartya=$_POST['kartya'];
        $emelet=$_POST['emelet'];
        if(!is_numeric($emelet)){
            $emelet=5;
        }else{
            $emelet=round($emelet);
        }
        if(!is_numeric($kartya)){
            $kartya=5;
        }else{
            $kartya=round($kartya);
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
//    echo"kártya:". $kartya." emelet:".$emelet;
    if(isset($_POST['emelet'])){
        unset($_POST['emelet']);
    }
    if(isset($_POST['kartya'])){
        unset($_POST['kartya']);
    }
    //7. feladat
    $valasz="7. feladat: A(z) ".$kartya.". kártyával nem utaztak a(z) ".$emelet. ". emeletre! <br>";
    foreach ($a as $item){
        if($item->getKartya()==$kartya && $item->getCel()==$emelet){
            $valasz="7. feladat: A(z) ".$kartya.". kártyával utaztak a(z) ".$emelet. ". emeletre! <br>";
            break;
        }
    }
    echo $valasz;
}else{
    echo"mindkét mezőt ki kell tölteni. <br>";
}

//8. feladat
echo '8. feladat: Statisztika<br>';
$stat= array();
foreach ($a as $item){
    $stat[]=$item->getDatum();
}
$stat= array_count_values($stat);
        //print_r($stat);
        /**$statOrdered=array();
        foreach ($stat as $key=>$value){
            $statOrdered[$key]=$value;
        }
        arsort($statOrdered);*///így lehetne sorba rendezni, csökkenő sorrendben 
//print_r($statOrdered);
foreach ($stat as $key=>$value){
    echo $behuzas. substr($key,0,strlen($key)-1)." - ".$value.'x<br>';
}
