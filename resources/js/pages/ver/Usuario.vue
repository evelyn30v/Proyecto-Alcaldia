<template>
    <div  id="verDep" class="modalPeq">
        <div class="contenedor dialogModal">
            <div  v-for="u in userArray" :key="u.id" v-if="idUserTabla === u.id">
                <!-- {{iddependencia}} -->

                <div class="modal-header" >
                    <h2>Usuario {{u.id}}</h2>
                <div v-for="d in dependenciasArray" :key="d.id" v-if="u.tipo_usuario_id===d.id">
                    <h4> {{d.nombre}}</h4>
                </div>
                </div>
                <div class="modal-body">
                    <h4>{{u.name}} {{u.apellido}}</h4>
                    <h6>Cédula: {{u.cedula}}</h6>
                    <h6>Celular: {{u.celular}}</h6>
                    <h6>Email: {{u.email}}</h6>
                    <h6 v-if="u.created_at">Fecha de creación: {{u.created_at}}</h6>
                    <h6 v-if="u.created_at">Creada por: {{u.created_at}}</h6>
                </div>


            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name:"VerUser",
        data(){
            return{
                userArray: [],
                dependenciasArray: [],
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
        dependenciaView: function () {
            var dependenciaUrl = 'tipoUsuario';
            axios.get(dependenciaUrl)
            .then(Response=>{
                this.dependenciasArray = Response.data;     
            })
        },
        },
        created: function () {
        this.dependenciaView();
        this.userView();
    },
    props:[
        // 'idDependenciaTabla',
        'idUserTabla'
    ]
    }
</script>

<style lang="scss" scoped>

</style>