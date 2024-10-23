<?php
function UploadImagemHospedagem($imagem, $cidade, $rua, $tipo, $valor, $parcela, $entrada, $saida, $status, $pagina){

  $sql = 'insert into tb_hospedagem set
          url_imagem_hospedagem = "'.$imagem.'",
          id_cidade = "'.$cidade.'",
          rua_hospedagem = "'.$rua.'",
          tp_hospedagem = "'.$tipo.'",
          vl_hospedagem = "'.$valor.'",
          qt_parcela_hospedagem = "'.$parcela.'",
          en_hospedagem = "'.$entrada.'",
          sd_hospedagem = "'.$saida.'",
          st_hospedagem = "'.$status.'"';
  $res = $GLOBALS['con']->query($sql);
  if($res){
    Confirma("Cadastrado com sucesso!", $pagina);
  }
  else{ Erro("Ops! hospedagem não foi cadastrado!");
  }
}

function ListarHospedagem(){
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
      h.id_cidade = c.cd_cidade;';
  
  $res = $GLOBALS['con']->query($sql);
  if($res->num_rows > 0){
      return $res;
  }
  else{
      echo '<div class="ml-3">Sem hospedagens cadastradas!</div>';
  }
}


  function Editar(  $item, $cidade, $rua, $tipo, $valor, $parcela, $entrada, $saida, $pagina){
    $sql = 'update tb_hospedagem set
            id_cidade = "'.$cidade.'",
            rua_hospedagem = "'.$rua.'",
            tp_hospedagem = "'.$tipo.'",
            vl_hospedagem = "'.$valor.'",
            qt_parcela_hospedagem = "'.$parcela.'",
            en_hospedagem = "'.$entrada.'",
            sd_hospedagem = "'.$saida.'"
            where
            cd_hospedagem = '.$item;
    DML ($sql, "Alterado com sucesso!", "Ops! Não foi alterado!", $pagina);
  }

  function EditarStatus( $item, $status, $pagina){
    $sql = 'update tb_hospedagem set
            st_hospedagem = "'.$status.'"
            where
            cd_hospedagem = '.$item;
            DML ($sql, "Alterado com sucesso!", "Ops! Não foi alterado!", $pagina);
  }

  function EditarImagem($item, $imagem, $pagina){
    $sql = 'select url_imagem_hospedagem from tb_hospedagem where cd_hospedagem =' .$item;
    $smt = $GLOBALS['con']->query($sql);
    $r = $smt->fetch_assoc();

    $dir = "../img/hospedagem/".$r['url_imagem_hospedagem'];
    chmod($dir, 0777);
    unlink($dir);
    $sql = 'update tb_hospedagem set
            url_imagem_hospedagem = "'.$imagem.'"
            where
            cd_hospedagem = '.$item;
            DML($sql, "Imagem alterada com sucesso!", "Ops! Não foi alterado!", $pagina);

  }
  

  function Delete($item, $imagem, $pagina){
  $dir = "../img/hospedagem/".$imagem;
  unlink($dir);
  $sql = 'delete from tb_hospedagem
          where
          cd_hospedagem = '.$item;
    DML($sql, "Excluido com sucesso!", "Ops! Não foi excluído!", $pagina);
  }

?>