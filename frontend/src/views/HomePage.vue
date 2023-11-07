<template>
  <div>
    <MainSlider/>
    <HowToOrder/>
  </div>
</template>

<script>
import MainSlider from '@/components/home/MainSlider.vue'
import HowToOrder from '@/components/home/HowToOrder.vue'

export default {
  name:'HomePage',
  components: {
    MainSlider,
    HowToOrder
  }
}
</script>

<style scoped>

</style>

