<template>                
    <div id="contenedorGeneral">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
        <router-link to="/" class="close" style="text-align: lefts;">&times;</router-link>
        
        <div class="contenedor">
        <div class="formulario">


            <div class="izquierda">
                    <img id="logo" src="../../assets/logoVertical.png">
                    <h2 style="color: black;">TE DAMOS LA BIENVENIDA A SEG</h2>
            </div>
            

            <div class="derecha">
                <form action="delitos" method="POST" v-on:submit.prevent="iniciarSesion" id="form_login">
                    <H1 style="padding: 50px 35%; text-align: center;">SEG</H1>
                    <input type="hidden" name="_token" :value="csrf" />
                        <label  for=""><b>Correo : </b></label>
                        <input  type="text" placeholder="eje@ejemplo.com" name="correo" required v-model="inputEmail"/>

                        <label  for="paswd"  ><b>Contraseña : </b></label>
                        <input 
                            type="password" placeholder="Introduzca su contraseña" name="paswd" required v-model="inputPaswd"/>
                        <label>
                         <input type="checkbox" checked="checked" name="remember"/> Recordar mi cuenta </label>
                        <p>
                            Al iniciar sesión, usted acepta todas las políticas de privacidad.
      <!-- ------------->   <a href="#" style="color:dodgerblue">Términos y condiciones</a> 
                        </p>
                    
                    <div class="clearfix, contenedorGeneral">
                        <button class="buttonN" style="text-align: center;" type="submit">Ingresar</button>
                    </div>
                    
                </form>
            </div>
    </div>
    </div>
        
        </div>
</template>

<script>
    export default {
         data() {
    return {
      inputEmail: "",
      inputPaswd: "",
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content")
    };
  },
  methods: {
    iniciarSesion: function() {
      let url = "login";
      axios
        .post(url, {
          //_token: this.csrf,
          email: this.inputEmail,
          password: this.inputPaswd
        })
        .then(result => {
          console.log("respuesta vue: ", result);
          location.reload();
        })
        .catch(err => {
          console.log("Error vue: ", err);
        });
    }
  }
}
</script>

<style lang="scss" scoped>

#contenedorGeneral {
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: #c5cae962;
  padding-top: 50px; 
}
.contenedor{
    margin: auto;
    padding: 0px;
    border-radius: 12px;
    background-color: #fefefe;
    height: 90%; 
    grid-template-columns: 50% 50%;
    width: 85%;
    box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.2), 0 9px 30px 0 rgba(0, 0, 0, 0.19); 
    overflow: hidden;
}
.formulario{ 
    height: auto; 
    width: 100%;
    display: grid;
    grid-template-columns: 50% 50%;
    height: 100%;
}
.derecha,
.izquierda {
    padding: 10px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.izquierda{
  background-color: #303F9F;
  background-image: linear-gradient(to bottom right,#303F9F ,  rgba(189, 189, 189, 0.295)  , #3F51B5 );
}
.close {
  position: absolute;
  right: 35px;
  top: 15px;
  font-size: 40px;
  font-weight: bold;
  color: #f1f1f1;
  text-decoration: none;
}
.close:hover,
.close:focus {
  color: #ff5722;
  cursor: pointer;
}
.lefts{
   flex-direction: column;
   justify-content: flex-start;
   align-items: flex-start;
}
input[type="text"],
input[type="password"] {
  width: 100%;
  height: 40px;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border-radius: 12px;
  background: #f1f1f1;
  border: #f1f1f1 solid 1px;
}
input[type="text"]:focus,
input[type="password"]:focus {
  background-color: #ddd;
  border: #f1f1f1 solid 1px;
  outline: none;
  display: inline-block;
}
.buttonN {
    text-decoration: none;
    border: #ff5722 solid 1px;
    background-color: #fd4006;
    color: white;
    padding: 5px;
    margin-top: 20px;
    border-radius: 24px;
    width: 50%;
    display: inline-block;
    height: 40px;
    opacity: 1;
    box-shadow: 0 6px 10px 0 rgba(13, 5, 44, 0.363)
}
.buttonN:hover,
.buttonA:hover {
    opacity: 0.8;
}
.ingresar-btn {
  width: 50%;
  text-decoration: none;
  color: #ddd;
}
#logo{
  margin-left: 20px;
  width: 50%;
  height: 60%;
  margin: 10px; 
}
.clearfix::after {
  content: "";
  clear: both;
  display: table;
  
}
@media screen and (max-width: 300px) {
  .ingresar-btn {
    width: 100%;
}
}

</style>