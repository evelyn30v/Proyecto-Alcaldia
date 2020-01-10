<template>
  <div id="verDep" class="modalPeq">
    <div class="contenedor dialogModal" style="width:80%">
      <div v-for="u in casosArray" :key="u.id" v-if="idcaso === u.id">
        <!-- {{iddependencia}} -->

        <div class="modal-header">
          <h2 style="width:50%">Caso: {{u.id}}</h2>
          <div style="padding:10px;" v-for="r in remisionesArray" :key="r.id">
            <h5 v-if="r.id===u.id_remision" style="color:#828FBF">Remisión: {{r.nombre}}</h5>
          </div>
          <div style="padding:10px;" >
            <h5 style="color:#828FBF">Estado: {{u.estado}}</h5>
          </div>
        </div>
        <div class="modal-body">
          <div class="formulario" style="margin:40px 0px 40px 0px">
            <div>
              <h4>Involucrados:</h4>
              <div v-for="d in involucradosArray" :key="d.id" v-if="d.id_registro_caso===u.id">
                <div class="dos_auto">
                  <div>
                    <h5>
                      - {{d.nombre}}
                      <h6>{{d.tipo_documento}}: {{d.no_documento}}</h6>
                      <h6 style="color:#828FBF">Rol: {{d.rol}}</h6>
                    </h5>
                  </div>
                  <!-- <p></p> -->
                  <div>
                    <a style="color:#828FBF" href="#" @click="estadoInv=true; involucrado_ver=d.id">ver</a>
                  </div>
                </div>
              </div>
            
            <div v-for="m in motivoArray" :key="m.id">
              <h4 v-if="u.id_motivo===m.id">Motivo:</h4>
              <div
                v-for="del in delitoArray"
                :key="del.id"
                v-if="u.id_motivo===m.id && del.id===m.id_tipo_delito"
              >
                <h6>
                  Tipo de delito:
                  <h6 style="color:#828FBF">{{del.nombre}}</h6>
                </h6>
              </div>
              <div
                v-for="mot in tipoMotArray"
                :key="mot.id"
                v-if="u.id_motivo===m.id && mot.id===m.id_tipo_motivo"
              >
                <h6>
                  Tipo de motivo:
                  <h6 style="color:#828FBF">{{mot.nombre}}</h6>
                </h6>
              </div>
              <div
                v-for="ciud in ciudArray"
                :key="ciud.id"
                v-if="u.id_motivo===m.id && ciud.id===m.id_ciudad"
              >
                <div>
                  <div
                    v-for="depto in deptoArray"
                    :key="depto.id"
                    v-if="u.id_motivo===m.id && ciud.id_departamento===depto.id"
                  >
                    <div
                      v-for="pais in paisArray"
                      :key="pais.id"
                      v-if="u.id_motivo===m.id && depto.id_pais===pais.id"
                    >
                      <h6>
                        Ocurrencia de los hechos:
                        <h6
                          style="color:#828FBF"
                        >{{ciud.nombre}}, {{depto.nombre}}, {{pais.nombre}}.</h6>
                      </h6>
                    </div>
                  </div>
                </div>
                <h6 v-if="u.created_at">
                  Fecha de registro:
                  <h6 style="color:#828FBF">{{u.created_at}}</h6>
                </h6>
                <h6 v-if="u.created_at">
                  Registrado por:
                  <h6 style="color:#009688">{{u.created_at}}</h6>
                </h6>

              </div>
            </div>
          </div>


              <div class="vl"></div>


              <div v-if="estadoInv===true">
                <div v-for="inv in involucradosArray" :key="inv.d">
                  <div v-if="inv.id === involucrado_ver">
                    <table class="table table-bordered">
                      <th style="text-align:center" colspan="4">Datos de involucrado</th>
                      <tr colspan="4">
                        <td colspan="2">Rol del involucrado</td>
                        <td colspan="2">{{inv.rol}}</td>
                      </tr>
                      <th style="text-align:center" colspan="4">Datos personales</th>
                      <tr>
                        <td colspan="2"><h6>Nombres y apellidos</h6></td>
                        <td colspan="2"><h6>{{inv.nombre}}</h6></td>
                      </tr>
                      <tr>
                        <td width=25%>Tipo de documento</td>
                        <td width=25%>{{inv.tipo_documento}}</td>
                        <td width=25%>Número de documento</td>
                        <td width=25%>{{inv.no_documento}}</td>
                      </tr>
                      <tr>
                        <td colspan="2">Fecha de expedición del documento</td>
                        <td colspan="2">{{inv.fecha_exp_documento}}</td>
                      </tr>
                      <tr>
                        <td colspan="2">Fecha de Nacimiento</td>
                        <td colspan="2">{{inv.fecha_nacimiento}}</td>
                      </tr>
                      <tr v-for="p in paisArray" :key="p.id+'pais_origen'" v-if="inv.id_pais===p.id">
                        <td colspan="2">País de nacimiento</td>
                        <td colspan="2">{{p.nombre}}</td>
                      </tr>
                      <tr>
                        <td colspan="2">Género</td>
                        <td colspan="2">{{inv.genero}}</td>
                      </tr>
                      <tr>
                        <td colspan="2">Enfoque diferencial</td>
                        <td colspan="2">{{inv.enfoque_diferencial}}</td>
                      </tr>
                      <tr>
                        <td colspan="2">Estado civil</td>
                        <td colspan="2">{{inv.estado_civil}}</td>
                      </tr>
                      <tr>
                        <td colspan="2">Grado de escolaridad</td>
                        <td colspan="2">{{inv.grado_escolaridad}}</td>
                      </tr>
                      
                      <tr>
                        <td width=25%>Estrato</td>
                        <td width=10%>{{inv.estrato}}</td>
                        <td width=28%>Empresa de salud</td>
                        <td width=37%>{{inv.salud_empresa}}</td>
                      </tr>
                      <th colspan="4" style="text-align:center">Datos de contacto</th>
                      <tr>
                        <td colspan="2">Correo</td>
                        <td colspan="2">{{inv.correo}}</td>
                        <!-- <td width=25%>No. celular</td>
                        <td width=25%>{{correo}}</td> -->
                      </tr>
                      <tr  v-for="c in ciudArray" :key="c.id+'city'" v-if="inv.id_ciudad_contacto=== c.id">
                            <td colspan="2">Dirección</td>
                            <td colspan="2">
                              <div v-for="d in deptoArray" :key="d.id">
                                <div v-for="p in paisArray" :key="p.id">
                                  <div v-if="d.id===c.id_departamento && p.id===d.id_pais">
                                  {{inv.direccion_contacto}}, {{c.nombre}}, {{d.nombre}}, {{p.nombre}}
                                  </div>
                                </div>
                              </div>
                            </td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</template>

<script>
export default {
  name: "casos",
  data() {
    return {
      involucrado_ver:"",
      casosArray: [],
      involucradosArray: [],
      remisionesArray: [],
      motivoArray: [],
      tipoMotArray: [],
      delitoArray: [],

      paisArray: [],
      deptoArray: [],
      ciudArray: [],
      estadoVer: false,

      estadoInv: false,
    };
  },
  methods: {
    casosView: function() {
      var url = "registro_caso";
      axios.get(url).then(Response => {
        this.casosArray = Response.data;
        // console.log(Response.data().nombre);
        //console.log(this.solicitantes)
      });
    },
    InvolucradosView: function() {
      var urlsolic = "involucrado";
      axios.get(urlsolic).then(Response => {
        this.involucradosArray = Response.data;
      });
    },
    RemView: function() {
      var urlsolic = "remision";
      axios.get(urlsolic).then(Response => {
        this.remisionesArray = Response.data;
        // console.log(this.remisionesArray);
      });
    },
    MotivoView: function() {
      var urlsolic = "motivo";
      axios.get(urlsolic).then(Response => {
        this.motivoArray = Response.data;
        // console.log(this.remisionesArray);
      });
    },
    DelitoView: function() {
      var urlsolic = "tDelito";
      axios.get(urlsolic).then(Response => {
        this.delitoArray = Response.data;
        // console.log(this.remisionesArray);
      });
    },
    TmotivoView: function() {
      var urlsolic = "tipo_motivo";
      axios.get(urlsolic).then(Response => {
        this.tipoMotArray = Response.data;
        // console.log(this.remisionesArray);
      });
    },
    ciudadView: function() {
      var urlsolic = "ciudad";
      axios.get(urlsolic).then(Response => {
        this.ciudArray = Response.data;
        // console.log(this.remisionesArray);
      });
    },
    departamentoView: function() {
      var urlsolic = "depto";
      axios.get(urlsolic).then(Response => {
        this.deptoArray = Response.data;
        // console.log(this.remisionesArray);
      });
    },
    paisView: function() {
      var urlsolic = "pais";
      axios.get(urlsolic).then(Response => {
        this.paisArray = Response.data;
        // console.log(this.remisionesArray);
      });
    }
  },
  created: function() {
    this.InvolucradosView();
    this.RemView();
    this.TmotivoView();
    this.DelitoView();
    this.MotivoView();
    this.casosView();

    this.paisView();
    this.departamentoView();
    this.ciudadView();
  },
  props: [
    // 'idDependenciaTabla',
    "idcaso"
  ]
};
</script>

<style lang="scss" scoped>
</style>