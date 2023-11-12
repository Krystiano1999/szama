<template>
    <div class="category-management">
      <h1>Categories</h1>
      <button class="add-category-btn">+ Add category</button>
      
      <div class="added-categories">
        <h2>Added Categories</h2>
        <table class="categories-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <!-- Dane kategorii powinny być generowane dynamicznie -->
            <tr>
              <td>#1</td>
              <td>Foods</td>
              <td><button class="action-btn">Edit</button></td>
            </tr>
            <!-- Powtórz dla każdej kategorii -->
          </tbody>
        </table>
      </div>
    </div>
  </template>
  
  <script>
  export default {
      name: 'CategoryManagement'
  }
  </script>
  
  <style>
  .category-management {
    padding: 20px;
    background-color: #f5f5f5;
    height: 100vh;
  }
  
  h1 {
    color: #333;
  }
  
  .add-category-btn {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    margin-bottom: 20px;
  }
  
  .add-category-btn:hover {
    background-color: #0056b3;
  }
  
  .added-categories {
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
  }
  
  .categories-table {
    width: 100%;
    border-collapse: collapse;
    text-align: left;
  }
  
  .categories-table th,
  .categories-table td {
    padding: 12px 15px;
    border: 1px solid #ddd;
  }
  
  .categories-table th {
    background-color: #f2f2f2;
  }
  
  .categories-table tr:nth-child(even) {
    background-color: #f9f9f9;
  }
  
  .action-btn {
    background-color: #ff5722;
    color: white;
    border: none;
    padding: 6px 10px;
    border-radius: 5px;
    cursor: pointer;
  }
  
  .action-btn:hover {
    background-color: #e64a19;
  }
  </style>
  