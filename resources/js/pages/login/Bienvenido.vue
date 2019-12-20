<template>
<div class="fondo"><router-view></router-view>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <div class="inicial">    
        <h1 class="titulo" style="color:white; font-size: 80px;">BIENVENIDO</h1>
        <p style="color:white" class="contenido"> SISTEMA ESTADÍSTICO DE GESTIÓN</p>   
        <router-link to="/login" class="buttonN" style="text-align: center; width:20%">Ingresar</router-link> 
        
    <!-- <div id="contenedorGeneral">
    </div> -->
</div>
</div> 
</template>

<script>
export default {
    
}
var contenedorGeneral = document.getElementById("contenedorGeneral");

window.onclick = function(event) {
  if (event.target == contenedorGeneral) {
    contenedorGeneral.style.display = "none";
  }
};
</script>

<style scoped>
.inicial{
    height: 100%;
    width: 100%;
    display:flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background-color: #303F9F;
    background-image: linear-gradient(to bottom right,rgb(25, 34, 94) ,  rgba(189, 189, 189, 0.295)  , rgb(28, 43, 133) );
}
*{
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;  
}
.fondo{
    padding: 0px;
    height: 100vh;
    width: 100%;
}
input[type="text"],
input[type="Contraseña"] {
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
input[type="Contraseña"]:focus {
  background-color: #ddd;
  border: #f1f1f1 solid 1px;
  outline: none;
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
</style>