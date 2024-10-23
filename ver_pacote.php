<?php
require_once 'header.php';
$pacote = $_GET['pacote']; 
?>
<body>
<?php
require_once 'nav.php';
?>

<div class="container-fluid mt-20">
    <div class="row">
        <div class="cols-sm-12" id="fundos">

        </div>
    </div>
</div>

<?php
$listar = DetalhesPacote($pacote);

if (is_array($listar)) { 
    $nmCidade = $listar['nmCidade']; // Defina nmCidade aqui
?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="font-weight-bolder text-center">
                    <!-- Exibe o nome do destino do pacote -->
                    <?php echo $listar['nmCidade']; ?>
                </h1>
            </div>
        </div>
    </div>
    <style>
        .mt-20 {
            margin-top: 3.6rem;
        }
        #fundos {
            background-image: url("./img/pacotes/<?php echo $listar['urlImagem']; ?>");
            background-size: 100% 100%; /* Estica a imagem para cobrir 100% da largura e altura */
            background-position: center; 
            background-repeat: no-repeat;
            height: 70vh; 
            width: 100%; 
        }
        .hide {
            position: absolute; 
            width: 0;           
            height: 0;         
            overflow: hidden;  
            opacity: 0;      
        }
    </style>
<?php
} 
?>

<?php
$listarH = DetalhesHospedagem($nmCidade); // Passa o nome da cidade aqui

if (is_array($listarH) && count($listarH) > 0) { 
?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="font-weight-bolder text-center">
                    <!-- Exibe todos os tipos de hospedagem -->
                    Tipos de Hospedagem em <?php echo $nmCidade; ?>:
                </h1>
            </div>
        </div>
        <div class="row">
            <?php foreach ($listarH as $hospedagem) { 
                // Verifica o estado da hospedagem
                $st = '';
                if ($hospedagem['stHospedagem'] == "0") {
                    $st = 'hide'; // Aplica a classe CSS hide se a hospedagem não estiver ativa
                }
            ?>
                <div class="col-sm-4 text-center <?php echo $st; ?>">
                    <div class="hospedagem-item">
                        <h2><?php echo $hospedagem['tpHospedagem']; ?></h2>
                        <p>Endereço: <?php echo $hospedagem['ruaHospedagem']; ?></p>
                        <p>Valor: R$ <?php echo number_format($hospedagem['vlHospedagem'], 2, ',', '.'); ?></p>
                        <p>Parcelas: <?php echo $hospedagem['qtParcelaHospedagem']; ?></p>
                        <!-- Adicione mais informações conforme necessário -->
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
<?php
} 

require_once 'footer.php';

// Função que busca os detalhes do pacote
function DetalhesPacote($pacote) {
    global $con; // Certifique-se de que a conexão está disponível globalmente
    
    $sql = 'SELECT 
                p.cd_pacote, 
                p.ds_periodo, 
                p.ds_acomodacao, 
                p.vl_pacote, 
                p.qt_parcela_pacote, 
                p.url_imagem_pacote, 
                p.st_pacote, 
                c.nm_cidade -- Nome da cidade a partir da tabela tb_cidade
            FROM 
                tb_pacote p
            INNER JOIN 
                tb_cidade c 
            ON 
                p.id_cidade = c.cd_cidade
            WHERE 
                p.cd_pacote = ?';
    $res = $con->prepare($sql);
    
    if ($res === false) {
        die('Erro ao preparar a consulta: ' . $con->error);
    }

    // Vincula o parâmetro da consulta
    if (!$res->bind_param('i', $pacote)) {
        die('Erro ao vincular parâmetros: ' . $res->error);
    }

    // Executa a consulta
    if (!$res->execute()) {
        die('Erro ao executar consulta: ' . $res->error);
    }

    // Liga as colunas do resultado às variáveis
    $res->bind_result($cdPacote, $dsPeriodo, $dsAcomodacao, $vlPacote, $qtParcela, $urlImagem, $stPacote, $nmCidade);

    // Verifica se há resultados e retorna como array
    if ($res->fetch()) {
        return [
            'cdPacote' => $cdPacote,
            'dsPeriodo' => $dsPeriodo,
            'dsAcomodacao' => $dsAcomodacao,
            'vlPacote' => $vlPacote,
            'qtParcela' => $qtParcela,
            'urlImagem' => $urlImagem,
            'stPacote' => $stPacote,
            'nmCidade' => $nmCidade
        ];
    }

    $res->close();
    
    return null;
}

// Função que busca os detalhes da hospedagem
function DetalhesHospedagem($nmCidade) {
    global $con; // Certifique-se de que a conexão está disponível globalmente
    
    $sql = 'SELECT 
                h.cd_hospedagem, 
                h.rua_hospedagem, 
                h.tp_hospedagem,
                h.vl_hospedagem, 
                h.qt_parcela_hospedagem,
                DATE_FORMAT(h.en_hospedagem, "%d/%m/%y") AS en_hospedagem_formatada, 
                DATE_FORMAT(h.sd_hospedagem, "%d/%m/%y") AS sd_hospedagem_formatada, 
                h.url_imagem_hospedagem, 
                h.st_hospedagem, 
                c.nm_cidade
            FROM 
                tb_hospedagem h
            INNER JOIN 
                tb_cidade c 
            ON 
                h.id_cidade = c.cd_cidade
            WHERE 
                c.nm_cidade = ?';
    $res = $con->prepare($sql);
    
    if ($res === false) {
        die('Erro ao preparar a consulta: ' . $con->error);
    }

    // Vincula o parâmetro da consulta
    if (!$res->bind_param('s', $nmCidade)) { // Mudado para 's' para string
        die('Erro ao vincular parâmetros: ' . $res->error);
    }

    // Executa a consulta
    if (!$res->execute()) {
        die('Erro ao executar consulta: ' . $res->error);
    }

    // Liga as colunas do resultado às variáveis
    $res->bind_result($cdHospedagem, $ruaHospedagem, $tpHospedagem, $vlHospedagem, $qtParcelaHospedagem, $enHospedagem, $sdHospedagem, $urlImagemHospedagem, $stHospedagem, $nmCidadeHospedagem);

    $resultados = []; // Inicializa um array para armazenar os resultados

    // Verifica se há resultados e armazena todos em um array
    while ($res->fetch()) {
        $resultados[] = [
            'cdHospedagem' => $cdHospedagem,
            'ruaHospedagem' => $ruaHospedagem,
            'tpHospedagem' => $tpHospedagem,
            'vlHospedagem' => $vlHospedagem,
            'qtParcelaHospedagem' => $qtParcelaHospedagem,
            'enHospedagem' => $enHospedagem,
            'sdHospedagem' => $sdHospedagem,
            'urlImagemHospedagem' => $urlImagemHospedagem,
            'stHospedagem' => $stHospedagem,
            'nmCidadeHospedagem' => $nmCidadeHospedagem
        ];
    }

    $res->close();
    
    return $resultados; // Retorna todos os resultados
}
?>
</body>
