<template>
  <div class="how-to-order-container container text-center my-md-5">
    <h2 class="fs-1">Jak zamawiać?</h2>
    <div class="steps d-flex justify-content-between align-items-center">
      <div class="step">
        <div class="icon">🔍</div>
        <p>1. Wyszukaj restaurację</p>
      </div>
      <div class="step">
        <div class="icon">🍔</div>
        <p>2. Wybierz jedzenie</p>
      </div>
      <div class="step">
        <div class="icon">💳</div>
        <p>3. Dokonaj płatności</p>
      </div>
      <div class="step">
        <div class="icon">🚚</div>
        <p>4. Czekaj na dostawę!</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'HowToOrder'
}
</script>

<style scoped>
.step {
  padding: 20px;
}

.icon {
  font-size: 30px;
}
</style>
