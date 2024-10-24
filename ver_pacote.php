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
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="font-weight-bolder">
                    <!-- Exibe o nome do destino do pacote -->
                    Hospedagens no <?php echo $listar['nmCidade']; ?>
                </h4>
            </div>
        </div>
    </div>
    <style>
        .mt-20 {
            margin-top: 4.5rem;
        }
        .mt-30 {
            margin-top: 180px;
        }
        #fundos {
            background-image: url("./img/pacotes/<?php echo $listar['urlImagem']; ?>");
            background-size: 100% 100%; /* Estica a imagem para cobrir 100% da largura e altura */
            background-position: center; 
            background-repeat: no-repeat;
            height: 65vh; 
            width: 100%; 
        }
        .hide {
            position: absolute; 
            width: 0;           
            height: 0;         
            overflow: hidden;  
            opacity: 0;      
        }
        .card-img-h{
            height: 378px;
            background-size: 100%; /* Estica a imagem para cobrir 100% da largura e altura */
            background-position: center; 
            background-repeat: no-repeat;
            width: 100%; 
            border-radius:10px;
            }
            .mx-10 {
                padding-left:350px;
                padding-top:10px;
                padding-right:175px;
                padding-bottom:0px;
                
            }

            .card {
                margin-bottom: 15%;
                border: none;
                width: 85%;
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                border-radius:10px;
                }

            .card:hover {
                transition: 0.7s;
                scale: 1.05;
                }
            .inside-box{
                border: 1px solid #ccc; /* Borda */
                border-radius: 8px; /* Borda arredondada */
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra ao redor da caixa */
                margin: 20px auto; /* Margem automática para centralizar horizontalmente */
                height:200px;
            }
            .border{
                border-right: 1px solid #ccc; /* Borda */
                
            }
    </style>
<?php
} 
?>

<?php
$listarH = DetalhesHospedagem($nmCidade); // Passa o nome da cidade aqui

if (is_array($listarH) && count($listarH) > 0) { 
?>
        <div class="row">
            <?php foreach ($listarH as $hospedagem) { 
                // Verifica o estado da hospedagem
                $st = '';
                if ($hospedagem['stHospedagem'] == "0") {
                    $st = 'hide'; // Aplica a classe CSS hide se a hospedagem não estiver ativa
                }
            ?>
               <div class="col-sm-12 mx-10 <?php echo $st; ?>">
                <div class="card mb-3">
                    <div class="row no-gutters">
                        <!-- Primeira Coluna -->
                        <div class="col-md-4 text-center">
                            <img src="./img/hospedagem/<?php echo $hospedagem['urlImagemHospedagem']; ?>" alt="Imagem do Hotel" class="card-img-h">
                            
                        </div>

                        <!-- Segunda Coluna -->
                        <div class="col-md-4 border">
                            <div class="card-body">
                                <h6 class="card-title font-weight-bolder">Nome do Hotel</h6>
                                <p class="card-text">Rua: <?php echo $hospedagem['ruaHospedagem']; ?></p>
                                <p class="card-text"><small class="text-muted">Detalhes da Hospedagem</small></p>
                                <div class="inside-box p-4">
                                    <p class="card-text"><small class="text-muted"><?php echo $hospedagem['tpHospedagem']; ?></small></p>
                                </div>
                            </div>
                        </div>

                        <!-- Terceira Coluna -->
                        <div class="col-md-4">
                            <div class="card-body mt-30">
                                <div class="d-flex col justify-content-between">
                                <p class="card-text">Total do pacote:</p>
                                <strong>R$ <?php echo number_format($hospedagem['vlHospedagem'], 2, ',', '.'); ?></strong>
                                </div>
                                <div class="d-flex row justify-content-center mb-2">
                                    <a href="" class="btn btn-outline-warning">Selecionar Hotel</a>
                                </div>
                                <div class="d-flex row justify-content-center">
                                    <p class="card-text">Taxas inclusas em até: <strong><?php echo $hospedagem['qtParcelaHospedagem']; ?>X</strong></p>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

<script>
var stars = document.querySelectorAll('.star-icon');
                  
document.addEventListener('click', function(e){
  var classStar = e.target.classList;
  if(!classStar.contains('ativo')){
    stars.forEach(function(star){
      star.classList.remove('ativo');
    });
    classStar.add('ativo');
    console.log(e.target.getAttribute('data-avaliacao'));
  }
});
</script>