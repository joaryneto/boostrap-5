<!DOCTYPE html>
<html lang="pt-BR" class="md">
<head>
<title>ADV</title>

<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, shrink-to-fit=no, viewport-fit=cover">

<!-- app CSS -->
<link id="theme" rel="stylesheet" href="{!! asset('css/app1.css') !!}" type="text/css">
</head>
<body class="color-theme-blue push-content-right theme-light">

<div class="wrapper">
<div class="page">
    <!--include('layouts.partials.navbar-direito')-->
  <div class="page-content">
  <div id="app">
      <div class="page-content">
        <router-view></router-view>
      </div>
      <div class="footer-tabs footer-spaces border-top text-center">
        <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                <li class="nav-item">
                  <router-link class="nav-link" to="/">
                                <i class="material-icons">home</i>
                                <small class="sr-only">Inicio</small>
                  </router-link>
                </li>
                <li class="nav-item">
            <router-link class="nav-link" to="desafios">
                        <i class="material-icons">description</i>
                        <small class="sr-only">Descrição</small>
            </router-link>
                </li>
                <li class="nav-item">
            <router-link class="nav-link" to="perfil">
                        <i class="material-icons">person</i>
                        <small class="sr-only">Perfil</small>
            </router-link>
                </li>
                <li class="nav-item">
                  <router-link class="nav-link" to="ajuda">
                              <i class="material-icons">help</i>
                              <small class="sr-only">Ajuda</small>
                  </router-link>
                </li>
            </ul>
        </div>
  </div>
</div>
</div>
</div>
<!-- Vue Pages -->
<script src="{!! asset('pages/home.vue.js') !!}"></script>
<script src="{!! asset('pages/desafios.vue.js') !!}"></script>
<script src="{!! asset('pages/perfil.vue.js') !!}"></script>
<script src="{!! asset('pages/ajuda.vue.js') !!}"></script>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/vue@3"></script>
<script src="https://unpkg.com/vue-router@4"></script>

<script src="{!! asset('assets/ectecnologia/js/jquery-3.2.1.min.js') !!}"></script>
<script src="{!! asset('assets/ectecnologia/js/popper.min.js') !!}"></script>
<script src="{!! asset('assets/ectecnologia/vendor/bootstrap-4.3.1/js/bootstrap.min.js') !!}"></script>
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap-4.3.1/js/bootstrap.min.js"></script>-->

<script src="https://unpkg.com/infinite-loading-vue3@1.0.1/dist/infinite-scroll-vue3.min.js"></script>
    
<!-- Sweet-Alert  -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.26/dist/sweetalert2.min.js"></script>


<!-- Vue Instance and Routes -->
<script>

const server = "{{ env('ASSET_URL') }}";

// 1. Define route components.
// These can be imported from other files
//const Home = { template: '<div>Home</div>' }
//const About = { template: '<div>About</div>' }

// 2. Define some routes
// Each route should map to a component.
// We'll talk about nested routes later.
const routes = [
  { path: '/', component: Home },
  { path: '/desafios', component: Desafios },
  { path: '/perfil', component: Perfil },
  { path: '/ajuda', component: Ajuda },
]

// 3. Create the router instance and pass the `routes` option
// You can pass in additional options here, but let's
// keep it simple for now.
const router = VueRouter.createRouter({
  // 4. Provide the history implementation to use. We are using the hash history for simplicity here.
  history: VueRouter.createWebHashHistory(),
  routes, // short for `routes: routes`
})

// 5. Create and mount the root instance.
const app = Vue.createApp({
})

// Make sure to _use_ the router instance to make the
// whole app router-aware.
app.use(router)
app.mount('#app')
app.config.compilerOptions.isCustomElement = tag => tag === 'infinite-scroll'

</script>
</body>
</html>