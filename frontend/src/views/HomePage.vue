<template>
  <HeaderComponent />
  <div>
    <MainSlider/>
    <HowToOrder/>
  </div>
  <FooterComponent />
</template>

<script>
import HeaderComponent from '@/components/common/Header.vue';
import FooterComponent from '@/components/common/Footer.vue';
import MainSlider from '@/components/home/MainSlider.vue'
import HowToOrder from '@/components/home/HowToOrder.vue'

export default {
  name:'HomePage',
  components: {
    HeaderComponent,
    FooterComponent,
    MainSlider,
    HowToOrder
  }
}
</script>

<style scoped>

</style>

