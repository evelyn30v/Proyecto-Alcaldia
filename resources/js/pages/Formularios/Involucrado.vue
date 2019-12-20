<template>
  <div>
    <h4 style="margin-top:40px; text-align: center;">Datos personales de los involucrados</h4>
    <h5 style="text-align: center">Involucrado 1</h5>

    <div class="formulario">
      <div class="izquierda">
        <div class="contenedorGeneral">
          <label class="derecha" for="label_delito">Rol del involucrado :</label>
          <input type="text" list="rolList" placeholder="seleccione o escriba" class="redondear" name="involucrado[rol][]"  required>
          <datalist id="rolList">
            <option value="Solicitante">Solicitante</option>
            <option value="Víctima">Víctima</option>
            <option value="Denunciante">Denunciante</option>
            <option value="Denunciado">Denunciado</option>
            <option value="Requerido">Requerido</option>
          </datalist>
        </div>
        <div class="contenedorGeneral">
          <label for>Nombre y apellido :</label>
          <input type="text" class="redondear" name="involucrado[np][]" placeholder="Nombre y apellidos completos" required/>
        </div>

        <div class="contenedorGeneral">
          <label for>País de orígen :</label>
          <select name="involucrado[pais_origen][]" class="redondear" ref="idPaisValue" v-model="paisSelect" required>
            <option value selected>Seleccione</option>
            <option v-for="p in PaisArray" :key="p.id" v-bind:value="p.id">{{p.nombre}}</option>
          </select>
        </div>

        <div class="contenedorGeneral">
          <label for>fecha de nacimiento :</label>
          <input type="date" name="involucrado[fecha_nacimiento][]" class="redondear" required/>
        </div>
        <div class="contenedorGeneral">
          <label for>Género :</label>
          <select class="redondear" name="involucrado[genero][]" required>
            <option value selected>Seleccione</option>
            <option value="f">Femenino</option>
            <option value="m">Masculino</option>
            <option value="n">No sabe, no responde</option>
            <option value="o">Otro</option>
          </select>
        </div>
        <div class="contenedorGeneral">
          <label for>Enfoque diferencial :</label>
          <select class="izquierda, redondear" name="involucrado[comunidad][]" required>
            <option selected value="0">Seleccione</option>
            <option value="1">Indígena</option>
            <optgroup label="Comunidades negras">
              <option value="2">Afrocolombianas</option>
              <option value="3">Palenqueras</option>
              <option value="4">Raizales</option>
            </optgroup>
            <optgroup label="Gitanos">
              <option value="5">Rom</option>
              <option value="6">Extorsión</option>
            </optgroup>
            <option value="10">persona con discapacidad</option>
            <option value="11">No aplica</option>
          </select>
        </div>
        <div class="contenedorGeneral">
          <label for>Estado civil :</label>
          <select class="redondear" name="involucrado[estado_civil][]" required>
            <option value selected>Seleccione</option>
            <option value="SO">Soltero</option>
            <option value="CA">Casado</option>
            <option value="UL">Unión libre</option>
            <option value="DI">Divorsiado</option>
          </select>
        </div>
        <div class="contenedorGeneral">
          <label for>Grado de escolaridad :</label>
          <select class="redondear" name="involucrado[grado_esco][]" required>
            <option value selected>Seleccione</option>
            <option value="PI">Educación de la primera infancia</option>
            <option value="BP">Educación básica primaria</option>
            <option value="BS">Educación básica secundaria</option>
            <option value="EM">Educación media</option>
            <option value="PS">Educación postsecundaria, no superior</option>
            <option value="ET">Educación técnica profesional y tecnológica</option>
            <option value="UN">Universitario o equivalente</option>
            <option value="ES">Especialización</option>
            <option value="MA">Maestría o equivalente</option>
            <option value="DO">Doctorado o equivalente</option>
            <option value="NN">Ninguna</option>
            <option value="NI">No informa</option>
          </select>
        </div>

        <div class="contenedorGeneral">
          <label for>Empresa de salud:</label>
          <input type="text" name="involucrado[emp_s][]" class="redondear" placeholder="Nombre" />
        </div>
      </div>

      <div class="vl"></div>

      <div class="derecha">
        <div class="contenedorGeneral">
          <label class="derecha" for="label_delito">Documento :</label>
          <div class="formulario">
            <select class="redondear" name="involucrado[doc_id][]" v-model="documento" required>
              <option value="1">TI</option>
              <option value="2">CC</option>
              <option value="3">Extranjero</option>
            </select>
            <p></p>
            <input type="number" class="redondear" name="involucrado[documento][]" placeholder="No. de identificación" required/>
          </div>
        </div>
        <div class="contenedorGeneral">
          <label>Fecha de expedición del documento :</label>
          <input type="date" placeholder="dd/mm/aa" name="involucrado[fecha_expe][]" class="redondear" required/>
        </div>
        <div id="lugar_exped_doc" v-if="documento==1|documento==2">
          <p>Lugar de expedición del documento :</p>

          <div class="contenedorGeneral">
            <label for>Departamento :</label>
            <select
              name="involucrado[dpto_hechos][]"
              id="depto_hechos"
              class="redondear"
              ref="idDeptoValue"
              v-model="depto3Select"
              required>
              <option value selected>Seleccione</option>
              <option v-for="d in DeptoArray" :key="d.id" v-bind:value="d.id">
                <p>{{d.nombre}}</p>
              </option>
            </select>
          </div>

          <div class="contenedorGeneral">
            <label for>Ciudad :</label>
            <select name="involucrado[ciud_hechos][]" id="ciud_hechos" class="redondear" required>
              <option value selected>Seleccione</option>
              <option
                v-for="c in CiudArray"
                :key="c.id"
                v-bind:value="c.id"
                v-if="c.id_departamento===depto3Select"
              >{{c.nombre}}</option>
            </select>
          </div>
        </div>

        <p>Datos de contacto :</p>

        <div class="contenedorGeneral">
          <label for>País :</label>
          <select name="involucrado[pais_hechos][]" class="redondear" ref="idPaisValue" v-model="pais2Select" required>
            <option value selected>Seleccione</option>
            <option v-for="p in PaisArray" :key="p.id" v-bind:value="p.id">{{p.nombre}}</option>
          </select>
        </div>

        <div class="contenedorGeneral">
          <label for>Departamento :</label>
          <select
            name="involucrado[dpto_hecho_cont][]"
            id="depto_hechos"
            class="redondear"
            ref="idDeptoValue"
            v-model="depto2Select"
            required>
            <option value selected>Seleccione</option>
            <option
              v-for="d in DeptoArray"
              :key="d.id"
              v-bind:value="d.id"
              v-if="d.id_pais===pais2Select"
            >
              <p>{{d.nombre}}</p>
            </option>
          </select>
        </div>

        <div class="contenedorGeneral">
          <label for>Ciudad :</label>
          <select name="involucrado[ciudad_hecho_con][]" id="ciud_hechos" class="redondear" required>
            <option value selected>Seleccione</option>
            <option
              v-for="c in CiudArray"
              :key="c.id"
              v-bind:value="c.id"
              v-if="c.id_departamento===depto2Select"
            >{{c.nombre}}</option>
          </select>
        </div>

        <div class="contenedorGeneral">
          <label for>Comuna/Barrio :</label>
          <input type="text" class="redondear" name="involucrado[comu_barrio][]" placeholder="Cra. # No. de casa" required/>
        </div>
        <div class="contenedorGeneral">
          <label for>Estrato :</label>
          <select name="involucrado[estrato][]" id="departamento" class="redondear" required>
            <option value selected>Seleccione</option>
            <option value="1">0-1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5 o mayor</option>
          </select>
        </div>
        <div class="contenedorGeneral">
          <label for>Correo Electrónico :</label>
          <input type="email" placeholder="ejemlo@ejemplo.com" name="involucrado[correo][]" class="redondear" required/>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "involucrado",
  data() {
    return {
      paisSelect: "",
      pais2Select: "",
      PaisArray: [],
      deptoSelect: "",
      depto2Select: "",
      depto3Select: "",
      DeptoArray: [],
      CiudArray: [],

      rem: "",
      delito: "",
      rolInv:"",
      delito_cual: "",
      otro: "",
      remision: "",
      documento: "",
      cita: false,
      cte: false,
      cdo: false
    };
  },
  methods: {
    paisGet: function() {
      //console.log('hola');
      var url = "pais";
      axios.get(url).then(Response => {
        this.PaisArray = Response.data;
      });
    },
    deptoGet: function() {
      //console.log('hola');
      var urlRem = "depto";
      axios.get(urlRem).then(Response => {
        this.DeptoArray = Response.data;
      });
    },
    ciudadGet: function() {
      //console.log('hola');
      var urlRem = "ciudad";
      axios.get(urlRem).then(Response => {
        this.CiudArray = Response.data;
      });
    }
  },
  created: function() {
    this.paisGet();
    this.deptoGet();
    this.ciudadGet();
  }
};
</script>

<style lang="scss" scoped>
</style>