<template>
  <div class="contenedordeformularios">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <div class="tituloInicial">
      <h1>Solicitudes</h1>
    </div>
    <!-- <div class="contenedor"> -->
    <form class="busqueda" action>
      <input type="hidden" name="_token" :value="csrf" />
      <div class="delgado" style="box-shadow: 0 6px 10px 0 rgba(13, 5, 44, 0.363)">
        <input
          type="text"
          placeholder="Buscar..."
          name="search"
          style="margin:0px;"
          v-model="newBuscar"
        />
        <select class="search buscar_por" style="margin: 0px" v-model="searchValue">
          <Option disabled value class="buscar_por">Buscar por :</Option>
          <!-- <Option value="1" style="color:#f0f0f0">Fecha</Option> -->
          <Option value="2" style="color:#f0f0f0">Nombre</Option>
          <Option value="3" style="color:#f0f0f0">Documento</Option>
          <!-- <i class="material-icons" style="color:white">search</i>-->
        </select>
      </div>
    </form>
    <div class="contenedor" id="solicitudes, solicitante">
      <table class="table table-hover table-sprite">
        <thead>
          <tr>
            <th class="cuatroTabla">
              <h5>No.</h5>
              <h5>Fecha de registro</h5>
              <h5>Solicitante</h5>
              <h5>Documento</h5>
            </th>
            <th colspan="5">&nbsp;</th>
          </tr>
        </thead>
        <tbody v-if="casosFilter && casosFilter.length">
          <tr v-for=" (sl) in casosFilter" :key="sl.id">
            <div v-for="(s) in solicitud" :key="s.id">
              <div v-if="s.id_solicitante==sl.id">
                <td width="10px">{{s.id }}</td>
                <td width="200px">{{s.created_at }}</td>
                <td v-if="sl.id===s.id_solicitante" width="250px">{{sl.nombre}} {{sl.apellido}}</td>
                <td v-if="sl.id===s.id_solicitante" width="50px">{{sl.no_documento}}</td>
                <td width="50px">
                  <a
                    v-if="s.id_solicitante==sl.id"
                    href="#"
                    @click="estadoVer=true; capturaridSolTabla(s.id)"
                    class="btnVer"
                    data-toggle="modal"
                  >Ver</a>
                </td>
                <td width="50px">
                  <a
                    v-if="s.id_solicitante==sl.id"
                    href="#"
                    class="btnModificar"
                    @click="estadoMod=true;capturaridSolTabla(s.id, sl.id);"
                    data-toggle="modal"
                    data-target="#VerMod"
                  >Modificar</a>
                </td>
                <td>
                  <a
                    href="#"
                    class="btnEliminar"
                    v-on:click.prevent="deleteSolic(s)"
                    v-if="s.id_solicitante==sl.id"
                  >Eliminar</a>
                </td>
              </div>
            </div>
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
      <VerSol :idsolic="idSolicTabla"></VerSol>
    </div>
    <!-- ********************************************************Modificar***************************************************************************             -->
    <div v-if="estadoMod">
      <button type="button" class="close nuevocerrar" @click="estadoMod=false">
        <span>&times;</span>
      </button>
      <ModSol :idsolic="idSolicTabla" :idsolicitanteT="idSolic_Tabla"></ModSol>
    </div>
  </div>
</template>

<script>
import VerSol from "../ver/VerSolicitudes.vue";
import ModSol from "../modificar/ModificarSolicitud.vue";
export default {
  components: {
    VerSol,
    ModSol
  },
  data() {
    return {
      solicitud: [],
      solicitantes: [],
      searchValue: "",
      solicitanteId: "",
      newBuscar: "",
      idSolicTabla: "",
      idSolic_Tabla: "",
      estadoVer: false,
      estadoMod: false,
      solicitante_varg: "",
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content")
    };
  },
  methods: {
    pintarsolicitantes: function() {
      for (var i in this.solicitud) {
        this.solicitanteId = this.solicitud[i].id_solicitante;
        console.log(this.solicitanteId);
      }
    },
    infoArray: function() {
      console.log("entro");
      this.solicitantes.forEach((value, index) => {
        console.log(value);
      });
    },
    solicitanteview: function() {
      var url = "solicitante";
      axios.get(url).then(Response => {
        this.solicitantes = Response.data;
        //console.log(Response.data);
        // console.log(Response.data().nombre);
        //console.log(this.solicitantes)
      });
    },
    solicitudesView: function() {
      var urlsolic = "solicitudRgistro";
      axios.get(urlsolic).then(Response => {
        this.solicitud = Response.data;
        for (var i in this.solicitud) {
          this.solicitanteId = this.solicitud[i].id_solicitante;
        }
      });
    },

    solicitudesView2: function() {
      var urlsolic = "solicitudRgistro/" + 1;
      axios.get(urlsolic).then(Response => {
        //this.solicitud = Response.data;
        //this.datosArray = Response.data;
      });
    },
    capturaridSolTabla: function(id, id2) {
      this.idSolicTabla = id;
      this.idSolic_Tabla = id2;
      // console.log(this.idSolicTabla);
      // console.log(this.idSolic_Tabla);
    },

    deleteSolic: function(solicitudes) {
      alert("¿Está seguro de borrar la solicitud " + solicitudes.id + "?");
      var urlDeleteSolic = "solicitudRgistro/" + solicitudes.id;
      axios.delete(urlDeleteSolic).then(Response => {
        this.solicitudesView();
      });
    }
  },
  computed: {
    casosFilter: function() {
      var textSearch = this.newBuscar;

      // if (this.searchValue == 1) {
      //   return this.solicitud.filter(function(el) {
      //     return (
      //       el.created_at.toLowerCase().indexOf(textSearch.toLowerCase()) !== -1
      //     );
      //   });
      // }
      if (this.searchValue == 2) {
        return this.solicitantes.filter(function(el) {
          return (
            el.nombre.toLowerCase().indexOf(textSearch.toLowerCase()) !== -1
          );
        });
      } else if (this.searchValue == 3) {
        return this.solicitantes.filter(function(el) {
          return (
            el.no_documento.toLowerCase().indexOf(textSearch.toLowerCase()) !==
            -1
          );
        });
      } else if (!this.searchValue) {
        return this.solicitantes.filter(function(el) {
          return (
            el.nombre.toLowerCase().indexOf(textSearch.toLowerCase()) !== -1
          );
        });
      }
    }
  },

  created: function() {
    this.solicitanteview();
    this.solicitudesView();
    this.infoArray();
  }
};
</script>

<style lang="scss" scoped>
</style>