<template>
  <div id="app" class="contenedordeformularios">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <h1
      style="margin-bottom:40px; text-align: center;"
    >Registro de casos para la resolución de conflictos</h1>
    <!--  -->
    <form method="POST" @submit.prevent="guardarFormularioG()" id="formCaso">
      <h4 style="margin-bottom:40px; text-align: center;">Registro No.</h4>
      <input type="hidden" name="_token" :value="csrf" />

      <div class="contenedorGeneral">
        <label for>Estado del caso:</label>
        <select name="estado" class="redondear">
          <option value="" disabled selected>Seleccione</option>
          <option value="Iniciado">Iniciado</option>
          <option value="Conciliado">Conciliado</option>
          <option value="No acuerdo">No acuerdo</option>
          <option value="Resuelto">Resuelto</option>
        </select>
        <!-- <div class="seleccione" id="contenedor">
          <div class="formulario">
            <div>
              <input type="radio" v-model="rem" value="1" name="remitido" />Si
            </div>
            <p></p>
            <div>
              <input type="radio" v-model="rem" value="0" name="remitido" />No
            </div>
          </div>
        </div> -->
        <!-- <div class="contenedorGeneral" v-if="rem==1"> -->
        <div class="contenedorGeneral">
          <label class="derecha" for="remitido_a">Remitido a :</label>
          <input
          class="redondear"
            type="text"
            list="remitidoA"
            name="remitir_aInput"
            placeholder="Seleccione o escriba"
            v-model="newRemision"
            @change="guardarRem()"
          />
          <datalist id="remitidoA">
            <option v-for="r in remitidoArray" :key="r.id">{{r.nombre}}</option>
          </datalist>
          <input
            type="hidden"
            name="nombre_remision_input"
            v-model="newRemision_name_input"
            required
          />
        </div>
      </div>

      <!-- ************************************************Motivo******************************************************************** -->

      <h4 style="margin-top:40px; text-align: center;">Motivo</h4>
      <div class="formulario">
        <div class="izquierda">
          <h5>Ocurrencia de los hechos :</h5>

          <div class="contenedorGeneral">
            <label for>País :</label>
            <select
              name="pais_motivo"
              class="redondear"
              ref="idPaisValue"
              v-model="paisSelect"
              required
            >
              <option value selected>Seleccione</option>
              <option v-for="p in PaisArray" :key="p.id" v-bind:value="p.id">{{p.nombre}}</option>
            </select>
          </div>

          <div class="contenedorGeneral">
            <label for>Departamento :</label>
            <select
              name="depto_motivo"
              id="depto_hechos"
              class="redondear"
              ref="idDeptoValue"
              v-model="deptoSelect"
              required
            >
              <option value selected>Seleccione</option>
              <option
                v-for="d in DeptoArray"
                :key="d.id"
                v-bind:value="d.id"
                v-if="d.id_pais===paisSelect"
              >
                <p>{{d.nombre}}</p>
              </option>
            </select>
          </div>

          <div class="contenedorGeneral">
            <label for>Ciudad :</label>
            <select name="ciudad_motivo" id="ciud_hechos" class="redondear" required>
              <option value selected>Seleccione</option>
              <option
                v-for="c in CiudArray"
                :key="c.id"
                v-bind:value="c.id"
                v-if="c.id_departamento===deptoSelect"
              >{{c.nombre}}</option>
            </select>
          </div>
        </div>

        <div class="vl"></div>

        <div class="derecha">
          <div class="contenedorGeneral">
            <label for>Tipo de motivo :</label>
            <input
              type="text"
              list="TmotivoList"
              name="TmotivoInput"
              @change="guardarTmotivo()"
              placeholder="Escriba o seleccione"
              v-model="newMotivo"
              class="redondear"
              required
            />
            <datalist id="TmotivoList">
              <option v-for="Tm in TipoMotivoArray" :key="Tm.id">{{Tm.nombre}}</option>
            </datalist>
            <input
              type="hidden"
              name="nombre_TipoMotivo_input"
              v-model="newMotivo_name_input"
              required
            />
          </div>
          <!-- <div class="contenedorGeneral">
            <label for>¿Comisión de delito?</label>
            <div style="margin-top:10px;" class="seleccione">
              <input type="radio" value="1" v-model="delito" name="com_delito" />Si
              <br />
              <input type="radio" value="0" v-model="delito" name="com_delito" />No
              <br />
            </div>
          </div> -->
          <!-- <div v-if="delito== 1"> -->
          <div>
            <div class="contenedorGeneral">
              <label for>Tipo de delito :</label>
              <input
                type="text"
                list="delitoList"
                name="tipo_delitoInput"
                @change="guardarDel()"
                placeholder="Escriba o seleccione"
                v-model="newDelito"
                class="redondear"
                required
              />
              <datalist id="delitoList">
                <option v-for="d in delitoArray" :key="d.id">{{d.nombre}}</option>
              </datalist>
              <input type="hidden" name="id_delito_input" v-model="newDelito_name_input" required />
            </div>
          </div>
        </div>
      </div>

      <!-- ************************************************Involucrado******************************************************************** -->

      <div v-if="estadoInv">
        <div class="contenedorGeneral" v-for="(inv) in InvolucradoArray" :key="inv">
          <Involucrado></Involucrado>
        </div>
      </div>

      <p style="color:red">
        <i class="material-icons" style="color:red">notification_important</i>
        Estimado ususario, asegúrese de indicar la cantidad de Involucrados correctos antes de diligenciar los campos
      </p>
      <div class="dos">
        <input
          type="number"
          placeholder="Número de involucrados"
          v-model="no_inv"
          class="redondear"
        />
        <button class="buttonA" @click="invdosTrue()" @focus="estadoInv=false">
          <i class="material-icons">person_add</i>
        </button>
      </div>

      <!-- ******************************************************cita*********************************************************************** -->
      <div class="contenedorGeneral" v-if="!estadoCita">
        <button class="buttonA" @focus="estadoCita=true">
          <i class="material-icons" style="font-size:15px">add</i>
          Generar citacion
        </button>
      </div>

      <div class="contenedorGeneral" v-if="estadoCita">
        <div class="dos">
          <p></p>
          <button class="boton_simple" @click="estadoCita=false">
            <i class="material-icons">clear</i>
          </button>
        </div>
        <Cita></Cita>
      </div>
        <div class="contenedorGeneral">
          <h5>Observaciones :</h5>
          <textarea
            name="observaciones"
            class="textarea"
            cols="30"
            rows="10"
            placeholder="Escriba un texto corto"
          ></textarea>
        </div>


      <div class="formulario">
        <router-link to="/RegistroC" class="buttonA" style="text-align: center;">Atrás</router-link>
        <div></div>
        <button class="buttonN" style="text-align: center;">
          <span
            class="spinner-border spinner-border-sm"
            role="status"
            aria-hidden="true"
            v-if="spinner"
            style="color:#ffff"
          ></span>
          <!-- <span class="sr-only">Loading...</span> -->
          Guardar
        </button>
      </div>
      <!-- </div> -->
    </form>
  </div>
</template>

<script>
import Involucrado from "./Involucrado.vue";
import Cita from "./Cita.vue";
export default {
  components: {
    Involucrado,
    Cita
  },
  name: "RegistroCaso",

  data() {
    return {
      spinner: false,
      remitidoArray: [],
      InvolucradoArray: [],
      delitoArray: [],
      TipoMotivoArray: [],
      PaisArray: [],
      paisSelect: "",
      DeptoArray: [],
      deptoSelect: "",
      CiudArray: [],
      estadoInv: false,
      estadoCita: false,
      newDelito: "",
      newRemision: "",
      newMotivo: "",

      newRemision_name_input: "",
      newDelito_name_input: "",
      newMotivo_name_input: "",
      no_inv: "",
      rem: "",
      delito: "",
      otro: "",
      remision: "",
      documento: "",
      // cita: false,
      cte: false,
      cdo: false,
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content")
    };
  },
  methods: {
    invdosTrue: function() {
      this.InvolucradoArray.length = this.no_inv;
      this.estadoInv = true;
      //  console.log(this.InvolucradoArray);
    },
    paisGet: function() {
      //console.log('hola');
      var url = "pais";
      axios.get(url).then(Response => {
        this.PaisArray = Response.data;
      });
    },
    // pintarPais: function(){
    //   this.seleccionado = this.$refs.idPaisValue.value;
    // },
    deptoGet: function() {
      //console.log('hola');
      var urlRem = "depto";
      axios.get(urlRem).then(Response => {
        this.DeptoArray = Response.data;
      });
    },
    ciudadGet: function() {
      //console.log('hola');
      var urlRem = "ciudad";
      axios.get(urlRem).then(Response => {
        this.CiudArray = Response.data;
      });
    },
    remisionGet: function() {
      //console.log('hola');
      var urlRem = "remision";
      axios.get(urlRem).then(Response => {
        this.remitidoArray = Response.data;
      });
    },
    delitoGet: function() {
      //console.log('hola');
      var urlDel = "tDelito";
      axios.get(urlDel).then(Response => {
        this.delitoArray = Response.data;
      });
    },
    TipoMotivoGet: function() {
      //console.log('hola');
      var urlTmot = "tipo_motivo";
      axios.get(urlTmot).then(Response => {
        this.TipoMotivoArray = Response.data;
      });
    },
    guardarDel: function() {
      for (var i in this.delitoArray) {
        if (this.delitoArray[i].nombre == this.newDelito) {
          this.newDelito_name_input = this.delitoArray[i].id;
          console.log("if");
          return this.newDelito_name_input;
        }
      }
      return this.newDelito_name_input;
    },
    guardarTmotivo: function() {
      for (var i in this.TipoMotivoArray) {
        if (this.TipoMotivoArray[i].nombre == this.newMotivo) {
          this.newMotivo_name_input = this.TipoMotivoArray[i].id;
          console.log("if");
          return this.newMotivo_name_input;
        }
      }
      return (this.newMotivo_name_input = null);
    },
    guardarRem: function() {
      for (var i in this.remitidoArray) {
        if (this.remitidoArray[i].nombre == this.newRemision) {
          this.newRemision_name_input = this.remitidoArray[i].id;
          console.log("if");
          return this.newRemision_name_input;
        }
      }
      return (this.newRemision_name_input = null);
    },
    guardarFormularioG: function() {
      if(this.rem === 0){
        this.newRemision_name_input = 1;
      }
      if(this.delito === 0){
        this.newDelito_name_input = 10;
      }
      var urlForm = "registro_caso";
      const formu = document.getElementById("formCaso");
      var datos = new FormData(formu);
      // console.log(datos.get('ciudad_motivo'));

      axios
        .post(urlForm, datos)
        .then(result => {
          console.log("respuesta vue: ", result);
        })
        .catch(err => {
          console.log("Error vue: ", err);
          // this.msgFalse=true;
        });
    }
  },
  created: function() {
    this.remisionGet();
    this.delitoGet();
    this.TipoMotivoGet();
    this.paisGet();
    this.deptoGet();
    this.ciudadGet();
  }
};
</script>

<style lang="scss" scoped>
</style>