<?php
require_once 'header.php';
require_once './carousel/function.php';
require_once './carousel/modal.php';
require_once './carousel/script.php';


?>

<body>
    <?php require_once 'nav.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10">
                <h3 class="font-weight-bolder">
                    Imagens - carousel
                </h3>
            </div>
            <div class="col-sm-2">
                <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#upload">
                    + Imagem
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
                <img src="../img/carousel/<?php echo $l['url_imagem_carousel'];?>" 
                alt="" class="card-img img-fluid">
                <div class="card-footer text-center">
                        <button class="btn btn-danger">
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
                $uploaddir = '../img/carousel/';
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
                move_uploaded_file($_FILES['imagem']['tmp_name'], $uploadfile);
            
                UploadImagemCarousel($imagem, 
                $_POST['descricao'],
                $_POST['status'],
                "carousel.php"  
            );
            }
        }
    }
    ?>

</body>