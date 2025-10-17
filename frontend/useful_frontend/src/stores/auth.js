import { defineStore } from 'pinia'
import axios from 'axios'

export const useAuthStore = defineStore('auth', {
  persist: true,
  state: () => ({
    user_: null,
    isAuthenticated: false,
    token: '',
  }),
  actions: {
    async register(userData) {
      try {
        const url = import.meta.env.VITE_API_BASE_URL + '/register'
        const response = await axios.post(url, userData)
        if (response.data?.token) {
          this.token = response.token
        }
        if (response.ok) {
          console.log("response.ok")
        }
        return response
      } catch (error) {
        throw error || 'Registration error'
      }
    },
    async login(credentials) {
      try {
        const url = import.meta.env.VITE_API_BASE_URL + '/login'
        const response = await axios.post(url, credentials)
        if (response.data?.token) {
          console.log("login success")
          this.user_ = response.data.user_
          this.isAuthenticated = true
          this.token = response.data.token
        }
        return response
      } catch (error) {
        throw error || 'Login error'
      }
    },
    async logout() {
      try {
        this.user_ = null
        this.isAuthenticated = false
        this.token = ''
      } catch (error) {
        throw error || 'Logout error'
      }
    },
  }
})
