<template>
    <div class="contenedordeformularios">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <div class="tituloInicial">
        <h1>Registro</h1>
    </div>
    <div class="contenedor">
        <router-link to="/RegistroDelitos" class="texto">Registrar delito</router-link>
        <router-link to="/RegistroMc" class="texto">Registrar  Medidas Correctivas</router-link>
        <router-link to="/RegistroMp" class="texto">Registrar  Medidas Preventivas</router-link>
    </div>
    </div>
</template>

<script>
    export default {
        
    }
</script>

<style lang="scss" scoped>
*{
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #303F9F;
}
.contenedor{
    margin-bottom: 1000px;
    padding: 0;
    margin: auto;
    background-color: #ffff;
    border-radius: 12px;
    height: auto;
    width: 80%;
    overflow: hidden;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
th:hover{
    background-color: #3e269417;
}
.texto{
  margin: 0px;
  text-decoration: none;
  display: block;
  line-height: 40px;
  text-align: center;
  }
.texto:hover{
    color: #ff3c009d;
    background-color: #3e269417;
}
</style>