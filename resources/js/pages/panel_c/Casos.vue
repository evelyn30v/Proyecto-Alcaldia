<template>
  <div class="contenedordeformularios">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <div class="tituloInicial">
      <h1>Casos</h1>
    </div>
    <!-- <div class="contenedor"> -->
    <form class="busqueda" action>
      <input type="hidden" name="_token" :value="csrf" />
      <div class="delgado">
        <input
          type="text"
          placeholder="Buscar..."
          name="search"
          style="margin:0px;"
          v-model="newBuscar"
        />
        <select
          class="search buscar_por"
          style="margin: 0px"
          v-model="searchValue"
          @click="estadoBuscar=false"
        >
          <Option disabled value class="buscar_por">Buscar por :</Option>
          <Option value="1" style="color:#f0f0f0">Fecha</Option>
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
              <h5>Involucrado</h5>
              <h5>Documento</h5>
            </th>
            <th colspan="5">&nbsp;</th>
          </tr>
        </thead>
        <!-- <tbody v-if="casosFilter && casosFilter.length || involucradoFilter && involucradoFilter.length "> -->
        <tbody v-if="casosFilter && casosFilter.length">
          <tr v-for="c in casos" :key="c.id">
            <div v-for="(caso) in casosFilter" :key="caso.id">
              <div v-if="caso.id_registro_caso===c.id">
                <td width="10px">{{c.id}}</td>
                <td width="200px">{{c.created_at}}</td>
                <td width="250px">{{caso.nombre}}</td>
                <td width="200px">{{caso.no_documento}}</td>
                <td>
                  <a
                    width="50px"
                    href="#"
                    class="btnVer"
                    @click="estadoVer=true; capturaridcasoTabla(c.id)"
                    data-toggle="modal"
                  >Ver</a>
                </td>
                <td>
                  <a
                    v-if="caso.id_registro_caso===c.id"
                    href="#"
                    class="btnModificar"
                    @click="estadoCita=true; capturaridcasoTabla(c.id)"
                    data-toggle="modal"
                  >Citaciones</a>
                </td>
              </div>
            </div>
            <!-- <td>
              <div v-for="c in casos" :key="c.id">
                <h6 width="10px" v-if="caso.id_registro_caso===c.id">{{c.id}}</h6>
              </div>
            </td>
            <td>
              <div v-for="c in casos" :key="c.id">
                <h6 width="10px" v-if="caso.id_registro_caso===c.id">{{c.created_at}}</h6>
              </div>
            </td>
            <td>
              <div v-for="(c) in casos" :key="c.id">
                <h6  width="300px" v-if="caso.id_registro_caso===c.id">{{caso.nombre}}</h6>
            </div>
            </td>
            <td>
              <div v-for="(c) in casos" :key="c.id">
                <h6  width="300px" v-if="caso.id_registro_caso===c.id">{{caso.no_documento}}</h6>
            </div>
            </td>
            <td>
              <div v-for="(c) in casos" :key="c.id">
              <a v-if="caso.id_registro_caso===c.id"
                href="#"
                class="btnVer"
                @click="estadoVer=true; capturaridcasoTabla(c.id)"
                data-toggle="modal"
              >Ver</a>
              </div>
            </td>
            <td>
              <div v-for="(c) in casos" :key="c.id">
              <a v-if="caso.id_registro_caso===c.id"
                href="#"
                class="btnModificar"
                @click="estadoCita=true; capturaridcasoTabla(c.id)"
                data-toggle="modal"
              >Citaciones</a>
              </div>
            </td>
            <td>
              <a href="#" class="btnEliminar">Eliminar</a>
            </td>-->
          </tr>
        </tbody>
        <div class="text-center" v-else>
          <h4>No se encontraron resultados...</h4>
        </div>
      </table>
    </div>
    <!-- ********************************************************Ver********************************************************************************             -->
    <div v-if="estadoVer">
      <button type="button" class="close nuevocerrar" @click="estadoVer=false">
        <span>&times;</span>
      </button>
      <casos :idcaso="idCasoTabla"></casos>
    </div>
    <!-- **********************************************************citaciones***************************************************************************** -->
    <div v-if="estadoCita">
      <button type="button" class="close nuevocerrar" @click="estadoCita=false">
        <span>&times;</span>
      </button>
      <citaciones :idcaso="idCasoTabla"></citaciones>
    </div>
    <!-- </div> -->
  </div>
</template>

<script>
import casos from "../ver/VerCaso.vue";
import citaciones from "../ver/Citaciones.vue";
import { log } from "util";
export default {
  components: {
    casos,
    citaciones
  },
  data() {
    return {
      estadoBuscar: true,
      id_caso: "",
      created_at_caso: "",
      nombre_inv: "",
      apellido_inv: "",
      cc_inv: "",

      searchValue: "",
      casos: [],
      involucrados: [],
      inv_casos: [],
      idCasoTabla: "",
      idInvTabla: "",
      estadoVer: false,
      estadoCita: false,
      estadoMod: false,
      newBuscar: "",
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content")
    };
  },
  methods: {
    casosView: function() {
      var url = "registro_caso";
      axios.get(url).then(Response => {
        this.casos = Response.data;
      });
    },
    InvolucradosView: function() {
      var urlsolic = "involucrado";
      axios.get(urlsolic).then(Response => {
        this.involucrados = Response.data;
      });
    },

    deleteSolic: function(solicitudes) {
      alert("¿Está seguro de borrar la solicitud " + solicitudes.id + "?");
      var urlDeleteSolic = "solicitudRgistro/" + solicitudes.id;
      axios.delete(urlDeleteSolic).then(Response => {
        this.solicitudesView();
      });
    },
    capturaridcasoTabla: function(id, id2) {
      this.idCasoTabla = id;
      this.idInvTabla = id2;
      // console.log(this.idSolicTabla);
      // console.log(this.idSolic_Tabla);
    }
  },
  computed: {
    casosFilter: function() {
      var textSearch = this.newBuscar;

      if (this.searchValue == 1) {
        return this.involucrados.filter(function(el) {
          return (
            el.created_at.toLowerCase().indexOf(textSearch.toLowerCase()) !== -1
          );
        });
      } else if (this.searchValue == 2) {
        return this.involucrados.filter(function(el) {
          return (
            el.nombre.toLowerCase().indexOf(textSearch.toLowerCase()) !== -1
          );
        });
      } else if (this.searchValue == 3) {
        return this.involucrados.filter(function(el) {
          return (
            el.no_documento.toLowerCase().indexOf(textSearch.toLowerCase()) !==
            -1
          );
        });
      } else if (!this.searchValue) {
        return this.involucrados.filter(function(el) {
          return (
            el.nombre.toLowerCase().indexOf(textSearch.toLowerCase()) !== -1
          );
        });
      }
    }
  },
  created: function() {
    this.InvolucradosView();
    this.casosView();
  }
};
</script>

<style lang="scss" scoped>
</style>