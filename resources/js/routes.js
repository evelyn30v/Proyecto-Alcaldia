import Vue from 'vue';
import VueRouter from 'vue-router';

import Bienvenido from './pages/login/Bienvenido.vue';
import Login from './pages/login/Login.vue';

import Admin from './pages/Admin/MenuAdmin.vue';
import RegistrosAdmin from './pages/Admin/RegistrosAdmin.vue';
import RegistroUsuario from './pages/Formularios/RegistroUsuario.vue';
import NuevaDependencia from './pages/Formularios/NuevaDependencia.vue';
import Usuarios from './pages/Admin/Usuarios.vue';
import Dependencia from './pages/Admin/Dependencias.vue';
// import RegistroMp from './pages/Formularios/RegistroMp.vue';
//import Reportes from './pages/panel_a/Reportes.vue';

import PanelA from './pages/panel_a/Menu.vue';
import Registros from './pages/panel_a/Registros.vue';
import RegistroDelitos from './pages/Formularios/RegistroDelitos.vue';
import RegistroMc from './pages/Formularios/RegistroMc.vue';
import RegistroMp from './pages/Formularios/RegistroMp.vue';
import Reportes from './pages/panel_a/Reportes.vue';

import panelC from './pages/panel_c/MenuC.vue';
import RegistrosC from './pages/panel_c/RegistroC.vue';
import RegistroSolic from './pages/Formularios/RegistroSolic.vue';
import RegistroCaso from './pages/Formularios/RegistroCaso.vue';
import ReportesC from './pages/panel_c/ReportesC.vue';
import Casos from './pages/panel_c/Casos.vue';
import Involucrado from './pages/Formularios/Involucrado.vue';
import Citacion from './pages/Formularios/Cita.vue';
import Solicitudes from './pages/panel_c/Solicitudes.vue';

import VerDep from './pages/ver/verDep.vue';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            component: Bienvenido,
            name: 'Bienvenido',
            children: [
                {
                    path: '/login',
                    component: Login,
                    name: 'login',
                }
            ]
        },
        {
            path: '/panel_a',
            component: PanelA,
            name: 'panel_a',
        },
        {
            path: '/registros',
            component: Registros,
            name: 'registros',
        },
        {
            path: '/reportes',
            component: Reportes,
            name: 'reportes'
        },

        {
            path: '/RegistroDelitos',
            component: RegistroDelitos,
            name: 'RegistroDelitos',
        },
        {
            path: '/RegistroMc',
            component: RegistroMc,
            name: 'RegistroMc',
        },
        {
            path: '/RegistroMp',
            component: RegistroMp,
            name: 'RegistroMp',
        },
        {
            path: '/panel_c',
            component: panelC,
            name: 'panel_c',
        },
        {
            path: '/involucrado',
            component: Involucrado,
            name: 'Involucrado'
        },
        {
            path: '/verDep',
            component: VerDep,
            name: 'verDep'
        },
        {
            path: '/citacion',
            component: Citacion,
            name: 'Citacion'
        },
        {
            path: '/registroC',
            component: RegistrosC,
            name: 'registroC',
        },
        {
            path: '/reportesC',
            component: ReportesC,
            name: 'reportesC'
        },
        {
            path: '/registro_solic',
            component: RegistroSolic,
            name: 'registro_solic'
        },
        {
            path: '/registroCaso',
            component: RegistroCaso,
            name: 'registroCaso'
        },
        {
            path: '/Casos',
            component: Casos,
            name: 'Casos'
        },
        {
            path: '/Solicitudes',
            component: Solicitudes,
            name: 'Solicitudes'
        },

        {
            path: '/Admin',
            component: Admin,
            name: 'Admin',
        },
        {
            path: '/RegistrosAdmin',
            component: RegistrosAdmin,
            name: 'RegistrosAdmin',
        },
        {
            path: '/RegistroUsuario',
            component: RegistroUsuario,
            name: 'RegistroUsuario'
        },
        {
            path: '/NuevaDependencia',
            component: NuevaDependencia,
            name: 'NuevaDependencia'
        },
        {
            path: '/usuarios',
            component: Usuarios,
            name: 'Usuarios'
        },
        {
            path: '/dependencia',
            component: Dependencia,
            name: 'Dependencia'
        },



    ]
});

export default router;