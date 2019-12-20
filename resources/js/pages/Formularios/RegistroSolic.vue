<template>
  <div class="contenedordeformularios">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />

    <h1 style="margin-bottom:40px; text-align: center;">Registro de solicitud</h1>

    <span v-if="msgFalse">
      <div class="danger" name="danger">
        <p style="color:#ffff">
          <i class="material-icons">error</i>
          <strong>¡oh, oh! No se pudo guardar su Solicitud</strong>
        </p>
        <span class="closebtn" @click="estadoFalse()" style="font-size:36px; color:#ffff">&times;</span>
      </div>
    </span>
    <!-- <span v-if="newAnio|newcantidadDelito|newDelito|newMes" > -->
    <span v-if="msgTrue">
      <div class="mssg" name="msgtrue">
        <p style="color:#ffff">
          <i class="material-icons">done</i>
          <strong>¡Su Solicitud preventiva se guardó con exito!</strong>
        </p>
        <span class="closebtn" @click="estadoFalse()" style="font-size:36px; color:#ffff">&times;</span>
      </div>
    </span>

    <form method="POST" @submit.prevent="addSolicitante()">
      <div class="formulario">
        <input type="hidden" name="_token" :value="csrf" />
        <div class="izquierda">
          <h5>Datos del solicitante :</h5>
          <div class="contenedorGeneral">
            <div class="contenedorGeneral">
              <div class="labelSpan">
                <label for="label_delito">Documento :</label>
                <span
                  v-if="newTipoDoc==0|!newTipoDoc== null|!newDocumento"
                  class="requerido"
                >Requerido*</span>
              </div>

              <div class="formulario">
                <select class="redondear" name="tipo_doc" v-model="newTipoDoc" required>
                  <option selected value="0">Seleccione un tipo</option>
                  <option value="1">TI</option>
                  <option value="2">CC</option>
                  <option value="3">Cedula de extrajería</option>
                </select>
                <p></p>

                <input
                  list="noDoc"
                  type="text"
                  name="documento"
                  class="redondear"
                  placeholder="Número"
                  v-model="newDocumento"
                  @change="llenar()"
                />
                <datalist id="noDoc">
                  <option
                    v-for="solicitante in documentoArray"
                    :key="solicitante.id"
                  >{{solicitante.no_documento}}</option>
                </datalist>
                <input
                  type="hidden"
                  name="id_solicitante_input"
                  v-model="newId_solicitante_input"
                  required
                />
              </div>
            </div>
            <div class="labelSpan">
              <label for="label_delito">Nombre :</label>
              <span v-if="!newNombre" class="requerido">Requerido*</span>
            </div>
            <input
              type="text"
              class="redondear"
              name="nombre"
              placeholder="Nombre completo"
              v-model="newNombre"
              required
            />
          </div>
          <div class="contenedorGeneral">
            <div class="labelSpan">
              <label for="label_delito">Apellido :</label>
              <span v-if="!newApellido" class="requerido">Requerido*</span>
            </div>
            <input
              type="text"
              class="redondear"
              name="apellido"
              placeholder="Nombre completo"
              v-model="newApellido"
              required
            />
          </div>
        </div>
        <div class="vl"></div>

        <div class="derecha">
          <div class="contenedorGeneral">
            <div class="labelSpan">
              <label for="label_delito">Estado del caso :</label>
              <span v-if="!newEstado" class="requerido">Requerido*</span>
            </div>
            <div class="formulario" style="margin-top:20px">
              <div>
                <input type="radio" v-model="newEstado" value="resuelto" name="estado" />Resuelto
              </div>
              <p></p>
              <div>
                <input type="radio" v-model="newEstado" value="pendiente" name="estado" />Pendiente
              </div>
            </div>
          </div>
          <div class="contenedorGeneral">
            <div class="labelSpan">
              <label for="label_delito">Fecha :</label>
              <span v-if="!newFecha" class="requerido">Requerido*</span>
            </div>
            <input type="date" class="redondear" v-model="newFecha" name="fecha" required />
          </div>
          <div class="contenedorGeneral">
            <div class="labelSpan">
              <label for="label_delito">Motivo :</label>
              <span v-if="!newMotivo" class="requerido">Requerido*</span>
            </div>
            <textarea
              name="motivo"
              class="textarea"
              cols="30"
              rows="10"
              placeholder="Escriba un texto corto"
              v-model="newMotivo"
              required
            ></textarea>
          </div>
        </div>
      </div>
      <div class="contenedorGeneral" style="margin-top:30px">
        <h5>Observaciones :</h5>
        <textarea
          name="observacion"
          class="textarea"
          cols="30"
          rows="10"
          placeholder="Escriba un texto corto"
          v-model="newObservacion"
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
          Guargar
        </button>
      </div>
    </form>
  </div>
</template>

<script>
import Vue from "Vue";

export default {
  name: "RegitroSolic",

  data() {
    return {
      spinner: false,
      msgTrue: false,
      msgFalse: false,
      newId_solicitante_input: "",
      documentoArray: [],
      newNombre: "",
      newApellido: "",
      newTipoDoc: "",
      newDocumento: "",
      newEstado: "",
      newFecha: "",
      newMotivo: "",
      newUserId: "",
      newObservacion: "",
      //   identificador_id,
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content")
    };
  },
  methods: {
    solicitanteview: function() {
      var url = "solicitante";
      axios.get(url).then(Response => {
        this.documentoArray = Response.data;
        // console.log(Response.data().nombre);
        //console.log(this.solicitantes)
      });
    },
    llenar: function() {
      for (var i in this.documentoArray) {
        if (this.documentoArray[i].no_documento == this.newDocumento) {
          this.newNombre = this.documentoArray[i].nombre;
          this.newApellido = this.documentoArray[i].apellido;
          this.newId_solicitante_input = this.documentoArray[i].id;
          console.log(this.newNombre);
          //console.log(this.newId_solicitante_input);
          return this.newId_solicitante_input;
        } else if (
          this.newDocumento == null ||
          this.newDocumento.length == 0 ||
          /^\s+$/.test(this.newDocumento)
        ) {
          this.newId_solicitante_input = null;
          this.newNombre = null;
          this.newApellido = null;
          // console.log("null")
        } else if (this.newDocumento !== this.documentoArray[i].no_documento) {
          this.newId_solicitante_input = null;
          this.newNombre = "";
          this.newApellido = "";
          // console.log("hola")
        }
        // console.log("hola")
      }
    },

    usuariologin: function() {
      $http.get("api/user").then(response => {
        console.log(response.body);
      });
    },
    // mostrarmsgs: function()
    // {

    // },

    addSolicitante: function() {
      console.log(this.newId_solicitante_input);
      let url = "api/solicitudRgistro";
      this.spinner = true;
      axios
        .post(url, {
          nombre: this.newNombre,
          apellido: this.newApellido,
          tipo_doc: this.newTipoDoc,
          documento: this.newDocumento,
          estado: this.newEstado,
          fecha: this.newFecha,
          motivo: this.newMotivo,
          observacion: this.newObservacion,
          id_solicitante_input: this.newId_solicitante_input
        })
        .then(result => {
          console.log("respuesta vue: ", result);
          this.msgTrue = true;
          this.newObs = "";
          this.newMes = "";
          this.newDelito = "";
          this.newAnio = "";
          this.spinner = false;
        })
        .catch(err => {
          console.log("Error vue: ", err);
          this.msgFalse = true;
        });
    },
    estadoFalse: function() {
      this.msgTrue = false;
      this.msgFalse = false;
    }
  },
  created: function() {
    this.solicitanteview();
  }
};
</script>