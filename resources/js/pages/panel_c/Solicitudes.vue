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
        <input type="text" placeholder="Search.." name="search" />
        <button type="submit" class="search" style="margin: 0px">
          <i class="material-icons" style="color:white">search</i>
        </button>
      </div>
    </form>
    <div class="contenedor" id="solicitudes, solicitante">
      <table class="table table-hover table-sprite">
        <thead>
          <tr>
            <th>No.</th>
            <th>Fecha</th>
            <th>Solicitante</th>
            <th colspan="5">&nbsp;</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for=" (sl) in solicitud" :key="sl.id">
            <td>{{sl.id}}</td>
            
            <td>{{sl.created_at}}</td>
            <div v-for="sol in solicitantes" :key="sol.id" style="width:300px; margin:0px">
              <td v-if="sl.id_solicitante==sol.id" style="width:400px" >{{sol.nombre}} {{sol.apellido}} {{solicitante_varg = sol.id}}</td>
              <!--  -->
            </div>
            <td>
              <a
                href="#"
                @click="estadoVer=true; capturaridSolTabla(sl.id)"
                class="btnVer"
                data-toggle="modal"
              >Ver</a>
            </td>
            <td>
            <div v-for="soli in solicitantes" :key="soli.id">
              <a v-if="sl.id_solicitante==soli.id" href="#" class="btnModificar" @click="estadoMod=true;capturaridSolTabla(sl.id, soli.id);" data-toggle="modal"
                data-target="#VerMod">Modificar</a>
                </div>
            </td>
            <td>
              <a href="#" class="btnEliminar" v-on:click.prevent="deleteSolic(solicitudes)">Eliminar</a>
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
      <VerSol :idsolic="idSolicTabla" ></VerSol>
    </div>
    <!-- ********************************************************Modificar***************************************************************************             -->
    <div v-if="estadoMod">
      <button type="button" class="close nuevocerrar" @click="estadoMod=false">
        <span>&times;</span>
      </button>
      <ModSol :idsolic="datosArray" :idsolicitanteT="idSolic_Tabla"></ModSol>
    </div>
  </div>
</template>

<script>
import VerSol from "../ver/VerSolicitudes.vue";
import ModSol from "../modificar/ModificarSolicitud.vue";
export default {
  components: {
    VerSol,
    ModSol,
  },
  data() {
    return {
      solicitud: [],
      solicitantes: [],
      idSolicTabla: "",
      idSolic_Tabla: "",
      estadoVer: false,
      estadoMod: false,
      solicitante_varg: '',
      datosArray: [],
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content")
    };
  },
  methods: {
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
      var urlsolic = "solicitudRgistro" ;
      axios.get(urlsolic).then(Response => {
        this.solicitud = Response.data;
      });
    },

    solicitudesView2: function() {
      var urlsolic = "solicitudRgistro/"+1;
      axios.get(urlsolic).then(Response => {
        //this.solicitud = Response.data;        
        //this.datosArray = Response.data;
        for (var i in this.datosArray) {
          i = Response.datosArray;  
        }
        console.log(this.datosArray);
        
      });
    },
    capturaridSolTabla: function(id, id2) {
      this.idSolicTabla = id;
      this.idSolic_Tabla = id2;
      console.log(this.idSolicTabla);
      console.log(this.idSolic_Tabla);
      this.solicitudesView2();
    },

    deleteSolic: function(solicitudes) {
      alert("¿Está seguro de borrar la solicitud " + solicitudes.id + "?");
      var urlDeleteSolic = "solicitudRgistro/" + solicitudes.id;
      axios.delete(urlDeleteSolic).then(Response => {
        this.solicitudesView();
      });
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