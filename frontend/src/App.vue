<template>
  <div id="app">
    
    <router-view></router-view>
    
  </div>
</template>

<script>
// import HeaderComponent from '@/components/common/Header.vue';
// import FooterComponent from '@/components/common/Footer.vue';

export default {
  name: 'App',
  /* components: {
    HeaderComponent,
    FooterComponent
  } */
}
</script>

<style>

#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: var(--color-dark-gray);
}


</style>
