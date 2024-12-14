import axios from 'axios'

// Base URL configuration
const API_URL = import.meta.env.VITE_API_URL || 'https://starkbrokers.com'

const axiosInstance = axios.create({
  baseURL: `${API_URL}/api/v1`, // Add /api/v1 to base URL to match API endpoints
  headers: {
    Accept: 'application/json',
    'Content-Type': 'application/json',
  },
  timeout: 15000,
})

// Request interceptor
axiosInstance.interceptors.request.use(
  (config) => {
    const token = localStorage.getItem('token')

    if (token) {
      // Add Bearer prefix to token
      config.headers.Authorization = `Bearer ${token}`
    }

    return config
  },
  (error) => {
    console.error('❌ Request Error:', error)
    return Promise.reject(error)
  }
)

// Response interceptor
axiosInstance.interceptors.response.use(
  (response) => {
    console.log('✅ Response:', {
      url: response.config.url,
      status: response.status,
      success: response.data.success,
    })
    return response
  },
  (error) => {
    console.error('❌ Response Error:', {
      url: error.config?.url,
      status: error.response?.status,
      message: error.response?.data?.message,
    })
    return Promise.reject(error)
  }
)

export default axiosInstance