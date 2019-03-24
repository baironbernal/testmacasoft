<!-- Modal -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crear rol</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form enctype="multipart/form-data" method="POST" action="{{route('roles.store')}}">
        {{ csrf_field() }}
      <div class="modal-body">
          <div class="form-group">
            <label for="RoleInput">Nombre de rol:</label>
            <input type="text" class="form-control" name="name" id="RoleInput" placeholder="ingresa el nombre del rol">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar pestaña</button>
        <button type="submit" class="btn btn-success">Registrar role</button>
      </div>
    </form>
    </div>
  </div>
</div>