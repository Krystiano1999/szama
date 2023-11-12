<template>
    <div class="admin-page">
      <AdminSidebar/>
      <div class="admin-content">
        <AdminNavbar/>
        <router-view/>
      </div>
    </div>
  </template>
  
  <script>
  import AdminSidebar from "@/components/common/AdminSidebar.vue";
  import AdminNavbar from "@/components/common/AdminNavbar.vue";
  
  export default {
    name: "AdminPage",
    components: {
      AdminSidebar,
      AdminNavbar
    }
  };
  </script>
  
  <style>

  </style>
  