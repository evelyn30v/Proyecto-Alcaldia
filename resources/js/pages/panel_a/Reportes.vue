<template>
  <div class="contenedordeformularios">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <div class="tituloInicial">
      <h1>Reportes</h1>
    </div>

    <div class="dos">
      <div class="contenedorpeq" style="width:97%">
        <h4 style="margin-bottom:50px">Reporte</h4>
        <line-chart :chart-data="datacollection" :height="100"></line-chart>
      </div>
      <div class="contenedorpeq">
        <h4 style="margin-bottom:30px">Filtrar por :</h4>

        <h5>Delitos :</h5>
        <select name="delitos_report" class="select-filtro" v-model="newDelito">
          <option value="0">Todos</option>
          <optgroup label="Homicidio">
            <option value="2">Homicidio</option>
          </optgroup>
          <optgroup label="Hurto">
            <option value="3">Hurto a personas</option>
            <option value="4">Hurto a comercio</option>
            <option value="5">Hurto a residencias</option>
            <option value="6">Hurto de automotores</option>
            <option value="7">Extorsión</option>
          </optgroup>
          <optgroup label="Violencia">
            <option value="8">Violencia a niños y adolescentes</option>
            <option value="9">Vioilencia al adulto mayor</option>
            <option value="10">Violencia de pareja</option>
          </optgroup>
        </select>
        <div class="contenedorGeneral">
            <h5>Reporte :</h5>
          <div class="formulario">
            <div>
              <input class="radio" type="radio" v-model="rem" value="1" />Mensual
            </div>
            <p></p>
            <div>
              <input class="radio" type="radio" v-model="rem" value="2" />Anual
            </div>
          </div>
          <div >
            <div v-if="rem==1">
              <select name="mes_i" v-model="mes_inicial" class="select-filtro">
                <option value="1">Enero</option>
                <option value="2">Febrero</option>
                <option value="3">Marzo</option>
                <option value="4">Abril</option>
                <option value="5">Mayo</option>
                <option value="6">Junio</option>
                <option value="7">Julio</option>
                <option value="8">Agosto</option>
                <option value="9">Septiembre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
              </select>
              <p></p>
             <select name="mes_f" v-model="mes_final" class="select-filtro">
                <option value="1">Enero</option>
                <option value="2">Febrero</option>
                <option value="3">Marzo</option>
                <option value="4">Abril</option>
                <option value="5">Mayo</option>
                <option value="6">Junio</option>
                <option value="7">Julio</option>
                <option value="8">Agosto</option>
                <option value="9">Septiembre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
              </select>
              <input type="number" class="select-filtro" placeholder="Año" v-model="anio_mes" name="an_me">
              <button class="buttonA" @click="llenarArrayMes()">Aceptar</button>
            </div>
            <div v-if="rem==2">
              <input
                type="text"
                placeholder="año inicial"
                name="anio_i"
                v-model="anio_inicial"
                required
              />
              <p></p>
              <input
                type="text"
                placeholder="año final"
                name="anio_f"
                v-model="anio_final"
                required
              />
              <button class="buttonA" @click="llenarArrayAnio()">Aceptar</button>
            </div>
          </div>
        </div>
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
      datacollection: null,
      anio_inicial: "",
      anio_final: "",
      mes_inicial: "",
      mes_final: "",
      anio_mes: "",

      casosArray: "",
      arrayAnio: [],
      cantidadArray: [],
      cantidad: "",
      newDelito: "",

      delitosArray_mes: [],
      arrayMes:[],
    };
  },
  mounted() {},
  methods: {
    llenarArrayAnio: function() {
      this.cantidad = 0;
      this.cantidadArray.length = 0;
      var url = "get_delito";
      axios
        .post(url, {
          anio_i: this.anio_inicial,
          anio_f: this.anio_final,
          delitos_report: this.newDelito
        })
        .then(Response => {
          this.casosArray = Response.data;
          this.arrayAnio.length = 0;
          console.log(this.casosArray);
          for (var i = this.anio_inicial; i <= this.anio_final; i++) {
            this.arrayAnio.push(i);
          }
          for (var j in this.arrayAnio) {
            this.cantidad = 0;
            for (var i in this.casosArray) {
              if (parseInt(this.casosArray[i].anio) == this.arrayAnio[j]) {
                this.cantidad += this.casosArray[i].cantidad;
                this.cantidadArray[j] = this.cantidad;
              }
            }

            console.log(this.cantidadArray);
          }
          this.fillData(this.arrayAnio, this.cantidadArray);
        });
    },

    llenarArrayMes: function(){
      this.cantidad = 0;
       this.cantidadArray.length = 0;
       var url = "get_delito_mes";
      axios
        .post(url, {
          mes_i: this.mes_inicial,
          mes_f: this.mes_final,
          an_me: this.anio_mes,
          delitos_report: this.newDelito
        })
        .then(Response => {
          this.delitosArray_mes = Response.data;
          this.arrayMes.length = 0;
          console.log(this.delitosArray_mes);

           for (var i = this.mes_inicial; i <= this.mes_final; i++) {
            this.arrayMes.push(i);
          }
          for (var j in this.arrayMes) {
            this.cantidad = 0;
            for (var i in this.delitosArray_mes) {
              if (parseInt(this.delitosArray_mes[i].mes) == this.arrayMes[j]) {
                this.cantidad += this.delitosArray_mes[i].cantidad;
                this.cantidadArray[j] = this.cantidad;
              }
            }

            console.log(this.cantidadArray);
          }
          this.fillData(this.arrayMes, this.cantidadArray);
        });
    },

    fillData(arrayAnio, cantidadArray) {
      // console.log(casosArray);

      this.datacollection = {
        labels: arrayAnio,
        datasets: [
          {
            label: "Delitos",
            backgroundColor: "#303F9F",
            data: cantidadArray
          }
        ]
      };
    }
  },
  props: ["charData"]
};
</script>

<style lang="scss" scoped>
</style>    