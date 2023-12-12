<template>
    <div class="dashboard">
      <h2 class="mt-5">Zarządzanie Kontem</h2>
      <div class="restaurant-management">
        <form class="row" @submit.prevent="saveRestaurant">
          <div class="form-group col-md-6">
            <label for="restaurant-name">Nazwa Restauracji</label>
            <input type="text" id="restaurant-name" v-model="restaurant.Nazwa_Restauracji" placeholder="Wpisz nazwę restauracji">
          </div>
          <div class="form-group col-md-6">
            <label for="restaurant-region">Województwo</label>
            <input type="text" id="restaurant-region" v-model="restaurant.Wojewodztwo" placeholder="Wpisz województwo">
          </div>
          <div class="form-group col-md-6">
            <label for="restaurant-city">Miasto</label>
            <input type="text" id="restaurant-city" v-model="restaurant.Miasto" placeholder="Wpisz miasto">
          </div>
          <div class="form-group col-md-6">
            <label for="restaurant-address">Adres</label>
            <input type="text" id="restaurant-address" v-model="restaurant.Adres" placeholder="Wpisz adres">
          </div>
          <div class="form-group">
            <label for="restaurant-description">Opis</label>
            <textarea id="restaurant-description" v-model="restaurant.Opis" placeholder="Wpisz opis restauracji"></textarea>
          </div>
          <button type="submit" class="save-button">Zapisz</button>
        </form>
      </div>
    </div>
  </template>
  
  <script>
  
  </script>
  
  
  <style>

  </style>
  