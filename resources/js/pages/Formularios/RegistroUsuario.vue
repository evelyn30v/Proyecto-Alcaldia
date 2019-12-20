<template>
  <div class="contenedordeformularios">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <!-- <link rel="stylesheet" type="text/css" href="../../css/cssFormularios.scss"> -->
    <h1 style=" text-align: center;">Registro de usuarios</h1>
    

    <!-- *********************************Mensajes************************************************************* -->
    <span v-if="msgFalse" >
      <div class="danger" name="danger">
        <p style="color:#ffff">
          <i class="material-icons">error</i>
          <strong>¡oh, oh! No se pudo guardar un nuevo usuario</strong> 
        </p>
        <span
          class="closebtn"
          @click="estadoFalse()"
          style="font-size:36px; color:#ffff"
        >&times;</span>
      </div>
    </span>

    <span v-if="msgTrue">
      <div class="mssg" name="msgtrue">
        <p style="color:#ffff">
          <i class="material-icons">done</i>
          <strong>¡El nuevo usuario guardado con exito!</strong>
        </p>
        <span
          class="closebtn"
          @click="estadoFalse()"
          style="font-size:36px; color:#ffff"
        >&times;</span>
      </div>
    </span>
    <!-- *********************************Mensajes************************************************************* -->

    <form method="POST" @submit.prevent="addUser" enctype="multipart/form-data">
      <input type="hidden" name="_token" :value="csrf" />
      <!-- <div class="contenedorGeneral">
        <figure>
          <img class="perfil" :src="imagenMetodo" />
        </figure>
        <label for="file-upload" class="subir">
          <i class="material-icons">add_photo_alternate</i>
          Foto de perfil
        </label>
        <input id="file-upload" @change="cambiarImg" type="file" style="display: none;" />
      </div> -->
      <!-- <input type="text" name="perfil" v-model="newPerfil"> -->
      <div class="formulario">
        <div class="izquierda">
          <div class="labelSpan">
            <label for="label_delito">Nombre :</label>
            <span v-if="!newName" class="requerido">Requerido*</span>
          </div>
          <input
            type="text"
            name="nombre"
            class="redondear"
            placeholder="name"
            v-model="newName"
            required
          />

          <div class="labelSpan">
            <label for="label_delito">Apellido :</label>
            <span v-if="!newApellido" class="requerido">Requerido*</span>
          </div>
          <input
            type="text"
            name="apellido"
            class="redondear"
            placeholder="apellido(s)"
            v-model="newApellido"
            required
          />

          <div class="labelSpan">
            <label for="label_delito">Cédula de ciuadadanía :</label>
            <span v-if="!newCedula" class="requerido">Requerido*</span>
          </div>
          <input
            type="number"
            name="cedula"
            class="redondear"
            placeholder="No. de Cédula"
            v-model="newCedula"
            required
          />

          <div class="labelSpan">
            <label for="label_delito">Celular :</label>
            <span v-if="!newCelular" class="requerido">Requerido*</span>
          </div>
          <input
            type="number"
            name="celular"
            class="redondear"
            placeholder="No. de celular"
            v-model="newCelular"
            required
          />
        </div>
        <div class="vl"></div>
        <div class="derecha">
          <div class="labelSpan">
            <label for="label_delito">Correo electrónico :</label>
            <span v-if="!newEmail" class="requerido">Requerido*</span>
          </div>
          <input
            type="email"
            name="email"
            class="redondear"
            placeholder="ejemplo@ejemplo.com"
            v-model="newEmail"
            required
          />

          <div class="labelSpan">
            <label for="label_delito">Contraseña :</label>
            <span v-if="!newContraseña" class="requerido">Requerido*</span>
          </div>
          <input
            type="password"
            name="password"
            class="redondear"
            placeholder="contraseña"
            v-model="newContraseña"
            required
          />

          <div class="labelSpan">
            <label for="label_delito">Tipo de usuario :</label>
            <span v-if="!newTipo_usuario_id" class="requerido">Requerido*</span>
          </div>
          <select name="tipo_usuario_id" class="redondear" v-model="newTipo_usuario_id" required>
            <option value="1">Administrador</option>
            <option value="2">Comisario</option>
            <option value="3">Supervisor Alcaldía</option>
          </select>
        </div>
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
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      spinner: false,
      msgTrue: false,
      msgFalse: false,

      imagenPequeña: "",
      newPerfil: "",
      newName: "",
      newApellido: "",
      newCedula: "",
      newCelular: "",
      newEmail: "",
      newContraseña: "",
      newTipo_usuario_id: "",
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content")
    };
  },
  methods: {
    // props:[
    //     'identificador'
    // ],
    cambiarImg(e) {
      let file = e.target.files[0];
      this.newPerfil = file;
      this.cargarImage(file);
      console.log(this.newPerfil);
    },
    cargarImage(file) {
      let ver = new FileReader();
      ver.onload = e => {
        this.imagenPequeña = e.target.result;
      };
      ver.readAsDataURL(file);
      // console.log(imgUrl);
    },
    addUser() {
        this.spinner=true;
        var url = "api/usuario";

        axios
          .post(url, {
            perfil: this.newPerfil,
            nombre: this.newName,
            apellido: this.newApellido,
            cedula: this.newCedula,
            celular: this.newCelular,
            email: this.newEmail,
            password: this.newContraseña,
            tipo_usuario_id: this.newTipo_usuario_id
          })
          .then(result => {
            console.log("respuesta vue: ", result);
            this.msgTrue=true;
            this.spinner=false;
          })
          .catch(err => {
            console.log("Error vue: ", err);
            this.msgFalse=true;
            this.spinner=false;
          });
    },
    estadoFalse: function(){
            this.msgTrue=false;
            this.msgFalse=false;
        }
  },
  computed: {
    imagenMetodo() {
      return this.imagenPequeña;
    }
  }
};
</script>

<style lang="scss" scoped>
</style>