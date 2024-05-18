<script setup lang="ts">
const props = defineProps({
  no: Number,
  onDelete: Function,
  data: Object
})
</script>
<template>
  <div class="item0002">{{ props.no ?? Math.floor(Math.random(100) * 100) }}</div>
  <div class="item0002">{{ props.data.email }}</div>
  <div class="item0002">{{ props.data.username }}</div>
  <div class="item0002">{{ props.data.number }}</div>
  <div class="item0002">{{ props.data.image }}</div>
  <div class="item0002 icon-button">
    <div class="item" @click="props.onDelete">
      <img src="../../assets/delete-3-svgrepo-com.svg" alt="" />
    </div>
  </div>
</template>

<style src="./style.css" lang="css"></style>
