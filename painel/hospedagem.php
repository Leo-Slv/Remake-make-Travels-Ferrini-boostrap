<?php
require_once 'header.php';
require_once './hospedagem/function.php';
require_once './hospedagem/modal.php';
require_once './hospedagem/script.php';
require_once './cidade/modal.php';
require_once './cidade/function.php';


?>

<style>
    .card-img{
        height: 230px;}
    .row .card{
        margin-bottom: 3%
    }
</style>

<body>
    <?php require_once 'nav.php'; ?>
    <div class="container-fluid mb-3">
        <div class="row">
            <div class="col-sm-8">
                <h3 class="font-weight-bolder">
                    Informações - Hospedagens
                </h3>
            </div>
                <div class="col-sm-2">
                <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#uploadCidade">
                    + Cidades
                </button>
                <button class="btn btn-danger btn-block" data-toggle="modal" data-target="#deleteCidade">
                    - Cidades
                </button>
                </div>
                <div class="col-sm-2">
                <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#upload">
                    + Pacotes
                </button>
                </div> 
            </div> 
        </div>
        <div class='row ml-2'>
            <?php
            $listar = ListarHospedagem();
            if($listar){
                foreach($listar as $l){
                    if($l['st_hospedagem'] == "1"){
                        $badge = 'badge-success';
                        $flag = 'ativo';
                    }
                    else{
                        $badge = 'badge-danger';
                        $flag = 'inativo';
                    }
            ?>
            <!--HTML -->
            <div class="col-sm-4">
            <div class="card">
                <img src="../img/hospedagem/<?php echo $l['url_imagem_hospedagem'];?>" 
                alt="" class="card-img img-fluid">
                <div class="card-body">
                    <span class="badge <?php echo $badge;?>">
                        <?php echo $flag; ?>
                    </span>
                    <strong>Destino:
                    <?php echo $l['nm_cidade']; ?>
                    </strong>
                    <br>
                    <strong>Rua:
                    <?php echo $l['rua_hospedagem']; ?>
                    </strong>
                    <br>
                    <strong>Detalhes do Hotel:
                    <?php echo $l['tp_hospedagem']; ?>
                    </strong>
                    <br>
                    <strong>Valor da hospedagem: R$
                    <?php echo $l['vl_hospedagem']; ?>
                    </strong>
                    <br>
                    <strong>Quantidade de Parcelas:
                    <?php echo $l['qt_parcela_hospedagem']; ?>x
                    </strong>
                    <br>
                    <strong>Data de entrada:
                    <?php echo $l['en_hospedagem_formatada']; ?>
                    </strong>
                    <br>
                    <strong>Data de saída:
                    <?php echo $l['sd_hospedagem_formatada']; ?>
                    </strong>
                    <br>
                </div>
                <div class="card-footer text-center">
                        <button class="btn btn-Warning btn-sm editimg"
                        data-toggle="modal"
                        data-target="#editimg"
                        title="editarimg"
                        cd="<?php echo $l['cd_hospedagem']; ?>"
                        imagem="<?php echo $l['url_imagem_hospedagem']; ?>">
                            <i class="bi bi-card-image"></i>
                        </button>
                        <button class="btn btn-info btn-sm edit"
                        data-toggle="modal"
                        data-target="#edit"
                        title="editar"
                        cd="<?php echo $l['cd_hospedagem']; ?>"
                        destino="<?php echo $l['id_cidade'];?>"
                        rua="<?php echo $l['rua_hospedagem'];?>"
                        tipo="<?php echo $l['tp_hospedagem'];?>"
                        valor="<?php echo $l['vl_hospedagem'];?>"
                        parcela="<?php echo $l['qt_parcela_hospedagem'];?>"
                        entrada="<?php echo $l['en_hospedagem'];?>"
                        saida="<?php echo $l['sd_hospedagem'];?>">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-danger delete"
                        data-toggle="modal"
                        data-target="#delete"
                        title="excluir"
                        cd="<?php echo $l['cd_hospedagem']; ?>"
                        imagem="<?php echo $l['url_imagem_hospedagem']; ?>">
                            <i class="bi bi-trash3"></i>
                        </button>
                        <button class="btn btn-primary btn-sm editst"
                        data-toggle="modal"
                        data-target="#editst"
                        title="editarst"
                        cd="<?php echo $l['cd_hospedagem']; ?>"
                        status="<?php echo $l['st_hospedagem']; ?>">
                            <i class="bi bi-bell"></i>
                        </button>
                    </div>
                </div>
            </div>
            <?php
            }
        }
        ?>
            </div>
            </div>

    <?php
    if(!empty($_POST)){
        if($_POST['action'] == "Cadastrar"){
            $extensao = pathinfo($_FILES['imagem']['name'],PATHINFO_EXTENSION);
            if($extensao == "png" || $extensao == "jpg" || $extensao == "jpeg" ||
            $extensao == "jfif" || $extensao == "webp"){
                $uploaddir = '../img/hospedagem/';
                if($extensao == "jpeg"){
                    $ext = strtolower(substr($_FILES['imagem']['name'],-5));
                }
                else if($extensao == "jfif"){
                    $ext = strtolower(substr($_FILES['imagem']['name'],-5));
                }
                else if($extensao == "webp"){
                    $ext = strtolower(substr($_FILES['imagem']['name'],-5));
                }
                else{
                    $ext = strtolower(substr($_FILES['imagem']['name'],-4));
                }
                $imagem = md5(date("d-m-y-h-i-s").$_FILES['imagem']['name']).$ext;
                $uploadfile = $uploaddir . basename($imagem);
                chmod($uploadfile, 0777);
                move_uploaded_file($_FILES['imagem']['tmp_name'], $uploadfile);
            
                UploadImagemHospedagem($imagem, 
                $_POST['cidade'],
                $_POST['rua'],
                $_POST['tipo'],
                $_POST['valor'],
                $_POST['parcela'],
                $_POST['entrada'],
                $_POST['saida'],
                $_POST['status'],
                "hospedagem.php"  
            );
            }
        }
        else if($_POST['action'] == "Alterar Imagem"){
            $extensao = pathinfo($_FILES['imagem']['name'],PATHINFO_EXTENSION);
            if($extensao == "png" || $extensao == "jpg" || $extensao == "jpeg" ||
            $extensao == "jfif" || $extensao == "webp"){
                $uploaddir = '../img/hospedagem/';
                if($extensao == "jpeg"){
                    $ext = strtolower(substr($_FILES['imagem']['name'],-5));
                }
                else if($extensao == "jfif"){
                    $ext = strtolower(substr($_FILES['imagem']['name'],-5));
                }
                else if($extensao == "webp"){
                    $ext = strtolower(substr($_FILES['imagem']['name'],-5));
                }
                else{
                    $ext = strtolower(substr($_FILES['imagem']['name'],-4));
                }
                $imagem = md5(date("d-m-y-h-i-s").$_FILES['imagem']['name']).$ext;
                $uploadfile = $uploaddir . basename($imagem);
                chmod($uploadfile, 0777);
                move_uploaded_file($_FILES['imagem']['tmp_name'], $uploadfile);

            EditarImagem(
                $_POST['cd'],
                $imagem,
                $pagina
            );
            }
        }
        else if($_POST['action'] == "Alterar"){
            Editar(
                $_POST['cd'],
                $_POST['cidade'],
                $_POST['rua'],
                $_POST['tipo'],
                $_POST['valor'],
                $_POST['parcela'],
                $_POST['entrada'],
                $_POST['saida'],
                $pagina
            );
        }
        else if($_POST['action'] == "Cadastrar Cidade"){
            CadastrarCidade(
                $_POST['cidade'],
                $pagina
            );
        }
        else if($_POST['action'] == "Excluir Cidade"){
            DeletarCidade(
                $_POST['cidade'],
                $pagina
            );
        }
        else if($_POST['action'] == "Alterar Status"){
            EditarStatus(
                $_POST['cd'],
                $_POST['status'],
                $pagina
            );
        }
        else if($_POST['action'] == "Excluir"){
            Delete(
                $_POST['cd'],
                $_POST['imagem'],
                $pagina
            );
        }
    }
    ?>

</body>