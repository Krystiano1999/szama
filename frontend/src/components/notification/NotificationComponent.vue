<template>
  <div :class="['notification', notificationType]" class="notification-box">
    {{ message }}
  </div>
</template>

<script>
export default {
  props: {
    message: String,
    notificationType: String, // 'success' lub 'error'
    onClose: Function
  },
  mounted() {
    setTimeout(() => {
      this.onClose();
    }, 3000);
  }
};
</script>

<style>
.notification-box {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  padding: 30px;
  border-radius: 25px;
  text-align: center;
  min-width: 300px;
  z-index: 9999999999999999999999;
  font-size: 25px;
  font-weight:600;
}
.notification.success {
  background-color: white;
  color: green;
}
.notification.error {
  background-color: red;
  color: white;
}
</style>
