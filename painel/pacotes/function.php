<?php
function UploadImagemPacote($imagem, $cidade, $periodo, $acomodacao, $valor, $parcela, $status, $pagina){

  $sql = 'insert into tb_pacote set
          url_imagem_pacote = "'.$imagem.'",
          id_cidade = "'.$cidade.'",
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
    $sql = 'SELECT 
  p.cd_pacote, 
  p.ds_periodo, 
  p.ds_acomodacao, 
  p.vl_pacote, 
  p.qt_parcela_pacote, 
  p.url_imagem_pacote, 
  p.st_pacote, 
  p.ic_active,
  c.nm_cidade -- Nome da cidade a partir da tabela tb_cidade
FROM 
  tb_pacote p
INNER JOIN 
  tb_cidade c 
ON 
  p.id_cidade = c.cd_cidade;';
    $res = $GLOBALS['con']->query($sql);
    if($res->num_rows > 0){
        return $res;
    }
    else{
      echo '<div class="ml-3">Sem pacotes cadastrados!</div>';
    }
  }

  function Editar(  $item, $cidade, $periodo, $acomodacao, $valor, $parcela, $pagina){
    $sql = 'update tb_pacote set
            id_cidade = "'.$cidade.'",
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

  function CadastrarCidade($cidade, $pagina){
    $sql = 'insert into tb_cidade set
          nm_cidade = "'.$cidade.'"';
  $res = $GLOBALS['con']->query($sql);
  if($res){
    Confirma("Cadastrado com sucesso!", $pagina);
  }
  else{ Erro("Ops! Pacote não foi cadastrado!");
  }
  }

  function DeletarCidade($cidade, $pagina){
    $dir = "../img/pacotes/".$imagem;
    unlink($dir);
    $sql = 'delete from tb_cidade
            where
            cd_cidade = '.$cidade;
      DML($sql, "Excluido com sucesso!", "Ops! Não foi excluído!", $pagina);
    }
?>