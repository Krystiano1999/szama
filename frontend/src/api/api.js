import axios from 'axios';

const apiClient = axios.create({
  baseURL: 'http://localhost:8000/api', // URL backendu
});

export const loginUser = (formData) => {
  return apiClient.post('/login', formData);
};

export const registerUser = (formData) => {
  return apiClient.post('/register', formData);
};