<form action="<?= URL . 'album/add/' . $album->id ?>" method="post" enctype="multipart/form-data">
    <!-- Modal Subir Archivos -->
    <div id="subir<?= $album->id ?>" class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Subir Imagen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <!-- Campo oculto para la validación de tamaño máximo 4mb -->
                        <input type="hidden" name="MAX_FILE_SIZE" value="4000000">
                        <input type="file" name="archivos[]" multiple="multiple" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Subir</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</form>

