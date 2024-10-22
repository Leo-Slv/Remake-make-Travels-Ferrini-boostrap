
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

<!-- Modal de Upload!-->
<div class="modal fade" id="upload" data-backdrop="static">
    <div class="modal-dialog modal-md div modal-content">
        <form method="post" enctype="multipart/form-data" class="form-group">
            <div class="modal-header">
                Upload Pacote
            </div>
            <div class="modal-body">
                <input type="file" name="imagem" class="form-control">
                <br>
                <label>Cidade</label>
                <select name="cidade" class="form-control">
                    <?php foreach ($cidades as $cidade): ?>
                        <option value="<?php echo $cidade['cd_cidade']; ?>">
                            <?php echo $cidade['nm_cidade']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <br>
                <Textarea name="periodo" class="form-control" rows="2" placeholder="Periodo"></Textarea>
                <br>
                <Textarea name="acomodacao" class="form-control" rows="3" placeholder="Descrição da Acomodação"></Textarea>
                <br>
                <input type="number" name="valor" class="form-control" rows="1" placeholder="Valor do Pacote"></input>
                <br>
                <label> Quantidade de Parcelas</label>
                <select name="parcela" class="form-control" placeholder="Quantidade de Parcelas">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                    <option>7</option>
                    <option>8</option>
                    <option>9</option>
                    <option>10</option>
                </select>
                <br>
                <select name="status" class="form-control">
                    <option value="1">ativo</option>
                    <option value="0">inativo</option>
                </select>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dimiss="modal">
                    Fechar
                </button>
                <input type="submit" class="btn btn-primary" name="action" value="Cadastrar">
            </div>
        </form>
    </div>
</div>

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

<!-- Modal de edit!-->
<div class="modal fade" id="edit" data-backdrop="static">
    <div class="modal-dialog modal-md div modal-content">
        <form method="post" enctype="multipart/form-data" class="form-group">
            <div class="modal-header">
                Editar Pacote
            </div>
            <div class="modal-body">
                <Textarea name="cd" id="cd" class="form-control" rows="1" placeholder="Código do pacote"readonly="readonly"></Textarea>
                <br>
                <label>Cidade</label>
                <select name="cidade" class="form-control">
                    <?php foreach ($cidades as $cidade): ?>
                        <option value="<?php echo $cidade['cd_cidade']; ?>">
                            <?php echo $cidade['nm_cidade']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <br>
                <Textarea name="periodo" id="periodo" class="form-control" rows="2" placeholder="Periodo"></Textarea>
                <br>
                <Textarea name="acomodacao" id="acomodacao" class="form-control" rows="3" placeholder="Descrição da Acomodação"></Textarea>
                <br>
                <label> Valor do pacote</label>
                <input type="number" name="valor" id="valor" class="form-control" rows="1" placeholder="Valor do Pacote"></input>
                <br>
                <label> Quantidade de Parcelas</label>
                <select name="parcela" id="parcela" class="form-control" placeholder="Quantidade de Parcelas">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                    <option>7</option>
                    <option>8</option>
                    <option>9</option>
                    <option>10</option>
                </select>
                <br>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dimiss="modal">
                    Fechar
                </button>
                <input type="submit" class="btn btn-info" name="action" value="Alterar">
            </div>
        </form>
    </div>
</div>

<!-- Modal de delete!-->
<div class="modal fade" id="delete" data-backdrop="static">
    <div class="modal-dialog modal-md div modal-content">
        <form method="post" enctype="multipart/form-data" class="form-group">
            <div class="modal-header">
                Excluir 
            </div>
            <div class="modal-body">
                <input type="text" name="cd" class="form-control" id="cd" readonly="readonly">
                <br>
                <input type="text" name="imagem" id="imagem" class="form-control">
                    <h4 class="text-danger font-weight-bolder">
                        Deseja realmente exlcuir este item?
                    </h4>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dimiss="modal">
                    Fechar
                </button>
                <input type="submit" class="btn btn-danger" name="action" value="Excluir">
            </div>
        </form>
    </div>
</div>

<!-- Modal de editimagem!-->
<div class="modal fade" id="editimg" data-backdrop="static">
    <div class="modal-dialog modal-md div modal-content">
        <form method="post" enctype="multipart/form-data" class="form-group">
            <div class="modal-header">
                Editar Imagem do Pacote
            </div>
            <div class="modal-body">
                <Textarea name="cd" id="cd" class="form-control" rows="1" placeholder="Código do pacote" readonly="readonly"></Textarea>
                <br>
                <input type="file" name="imagem" class="form-control">
                <br>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dimiss="modal">
                    Fechar
                </button>
                <input type="submit" class="btn btn-info" name="action" value="Alterar Imagem">
            </div>
        </form>
    </div>
</div>

<!-- Modal de editstatus!-->
<div class="modal fade" id="editst" data-backdrop="static">
    <div class="modal-dialog modal-md div modal-content">
        <form method="post" enctype="multipart/form-data" class="form-group">
            <div class="modal-header">
                Editar Status do Pacote
            </div>
            <div class="modal-body">
                <Textarea name="cd" id="cd" class="form-control" rows="1" placeholder="Código do pacote" readonly="readonly"></Textarea>
                <br>
                <select name="status" id="status" class="form-control">
                    <option value="1">ativo</option>
                    <option value="0">inativo</option>
                </select>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dimiss="modal">
                    Fechar
                </button>
                <input type="submit" class="btn btn-info" name="action" value="Alterar Status">
            </div>
        </form>
    </div>
</div>