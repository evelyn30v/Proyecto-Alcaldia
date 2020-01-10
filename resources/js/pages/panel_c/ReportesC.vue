<template>
  <div class="contenedordeformularios">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <div class="tituloInicial">
      <h1>Reportes</h1>
    </div>
    <div class="dos">
      <div class="contenedorpeq" style="width:97%">
        <div v-if="!aceptar">
          <img class="image" src="../../assets/reporte.png" />
        </div>

        <div v-if="aceptar">




          <h4 style="margin-bottom:50px">Reporte de casos</h4>
          <table class="table table-hover table-sprite">
            <thead>
              <tr>
                <th>Descripción</th>
                <th>Cantidad</th>
                <th colspan="5">&nbsp;</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Casos conciliados</td>
                <td>{{this.cantidad_conciliado}}</td>
              </tr>
              <tr>
                <td>Casos en no acuerdo</td>
                <td>{{this.cantidad_desacuerdo}}</td>
              </tr>
              <tr>
                <td>Casos resueltos</td>
                <td>{{this.cantidad_resuelto}}</td>
              </tr>
              <tr>
                <td>Casos remitidos</td>
                <td>{{this.cantidad_remitido}}</td>
              </tr>
              <tr>
                <td>Total de casos atendidos</td>
                <td>{{this.cantidad}}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- <line-chart :chart-data="datacollection" :height="100"></line-chart> -->
      </div>
      <div class="contenedorpeq">
        <h4 style="margin-bottom:30px">Filtrar por fecha:</h4>

        <!-- <h5>Delitos :</h5>
        <div class="contenedorGeneral">
              <label for>Tipo de delito :</label>
              <input
                type="text"
                list="delitoList"
                @change="guardarDel()"
                name="delitos_report_s"
                placeholder="Escriba o seleccione"
                v-model="newDelito"
                class="redondear"
                required
              />
              <datalist id="delitoList">
                <option v-for="d in delitoArray" :key="d.id">{{d.nombre}}</option>
              </datalist>
              <input type="hidden" name="delitos_report" v-model="newDelito_name_input" required />
        </div>-->
        <div class="contenedorGeneral">
          <h5>Reporte :</h5>
          <div>
            <div>
              <input
                type="date"
                class="redondear"
                placeholder="año inicial"
                name="anio_i"
                v-model="anio_inicial"
                required
              />
              <p></p>
              <input
                type="date"
                class="redondear"
                placeholder="año final"
                name="anio_f"
                v-model="anio_final"
                required
              />
              <button class="buttonA" @click="ejecutar(); aceptar=true">Aceptar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "reportesC",
  components: {},
  data() {
    return {
      aceptar: false,

      rem: "",
      datacollection: null,
      anio_inicial: "",
      anio_final: "",
      mes_inicial: "",
      mes_final: "",
      anio_mes: "",

      ArrayConciliado: [],
      cantidad_conciliado: "",

      ArrayDesacuerdo: [],
      cantidad_desacuerdo: "",

      ArrayResuelto: [],
      cantidad_resuelto: "",

      ArrayRemitido: [],
      cantidad_remitido: "",

      casosArray: "",
      arrayAnio: [],
      cantidadArray: [],
      cantidad: "",
      newDelito: "",

      delitosArray_mes: [],
      arrayMes: []
    };
  },
  mounted() {},

  methods: {
    ejecutar: function() {
      this.llenarArrayAnio();
      this.llenarArrayConciliado();
      this.llenarArrayDesacuerdo();
      this.llenarArrayResuelto();
      this.llenarArrayRemitido();
    },

    // delitoGet: function() {
    //   //console.log('hola');
    //   var urlDel = "tDelito";
    //   axios.get(urlDel).then(Response => {
    //     this.delitoArray = Response.data;
    //   });
    // },
    // guardarDel: function() {
    //   for (var i in this.delitoArray) {
    //     if (this.delitoArray[i].nombre == this.newDelito) {
    //       this.newDelito_name_input = this.delitoArray[i].id;
    //       console.log("if");
    //       return this.newDelito_name_input;
    //     }
    //   }
    //   return this.newDelito_name_input;
    // },

    llenarArrayAnio: function() {
      this.cantidad = 0;
      this.cantidadArray.length = 0;
      var url = "reporte_caso_anio";
      axios
        .post(url, {
          anio_i: this.anio_inicial,
          anio_f: this.anio_final,
          delitos_report: this.newDelito
        })
        .then(Response => {
          this.casosArray = Response.data;
          this.cantidad = this.casosArray.length;
          // console.log(this.cantidad);
        });
    },
    llenarArrayConciliado: function() {
      this.cantidad_conciliado = 0;
      // this.cantidadArray.length = 0;
      var url = "reporte_caso_conciliado";
      axios
        .post(url, {
          anio_i: this.anio_inicial,
          anio_f: this.anio_final
        })
        .then(Response => {
          this.ArrayConciliado = Response.data;
          this.cantidad_conciliado = this.ArrayConciliado.length;
          // console.log(this.cantidad_conciliado);
        });
    },
    llenarArrayDesacuerdo: function() {
      this.cantidad_desacuerdo = 0;
      // this.cantidadArray.length = 0;
      var url = "reporte_caso_desacuerdo";
      axios
        .post(url, {
          anio_i: this.anio_inicial,
          anio_f: this.anio_final
        })
        .then(Response => {
          this.ArrayDesacuerdo = Response.data;
          this.cantidad_desacuerdo = this.ArrayDesacuerdo.length;
          // console.log(this.ArrayDesacuerdo);
        });
    },
    llenarArrayResuelto: function() {
      this.cantidad_resuelto = 0;
      // this.cantidadArray.length = 0;
      var url = "reporte_caso_resuelto";
      axios
        .post(url, {
          anio_i: this.anio_inicial,
          anio_f: this.anio_final
        })
        .then(Response => {
          this.ArrayResuelto = Response.data;
          this.cantidad_resuelto = this.ArrayResuelto.length;
          console.log(this.cantidad_resuelto);
        });
    },
    llenarArrayRemitido: function() {
      this.cantidad_remitido = 0;
      // this.cantidadArray.length = 0;
      var url = "reporte_caso_remitido";
      axios
        .post(url, {
          anio_i: this.anio_inicial,
          anio_f: this.anio_final
        })
        .then(Response => {
          this.ArrayRemitido = Response.data;
          this.cantidad_remitido = this.ArrayRemitido.length;
          console.log(this.cantidad_remitido);
        });
    }
  },
  created: function() {
    // this.delitoGet();
  }
};
</script>

<style lang="scss" scoped>
</style>    