<template>
    <!-- Modal -->
<div>
    <div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="editUserLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editUserLabel">Editar usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form" @submit.prevent="updateUser()" enctype="multipart/form-data">
      <div class="modal-body">
          <div class="form-group">
            <label for="NameInput2">Nombre</label>
            <input type="text" class="form-control" name="name" id="NameInput2" placeholder="ingresa tu nombre completo" :value="name">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail2">Correo electronico</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail2" placeholder="Ingresa tu correo electronico" :value="email">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword2">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword2" placeholder="Password">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword2">Confirmar contraseña:</label>
              <input id="password-confirm2" type="password" class="form-control" name="password_confirmation">
          </div>
          <div class="form-group">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="inputGroupSelect02">Sus actuales roles son: <span v-for="role in roles">{{role.name}}</span>
                  </label>
                </div>
                <select name="role" class="custom-select" id="inputGroupSelect02">
                    <option value="">Selecciona el rol</option>
                    <option v-for="item in allRoles" v-bind:value="item.name">{{item.name}}</option>
                </select>
              </div>
          </div>
          <div class="form-group">
            <label for="exampleFormControlFile1">Foto</label>
            <input name="photo" type="file" accept="img/*" class="form-control-file" id="photo" />
          </div>       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar pestaña</button>
        <button type="submit" class="btn btn-success">Actualizar usuario</button>
      </div>
    </form>
    </div>
  </div>
</div>
</div>
</template>

<script>
    export default {
        props : ['id','name','email','roles'],
        data() {
            return {
                allRoles: [],
            }
        },
        mounted() {
            axios.get('roles')
                .then(response => {this.allRoles = response.data.allRoles});
        },
        methods: {
            updateUser: function(e) {
                var id = this.id;
                var form = document.getElementById('form');
                var formData = new FormData(form);
                
                axios.put('users/'+ id , formData)
                .then((response) => {
                      //toastr.success('Registro actualizado');  
                }, (response) => {
                    // error callback
                });
            }
        }

    }
</script>
