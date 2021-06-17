<template>
    <div class="">
        <table>
            <tr>
                <th>ID</th>
                <th>First name</th>
                <th>Last Name</th>
                <th>Action</th>
            </tr>
            <tr v-for="(value, index, key) in accounts_data" :key="key">
                <td>{{value.id}}</td>
                <td>{{value.first_name}}</td>
                <td>{{value.last_name}}</td>
                <td>
                    <BaseButtonComponent label="Edit" :onClick="EditAccount" :data="value"/> 
                    <BaseButtonComponent label="Delete" :onClick="DeleteAccount" :data="value.id"/>
                </td>
            </tr>
        </table>      
        <EditForm v-show="showForm" :account_details="edit_acct" />  
    </div>
</template>

<script>
import BaseButtonComponent from './BaseComponents/BaseButtonComponent.vue'
import EditForm from './EditForm.vue'
export default {
    props: ['accounts'],
    components: {
        BaseButtonComponent,
        EditForm
    },
    data: function(){
        return {
            showForm: false,
            edit_acct: ['wefwef'],
            // accounts_data: [],
        }
    },
    computed: {
        accounts_data() {
            return this.accounts
        }
    },
    methods: {
        DeleteAccount(id) {
            axios.delete('/api/user/'+id)
                .then(response=>{
                    console.log(response)
                    TriggerEventBus.$emit('fetchaccount');
                })
        },
        EditAccount(data) {
            if(!this.showForm){
                this.edit_acct = data
                this.showForm = true
            }else{
                this.edit_acct = []
                this.showForm = false
            }
        },
    }
}
</script>

<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}
</style>