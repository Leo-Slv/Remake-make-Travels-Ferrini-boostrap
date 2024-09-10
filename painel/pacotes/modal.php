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
                <Textarea name='destino' class="form-control" rows="1" placeholder="Nome do Destino"></Textarea>
                <br>
                <Textarea name="periodo" class="form-control" rows="2" placeholder="Periodo"></Textarea>
                <br>
                <Textarea name="acomodacao" class="form-control" rows="3" placeholder="Descrição da Acomodação"></Textarea>
                <br>

                <select name="parcela" class="form-control" placeholder="Quantidade de Parcelas">
                    <option>1x</option>
                    <option>2x</option>
                    <option>3x</option>
                    <option>4x</option>
                    <option>5x</option>
                    <option>6x</option>
                    <option>7x</option>
                    <option>8x</option>
                    <option>9x</option>
                    <option>10x</option>
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

<!-- Modal de edit!-->
<div class="modal fade" id="edit" data-backdrop="static">
    <div class="modal-dialog modal-md div modal-content">
        <form method="post" enctype="multipart/form-data" class="form-group">
            <div class="modal-header">
                Editar Imagem
            </div>
            <div class="modal-body">
                <input type="text" name="cd" class="form-control" id="cd">
                <br>
                <Textarea name="descricao" id="descricao" class="form-control" rows="5" placeholder="descrição"></Textarea>
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
                Exlcuir 
            </div>
            <div class="modal-body">
                <input type="text" name="cd" class="form-control" id="cd">
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