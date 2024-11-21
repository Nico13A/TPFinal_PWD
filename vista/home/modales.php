<!-- Modal opcion 2-->
<div class="modal fade" id="modal-inicio" name="modal-inicio" role="dialog" >
    <div class="modal-dialog d-flex justify-content-center">
        <div class="modal-content w-75">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Iniciar Sesion</h5>
            </div>
            <div class="modal-body p-4">
                <form role="form" name="formulario-inicio" id="formulario-inicio">
                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="usnombre" >Usuario</label>
                        <input type="text" name="usnombre" id="usnombre" class="form-control" />
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="uspass">Password</label>
                        <input type="password" name="uspass" id="uspass"  class="form-control" />
                    </div>
                    <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-dark me-3 btn-block">Ingresar</button>
                </form>
            </div>
            <div class="modal-footer">
          <p class="text-center mt-2">No estas registrado? <a href="../registro/registro.php" class="nav-link link-secondary fs-5 text-black">Registrar</a></p>
        </div>
        </div>
    </div>
</div>

