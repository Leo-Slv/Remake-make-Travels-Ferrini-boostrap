<?php

require_once '../conect.php';

$sql = "SELECT cd_cidade, nm_cidade FROM tb_cidade";
$result = $con->query($sql);

$cidades = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $cidades[] = $row;
    }
}


?>

<!-- Modal de UploadCidade! -->
<div class="modal fade" id="uploadCidade" data-backdrop="static">
    <div class="modal-dialog modal-md div modal-content">
        <form method="post" enctype="multipart/form-data" class="form-group">
            <div class="modal-header">
                Upload Cidade
            </div>
            <div class="modal-body">
            <Textarea name="cidade" id="cidade" class="form-control" rows="1" placeholder="Insira a cidade"></Textarea>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dimiss="modal">
                    Fechar
                </button>
                <input type="submit" class="btn btn-info" name="action" value="Cadastrar Cidade">
            </div>
        </form>
    </div>
</div>


<!-- Modal de Deletar Cidade -->

<div class="modal fade" id="deleteCidade" data-backdrop="static">
    <div class="modal-dialog modal-md div modal-content">
        <form method="post" enctype="multipart/form-data" class="form-group">
            <div class="modal-header">
                Excluir 
            </div>
            <div class="modal-body">
                <label>Cidade</label>
                <select name="cidade" class="form-control">
                    <?php foreach ($cidades as $cidade): ?>
                        <option value="<?php echo $cidade['cd_cidade']; ?>">
                            <?php echo $cidade['nm_cidade']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                    <h4 class="text-danger font-weight-bolder">
                        Deseja realmente exlcuir esta cidade?
                    </h4>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dimiss="modal">
                    Fechar
                </button>
                <input type="submit" class="btn btn-danger" name="action" value="Excluir Cidade">
            </div>
        </form>
    </div>
</div>