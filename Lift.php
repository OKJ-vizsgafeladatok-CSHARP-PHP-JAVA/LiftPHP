<?php

class Lift {

    private $datum;
    private $kartya;
    private $indulo;
    private $cel;
    function __construct($datum, $kartya, $indulo, $cel) {
        $this->datum = $datum;
        $this->kartya = $kartya;
        $this->indulo = $indulo;
        $this->cel = $cel;
    }
    function getDatum() {
        return $this->datum;
    }

    function getKartya() {
        return $this->kartya;
    }

    function getIndulo() {
        return $this->indulo;
    }

    function getCel() {
        return $this->cel;
    }

    function setDatum($datum): void {
        $this->datum = $datum;
    }

    function setKartya($kartya): void {
        $this->kartya = $kartya;
    }

    function setIndulo($indulo): void {
        $this->indulo = $indulo;
    }

    function setCel($cel): void {
        $this->cel = $cel;
    }


    
}
