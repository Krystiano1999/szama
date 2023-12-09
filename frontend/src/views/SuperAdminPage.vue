<template>
    <div class="admin-page container-fluid ">
      <div class="row ">
        <SuperAdminSidebar/>
        <div class="admin-content col-md-10">
          <router-view/>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import SuperAdminSidebar from "@/components/common/SuperAdminSidebar.vue";
  
  export default {
    name: "SuperAdminPage",
    components: {
      SuperAdminSidebar,
    }
  };
  </script>
  
  <style>
    .admin-page .row{
        overflow:hidden;
    }
    .admin-content{
        max-height:100vh;
        overflow-y:scroll;
    }
  </style>
  