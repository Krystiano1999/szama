import axios from 'axios';

const apiClient = axios.create({
  baseURL: 'http://localhost:8888/api', // URL backendu
});

export const loginUser = (formData) => {
  return apiClient.post('/login', formData);
};

export const registerUser = (formData) => {
  return apiClient.post('/register', formData);
};

export const logoutUser = () => {
  return apiClient.post('/logout');
};

export const getRestaurantsByCity = (cityName) => {
  return apiClient.post('/get-restaurants-by-city', { miasto: cityName });
};

export const getRestaurantMenu = (restaurantId) => {
  return apiClient.get(`/restaurant/${restaurantId}/menu`);
};

// Dodane metody do zarządzania zamówieniami
export const getOrders = () => {
  return apiClient.get('/zamowienia');
};

export const getOrderById = (orderId) => {
  return apiClient.get(`/zamowienia/${orderId}`);
};

export const createOrder = (orderData) => {
  return apiClient.post('/zamowienia', orderData);
};

export const updateOrder = (orderId, orderData) => {
  return apiClient.put(`/zamowienia/${orderId}`, orderData);
};

export const deleteOrder = (orderId) => {
  return apiClient.delete(`/zamowienia/${orderId}`);
};
