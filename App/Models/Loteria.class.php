<?php

/**
 * Classe Loteria
 *
 * @author André Fernandes
 */
class Loteria {
	
    private $quantidadeDezenas;
    private $resultado;
    private $totalJogos;
    private $jogos;

    private $quantidadeDezenasSorteio = 6;
    private $quantidadeMaximaDezenasSorteio = 60;
    private $quantidadeDezenasPermitidas = [6,7,8,9,10];

    // método construtor da classe
    public function __construct(int $quantidadeDezenas, int $totalJogos) {
        $this->setQuantidadeDezenas($quantidadeDezenas);
        $this->setTotalJogos($totalJogos);
    }

    // Gera sorteio e seta em resultados
    public function gerarSorteio() {
        $quantidadeDezenas = $this->getQuantidadeDezenasSorteio();
        $arrayResultado    = $this->gerarDezenasOrdemCrescente($quantidadeDezenas);
        $this->setResultado($arrayResultado);
        return $this;
    }

    // gera os jogos de acordo com a definição de total de jogos
    public function gerarJogos() {
        $arrayJogos = [];
        $totalJogos = $this->getTotalJogos();
        while (count($arrayJogos) < $totalJogos) {
            $quantidadeDezenas = $this->getQuantidadeDezenas();
            $dezenas = $this->gerarDezenasOrdemCrescente($quantidadeDezenas);
            array_push($arrayJogos, $dezenas);
        }
        $this->setJogos($arrayJogos);
        return $this;
    }

    // confere os jogo e retorna para o usuário
    public function conferirJogos(): array {
        $retorno = [
            'resultado'                  => $this->getResultado(),
            'quantidadeDezenasSorteadas' => $this->getQuantidadeDezenasSorteio(),
            'quantidadeDezenasJogadas'   => $this->getQuantidadeDezenas()
        ];

        $quantidadeGanhadores = 0;
        $arrayJogos = $this->getJogos();
        foreach ($arrayJogos as $key => $jogo) {
            $dezenasSorteadas = $this->getDezenasSorteadas($jogo);
            $situacaoJogo     = (count(array_diff($jogo, $dezenasSorteadas)) === 0) ? 'GANHOU' : 'PERDEU'; 
            $retorno['jogos'][$key] = [
                'numeros'   => $jogo,
                'sorteados' => $dezenasSorteadas,
                'situacao'  => $situacaoJogo
            ];

            if (count(array_diff($jogo, $dezenasSorteadas)) === 0) {
                $quantidadeGanhadores++;
            }
        }

        $retorno['quantidadeGanhadores'] = $quantidadeGanhadores;

        return $retorno;
    }

    // retorna as dezenas sorteadas
    private function getDezenasSorteadas($jogo): array {
        $resultado = $this->getResultado();
        $sorteados = array_intersect($jogo, $resultado);
        return $sorteados;
    }

    // gera dezenas únicas, aleatórias em ordem crescente
    private function gerarDezenasOrdemCrescente($quantidadeDezenas): array {
        $arrayDezenas = [];
        while (count($arrayDezenas) < $quantidadeDezenas) {
            $dezena = rand(1, $this->getQuantidadeMaximaDezenasSorteio());
            if (!in_array($dezena, $arrayDezenas)) {
                array_push($arrayDezenas, $dezena);
            }
        }
        sort($arrayDezenas);
        return $arrayDezenas;
    }

    // obter valor de quantidade de dezenas
    public function getQuantidadeDezenas(): int {
        return $this->quantidadeDezenas;
    }
    
    // setar valor em quantidade de dezenas
    public function setQuantidadeDezenas(int $quantidadeDezenas) {
        if (!in_array($quantidadeDezenas, $this->quantidadeDezenasPermitidas)) {
            throw new Exception('Quantidade de dezenas não permitida.');
        }
        $this->quantidadeDezenas = $quantidadeDezenas;
    }
    
    // obter valor de resultado
    public function getResultado(): array {
        return $this->resultado;
    }
    
    // setar valor em resultado
    public function setResultado(array $resultado) {
        $this->resultado = $resultado;
    }

    // obter valor de total de jogos
    public function getTotalJogos(): int {
        return $this->totalJogos;
    }
    
    // setar valor em total de jogos
    public function setTotalJogos(int $totalJogos) {
        $this->totalJogos = $totalJogos;
    }

    // obter valor de jogos
    public function getJogos(): array {
        return $this->jogos;
    }

    // setar valor em total de jogos
    public function setJogos(array $jogos) {
        $this->jogos = $jogos;
    }

    // obter valor da quantidade de dezenas que serão sorteadas
    public function getQuantidadeDezenasSorteio(): int {
        return $this->quantidadeDezenasSorteio;
    }

    // setar valor em quantidade de dezenas que serão sorteadas
    public function setQuantidadeDezenasSorteio(int $quantidadeDezenasSorteio) {
        $this->quantidadeDezenasSorteio = $quantidadeDezenasSorteio;
    }

    // obter valor da quantidade de dezenas que serão sorteadas
    public function getQuantidadeMaximaDezenasSorteio(): int {
        return $this->quantidadeMaximaDezenasSorteio;
    }

    // setar valor em quantidade de dezenas que serão sorteadas
    public function setQuantidadeMaximaDezenasSorteio(int $quantidadeMaximaDezenasSorteio) {
        $this->quantidadeMaximaDezenasSorteio = $quantidadeMaximaDezenasSorteio;
    }
}