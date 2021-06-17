<template>
  <div class="button_container">
      <button @click="onClick(data)">{{label}}</button>
  </div>
</template>

<script>
export default {
    props: {
        label:{
            type: String,
            required: true
        },
        onClick: {
            type: Function,
            required: true
        },
        data: '',
    }
}
</script>

<style>

</style>