<script setup lang="ts">
const props = defineProps({
  onNewusers: Array,
 
})
import TokenExtrator from '@/service/cookieToken/tokenExtrator'
import generateUniqueId from '@/service/utility/uuid'
import axios from 'axios'
import { ref } from 'vue'
axios.defaults.withCredentials = true
axios.defaults.baseURL = 'http://localhost:8000'
axios.defaults.withCredentials = true
axios.defaults.withXSRFToken = true
const email = ref('')
const number = ref('')
const username = ref('')
const file = ref(null)
const token = ref(null)

function filehandler(event) {
  file.value = event.target.files[0]
}

async function handleSubmit() {
  const formData = new FormData()
  formData.append('file', file.value)
  formData.append('email', email.value)
  formData.append('number', number.value)
  formData.append('username', username.value)
  formData.append('id', generateUniqueId())

  try {
    await axios.get('sanctum/csrf-cookie')
    const response = await axios.post('api/users', formData, {
      headers: {
        Accept: 'application/json',
        'X-XSRF-TOKEN': TokenExtrator()['XSRF-TOKEN']
      },
      withCredentials: true
    })

    if (props.onNewusers) {
      props.onNewusers(response.data.users)
    }
  } catch (error) {
    console.error('Error uploading file:', error)
  }
}
</script>

<template>
  <div class="create-user-0001">
    <div class="header">Create New User</div>
    <form class="" @submit.prevent="handleSubmit">
      <input type="hidden" name="csrf" :value="token" />
      <div class="input-box">
        <input type="text" name="email" id="email" v-model="email" placeholder="email" required />
      </div>
      <div class="input-box">
        <input
          type="text"
          name="number"
          id="number"
          v-model="number"
          placeholder="number"
          required
        />
      </div>
      <div class="input-box">
        <input
          type="text"
          name="username"
          id="username"
          v-model="username"
          placeholder="username"
          required
        />
      </div>
      <div class="file-input-box">
        <input type="file" name="" id="" required @change="filehandler" />
      </div>

      <div class="submit-button">
        <input type="submit" value="Submit" class="submit-button-box" />
      </div>
    </form>
  </div>
</template>

<style src="./style.css" lang="css"></style>
