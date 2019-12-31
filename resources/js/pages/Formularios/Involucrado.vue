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
            <option value="Femenino">Femenino</option>
            <option value="Masculino">Masculino</option>
            <option value="No sabe, no responde">No sabe, no responde</option>
            <option value="Otro">Otro</option>
          </select>
        </div>
        <div class="contenedorGeneral">
          <label for>Enfoque diferencial :</label>
          <select class="izquierda, redondear" name="involucrado[comunidad][]" required>
            <option selected value="0">Seleccione</option>
            <option value="Indígena">Indígena</option>
            <optgroup label="Comunidades negras">
              <option value="Afrocolombianas">Afrocolombianas</option>
              <option value="Palenqueras">Palenqueras</option>
              <option value="Raizales">Raizales</option>
            </optgroup>
            <optgroup label="Gitanos">
              <option value="Rom">Rom</option>
            </optgroup>
            <option value="persona con discapacidad">persona con discapacidad</option>
            <option value="No aplica">No aplica</option>
          </select>
        </div>
        <div class="contenedorGeneral">
          <label for>Estado civil :</label>
          <select class="redondear" name="involucrado[estado_civil][]" required>
            <option value selected>Seleccione</option>
            <option value="Soltero">Soltero</option>
            <option value="Casado">Casado</option>
            <option value="Unión libre">Unión libre</option>
            <option value="Divorsiado">Divorsiado</option>
          </select>
        </div>
        <div class="contenedorGeneral">
          <label for>Grado de escolaridad :</label>
          <select class="redondear" name="involucrado[grado_esco][]" required>
            <option value selected>Seleccione</option>
            <option value="Educación de la primera infancia">Educación de la primera infancia</option>
            <option value="Educación básica primaria">Educación básica primaria</option>
            <option value="Educación básica secundaria">Educación básica secundaria</option>
            <option value="Educación media">Educación media</option>
            <option value="Educación postsecundaria, no superior">Educación postsecundaria, no superior</option>
            <option value="Educación técnica profesional y tecnológica">Educación técnica profesional y tecnológica</option>
            <option value="Universitario o equivalente">Universitario o equivalente</option>
            <option value="Especialización">Especialización</option>
            <option value="Maestría o equivalente">Maestría o equivalente</option>
            <option value="Doctorado o equivalente">Doctorado o equivalente</option>
            <option value="Ninguna">Ninguna</option>
            <option value="No informa">No informa</option>
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
              <option value="TI">TI</option>
              <option value="CC">CC</option>
              <option value="Cédula de extranjero">Cédula de extranjero</option>
            </select>
            <p></p>
            <input type="number" class="redondear" name="involucrado[documento][]" placeholder="No. de identificación" required/>
          </div>
        </div>
        <div class="contenedorGeneral">
          <label>Fecha de expedición del documento :</label>
          <input type="date" placeholder="dd/mm/aa" name="involucrado[fecha_expe][]" class="redondear" required/>
        </div>
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
        <p></p>
        <h5>Datos de contacto :</h5>

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