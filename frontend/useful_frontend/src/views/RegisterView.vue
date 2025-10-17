<script setup>
import { useAuthStore } from '@/stores/auth';
import { onMounted, ref } from 'vue';
import { useRouter } from 'vue-router';

const name = ref('')
const email = ref('')
const password = ref('')
const loadingRegister = ref(false)
const error = ref('')
const router = useRouter()

const authStore = useAuthStore()

let register

onMounted(async function() {
  register = async function() {
    loadingRegister.value = true
    error.value = ''
    // let response = null
    try {
      await authStore.register({
        name: name.value,
        email: email.value,
        password: password.value
      })
      // if (response.data.token) {
      // }
      alert('Account created ! You can login')
      router.push({ name: "login" })
    } catch (err) {
      error.value = err
    } finally {
      loadingRegister.value = false
    }
  }
})
</script>

<template>
  <div class="w-full h-screen bg-black absolute top-0 left-0">
    <div class="flex items-center justify-center min-h-screen px-4">
      <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-center text-900">Créer un compte</h1>
  
        <form @submit.prevent="register" class="space-y-4">
          <div>
            <label>Name</label>
            <input
              v-model="name"
              type="text"
              required
              class="w-full px-3 py-2 mt-1 rounded-md shadow-sm"
            />
            <br />
  
            <label>Email</label>
            <input
              v-model="email"
              type="email"
              required
              class="w-full px-3 py-2 mt-1 rounded-md shadow-sm"
            />
            <br />
  
            <label>Password</label>
            <input
              v-model="password"
              type="password"
              required
              minlength="6"
              class="w-full px-3 py-2 mt-1 rounded-md shadow-sm"
            />
            <br />
          </div>
  
          <div class="pt-3">
            <button
              type="submit"
              class="w-full flex items-center justify-center gap-1 px-4 py-2 text-white bg-blue-500 rounded-md shadow-sm hover:bg-blue-700"
              :disabled="loadingRegister"
            >
              <span class="animate-spin" v-if="loadingRegister">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="25"
                  height="25"
                  fill="currentColor"
                  class="bi bi-arrow-clockwise"
                  viewBox="0 0 16 16"
                >
                  <path
                    fill-rule="evenodd"
                    d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z"
                  />
                  <path
                    d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466"
                  />
                </svg>
              </span>
              S'inscrire
            </button>
          </div>
        </form>
  
        <p>
          Already have an account ? 
          <router-link to="/login" class="font-medium text-blue-600 hover:underline"
            >Login</router-link
          >
        </p>
  
        <p v-if="error" class="text-sm text-center text-red-600 pt-5">{{ error }}</p>
      </div>
    </div>
  </div>
</template>
