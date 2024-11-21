<div class="modal fade" id="modal-rol" tabindex="-1" aria-labelledby="modalRol" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalRol">Nuevo Rol</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formRol">
                    <div class="mb-3">
                        <input type="text" class="form-control" id="rodescripcion" name="rodescripcion" placeholder="Descripción del Rol" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- NUEVO MODAL AGREGAR MENU -->
<?php
$obj = new ABMRol();
$roles = $obj->buscar("");
?>
<div class="modal fade" id="modal-menu" tabindex="-1" aria-labelledby="modal-menu" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-menu">Nuevo Menú</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formulario-menu">
                    <div class="mb-3">
                        <label for="usmail" class="form-label">Nombre del nuevo Menú</label>
                        <input type="text" class="form-control" id="menombre" name="menombre" required>

                    </div>
                    <div class="mb-3">
                    <label for="itemRol" class="form-label">Tipo Rol</label>
                    <select class="form-select" id="idrol" name="idrol" required>
                        <option value="" disabled>Seleccione un rol</option>
                        <?php foreach ($roles as $rol): ?>
                            <option value="<?php echo $rol->getIdRol(); ?>">
                                <?php echo $rol->getRoDescripcion(); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                    <button type="submit" class="btn btn-success">Agregar</button>
                </form>
            </div>
        </div>
    </div>
</div>
