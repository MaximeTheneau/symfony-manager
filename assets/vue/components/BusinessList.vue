<template>
  <div class="business-list">
    <h1>Liste des entreprises</h1>
    <ul>
      <li v-for="business in businesses" :key="business.id">
        <h2>{{ business.name }}</h2>
      </li>
    </ul>
  </div>
</template>

<script>
export default {

  data() {
    return {
      businesses: []
    };
  },
  created() {
    this.fetchBusinesses();
  },
  methods: {
    async fetchBusinesses() {
      try {
        const response = await fetch('/api/businesses');
        
        // Vérifie si la réponse est correcte (status 200)
        if (!response.ok) {
          throw new Error('Erreur lors de la récupération des entreprises');
        }
        
        const data = await response.json(); // Convertit la réponse en JSON
        this.businesses = data; // Assigne les données à la variable `businesses`
      } catch (error) {
        console.error(error); // Affiche l'erreur dans la console si quelque chose ne va pas
      }
    }
  }
};
</script>

<style scoped>
.business-list {
  padding: 20px;
}

.business-list h1 {
  text-align: center;
}

.business-list ul {
  list-style-type: none;
  padding: 0;
}

.business-list li {
  padding: 10px;
  margin: 10px 0;
  border: 1px solid #ccc;
}
</style>
