<?php
require_once 'conect.php';

function ListarPacotes(){
    $sql = 'select 
    cd_pacote, 
    nm_destino_pacote, 
    ds_periodo, 
    ds_acomodacao,
    vl_pacote, 
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

  function ListarServicos(){
    $sql = 'select 
    cd_servico,
    nm_servico,
    ds_servico,
    url_imagem_servico
    from 
    tb_servico';
    $res = $GLOBALS['con']->query($sql);
    if($res->num_rows > 0){
      return $res;
    }
  }

  function ListarCarousel(){
    $sql = 'select 
    url_imagem_carousel,
    st_carousel,
    ic_active
    from tb_carousel';
    $res =$GLOBALS['con']->query($sql);
    if($res->num_rows > 0){
      return $res;
    }
  }
?>