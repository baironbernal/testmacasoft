<template>
  <v-table :data="users" class="table table-dark" >
    <thead slot="head">
        <th>Nombre completo</th>
        <th>Email</th>
        <th>Fecha de creado</th>
        <th>Rol</th>
    </thead>
    <tbody slot="body" slot-scope="{displayData}">
        <tr v-for="(user, index) in users" :key="user.id">
          <td>{{ user.name }}</td>
          <td>{{ user.email }}</td>
          <td>{{ user.created_at }}</td>
          <td v-for="role in user.roles">
           <span>
            {{role.name}} 
           </span>
          </td>
          <td>
            <button class="btn btn-success">
                Editar
            </button>
          </td>
          <td>
            <button v-if="users.length > 1" class="btn btn-warning" 
              @click="deleteUser(user.id, index)">
                Eliminar
            </button>
          </td>
        </tr>
    </tbody>
  </v-table>
</template>

<script>
    export default {
        data() {
            return {
                users: [],
            }
        },
        mounted() {
            //toastr.success('Nuevo tag creado');
            axios.get('users')
                .then(response => {this.users = response.data.users});
            },
        methods:{
            deleteUser: function(id, index) {
                axios.get('users/delete/' + id)
                  .then(response => {
                    var status = response.data.status;
                    if (status == 200) {
                      toastr.success('Tag eliminado');  
                    }
                    else {
                      toastr.error('Algo ha ocurrido mal :(');  
                    }
                  });
            }          
        }

    }
</script>
