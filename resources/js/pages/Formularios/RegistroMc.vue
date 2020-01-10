<template>
  <div class="contenedordeformularios">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <!-- <link rel="stylesheet" type="text/css" href="../../css/cssFormularios.scss"> -->

    <div class="tituloInicial">
      <h1>Registro de medidas correctivas</h1>
    </div>

    <span v-if="msgFalse">
      <div class="danger" name="danger">
        <p style="color:#ffff">
          <i class="material-icons">error</i>
          <strong>¡oh, oh! No se pudo guardar su Medida correctiva</strong>
        </p>
        <span class="closebtn" @click="estadoFalse()" style="font-size:36px; color:#ffff">&times;</span>
      </div>
    </span>
    <!-- <span v-if="newAnio|newcantidadDelito|newDelito|newMes" > -->
    <span v-if="msgTrue">
      <div class="mssg" name="msgtrue">
        <p style="color:#ffff">
          <i class="material-icons">done</i>
          <strong>¡Su Medida correctiva se guardó con exito!</strong>
        </p>
        <span class="closebtn" @click="estadoFalse()" style="font-size:36px; color:#ffff">&times;</span>
      </div>
    </span>

    <form action="mc" @submit.prevent="addDelito()">
      <!-- <div class="contenedor"> -->
      <div class="formulario">
        <input type="hidden" name="_token" :value="csrf" />

        <div class="izquierda">
          <div class="contenedorGeneral">
            <label class="derecha" for="label_delito">El delito de tipo :</label>
            <select class="izquierda, redondear" name="delito" v-model="newDelito" required>
              <option selected value="0">Elige una opción</option>
              <optgroup label="Homicidio">
                <option value="2">Homicidio</option>
              </optgroup>
              <optgroup label="Hurto">
                <option value="3">Hurto a personas</option>
                <option value="4">Hurto a comercio</option>
                <option value="5">Hurto a residencias</option>
                <option value="6">Hurto de automotores</option>
                <option value="7">Extorsión</option>
              </optgroup>
              <optgroup label="Violencia">
                <option value="8">Violencia a niños y adolescentes</option>
                <option value="9">Vioilencia al adulto mayor</option>
                <option value="10">Violencia de pareja</option>
              </optgroup>
            </select>
            <!-- <input type="text" v-model="newDelito" name="delito"> -->
          </div>

          <div class="contenedorGeneral">
            <!-- <label class="derecha" for="label_delito">Descripción : </label>
            <input type="text" class="redondear" v-model="cantidadDelito" placeholder="Introduzca una breve descripción...">-->
          </div>
        </div>

        <div class="vl"></div>

        <div class="derecha">
          <div class="contenedorGeneral">
            <label class="derecha" for="label_delito">Descripción :</label>
            <textarea
              type="number"
              class="textarea"
              cols="30"
              rows="10"
              name="observacion"
              v-model="newObs"
              placeholder="Introduzca un texto corto"
              required
            ></textarea>
          </div>
          <div class="contenedorGeneral">
            <label class="derecha" for="label_delito">Fecha :</label>
            <div class="formulario">
              <select class="redondear" name="mes" v-model="newMes" required>
                <option value="01">Enero</option>
                <option value="02">Febrero</option>
                <option value="03">Marzo</option>
                <option value="04">Abril</option>
                <option value="05">Mayo</option>
                <option value="06">Junio</option>
                <option value="07">Julio</option>
                <option value="08">Agosto</option>
                <option value="09">Septiembre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
              </select>
              <!-- <input type="text" v-model="newMes" name="delito"> -->
              <p></p>
              <input
                type="number"
                name="anio"
                class="redondear"
                placeholder="Año"
                v-model="newAnio"
                required
              />
            </div>
          </div>
        </div>
      </div>

      <div class="formulario">
        <router-link to="/Registros" class="buttonA" style="text-align: center;">Atrás</router-link>
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
      <!-- </div> -->
    </form>
  </div>
</template>

<script>
import cssFormularios from "../../css/cssFormularios.scss";
export default {
  data() {
    return {
      spinner: false,
      msgTrue: false,
      msgFalse: false,
      newObs: "",
      newMes: "",
      newDelito: "",
      newAnio: "",
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content")
    };
  },
  methods: {
    addDelito: function() {
      let url = "api/medidac";
      this.spinner = true;
      axios
        .post(url, {
          observacion: this.newObs,
          mes: this.newMes,
          anio: this.newAnio,
          delito: this.newDelito
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
  }
};
</script>

