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
    </div>

</body>