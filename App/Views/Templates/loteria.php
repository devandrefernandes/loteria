<?php
    $jogos     = $dadosSorteio['jogos'];
    
    $textoGanhadores = ($dadosSorteio['quantidadeGanhadores'] === 0) ? 'Acumulou' : ($dadosSorteio['quantidadeGanhadores'] . ' ganhadores');

    function montarBadgeCompleto($numeros, $classeCor) {
        $htmlBadge  = "<span class='badge badge-pill badge-{$classeCor} m-2'>";
        $htmlBadge .= implode("</span><span class='badge badge-pill badge-{$classeCor} m-2'>", $numeros);
        $htmlBadge .= "</span>";
        return $htmlBadge;
    }

    function montarBadgeIndividual($numero, $classeCor) {
        return "<span class='badge badge-pill badge-{$classeCor}'>{$numero}</span>";
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>  
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Loteria</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="public/css/style.css">
    </head>
    <body>
        <section class="p-5 text-center">
            <div class="container">
                <h1>Loteria</h1>
                <p class="pt-2">
                    <?php echo montarBadgeCompleto($dadosSorteio['resultado'], 'warning') ?>
                </p>
                <h2><?php echo $textoGanhadores ?></h2>
            </div>
        </section>
        <section>
            <div class="container">
                <table class="jumbotron table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Qtd. Dezenas</th>
                            <th scope="col">Números</th>
                            <th scope="col">Qtd. Acertos</th>
                            <th scope="col">Acertos</th>
                            <th scope="col">Situação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            foreach ($jogos as $key => $jogo) {
                                $numeros   = $jogo['numeros'];
                                $sorteados = $jogo['sorteados'];
                                $situacao  = $jogo['situacao'];
                                $quantidadeDezenasSorteadas = count($sorteados);
                                echo "<tr>";
                                echo "  <td>" . ($key+1) . "</td>";
                                echo "  <td>" . $dadosSorteio['quantidadeDezenasJogadas'] . "</td>";
                                $tdNumeros = '';
                                foreach ($numeros as $numero) {
                                    $classeSorteado = (in_array($numero, $sorteados)) ? 'success' : 'danger';
                                    $tdNumeros     .= montarBadgeIndividual($numero, $classeSorteado);
                                }
                                echo "  <td>{$tdNumeros}</td>";
                                echo "  <td>" . count($sorteados) . "</td>";
                                echo "  <td>" . montarBadgeCompleto($sorteados, 'warning') . "</td>";
                                echo "  <td>{$situacao}</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
                <div class="text-center">
                    <button type="button" class="btn btn-success" onclick="location.reload();">Sortear</button>
                </div>
            </div>
        </section>

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>