<template>

    <div class="contenedordeformularios" id="listarDep">
       <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
        <div class="tituloInicial">
            <h1>Dependencias registradas</h1>
        </div>
        <!-- <div class="contenedor"> -->
            <form class="busqueda" action="">
                <input type="hidden" name="_token" :value="csrf">
                <div class="delgado" style="box-shadow: 0 6px 10px 0 rgba(13, 5, 44, 0.363)">
                   <input type="text" placeholder="Search.." name="search" >
                    <button type="submit" class="search" style="margin: 0px">
                        <i class="material-icons" style="color:white">search</i></button> 
                </div>
            </form>
            <div class="contenedor" id="solicitudes, solicitante">
            <table class="table  table-hover table-sprite ">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nombre</th>
                        <th colspan="5"> &nbsp; </th>
                    </tr>
                </thead>
                <tbody >
                    <tr v-for="(dependenciaGet) in dependenciasArray" :key="dependenciaGet.id">
                        <td width='10px'>{{dependenciaGet.id}}</td>
                        <td width='30%'>{{dependenciaGet.nombre}}</td>
                        <td width='70%'></td>
                        <td>
                            <a href="#" @click="estadoVer=true; capturaridDepTabla(dependenciaGet.id)"
                             class="btnVer" data-toggle="modal" data-target="#VerDep" >Ver</a>
                        </td>
                        <td>
                            <a href="#" @click="estadoModificar=true; capturaridDepTabla(dependenciaGet.id)" 
                            class="btnModificar">Modificar</a>
                        </td>
                        <td>
                            <a href="#" class="btnEliminar" v-on:click.prevent = "deleteSolic(dependenciaGet)">Eliminar</a>
                        </td>
                    </tr>
                </tbody>
            </table>
            </div>
<!-- ********************************************************Ver********************************************************************************             -->
            <div v-if="estadoVer">
                <button type="button"  class="close nuevocerrar" @click="estadoVer=false">
                        <span>&times;</span>
                    </button>
                <VerDep :iddependencia = "idDependenciaTabla"></VerDep>
            </div>
<!-- ********************************************************Modificar****************************************************************************             -->
            <div v-if="estadoModificar">
                <button type="button"  class="close nuevocerrar" @click="estadoModificar=false">
                        <span>&times;</span>
                    </button>
                <ModDep :iddependencia = "idDependenciaTabla"></ModDep>
            </div>


        <!-- </div> -->
    </div>
</template>

<script>
import VerDep from "../ver/VerDep";
import ModDep from "../modificar/ModificarDependencia";
    export default {
        components: {
            VerDep,
            ModDep,
        },
        data() {
            return{
            dependenciasArray: [],
            estadoVer:false,
            estadoModificar:false,
            idDependenciaTabla:'',
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }   
    },
    methods:{
        dependenciaView: function () {
            var dependenciaUrl = 'tipoUsuario';
            axios.get(dependenciaUrl)
            .then(Response=>{
                this.dependenciasArray = Response.data;
            })
        },
        capturaridDepTabla: function(id){
            this.idDependenciaTabla = id;
            console.log(this.idDependenciaTabla)
        },
        
        deleteSolic: function (dependenciaGet) {
            alert('¿Está seguro de borrar la dependencia '+ dependenciaGet.nombre + '?');
            var urlDeleteUser = 'tipoUsuario/' + dependenciaGet.id;
            axios.delete(urlDeleteUser)
            .then(Response=>{
                this.dependenciaView();
            })
        }
    },
    created: function () {
        this.dependenciaView();
    },
    
    }
</script>

<style lang="scss" scoped>

</style>