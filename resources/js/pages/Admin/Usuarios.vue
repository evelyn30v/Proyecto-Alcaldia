<template>
  <div class="contenedordeformularios">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <div class="tituloInicial">
      <h1>Usuarios registrados</h1>
    </div>
    <!-- <div class="contenedor"> -->
    <form class="busqueda" action>
      <input type="hidden" name="_token" :value="csrf" />
      <div class="delgado" style="box-shadow: 0 6px 10px 0 rgba(13, 5, 44, 0.363)">
        <input type="text" placeholder="Search.." name="search" />
        <button type="submit" class="search" style="margin: 0px">
          <i class="material-icons" style="color:white">search</i>
        </button>
      </div>
    </form>
    <div class="contenedor" id="usuarioget, solicitante">
      <table class="table table-hover table-sprite">
        <thead>
          <tr>
            <th>Cédula</th>
            <th>Nombre y apellidos</th>
            <th>Dependencia</th>
            <th colspan="5">&nbsp;</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="usuarioget in userArray" :key="usuarioget.id">
            <td width="10px">{{usuarioget.cedula}}</td>
            <td width="30%">{{usuarioget.name}} {{usuarioget.apellido}}</td>
            <div v-for="dep in dependenciaArray" :key="dep.id" style="width:300px; margin:0px">
              <td v-if="usuarioget.tipo_usuario_id==dep.id" style="width:400px">{{dep.nombre}}</td>
            </div>
            <td>
              <a
                href="#"
                @click="estadoVer=true; capturaridUserTabla(usuarioget.id)"
                class="btnVer"
                data-toggle="modal"
                data-target="#VerUser"
              >Ver</a>
            </td>
            <td>
              <a
                href="#"
                @click="estadoModificar=true; capturaridUserTabla(usuarioget.id)"
                class="btnModificar"
              >Modificar</a>
            </td>
            <td>
              <a href="#" class="btnEliminar" v-on:click.prevent="deleteSolic(usuarioget)">Eliminar</a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- </div> -->
    <!-- ********************************************************Ver********************************************************************************             -->
    <div v-if="estadoVer">
      <button type="button" class="close nuevocerrar" @click="estadoVer=false">
        <span>&times;</span>
      </button>
      <VerUser :idUserTabla="idUserTabla"></VerUser>
    </div>
    <!-- ********************************************************Modificar****************************************************************************             -->
    <div v-if="estadoModificar">
      <button type="button" class="close nuevocerrar" @click="estadoModificar=false">
        <span>&times;</span>
      </button>
      <ModUser :idUser="idUserTabla"></ModUser>
    </div>
  </div>
</template>

<script>
import VerUser from "../ver/Usuario.vue";
import ModUser from "../modificar/ModificarUsuario.vue";
export default {
  components: {
    VerUser,
    ModUser
  },
  data() {
    return {
      estadoModificar: false,
      estadoVer: false,
      idUserTabla: "",
      userArray: [],
      dependenciaArray: [],
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content")
    };
  },
  methods: {
    userView: function() {
      var urlUser = "user";
      axios.get(urlUser).then(Response => {
        this.userArray = Response.data;
      });
    },
    dependenciaView: function() {
      var urlDependencia = "tipo_usuario";
      axios.get(urlDependencia).then(Response => {
        this.dependenciaArray = Response.data;
      });
    },
    capturaridUserTabla: function(id) {
      this.idUserTabla = id;
      console.log(this.idUserTabla);
    },

    deleteSolic: function(usuarioget) {
      alert(
        "¿Está seguro de borrar el usuario " +
          usuarioget.name +
          usuarioget.apellido +
          "?"
      );
      var urlDeleteUser = "user/" + usuarioget.id;
      axios.delete(urlDeleteUser).then(Response => {
        this.userView();
      });
    }
  },
  created: function() {
    this.dependenciaView();
    this.userView();
  },
  computed: {
    
  }
};
</script>

<style lang="scss" scoped>
</style>