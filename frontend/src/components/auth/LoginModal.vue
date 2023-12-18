<template>
<!-- Modal -->
    <div ref="loginModal" class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="loginModalLabel">{{ isLoginMode ? 'Zaloguj się' : 'Załóż konto' }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="isLoginMode ? loginUser() : registerUser()">
              <div v-if="!isLoginMode">
                <div class="mb-3">
                  <label for="email" class="form-label">Adres Email</label>
                  <input type="email" class="form-control" id="email" v-model="formData.email" required>
                </div>
                <div class="mb-3">
                  <label for="tel" class="form-label">Numer Telefonu</label>
                  <input type="tel" class="form-control" v-model="formData.phone_number" id="tel" required>
                </div>
                <div class="mb-3">
                  <label for="address" class="form-label">Adres</label>
                  <input type="text" class="form-control" id="address" v-model="formData.address" required>
                </div>
              </div>
              <div class="mb-3">
                <label for="username" class="form-label">Nazwa Użytkownika</label>
                <input type="text" class="form-control" id="username" v-model="formData.username" required>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Hasło</label>
                <input type="password" class="form-control" id="password" v-model="formData.password" required>
              </div>
              <button type="submit" class="btn btn-primary">{{ isLoginMode ? 'Zaloguj się' : 'Zarejestruj' }}</button>
            </form>
          </div>
           <div class="modal-footer">
            <button type="button" class="btn btn-link" @click="toggleMode">{{ isLoginMode ? 'Załóż konto' : 'Masz już konto? Zaloguj się' }}</button>
          </div>
          <div class="modal-footer text-end">
            <router-link class="text-end" to="/register-restaurant">Chcesz umieścić u nas swoją firmę?<br> Zarejestruj restaurację</router-link>
          </div>
        </div>
      </div>
    </div>
</template>

<script>
import { loginUser, registerUser } from '@/api/api';
import { showSuccessMessage, showErrorMessage } from '@/components/notification/NotificationHelper';

export default {
  name: 'LoginModal',
  data() {
    return {
      isLoginMode: true,
      messageContent: '',
      messageType: '',
      formData: {
        username: '',
        email: '',
        phone_number:'',
        address: '',
        password:'',
        user_type: 0, 
      },
      alert: null
    };
  },
  methods: {
    toggleMode() {
      this.isLoginMode = !this.isLoginMode;
    },
    loginUser() {
      loginUser(this.formData)
        .then(response => {
          localStorage.setItem('token', response.data.token);
          localStorage.setItem('userType', response.data.user_type.toString());
          localStorage.setItem('id', response.data.user_id);
          localStorage.setItem('username', response.data.username);
          localStorage.setItem('email', response.data.email); 
          localStorage.setItem('phone_number', response.data.phone_number); 

          this.closeModalDirectly();

          this.$emit('user-logged-in', {
            userType: response.data.user_type.toString()
          });

          showSuccessMessage("Zalogowano");
        })
        .catch(error => {
          console.error(error.response.data);
          showErrorMessage(error.response.data);
        });
    },
    registerUser() {
      registerUser(this.formData)
        .then(response => {
          console.log(response.data);
          showSuccessMessage("Zarejestrowano");
          this.closeModalDirectly();
        })
        .catch(error => {
          console.error(error.response.data);
          showErrorMessage(error.response.data);
        });
    },
    closeModalDirectly() {
      const modalElement = document.getElementById('loginModal');
      const bodyElement = document.body;
      if (modalElement) {
        modalElement.style.display = 'none'; 
        modalElement.classList.remove('show'); 
        bodyElement.classList.remove('modal-open');
        bodyElement.style.overflow = ''; 
        bodyElement.style.paddingRight = '';
      }
    },
  }
}
</script>


<style scoped>
  .modal .btn{
      background-color: var(--color-blue) ;
      color: var(--color-light-cream) ;
  }
  .modal .modal-open {
    overflow: inherit !important;
  }
  .modal .modal.fade.show{
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1050;
    width: 100vw;
    height: 100vh;
    background-color: rgba(0,0,0,0.5);
  }
  .message-box {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    padding: 20px;
    border-radius: 5px;
    text-align: center;
    min-width: 300px;
    z-index: 1000;
  }

  .message.success {
    background-color: white;
    color: green;
  }

  .message.error {
    background-color: red;
    color: white;
  }

</style>