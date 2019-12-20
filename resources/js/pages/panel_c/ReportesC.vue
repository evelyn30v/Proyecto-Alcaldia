
<template>
    <div class="contenedordeformularios">
       <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
        <div class="tituloInicial">
            <h1>Reportes</h1>
        </div>
        <div class="contenedorGeneral">
            <div class="tres" >
                <h5>Reporte :</h5>
                <div><input class="radio" type="radio" v-model="rem" value="1" />Diario</div>
                <div><input class="radio" type="radio" v-model="rem" value="2" />Mensual</div>
                <div><input class="radio" type="radio" v-model="rem" value="3" />Anual</div>
            </div>
        </div>
        <div class="dos">
        <div class="contenedor">
            <h4 style="margin-bottom:50px">Reporte</h4>
        </div>
        <div class="contenedorpeq" style="margin-left:30px">
            <h4>Filtrar por :</h4>
            <h5>Estado de casos :</h5>
            <select class="select-filtro" name="estado-caso" id="">
                <option value="1">Atendidos</option>
                <option value="2">Resueltos</option>
                <option value="3">Remitidos</option>
                <option value="4">Todos</option>
            </select>

            <h5>Delitos :</h5>
            <select name="delitos-report" class="select-filtro"></select>

            <h5>Lugar de ocurrencia de hechos:</h5>
            <h6>Ciudad :</h6>
            <select name="ciudad-report" class="select-filtro"></select>
            <h6>Barrio/Comuna :</h6>
            <select name="barrio-report" class="select-filtro"></select>
            <h5>Motivo :</h5>
            <select name="motivo-report" class="select-filtro"></select>

        </div>
        </div>
    </div>
</template>

<script>

    export default {
        name: "ReportesC",  
        data(){
            return{
                rem:""
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>