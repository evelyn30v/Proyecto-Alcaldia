<template>
    <div class="contenedordeformularios">
    <div class="tituloInicial">
        <h1>Registro</h1>
    </div>
    <div class="contenedor">
        <router-link to="/RegistroUsuario" class="texto">Registrar Usuario</router-link>
        <router-link to="/NuevaDependencia" class="texto">Registrar nueva dependencia</router-link>
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