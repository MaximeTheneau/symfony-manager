<template>
  <div class="home">
    <h1>Bienvenue sur mon site 🚀</h1>
    <div>
        <router-link to="/businesses">Voir les entreprises</router-link>
    </div>
  </div>
</template>

<script>
import BusinessList from './BusinessList.vue';

export default {
  name: "Home",
  components: {
    BusinessList, // Enregistre BusinessList comme un composant local
  },
};
</script>

<style scoped>
.home {
  text-align: center;
  padding: 20px;
}
</style>
