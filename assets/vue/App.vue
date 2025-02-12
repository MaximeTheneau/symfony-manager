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
