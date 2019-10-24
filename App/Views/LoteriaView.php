<?php

class LoteriaView
{
    private $dadosSorteio;

    public function __construct($dadosSorteio) {
        $this->dadosSorteio = $dadosSorteio;
    }

    public function render() {
        $dadosSorteio = $this->dadosSorteio;
        require_once(dirname(__FILE__) . '/Templates/loteria.php');
    }
}