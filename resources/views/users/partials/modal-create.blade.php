<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Creaciòn de usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form enctype="multipart/form-data" method="POST" action="{{route('users.store')}}">
        {{ csrf_field() }}
      <div class="modal-body">
          <div class="form-group">
            <label for="NameInput">Nombre</label>
            <input type="text" class="form-control" name="name" id="NameInput" placeholder="ingresa tu nombre completo">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Correo electronico</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Ingresa tu correo electronico">
            <small id="emailHelp" class="form-text text-muted">Importante que no te hayas registrado antes con el mismo correo</small>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Confirmar contraseña:</label>
              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
          </div>

          <div class="form-group">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="inputGroupSelect01">Roles</label>
                </div>
                <select name="role" class="custom-select" id="inputGroupSelect01">
                  @foreach($roles as $role)
                    <option value="{{$role->name}}">{{$role->name}}</option>
                  @endforeach
                </select>
              </div>
          </div>
          <div class="form-group">
            <label for="exampleFormControlFile1">Foto</label>
            <input name="photo" type="file" accept="img/*" class="form-control-file" id="image" />
            
          </div>       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar pestaña</button>
        <button type="submit" class="btn btn-success">Registrar usuario</button>
      </div>
    </form>
    </div>
  </div>
</div>