<?php
function UploadImagemCarousel($imagem, $descricao, $status, $pagina){

  $sql = 'insert into tb_carousel set
          url_imagem_carousel = "'.$imagem.'",
          ds_carousel = "'.$descricao.'",
          st_carousel = "'.$status.'"';
  $res = $GLOBALS['con']->query($sql);
  if($res){
    ValidarActive($imagem);
    Confirma("Cadastrado com sucesso!", $pagina);
  }
  else{ Erro("Ops! Imagem não foi cadastrada!");
  }
}


  function ValidarActive(){
    $sql = 'select cd_carousel from tb_carousel 
            where
            ic_active = "1" and
            st_carousel = "1"';
    $res = $GLOBALS['con']->query($sql);
    if($res->num_rows == 0){
      Active($imagem);
    }        
  }
  function Active ($imagem){
    $sql = 'update tb_carousel set ic_active = "1"
            where 
            url_imagem_carousel = "'.$imagem.'"';
    $res =  $GLOBALS['con']->query($sql);
  }

  function ListarImagem(){
    $sql = 'select cd_carousel, url_imagem_carousel, ds_carousel, st_carousel from tb_carousel';
    $res = $GLOBALS['con']->query($sql);
    if($res->num_rows > 0){
        return $res;
    }
    else{
      echo 'sem imagens cadastradas!';
    }
  }

  function Editar($item, $descricao, $status, $pagina){
    $sql = 'update tb_carousel set
            ds_carousel = "'.$descricao.'",
            st_carousel = "'.$status.'"
            where
            cd_carousel = '.$item;
    DML ($sql, "Alterado com sucesso!", "Ops! Não foi alterado!", $pagina);
  }

  function Delete($item, $imagem, $pagina){
  $dir = "../img/carousel/".$imagem;
  chmod($dir, 0777);
  unlink($dir);
  $sql = 'delete from tb_carousel
          where
          cd_carousel = '.$item;
    DML($sql, "Excluido com sucesso!", "Ops! Não foi excluído!", $pagina);
  }
?>