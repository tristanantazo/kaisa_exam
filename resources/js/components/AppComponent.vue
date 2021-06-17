<template>
  <div class="main_container">
      <FormComponent/>
      <TableComponent :accounts="accounts_data"/>
  </div>
</template>

<script>
import FormComponent from './FormComponent.vue'
import TableComponent from './TableComponent.vue'
export default {
    components: {
        FormComponent,
        TableComponent
    },
    data: function(){
        return {
            accounts_data: [],
        }
    },
    created() {
        this.FetchAccounts()
        TriggerEventBus.$on('fetchaccount', ()=> {
            this.FetchAccounts()
        })
    },
    methods: {
        FetchAccounts(){
            axios.get('/api/user/get/all')
            .then(response => {
                this.accounts_data = response.data
            })
        }
    }
}
</script>

<style>

</style>