<template>
    <div class="admin-page container-fluid ">
      <div class="row ">
        <AdminSidebar/>
        <div class="admin-content col-md-10">
          <router-view/>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import AdminSidebar from "@/components/common/AdminSidebar.vue";
  
  export default {
    name: "AdminPage",
    components: {
      AdminSidebar,
    }
  };
  </script>
  
  <style>

  </style>
  