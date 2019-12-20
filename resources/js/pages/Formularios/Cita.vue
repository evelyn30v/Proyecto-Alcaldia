<template>
    <div>

        <h4 style="margin-top:40px; text-align: center;">Citación</h4>
        <input type="hidden" name="_token" :value="csrf"/>
        <div class="formulario">
          <div class="izquierda">

            <div class="contenedorGeneral">
              <label for>Lugar de citación :</label>
              <input type="text" list="lugarList" name="lugarInput_cita" @change="guardarLug()"
              placeholder="Escriba o seleccione" v-model="newLugar" class="redondear" required>
              <datalist id="lugarList">
                <option v-for="l in lugarArray" :key="l.id">
                  {{l.nombre}}
                </option>
              </datalist>
            <input
              type="hidden"
              name="lugar_cita"
              v-model="newLugar_name_input"
              required/>
            </div>

              <label for>Convocante(s) :</label>
              <div v-if="estado_cte">
                <div v-for="cte in convocantesArray" :key="cte">
                <input type="text" class="redondear" placeholder="Nombre del convocante" name="convocante[nombre][]" required/>
              </div>
              </div>
              
            <div class="dos" >
                <input type="number" class="redondear" v-model="no_ctes" placeholder="No. de convocantes">
                <div class="mas" @click="ArrayConvocantes_m()" @focus="estado_cte = false"><i class="material-icons">add</i></div>
            </div>
                
            
              <label for>Convocados(s) :</label>
              <div v-if="estado_cdo">
                <div v-for="cdo in convocadosArray" :key="cdo">
                  <input type="text" class="redondear" placeholder="Nombre del convocado" name="convocado[nombre][]" required/>
                </div>
              </div>
            <div class="dos">
              <input type="number" class="redondear" v-model="no_cdos" placeholder="No. de convocados">
                <div class="mas" @click="ArrayConvocados_m()" @focus="estado_cdo = false"><i class="material-icons">add</i></div>
            </div>
          </div>

          <div class="vl"></div>

          <div class="derecha">
            <div class="contenedorGeneral">
              <label for>Fecha de citación :</label>
              <input type="date" class="redondear" placeholder="dd/mm/aa" name="fecha_cita" required/>
            </div>
            <div class="contenedorGeneral">
              <label for>hora de citación :</label>
              <input
                type="time"
                id="hora-cita"
                name="hora_cita"
                class="redondear"
                min="08:00"
                max="12:00"
                required/>
            </div>
            <div class="contenedorGeneral">
              <label for>Duración :</label>
              <div class="formulario">
                <input type="number" id="duracion" name="duracion_cita" class="redondear" min="1" required/>
                <p></p>
                <select name="tiempo_cita" class="redondear" required>
                  <option value selected>Seleccione</option>
                  <option value="1">Minutos</option>
                  <option value="2">Horas</option>
                </select>
              </div>
            </div>
          </div>
        </div>

    </div>
</template>

<script>
    export default {
    name: 'Cita',
        data() {
    return {
      lugarArray:[],
      convocantesArray:[],
      convocadosArray:[],
      newLugar_name_input:'',
      delito: "",
      newLugar:"",
      estado_cte: false,
      estado_cdo: false,
      no_cdos:'',
      no_ctes:'',
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content")
    };
    },
    methods:{
    ArrayConvocantes_m: function() {
      console.log('cambio');
      this.convocantesArray.length = this.no_ctes;
      this.estado_cte = true;
    },
    ArrayConvocados_m: function() {
      this.convocadosArray.length = this.no_cdos;
      this.estado_cdo = true;
      //  console.log(this.InvolucradoArray);
    },
      lugarGet: function(){
      //console.log('hola');
      var urlDel= 'lugar';
      axios.get(urlDel).then(Response => {
        this.lugarArray = Response.data;
      });
    },
    guardarLug: function(){
      for(var i in this.lugarArray){
        if(this.lugarArray[i].nombre == this.newLugar){
          this.newLugar_name_input = this.lugarArray[i].id;
          console.log('if');
          return this.newLugar_name_input;
        }
        }
        return this.newLugar_name_input;
    },
    },
    created: function(){
      this.lugarGet();
    },
    };
</script>

<style lang="scss" scoped>

</style>