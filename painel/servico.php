<?php
require_once 'header.php';
require_once './servico/function.php';
require_once './servico/modal.php';
require_once './servico/script.php';


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
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10">
                <h3 class="font-weight-bolder">
                    Informações - Serviços
                </h3>
            </div>
            <div class="col-sm-2">
                <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#upload">
                    + Informações
                </button>
            </div> 
        </div>
        <div class='row'>
            <?php
            $listar = ListarImagem();
            if($listar){
                foreach($listar as $l){
            ?>
            <!--HTML -->
            <div class="col-sm-3">
            <div class="card">
                <img src="../img/servico/<?php echo $l['url_imagem_servico'];?>" 
                alt="" class="card-img img-fluid">
                <div class="card-body">Nome do Serviço:
                    <?php echo $l['nm_servico']; ?>
                    <br>
                    Descrição do Serviço:
                    <?php echo $l['ds_servico']; ?>
                </div>
                <div class="card-footer text-center">
                    <button class="btn btn-info btn-sm edit"
                    data-toggle="modal"
                    data-target="#edit"
                    title="editar"
                    cd="<?php echo $l['cd_servico']; ?>"
                    nome="<?php echo $l['nm_servico']; ?>"
                    descricao="<?php echo $l['ds_servico']; ?>">
                        <i class="bi bi-pencil">
                        </i>
                    </button>
                        <button class="btn btn-danger delete"
                        data-toggle="modal"
                        data-target="#delete"
                        title="excluir"
                        cd="<?php echo $l['cd_servico']; ?>"
                        imagem="<?php echo $l['url_imagem_servico']; ?>">
                            <i class="bi bi-trash3"></i>
                        </button>
                        <button class="btn btn-Warning btn-sm editimg"
                        data-toggle="modal"
                        data-target="#editimg"
                        title="editarimg"
                        cd="<?php echo $l['cd_servico']; ?>"
                        imagem="<?php echo $l['url_imagem_servico']; ?>">
                            <i class="bi bi-card-image"></i>
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
                $uploaddir = '../img/servico/';
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
            
                UploadImagemServico($imagem, 
                $_POST['descricao'],
                $_POST['nome'],
                "servico.php"  
            );
            }
        }
        else if($_POST['action'] == "Alterar"){
            Editar(
                $_POST['cd'],
                $_POST['descricao'],
                $_POST['nome'],
                $pagina
            );
        }

        else if($_POST['action'] == "Alterar Imagem"){
            $extensao = pathinfo($_FILES['imagem']['name'],PATHINFO_EXTENSION);
            if($extensao == "png" || $extensao == "jpg" || $extensao == "jpeg" ||
            $extensao == "jfif" || $extensao == "webp"){
                $uploaddir = '../img/servico/';
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