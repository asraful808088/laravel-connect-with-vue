<script setup lang="ts">
const props = defineProps({
  active: Boolean,
  
})
</script>

<template>
    
  <div :class="props.active ? 'popup-frame' : ' popup-frame-hidden popup-frame'"><slot></slot></div>
</template>

<style src="./style.css" lang="css"></style>
