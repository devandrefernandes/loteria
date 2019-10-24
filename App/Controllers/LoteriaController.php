<?php
require_once dirname(dirname(__FILE__)) . '/Models/Loteria.class.php';

class LoteriaController {

    public function index() {
        $quantidadeDezenas = rand(6,10);
        $totalJogos        = rand(3,5);

        $loteria = new Loteria($quantidadeDezenas, $totalJogos);
        $loteria->gerarJogos()->gerarSorteio();
        return $loteria->conferirJogos();
    }

}