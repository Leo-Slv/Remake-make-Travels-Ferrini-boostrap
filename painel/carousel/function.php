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
?>