<?php
function UploadImagemPacote($imagem, $destino, $periodo, $acomodacao, $valor, $parcela, $status, $pagina){

  $sql = 'insert into tb_pacote set
          url_imagem_pacote = "'.$imagem.'",
          nm_destino_pacote = "'.$destino.'",
          ds_periodo = "'.$periodo.'",
          ds_acomodacao = "'.$acomodacao.'",
          vl_pacote = "'.$valor.'",
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
    $sql = 'select cd_pacote, nm_destino_pacote, ds_periodo, ds_acomodacao, vl_pacote, qt_parcela_pacote, url_imagem_pacote, st_pacote from tb_pacote';
    $res = $GLOBALS['con']->query($sql);
    if($res->num_rows > 0){
        return $res;
    }
    else{
      echo '<div class="ml-3">Sem pacotes cadastrados!</div>';
    }
  }

  function Editar(  $item, $destino, $periodo, $acomodacao, $valor, $parcela, $pagina){
    $sql = 'update tb_pacote set
            nm_destino_pacote = "'.$destino.'",
            ds_periodo = "'.$periodo.'",
            ds_acomodacao = "'.$acomodacao.'",
            vl_pacote = "'.$valor.'",
            qt_parcela_pacote = "'.$parcela.'"
            where
            cd_pacote = '.$item;
    DML ($sql, "Alterado com sucesso!", "Ops! Não foi alterado!", $pagina);
  }

  function EditarStatus( $item, $status, $pagina){
    $sql = 'update tb_pacote set
            st_pacote = "'.$status.'"
            where
            cd_pacote = '.$item;
            DML ($sql, "Alterado com sucesso!", "Ops! Não foi alterado!", $pagina);
  }

  function EditarImagem($item, $imagem, $pagina){
    $sql = 'select url_imagem_pacote from tb_pacote where cd_pacote =' .$item;
    $smt = $GLOBALS['con']->query($sql);
    $r = $smt->fetch_assoc();

    $dir = "../img/pacotes/".$r['url_imagem_pacote'];
    chmod($dir, 0777);
    unlink($dir);
    $sql = 'update tb_pacote set
            url_imagem_pacote = "'.$imagem.'"
            where
            cd_pacote = '.$item;
            DML($sql, "Imagem alterada com sucesso!", "Ops! Não foi alterado!", $pagina);

  }
  

  function Delete($item, $imagem, $pagina){
  $dir = "../img/pacotes/".$imagem;
  unlink($dir);
  $sql = 'delete from tb_pacote
          where
          cd_pacote = '.$item;
    DML($sql, "Excluido com sucesso!", "Ops! Não foi excluído!", $pagina);
  }
?>