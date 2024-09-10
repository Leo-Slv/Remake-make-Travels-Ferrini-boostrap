<?php
function UploadImagemPacote($imagem, $destino, $periodo, $acomodacao, $parcela, $status, $pagina){

  $sql = 'insert into tb_pacote set
          url_imagem_pacote = "'.$imagem.'",
          nm_destino_pacote = "'.$destino.'",
          ds_periodo = "'.$periodo.'",
          ds_acomodacao = "'.$acomodacao.'",
          qt_parcela_pacote = "'.$parcela.'",
          st_pacote = "'.$status.'"';
  $res = $GLOBALS['con']->query($sql);
  if($res){
    ValidarActive($imagem);
    Confirma("Cadastrado com sucesso!", $pagina);
  }
  else{ Erro("Ops! Pacote não foi cadastrado!");
  }
}


  function ValidarActive(){
    $sql = 'select cd_pacote from tb_pacote 
            where
            st_pacote = "1"';
    $res = $GLOBALS['con']->query($sql);
    if($res->num_rows == 0){
      Active($imagem);
    }        
  }
  function Active ($imagem){
    $sql = 'update tb_pacote set ic_active = "1"
            where 
            url_imagem_pacote = "'.$imagem.'"';
    $res =  $GLOBALS['con']->query($sql);
  }

  function ListarImagem(){
    $sql = 'select cd_pacote, nm_destino_pacote, ds_periodo, ds_acomodacao, qt_parcela_pacote, url_imagem_pacote, st_pacote from tb_pacote';
    $res = $GLOBALS['con']->query($sql);
    if($res->num_rows > 0){
        return $res;
    }
    else{
      echo '<div class="ml-3">Sem pacotes cadastrados!</div>';
    }
  }

  function Editar($item, $descricao, $status, $pagina){
    $sql = 'update tb_pacote set
            ds_carousel = "'.$descricao.'",
            st_carousel = "'.$status.'"
            where
            cd_carousel = '.$item;
    DML ($sql, "Alterado com sucesso!", "Ops! Não foi alterado!", $pagina);
  }

  function Delete($item, $imagem, $pagina){
  $dir = "../img/carousel/".$imagem;
  unlink($dir);
  $sql = 'delete from tb_carousel
          where
          cd_carousel = '.$item;
    DML($sql, "Excluido com sucesso!", "Ops! Não foi excluído!", $pagina);
  }
?>