<template>
    <div  id="verDep" class="modalPeq">
        <div class="contenedor dialogModal">
            <div  v-for="u in solicitud" :key="u.id" v-if="idsolic === u.id">
                <!-- {{iddependencia}} -->

                <div class="modal-header" >
                    <h2>Solicitud: {{u.id}}</h2>
                </div>
                <div v-for="d in solicitantes" :key="d.id" v-if="u.id_solicitante===d.id">
                    <h4>Solicitante: </h4>
                    <h5>{{d.nombre}} {{d.apellido}} </h5>
                </div>
                <div class="modal-body">
                    <h6>Estado: {{u.estado}}</h6>
                    <h6>Motivo: </h6>
                    <h8>{{u.motivo}}</h8>

                    <h6>Observación: </h6>
                    <h8>{{u.obervación}} </h8>

                    <h6>Email: {{u.email}}</h6>
                    <h6 v-if="u.created_at">Fecha de creación: {{u.created_at}}</h6>
                    <div v-for="us in userArray" :key="us.id" v-if="u.id_user===us.id">
                        <h6 style="color:green">Creada por: {{us.name}} {{us.apellido}}</h6>
                    </div>
                    
                </div>


            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name:"VerSol",
        data(){
            return{
                userArray: [],
                solicitud: [],
                solicitantes: [],
                estadoVer:false,
            }
        },
        methods:{
            userView: function () {
            var urlUser = 'user';
            axios.get(urlUser)
            .then(Response=>{
                this.userArray = Response.data;    
            })
        },
        solicitanteview:function () {
            var url = 'solicitante';
            axios.get(url)
            .then(Response=>{
                this.solicitantes = Response.data;
            })
        },
        solicitudesView: function () {
            var urlsolic = 'solicitudRgistro';
            axios.get(urlsolic)
            .then(Response=>{
                this.solicitud = Response.data;   
            })
        },
        },
        created: function () {
        this.solicitanteview();
        this.solicitudesView();
        this.userView();
    },
    props:[
        // 'idDependenciaTabla',
        'idsolic'
    ]
    }
</script>

<style lang="scss" scoped>

</style>