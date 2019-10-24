<?php
require_once 'App/Controllers/LoteriaController.php';
require_once 'App/Views/LoteriaView.php';

$dadosSorteio = (new LoteriaController)->index();

(new LoteriaView($dadosSorteio))->render();