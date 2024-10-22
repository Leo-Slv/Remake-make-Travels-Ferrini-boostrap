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

        if(is_array($listar)){ 
?>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="font-weight-bolder">
                        <!-- Exibe o nome do destino do pacote -->
                        <?php echo $listar['nmDestino'] ?>
                    </h1>
                </div>
            </div>
        </div>
        <style>
            .mt-20{
                margin-top: 3rem;
            }
            #fundos{
                height: 41rem;
                width: 100%;
                background-image: url("./img/pacotes/<?php echo $listar['urlImagem'];?>");
                background-repeat: no-repeat;
                background-size: 100%;
            }
        </style>
    <?php
        } 
        require_once 'footer.php';

        // Função que busca os detalhes do pacote
        function DetalhesPacote($pacote){
            global $con; // Certifique-se de que a conexão está disponível globalmente
            
            $sql = 'SELECT cd_pacote, nm_destino_pacote, ds_periodo, ds_acomodacao, vl_pacote, qt_parcela_pacote, url_imagem_pacote, st_pacote 
                    FROM tb_pacote WHERE cd_pacote = ?';
            
            $res = $con->prepare($sql);
            
            if($res === false){
                die('Erro ao preparar a consulta: '.$con->error);
            }

            // Vincula o parâmetro da consulta
            if(!$res->bind_param('i', $pacote)){
                die('Erro ao vincular parâmetros: '.$res->error);
            }

            // Executa a consulta
            if(!$res->execute()){
                die('Erro ao executar consulta: '.$res->error);
            }

            // Liga as colunas do resultado às variáveis
            $res->bind_result($cdPacote, $nmDestino, $dsPeriodo, $dsAcomodacao, $vlPacote, $qtParcela, $urlImagem, $stPacote);

            // Verifica se há resultados e retorna como array
            if($res->fetch()){
                return [
                    'cdPacote' => $cdPacote,
                    'nmDestino' => $nmDestino,
                    'dsPeriodo' => $dsPeriodo,
                    'dsAcomodacao' => $dsAcomodacao,
                    'vlPacote' => $vlPacote,
                    'qtParcela' => $qtParcela,
                    'urlImagem' => $urlImagem,
                    'stPacote' => $stPacote
                ];
            }

            $res->close();
            
            return null;
        }
    ?>

</body>