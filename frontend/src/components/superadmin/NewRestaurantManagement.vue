<template>
  <div class="new-restaurant-management container my-5">
    <h2>Zarządzanie zgłoszeniami restauracji</h2>
    <div v-if="applications.length === 0" class="alert alert-info">Brak zgłoszeń do przetworzenia.</div>
    <div v-else>
      <ul class="list-group">
        <li v-for="application in applications" :key="application.id" class="list-group-item d-flex justify-content-between align-items-center">
          <div>
            <p class="mb-0">Właściciel: {{ application.owner_name }}</p>
            <p class="mb-0">Restauracja: {{ application.restaurant_name }}</p>
            <p class="mb-0">Adres: {{ application.city }} {{application.address}}</p>
            <p class="mb-0">Kontakt: {{ application.email }}</p>
          </div>
          <div>
            <button @click="acceptApplication(application.id)" class="btn btn-success me-2">Zaakceptuj</button>
            <button @click="rejectApplication(application.id)" class="btn btn-danger">Odrzuć</button>
          </div>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import { getRestaurantRegistrations, rejectRestaurantRegistration,acceptRestaurantRegistration } from '@/api/api';

export default {
  name: 'NewRestaurantManagement',
  data() {
    return {
      applications: [] // Tutaj będą dane zgłoszeń
    };
  },
  methods: {
    fetchApplications() {
      getRestaurantRegistrations()
        .then(response => {
          this.applications = response.data;
          console.log(response.data);
        })
        .catch(error => {
          console.error('Wystąpił błąd podczas pobierania zgłoszeń:', error);
        });
    },
    acceptApplication(id) {
        if (confirm('Czy na pewno chcesz zaakceptować to zgłoszenie?')) {
        acceptRestaurantRegistration(id)
            .then(() => {
                this.fetchApplications(); 
                alert('Zgłoszenie zostało zaakceptowane. Dane logowania wysłane na email.');
            })
            .catch(error => {
                if (error.response.status === 409) {
                    alert('Nie można zaakceptować zgłoszenia. Adres email już istnieje.');
                } else {
                    console.error('Wystąpił błąd:', error);
                }
            });
        }
    },
    rejectApplication(id) {
      if (confirm('Czy na pewno chcesz odrzucić to zgłoszenie?')) {
        rejectRestaurantRegistration(id)
          .then(() => {
            this.fetchApplications(); 
            alert('Zgłoszenie zostało odrzucone.');
          })
          .catch(error => {
            console.error('Wystąpił błąd:', error);
          });
      }
    }
  },
  mounted() {
    this.fetchApplications();
  }
}
</script>

<style>
  /* Styl dla komponentu */
</style>
