<template>
  <div class="modalPeq">
    <div class="contenedor dialogModal" style="width:80%">
      <div class="dos">
        <h4>Citaciones:</h4>
        <a href="#" class="btncitacion" @click="g_citacion=true">Generar citación</a>
      </div>

      <div v-if="g_citacion">
        <form method="POST" @submit.prevent="guardarNewCita()" id="formCita">
          <citacion></citacion>
          <input type="hidden" name="id_caso" v-model="id_caso" />
          <div class="formulario">
            <a href="#" class="buttonA" @click="g_citacion=false;">Cerrar</a>
            <p></p>
            <button class="buttonN" style="text-align: center;">
              <span
                class="spinner-border spinner-border-sm"
                role="status"
                v-if="spinner"
                style="color:#ffff"
              ></span>
              <!-- <span class="sr-only">Loading...</span> -->
              Guardar
            </button>
          </div>
        </form>
      </div>

      <table class="table table-hover table-sprite" v-if="!g_citacion && !estadoMod">
        <thead>
          <tr>
            <th>No.</th>
            <th>Fecha expedición</th>
            <th>fecha de citación</th>
            <th>hora de citación</th>
            <th>lugar</th>
            <th>Convocante</th>
            <th>Convocado</th>
            <th colspan="5">&nbsp;</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="cit in citacionesArray" :key="cit.id" v-if="idcaso===cit.id_registro_caso">
            <td>{{cit.id}}</td>
            <td>{{cit.created_at}}</td>
            <td>{{cit.fecha}}</td>
            <td>{{cit.hora_inicio}}</td>
            <td v-for="l in lugarArray" :key="l.id" v-if="l.id===cit.id_lugar">{{l.nombre}}</td>
            <td>
              <div v-for="ctes in convocanteArray" :key="ctes.id +'cte'">
              <h6 v-if="ctes.id_citacion===cit.id">-{{ctes.nombre}}</h6>
            </div>
            </td>
            <td>
              <div v-for="cdos in convocadoArray" :key="cdos.id +'cdo'">
              <h6 v-if="cdos.id_citacion===cit.id">-{{cdos.nombre}}</h6>
            </div>
            </td>
            <td>
              <div  v-for="l in lugarArray" :key="l.id" v-if="l.id===cit.id_lugar">
                <a href="#" class="btnModificar" @click="estadoMod=true; capturarIdCita(cit.id, l.id)">Editar</a>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
      <div v-if="estadoMod">
        <!-- **************************************************************cita modificar************************************************* -->
        <h4 style="margin-top:40px; text-align: center;">Modificar citación</h4>

        <form method="PUT" @submit.prevent="updateCita()" id="updateCita">
          <input type="hidden" name="_token" :value="csrf" />
          <div class="formulario">
            <div class="izquierda">
              <div class="contenedorGeneral">
                <label for>Lugar de citación :</label>
                <input
                  type="text"
                  list="lugarList"
                  name="lugarInput_cita"
                  @change="guardarLug()"
                  placeholder="Escriba o seleccione"
                  v-model="newLugar"
                  class="redondear"
                  required
                />
                <datalist id="lugarList">
                  <option v-for="l in lugarArray" :key="l.id">{{l.nombre}}</option>
                </datalist>
                <input type="hidden" name="lugar_cita" v-model="newLugar_name_input" required />
                <input type="hidden" name="id_lugar_input_hidden" v-model="newid_lugar_input_hidden">
              </div>

              <label>Convocante(s) :</label>
              <div v-if="estado_cte">
                <div v-for="(cte,i) in convocanteArray" :key="cte[i]">
                  <input
                    type="text"
                    class="redondear"
                    placeholder="Nombre del convocante"
                    name="convocante[nombre][]"
                    required
                  />
                </div>
              </div>

              <div class="dos">
                <input
                  type="number"
                  class="redondear"
                  v-model="no_ctes"
                  placeholder="No. de convocantes"
                />
                <div class="mas" @click="ArrayConvocantes_m()" @focus="estado_cte = false">
                  <i class="material-icons">add</i>
                </div>
              </div>

              <label>Convocados(s) :</label>
              <div v-if="estado_cdo">
                <div v-for="(cdo,i) in convocadoArray" :key="cdo[i]">
                  <input
                    type="text"
                    class="redondear"
                    placeholder="Nombre del convocado"
                    name="convocado[nombre][]"
                    required
                  />
                </div>
              </div>
              <div class="dos">
                <input
                  type="number"
                  class="redondear"
                  v-model="no_cdos"
                  placeholder="No. de convocados"
                />
                <div class="mas" @click="ArrayConvocados_m()" @focus="estado_cdo = false">
                  <i class="material-icons">add</i>
                </div>
              </div>
            </div>

            <div class="vl"></div>

            <div class="derecha">
              <div class="contenedorGeneral">
                <label for>Fecha de citación :</label>
                <input
                  type="date"
                  class="redondear"
                  placeholder="dd/mm/aa"
                  v-model="newFechaCita"
                  name="fecha_cita"
                  required
                />
              </div>
              <div class="contenedorGeneral">
                <label for>hora de citación :</label>
                <input
                  type="time"
                  v-model="newHoracita"
                  id="hora-cita"
                  name="hora_cita"
                  class="redondear"
                  min="08:00"
                  max="18:00"
                  required
                />
              </div>
              <div class="contenedorGeneral">
                <label for>Duración :</label>
                <div class="formulario">
                  <input
                    type="number"
                    id="duracion"
                    v-model="newDuracion"
                    name="duracion_cita"
                    class="redondear"
                    required
                  />
                  <p></p>
                  <select name="tiempo_cita" class="redondear" v-model="NewTiempoDuracion" required>
                    <option value selected>Seleccione</option>
                    <option value="Minutos">Minutos</option>
                    <option value="Horas">Horas</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        <textarea
          name="observacion"
          id="obs"
          cols="60"
          rows="10"
          class="textarea"
          v-model="newObs"
          placeholder="Asistencias y datos reelevantes..."
        ></textarea>
        </form>
        <div class="formulario">
          <a href="#" class="buttonA" @click="estadoMod=false">Cerrar</a>
          <p></p>
          <button class="buttonN" style="text-align: center;" @click.prevent="updateCita();guardarLug();">
            <span
              class="spinner-border spinner-border-sm"
              role="status"
              v-if="spinner"
              style="color:#ffff"
            ></span>
            <!-- <span class="sr-only">Loading...</span> -->
            Guardar
          </button>
        </div>
        <!-- **************************************************************cita modificar************************************************* -->
      </div>
    </div>
  </div>
</template>

<script>
import citacion from "../Formularios/Cita.vue";
// import func from '../../../../vue-temp/vue-editor-bridge';
export default {
  name: "citaciones",
  components: {
    citacion
  },
  data() {
    return {
      g_citacion: false,
      id_caso: "",
      spinner: false,
      estadoMod: false,

      citacionesArray: [],
      lugarArray: [],
      convocadoArray: [],
      convocanteArray: [],
      CitacionLlenarArray:[],
      LugarLlenarArray:[],
      newid_lugar_input_hidden:"",
      // cteLlenarArray:[],
      // cdoLlenarArray:[],

      lengtcte:"",
      lengtcdo:"",

      newLugar_name_input: "",
      delito: "",
      newLugar: "",
      estado_cte: false,
      estado_cdo: false,
      newFechaCita:"",
      newHoracita:"",
      NewTiempoDuracion:"",
      newDuracion:"",
      no_cdos: "",
      no_ctes: "",
      newObs: "",

      nombreLugarLlenar:"",

      idCita:"",
      idLugar:"",
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content")
    };
  },
  methods: {
    capturarIdCita: function(id,id_l){
      this.idCita = id;
      this.idLugar = id_l;
      this.citacionLlenar(this.idCita);
      this.LugarLlenar(this.idLugar);
    },
    ArrayConvocantes_m: function() {
      // console.log("cambio");
      this.convocanteArray.length = this.no_ctes;
      this.lengtcte = this.no_ctes;
      this.estado_cte = true;
      // return this.lengtcte;
    },
    ArrayConvocados_m: function() {
      this.convocadoArray.length = this.no_cdos;
      this.lengtcdo = this.no_ctes;
      this.estado_cdo = true;
      //  console.log(this.InvolucradoArray);
      // return this.lengtcdo;
    },
    LugarLlenar: function(id) {
      var urlcitacionview = "lugar/" + id;
      console.log(id);
      
       axios.get(urlcitacionview).then(Response => {
        this.LugarLlenarArray = Response.data;

        this.newLugar = this.LugarLlenarArray.nombre;        
        this.newid_lugar_input_hidden = id;
      });
    },
    lugarView: function() {
      var urlsolic = "lugar";
      axios.get(urlsolic).then(Response => {
        this.lugarArray = Response.data;
        // console.log(this.remisionesArray);
      });
    },
    guardarLug: function() {
      for (var i in this.lugarArray) {
        if (this.lugarArray[i].nombre == this.newLugar) {
          this.newLugar_name_input = this.lugarArray[i].id;
      console.log(this.newLugar_name_input);
          // console.log("if");
          return this.newLugar_name_input;
        }
      }
      return this.newLugar_name_input;
    },
    citasView: function() {
      var urlsolic = "citas";
      axios.get(urlsolic).then(Response => {
        this.citacionesArray = Response.data;
        // console.log(this.remisionesArray);
      });
    },
    
    citacionLlenar: function(id) {
      var urlcitacionview = "citas/" + id;
      console.log(id);
      
       axios.get(urlcitacionview).then(Response => {
        this.CitacionLlenarArray = Response.data;

        this.newFechaCita = this.CitacionLlenarArray.fecha;
        this.newHoracita = this.CitacionLlenarArray.hora_inicio;
        this.newObs = this.CitacionLlenarArray.observacion;
        this.newDuracion = this.CitacionLlenarArray.duracion;
        this.NewTiempoDuracion = this.CitacionLlenarArray.tiempo;
      });
    },
    
    cteView: function() {
      var urlsolic = "cte";
      axios.get(urlsolic).then(Response => {
        this.convocanteArray = Response.data;
        //console.log(this.convocanteArray);
      });
    },
    cdoView: function() {
      var urlsolic = "cdo";
      axios.get(urlsolic).then(Response => {
        this.convocadoArray = Response.data;
        // console.log(this.remisionesArray);
      });
    },
    guardarNewCita: function() {
      this.spinner = true;
      this.id_caso = this.idcaso;
      // console.log(this.id_caso);

      const formu = document.getElementById("formCita");
      var datos = new FormData(formu);
      // console.log(datos.get('ciudad_motivo'));

      var urlCita = "citas";
      axios
        .post(urlCita, datos)
        .then(result => {
          this.spinner = false;
          location.reload();
          console.log("respuesta vue: ", result);
        })
        .catch(err => {
          this.spinner = false;
          console.log("Error vue: ", err);
          // this.msgFalse=true;
        });
    },
    updateCita: function(){
      
      this.spinner=true;
      console.log(this.idCita);
      
      const formu = document.getElementById("updateCita");
      var datos = new FormData(formu);

      var url = 'citas/' + this.idCita;
      axios.put(url,datos)
      .then(result => {
          this.spinner = false;
          // location.reload();
          console.log("respuesta vue: ", result);
        })
        .catch(err => {
          this.spinner = false;
          console.log("Error vue: ", err);
          // this.msgFalse=true;
        });
    }
  },
  created: function() {
    this.id_caso = this.idcaso;
    this.lugarView();
    this.citasView();
    this.cteView();
    this.cdoView();
  },
  props: ["idcaso"]
};
</script>

<style lang="scss" scoped>
</style>