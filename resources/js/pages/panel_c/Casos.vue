<template>

    <div class="contenedordeformularios">
       <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
        <div class="tituloInicial">
            <h1>Casos</h1>
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
                        <th>Fecha</th>
                        <th>Solicitante</th>
                        <th colspan="5"> &nbsp; </th>
                    </tr>
                </thead>
                <tbody >
                    <tr v-for="(solicitudes, index) in solicitud" :key="solicitudes.id">
                        <td width='10px'>{{solicitudes.id}}</td>
                        <td width='30%'>{{solicitudes.created_at}}</td>
                        <td width='70%'>{{solicitantes[index].nombre}}</td>
                        <td>
                            <a href="#" class="btnVer">Ver</a>
                        </td>
                        <td>
                            <a href="#" class="btnModificar">Modificar</a>
                        </td>
                        
                    </tr>
                </tbody>
            </table>
            </div>
        <!-- </div> -->
    </div>
</template>

<script>
    export default {
        data() {
            return{
            solicitud: [],
            solicitantes: [],
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }   
    },
    methods:{
        solicitanteview:function () {
            var url = 'solicitante';
            axios.get(url)
            .then(Response=>{
                this.solicitantes = Response.data;
                // console.log(Response.data().nombre);
                //console.log(this.solicitantes)
            })
        },
        solicitudesView: function () {
            var urlsolic = 'solicitudRgistro';
            axios.get(urlsolic)
            .then(Response=>{
                this.solicitud = Response.data;
                
            })
        },
        
        deleteSolic: function (solicitudes) {
            alert('¿Está seguro de borrar la solicitud '+ solicitudes.id + '?');
            var urlDeleteSolic = 'solicitudRgistro/' + solicitudes.id;
            axios.delete(urlDeleteSolic)
            .then(Response=>{
                this.solicitudesView();
            })
        }
    },
    created: function () {
        this.solicitanteview();
        this.solicitudesView();
        
    }
    }
</script>

<style lang="scss" scoped>

</style>