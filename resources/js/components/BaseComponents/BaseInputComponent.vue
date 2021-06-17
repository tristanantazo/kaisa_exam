<template>
  <div class="input_container">
      <label>{{label}}</label>
      <input :value="value" :type="type" @input="emitValue">
  </div>
</template>

<script>
export default {
    props: {
        label:{
            type: String,
            required: true
        },
        type: {
            default: 'text'
        },
        value: [String, Number]
    },
    methods: {
        emitValue(e){
            this.$emit('input', e.target.value)
        }
    }
}
</script>

<style>

</style>