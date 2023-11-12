<template>
  <div class="dashboard">
    <h1>Overview</h1>
    <div class="dashboard-cards">
      <div class="card">
        <div class="card-icon">
          <img src="path-to-your-account-icon" alt="Account Balance">
        </div>
        <div class="card-content">
          <p>Account Balance</p>
          <h2>$30,659.45</h2>
          <button>View all</button>
        </div>
      </div>
      <div class="card">
        <div class="card-icon">
          <img src="path-to-your-pending-icon" alt="Pending">
        </div>
        <div class="card-content">
          <p>Pending</p>
          <h2>$19,500.45</h2>
          <button>View all</button>
        </div>
      </div>
      <div class="card">
        <div class="card-icon">
          <img src="path-to-your-processed-icon" alt="Processed">
        </div>
        <div class="card-content">
          <p>Processed</p>
          <h2>$20,659</h2>
          <button>View all</button>
        </div>
      </div>
    </div>
    
    <h2>Recent menu items</h2>
    <table class="menu-items">
      <thead>
        <tr>
          <th>ID</th>
          <th>Image</th>
          <th>Name</th>
          <th>Category</th>
          <th>Price</th>
          <th>Available?</th>
        </tr>
      </thead>
      <tbody>
        <!-- Przykładowe wpisy, powinny być wygenerowane dynamicznie -->
        <tr>
          <td>#1</td>
          <td><img src="path-to-dish-image" alt="Spaghetti with Bread Dish"></td>
          <td>Spaghetti with Bread Dish</td>
          <td>Foods</td>
          <td>2000.00</td>
          <td>Available</td>
        </tr>
        <!-- Powtórz dla każdego elementu menu -->
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  name: "DashboardAdmin"
};
</script>

<style>
.dashboard {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  padding: 20px;
}

.dashboard-cards {
  display: flex;
  justify-content: space-between;
  margin-bottom: 20px;
}

.card {
  background-color: white;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  width: 30%;
  padding: 20px;
  display: flex;
  align-items: center;
}

.card-icon {
  margin-right: 20px;
}

.card-content p {
  margin: 0;
  color: #888;
}

.card-content h2 {
  margin: 0;
  color: #333;
}

button {
  background-color: #007bff;
  color: white;
  border: none;
  padding: 10px;
  border-radius: 5px;
  cursor: pointer;
}

button:hover {
  background-color: #0056b3;
}

.dashboard .menu-items {
  width: 100%;
  border-collapse: collapse;
}

.dashboard .menu-items th,
.dashboard .menu-items td {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: left;
}

.dashboard .menu-items th {
  background-color: #f2f2f2;
}

.dashboard .menu-items tr:nth-child(even) {
  background-color: #f9f9f9;
}

.dashboard .menu-items img {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  object-fit: cover;
}

</style>
