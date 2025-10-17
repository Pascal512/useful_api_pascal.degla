import { defineStore } from 'pinia'
import axios from 'axios'
import { useAuthStore } from './auth'

const authStore = useAuthStore()

export const useModuleStore = defineStore('module', {
  persist: true,
  state: () => ({
    isModule1Active: false,
    isModule2Active: false,
    isModule3Active: false,
    isModule4Active: false,
    isModule5Active: false,
  }),
  actions: {
    async activate(module_id) {
      try {
        const url = import.meta.env.VITE_API_BASE_URL + '/modules/' + module_id + '/activate'
        const response = await axios.post(url, {
          headers: {
            'Content-Type': 'application/json',
            Authorization: 'Bearer ' + authStore.token,
          },
        })
        if (response.ok) {
          console.log('response.ok')
        }
        switch (module_id) {
          case 1:
            this.isModule1Active = true
            break;
          case 2:
            this.isModule2Active = true
            break;
          case 3:
            this.isModule3Active = true
            break;
          case 4:
            this.isModule4Active = true
            break;
          case 5:
            this.isModule5Active = true
            break;
        
          default:
            break;
        }
        return response
      } catch (error) {
        throw error || 'Module activation error'
      }
    },
    async deactivate(module_id) {
      try {
        const url = import.meta.env.VITE_API_BASE_URL + '/modules/' + module_id + '/deactivate'
        const response = await axios.post(url, {
          headers: {
            'Content-Type': 'application/json',
            Authorization: 'Bearer ' + authStore.token,
          },
        })
        if (response.ok) {
          console.log('response.ok')
        }
        switch (module_id) {
          case 1:
            this.isModule1Active = false
            break;
          case 2:
            this.isModule2Active = false
            break;
          case 3:
            this.isModule3Active = false
            break;
          case 4:
            this.isModule4Active = false
            break;
          case 5:
            this.isModule5Active = false
            break;
        
          default:
            break;
        }
        return response
      } catch (error) {
        throw error || 'Module activation error'
      }
    },
  },
})
