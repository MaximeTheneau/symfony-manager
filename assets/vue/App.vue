<template>
    <div id="app">
        <nav>
            <router-link to="/">Accueil</router-link> |
            <router-link to="/businesses">Liste des entreprises</router-link>
        </nav>
        <router-view></router-view>
    </div>
</template>

<script>
export default {
    name: 'App'
}
</script>

<style>
#app {
    font-family: Arial, sans-serif;
}

nav {
    padding: 1rem;
}

nav a {
    margin: 0 0.5rem;
}
</style>