<template>
  <div class="contenedordeformularios">
    <h1 style=" text-align: center;">Registro de dependencias</h1>

    <span v-if="msgFalse">
      <div class="danger" name="danger">
        <p style="color:#ffff">
          <i class="material-icons">error</i>
          <strong>¡oh, oh! No se pudo guardar una nueva Dependencia</strong>
        </p>
        <span class="closebtn" @click="estadoFalse()" style="font-size:36px; color:#ffff">&times;</span>
      </div>
    </span>

    <span v-if="msgTrue">
      <div class="mssg" name="msgtrue">
        <p style="color:#ffff">
          <i class="material-icons">done</i>
          <strong>¡Una nueva Dependencia se guardó con exito!</strong>
        </p>
        <span class="closebtn" @click="estadoFalse()" style="font-size:36px; color:#ffff">&times;</span>
      </div>
    </span>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <!-- <link rel="stylesheet" type="text/css" href="../../css/cssFormularios.scss"> -->
    <form method="POST" @submit.prevent="addTipoUser">
      <div class="contenedor">
        <div class="izquierda">
          <div class="labelSpan">
            <label for="label_delito">Nombre de la nueva dependencia :</label>
            <span v-if="!newNombre" class="requerido">Requerido*</span>
          </div>
          <input
            type="text"
            name="nombre"
            class="redondear"
            placeholder="Nombre"
            v-model="newNombre"
          />
        </div>
        <div class="formulario">
          <router-link to="/RegistrosAdmin" class="buttonA" style="text-align: center;">Atrás</router-link>
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
      </div>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      newNombre: "",
      spinner: false,
      msgTrue: false,
      msgFalse: false
    };
  },
  methods: {
    addTipoUser: function() {
      this.spinner = true;
      let url = "tipoUsuario";
      axios
        .post(url, {
          nombre: this.newNombre
        })
        .then(result => {
          console.log("respuesta vue: ", result);
          this.msgTrue = true;
          this.newNombre = "";
          this.spinner = false;
        })
        .catch(err => {
          console.log("Error vue: ", err);
          this.msgFalse = true;
          this.spinner = false;
        });
    },
    estadoFalse: function() {
      this.msgTrue = false;
      this.msgFalse = false;
    }
  }
};
</script>

<style lang="scss" scoped>
</style>