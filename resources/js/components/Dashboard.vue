<template>
  <div>
    <h4>Welcome, {{this.user_logged.email}}!</h4>
    <PokemonsList :pokemons="this.pokemonsData"/>
    <button class="btn btn-info load-more text-white" @click="loadMore">Load More Pokemons</button>
  </div>
</template>

<script>
import Header from './Header.vue'
import PokemonsList from './PokemonsList.vue';

export default {
  components:{Header, PokemonsList},

  data() {
    return {
      pokemonsData: [],
      limit : 28,
      user_logged: "",
      user_id: 0

    };
  },

  methods: {
    fetchData(limit) {

      axios.get("https://pokeapi.co/api/v2/pokemon?limit="+limit)
      .then((result)=>{
        const data = result.data;
        this.pokemonsData = data.results;
      })
      .catch((error) => {
          console.log("There is a problem: ", error);
      });
    },

    loadMore(){
      this.limit += 8;
      this.fetchData(this.limit);
    }

  },
  mounted() {

    if (localStorage.getItem('reloaded')) {
        localStorage.removeItem('reloaded');
    } else {
        localStorage.setItem('reloaded', '1');
        location.reload();
    }

    this.fetchData(this.limit);
    this.user_logged = JSON.parse(localStorage.getItem('user_logged'));
    //console.log("session email: ", sessionStorage.getItem("email"));
  },

  created(){
      console.log(sessionStorage.getItem("user_id"))
  }
};
</script>

<style scoped>
  .load-more{
    display: block;
    margin-left: auto;
    margin-right: auto;
    margin-top: 50px;
    margin-bottom: 100px;
  }
</style>