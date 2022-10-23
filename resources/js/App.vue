<template>
    <div class="container">

        <nav class="navbar navbar-expand-lg navbar-light bg-info fixed-top">
            <div class="container">
                <router-link to="/dashboard" class="nav-item nav-link text-white">
                    <a class="navbar-brand" href="#"><img class="logo-banner" src="/image/pokemon-logo.png" alt=""></a>
                </router-link>

            <div class="collapse navbar-collapse">
                <!-- for non-logged user-->

                <div class="navbar-nav col-md-2" v-if="!this.isLoggedIn">
                    <router-link to="/login" class="nav-item nav-link text-white">Login</router-link>
                    <router-link to="/register" class="nav-item nav-link text-white">Register</router-link>

                </div>
                <!-- for logged-in user-->
                <div class="navbar-nav col-md-7 offset-md-5" v-else>
                    <router-link to="/dashboard" class="nav-item nav-link text-white">Pokemons</router-link>
                    <router-link to="/account-view" class="nav-item nav-link text-white">Account</router-link>
                    <router-link to="/liked-pokemons" class="nav-item nav-link text-white">My Likes</router-link>
                    <router-link to="/hated-pokemons" class="nav-item nav-link text-white">My Hates</router-link>
                     <router-link to="/other-users" class="nav-item nav-link text-white">Other Users</router-link>
                    <a class="nav-item nav-link text-danger" style="cursor: pointer;" @click="this.logout">Logout</a>
                </div>
            </div>
            </div>
        </nav>
        <br/>
        <router-view class="mt-5 pt-5" />
    </div>
</template>

<script>
export default {
    name: "App",
    data() {
        return {
            isLoggedIn: false,
        }
    },
    methods: {
        logout(e) {
            e.preventDefault()
            axios.post('/api/logout')
                .then(({response}) => {
                    localStorage.removeItem('access_token');
                    localStorage.removeItem('user_logged');
                    this.isLoggedIn = false;
                    this.$router.push({name: 'Home'});
                })
                .catch(function (error) {
                    console.error(error);
                });
        },

        checkIfLoggedIn(){


        }
    },

    created() {

        let access_token = localStorage.getItem("access_token");


        if (access_token) {
            this.isLoggedIn = true;
            this.$router.push({name: 'Dashboard'});
        }
        else {
            this.isLoggedIn = false;
            this.$router.push({name: 'Home'});
        }

    },
}
</script>
<style scoped>
  .logo-banner{
    height: 30px;
    width: 70px;
  }
</style>