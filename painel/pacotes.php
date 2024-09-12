<?php
require_once 'header.php';
require_once './pacotes/function.php';
require_once './pacotes/modal.php';
require_once './pacotes/script.php';


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
                    Informações - Pacotes
                </h3>
            </div>
            <div class="col-sm-2">
                <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#upload">
                    + Pacotes
                </button>
            </div> 
        </div>
        <div class='row'>
            <?php
            $listar = ListarImagem();
            if($listar){
                foreach($listar as $l){
                    if($l['st_pacote'] == "1"){
                        $badge = 'badge-success';
                        $flag = 'ativo';
                    }
                    else{
                        $badge = 'badge-danger';
                        $flag = 'inativo';
                    }
            ?>
            <!--HTML -->
            <div class="col-sm-3">
            <div class="card">
                <img src="../img/pacotes/<?php echo $l['url_imagem_pacote'];?>" 
                alt="" class="card-img img-fluid">
                <div class="card-body">
                    <span class="badge <?php echo $badge;?>">
                        <?php echo $flag; ?>
                    </span>
                    <strong>Destino:
                    <?php echo $l['nm_destino_pacote']; ?>
                    </strong>
                    <br>
                    <strong>Periodo:
                    <?php echo $l['ds_periodo']; ?>
                    </strong>
                    <br>
                    <strong>Acomodação:
                    <?php echo $l['ds_acomodacao']; ?>
                    </strong>
                    <br>
                    <strong>Quantidade de Parcelas:
                    <?php echo $l['qt_parcela_pacote']; ?>x
                    </strong>
                    <br>

                </div>
                <div class="card-footer text-center">
                        <button class="btn btn-Warning btn-sm edit"
                        data-toggle="modal"
                        data-target="#editimg"
                        title="editarimg"
                        cd="<?php echo $l['cd_pacote']; ?>"
                        imagem="<?php echo $l['url_imagem_pacote']; ?>">
                            <i class="bi bi-card-image"></i>
                        </button>
                        <button class="btn btn-info btn-sm edit"
                        data-toggle="modal"
                        data-target="#edit"
                        title="editar"
                        cd="<?php echo $l['cd_pacote']; ?>"
                        destino="<?php echo $l['nm_destino_pacote'];?>"
                        periodo="<?php echo $l['ds_periodo'];?>"
                        acomodacao="<?php echo $l['ds_acomodacao'];?>"
                        parcela="<?php echo $l['qt_parcela_pacote'];?>"
                        status="<?php echo $l['st_pacote']; ?>">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-danger delete"
                        data-toggle="modal"
                        data-target="#delete"
                        title="excluir"
                        cd="<?php echo $l['cd_pacote']; ?>"
                        imagem="<?php echo $l['url_imagem_pacote']; ?>">
                            <i class="bi bi-trash3"></i>
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
            if($extensao == "png" || $_extensao == "jpg" || $extensao == "jpeg" ||
            $extensao == "jfif" || $extensao == "webp"){
                $uploaddir = '../img/pacotes/';
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
            
                UploadImagemPacote($imagem, 
                $_POST['destino'],
                $_POST['periodo'],
                $_POST['acomodacao'],
                $_POST['parcela'],
                $_POST['status'],
                "pacotes.php"  
            );
            }
        }
        else if($_POST['action'] == "Alterar Imagem"){
            $extensao = pathinfo($_FILES['imagem']['name'],PATHINFO_EXTENSION);
            if($extensao == "png" || $_extensao == "jpg" || $extensao == "jpeg" ||
            $extensao == "jfif" || $extensao == "webp"){
                $uploaddir = '../img/pacotes/';
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
                $_POST['destino'],
                $_POST['periodo'],
                $_POST['acomodacao'],
                $_POST['parcela'],
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