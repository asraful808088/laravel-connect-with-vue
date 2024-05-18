<script setup lang="ts">
import Item0001 from '@/components/header/HeaderItemCom.vue'
import Item0002 from '@/components/item/ItemsCom.vue'
import PopUpbox from '@/components/popup/PopupBox.vue'
import axios from 'axios'
import { onMounted, ref } from 'vue'
import CreateUsers from './components/form/createUsers/CreateUsers.vue'
const createUserOpoup = ref(false)
const deleteOpoup = ref(false)
const deleteItemItems = ref(null)
function closeCreateOpoup() {
  createUserOpoup.value = false
}
function openCreateOpoup() {
  createUserOpoup.value = true
}
function closePremission() {
  deleteOpoup.value = false
}
function deleteItem() {
  axios.delete(`api/users/${deleteItemItems.value.id}`).then((res) => {
    items.value = res.data.users
    deleteOpoup.value = false
  })
}

const items = ref([])
onMounted(() => {
  axios
    .get('api/users')
    .then((res) => {
      items.value = res.data.users
    })
    .catch((e) => {
      console.log(e)
    })
})
function reload() {
  axios
    .get('api/users')
    .then((res) => {
      items.value = res.data.users
    })
    .catch((e) => {
      console.log(e)
    })
}
function newUsers(values) {
  items.value = values
  closeCreateOpoup()
}

function onDelete(value) {
  deleteOpoup.value = true
  deleteItemItems.value = value
}
</script>

<template>
  <div class="main">
    <PopUpbox :active="createUserOpoup">
      <div class="create-user">
        <div class="close-box">
          <div class="close-button" @click="closeCreateOpoup">+</div>
        </div>
        <CreateUsers :onNewusers="newUsers" />
      </div>
    </PopUpbox>

    <PopUpbox :active="deleteOpoup">
      <div class="permission-user">
        <div class="close-box">
          <div class="close-button" @click="closePremission">+</div>
        </div>
        <div class="message">Are you sure you want to delete pop up ???</div>
        <div class="button-box">
          <div class="item pos" @click="() => deleteItem()">Yes</div>
          <div class="neg item" @click="closePremission">No</div>
        </div>
      </div>
    </PopUpbox>

    <div class="header">
      <div class="header-item">Users-Table</div>
      <div class="header-item">
        <div class="option" @click="reload">
          <img src="./assets/reload-svgrepo-com.svg" alt="" />
        </div>
        <div class="option" @click="openCreateOpoup">
          <img src="./assets/add-symbol-svgrepo-com.svg" alt="" />
        </div>
      </div>
    </div>
    <div class="content">
      <Item0001 />
      <Item0002
        v-for="(item, index) in items"
        :key="index"
        :no="index"
        :onDelete="() => onDelete(item)"
        :data="item"
      />
    </div>
  </div>
</template>

<style src="./style.css" lang="css"></style>
