<!DOCTYPE html>
<html>
<head>
	<title>Vue.js Routing From Scratch Using Vue Router CDN</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link id="theme" rel="stylesheet" href="{!! asset('css/app1.css') !!}" type="text/css">
</head>
<body>

<div id="app" class="container" style="margin-top: 50px;">


	<nav class="footer-tabs footer-spaces border-top text-center" style="background-color: #e3f2fd;">
	  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
	    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
			<li> <router-link class="nav-link" to="/"> Home </router-link> </li>
			<li> <router-link class="nav-link" to="desafios"> Desafios </router-link> </li>
			<li> <router-link class="nav-link" to="perfil"> Desafios </router-link> </li>
	    </ul>
	  </div>
	</nav>

	<div class="text-center" style="margin-top: 20px;">
		<router-view></router-view>
	</div>
</div>
<nav class="footer-tabs footer-spaces border-top text-center" style="background-color: #e3f2fd;">
<div id="navbarTogglerDemo03">
        <ul class="nav nav-tabs justify-content-center">
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
				<router-link class="nav-link">
                    <i class="material-icons">help</i>
                    <small class="sr-only">Ajuda</small>
				</router-link>
            </li>
        </ul>
    </div>
</nav>
<!-- Vue Pages -->
<script src="pages/home.vue.js"></script>
<script src="pages/desafios.vue.js"></script>
<script src="pages/perfil.vue.js"></script>

<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<script src="https://unpkg.com/vue-router@4.1.3/dist/vue-router.global.js"></script>
<script src="https://unpkg.com/vue@3"></script>
<script src="https://unpkg.com/vue-router@4"></script>

<!-- Vue Instance and Routes -->
<script>
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
const app = Vue.createApp({})
// Make sure to _use_ the router instance to make the
// whole app router-aware.
app.use(router)

app.mount('#app')

</script>
</body>
</html>