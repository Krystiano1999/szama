<template>
  <div id="app">
    <HeaderComponent />
    <router-view></router-view>
    <FooterComponent />
  </div>
</template>

<script>
import HeaderComponent from '@/components/common/Header.vue';
import FooterComponent from '@/components/common/Footer.vue';

export default {
  name: 'App',
  components: {
    HeaderComponent,
    FooterComponent
  }
}
</script>

<style>
body{
  margin:0 !important;
  background-color: var(--color-light-cream);
}
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: var(--color-dark-gray);
}
.container-fluid{
  padding-left: 0 !important;
  padding-right: 0 !important;
}
@media (min-width:1400px) {
  /* .container{
    max-width:1600px;
  } */
  .fs-1{
    font-size: 4.5rem !important;
  }
  .fs-2{
    font-size: 3.25rem !important;
  } 
}
</style>
