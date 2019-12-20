<template>
<div>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

    <div class="menu">
        <div class="contenedor-general" id= "inicial"><img class="logo" src="../../assets/user.svg"/>
        <p class="usuario">{{ usuario }}</p>
        <!-- <p>{{identificador_id}}</p> -->
        </div>
        
        <div  class="contenedor-general">
            <div class="icono"><i class="material-icons" id="icons" >create</i></div>
            <router-link to="/RegistrosAdmin" class="texto">Registros</router-link>
        </div>
        <div  class="contenedor-general">
            <div class="icono"><i class="material-icons" id="icons" >people</i></div>
            <router-link to="/usuarios" class="texto">Usuarios</router-link>
        </div>
        <div  class="contenedor-general">
            <div class="icono"><i class="material-icons" id="icons" >work</i></div>
            <router-link to="/dependencia" class="texto">Dependencias</router-link>
        </div>
        <div  class="contenedor-general">
                <div class="icono"><i class="material-icons" id="icons">transit_enterexit</i></div>
            <form method="POST" v-on:submit.prevent="cerrarSesion">
                <button type="submit" class="boton_simple">salir</button>
            </form>     
        </div>
  </div>  
  <div class="fondo" id="fondo"></div>
  <div class="fondo2"><router-view identificador="identificador_id" ></router-view></div>
</div>
</template>

<script>
 import MenuIcon from 'vue-material-design-icons/Menu.vue';
 import menu from '../../css/menu.scss';

    export default {
        data(){
            return{
                nombre:"",
                // identificador_id,
            }
        },

        methods: {
            cerrarSesion: function() {
                var url= 'logout';
                
                axios.post(url).then(result =>{
                    location.assign('/');
                }).catch(error => {
                    console.log('error cerrando sesion ', error);
                    
                });
            },
            mostrarNombre: function(){
                var url = 'login/' + '{{auth()->user()->name}}';
                axios.get(url).then(response=>{
                    this.info = response.data
                });
            }
        },

        props: [
            'usuario',
            'identificador_id'
        ]

    }
</script>