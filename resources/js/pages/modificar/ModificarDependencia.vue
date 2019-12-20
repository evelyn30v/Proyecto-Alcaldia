<template>
     <div class=" modalPeq" >
         <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
            rel="stylesheet">
         <form method="POST"  id="form_mod">
             <!-- v-on:submit.prevent="updateDep(fillDep.id)" -->
        
            <input type="hidden" name="_token" :value="csrf">
            <div class="contenedor dialogModal">
                <div class="modal-header">
                    <h2 style=" text-align: center;">Modificar dependencia {{iddependencia}}</h2>
                    <!-- <button type="button"  class="close nuevocerrar" @click="estadoVer=false">
                        <span>&times;</span>
                    </button> -->
                </div>

                        <label for="nombre"> Nombre del rol :</label>
                        <div v-for="d in dependenciasArray" :key="d.id" v-if="iddependencia === d.id">
                            <input type="text" name="nombre" class="redondear"  v-model="fillDep.nombre"  :placeholder="d.nombre" required>
                            
                            <div class="formulario" v-if="iddependencia === d.id">
                                <p></p>
                                <div></div>
                                <button  class="buttonN" style="text-align: center;" v-on:click.prevent = "updateDep(d)">
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" 
                                    v-if="spinner" style="color:#ffff"></span>Modificar</button>
                            </div>
                        </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: "ModDep",
        data(){
            return{
                spinner:false,
                estadoVer:false,
                fillDep:{
                    id:'',
                    nombre:'',
                },
                nombre:'',
                dependenciasArray: [],
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        },
        methods:{
            dependenciaView: function () {
                var dependenciaUrl = 'tipoUsuario';
                axios.get(dependenciaUrl)
                .then(Response=>{
                    this.dependenciasArray = Response.data;
                });
            },

            updateDep: function(dGet) {
                this.spinner=true;
                // console.log(dGet.nombre)
                let  url ="api/tipoUsuario/" + dGet.id; 
                this.fillDep.id = dGet.id;
                axios.put(url,{
                    nombre: this.fillDep.nombre
                })
                .then(response=>{
                    this.spinner=false;
                    this.estadoVer=false;
                    location.reload();
                    
                })
                .catch(err => {
                    console.log("Error vue: ", err);
                    this.msgFalse=true;
                    this.spinner=false;
                });
            }
        },
        created: function () {
        this.dependenciaView();
        this.estadoVer=true;
    },
        props:[
        // 'idDependenciaTabla',
        'iddependencia'
    ]
    }
</script>

<style lang="scss" scoped>

</style>