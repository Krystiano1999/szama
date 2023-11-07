<template>
  <div id="carouselExampleCaptions" class="carousel slide main-slider" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="@/assets/images/hungryobelix.png" class="d-block w-100" alt="...">
        <div class="carousel-caption container d-none d-md-flex align-items-center justify-content-start">
          <div class="text-start">
              <p class="text-decoration-line-through fs-2 mb-0">Przybyłem</p>
              <h2 class="fs-1 mb-3">Zamów</h2>
              <router-link to="/restaurants" class="search-btn">Wybierz Restauracje</router-link>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img src="@/assets/images/obelixwithboar.png" class="d-block w-100" alt="...">
        <div class="carousel-caption container d-none d-md-flex align-items-center justify-content-start">
          <div class="text-start">
            <p class="text-decoration-line-through fs-2 mb-0">Zobaczyłem</p>
            <h2 class="fs-1  mb-3">Odbierz</h2>
            <router-link to="/restaurants" class="search-btn">Wybierz Restauracje</router-link>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img src="@/assets/images/obelixeatingboar.png" class="d-block w-100" alt="...">
        <div class="carousel-caption container d-none d-md-flex align-items-center justify-content-start">
          <div class="text-start">
            <p class="text-decoration-line-through fs-2 mb-0">Zwyciężyłem</p>
            <h2 class="fs-1 mb-3">Wszamaj</h2>
             <router-link to="/restaurants" class="search-btn">Wybierz Restauracje</router-link>
          </div>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</template>

<script>
export default {
  name: 'MainSlider'
}
</script>

<style scoped>
.search-btn {
  background-color: var(--color-orange);
  border: none;
  padding: 10px 20px;
  color: var(--color-light-cream);
  cursor: pointer;
}
.main-slider{
  position: relative;
  max-height:100vh;
  height:100vh;
  overflow: hidden;
}
.main-slider .carousel-inner, .main-slider .carousel-item, .main-slider img{
  max-height: 100vh;
}
.carousel-caption{
  top:50%;
  transform: translateY(-50%);
}
</style>
