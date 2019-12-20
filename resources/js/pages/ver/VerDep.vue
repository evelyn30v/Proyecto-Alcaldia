<template>
    <div  class="modalPeq">
        <div class="contenedor dialogModal">
            <div  v-for="d in dependenciasArray" :key="d.id" v-if="iddependencia === d.id">
                <!-- {{iddependencia}} -->

                <div class="modal-header" >
                    <h2>Dependencia {{d.id}}</h2>
                    
                </div>
                <div class="modal-body">
                    <h4>{{d.nombre}}</h4>
                    <h6> Creada {{d.created_at}}</h6>
                </div>


            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name:"VerDep",
        data(){
            return{
                dependenciasArray: [],
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
        },
        created: function () {
        this.dependenciaView();
    },
    props:[
        // 'idDependenciaTabla',
        'iddependencia'
    ]
    }
</script>

<style lang="scss" scoped>

</style>