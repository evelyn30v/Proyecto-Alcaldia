
<template>
  <div class="contenedordeformularios">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <div class="tituloInicial">
      <h1>Reportes</h1>
    </div>
    <!-- <div class="contenedorGeneral">
      <div class="tres">
        <h5>Reporte :</h5>
        <div>
          <input class="radio" type="radio" v-model="rem" value="2" />Mensual
        </div>
        <div>
          <input class="radio" type="radio" v-model="rem" value="3" />Anual
        </div>
        <p></p>
      </div>
    </div> -->
    <div class="dos">
      <div>
        <div class="contenedorpeq" style="width:97%; margin-bottom:10px">
          <h4 style="margin-bottom:50px">Reporte</h4>
          <line-chart :chart-data="datacollection" :height="100"></line-chart>
      </div>
      <div class="contenedorpeq" style="width:97%">
        <h4>Mensual</h4>
        <h4>Anual</h4>
      </div>
      </div>
      <div class="contenedorpeq">
        <h4 style="margin-bottom:30px">Filtrar por :</h4>
        <h5>Estado de casos :</h5>
        <select class="select-filtro" name="estado-caso" id>
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
import LineChart from "../LineChart.js";

export default {
  name: "reportesC",
  components: {
    LineChart
  },
  data() {
    return {
      rem: "",
      datacollection: null
    };
  },
  mounted() {
    this.fillData();
  },
  methods: {
    fillData() {
      this.datacollection = {
        labels: [
          "Lunes",
          "Martes",
          "Miercoles",
          "Jueves",
          "Viernes",
          "Sabado",
          "Domingo"
        ],
        datasets: [
          {
            label: "Delitos",
            backgroundColor: "#FF0066",
            data: [20, 40, 50, 20, 50, 40]
          }
        ]
      };
    }
  }
};
</script>

<style lang="scss" scoped>
</style>