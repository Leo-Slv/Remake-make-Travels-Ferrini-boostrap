<?php
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