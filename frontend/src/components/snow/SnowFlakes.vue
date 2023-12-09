<template>
  <div class="snowflakes" aria-hidden="true">
    <div v-for="n in 50" :key="n" class="snowflake">❅</div>
  </div>
</template>

<script>
export default {
  name: 'SnowFlakes',
  mounted() {
    const snowflakes = document.querySelectorAll('.snowflake');
    snowflakes.forEach(snowflake => {
      snowflake.style.left = `${Math.random() * 100}vw`;
      snowflake.style.opacity = Math.random();
      snowflake.style.fontSize = `${Math.random() * 24 + 10}px`;
      snowflake.style.animationDuration = `${Math.random() * 5 + 5}s`;
      snowflake.style.animationDelay = `-${Math.random() * 5}s`;

      const x = Math.random() * 20 - 10; // Przesunięcie w poziomie
      snowflake.style.setProperty('--x', `${x}vw`);
    });
  }
};
</script>

<style scoped>
.snowflakes {
  position: fixed;
  top: 0;
  left: 0;
  pointer-events: none;
  width: 100%;
  height: 100%;
  z-index: 1000000;
}

.snowflake {
  position: absolute;
  top: -10px;
  color: #fff;
  user-select: none;
  z-index: 1000000;
  animation: snowfall linear infinite;
}

@keyframes snowfall {
  0% { transform: translateY(0) translateX(0) rotate(0deg); }
  100% { transform: translateY(100vh) translateX(var(--x)) rotate(360deg); }
}
</style>
