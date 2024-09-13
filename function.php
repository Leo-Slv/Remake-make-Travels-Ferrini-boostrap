<?php
require_once 'conect.php';

function ListarPacotes(){
    $sql = 'select 
    cd_pacote, 
    nm_destino_pacote, 
    ds_periodo, 
    ds_acomodacao, 
    qt_parcela_pacote, 
    url_imagem_pacote,
    st_pacote
    from 
    tb_pacote';
    $res = $GLOBALS['con']->query($sql);
    if($res->num_rows > 0){
        return $res;
    }
  }
?>