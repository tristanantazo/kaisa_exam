<template>
  <div class="form_container">
      <div class="wrapper">
        <div class="input_wrapper">
            <base-input-component label="First name" v-model="form.first_name"/>
            <base-input-component label="Last name" v-model="form.last_name"/>
        </div>
      </div>
    <base-button-component label="Save" :onClick="submitNewAccount"/>          
  </div>
</template>

<script>
import BaseInputComponent from './BaseComponents/BaseInputComponent.vue'
import BaseButtonComponent from './BaseComponents/BaseButtonComponent.vue'
export default {
    props: {
        account_details: []
    },
    components: {
        BaseInputComponent,
        BaseButtonComponent,
    },
    data() {
        return {
            form: {
                first_name: '',
                last_name: '',
            }
        }
    },
    watch: { 
      	account_details: function(newVal, oldVal) { // watch it
            this.form.first_name = newVal.first_name
            this.form.last_name = newVal.last_name
        }
    },
    methods: {
        submitNewAccount(id){
            const form = this.form;
            axios.put('/api/user/'+this.account_details.id, {
                form,
            })
            .then(response =>{
                console.log(response);
                TriggerEventBus.$emit('fetchaccount');
            })
        }
    }
}
</script>

<style lang="scss" scoped>
    .form_container {
        padding: 50px;
        .wrapper{
            display: flex;
        }
        .photos_container {
            flex: 1 1 auto;
            padding: 0 20px;
            display: flex;
            .photos_wrapper{
                flex: 1 1 auto;
                display: flex;
                flex-direction: column;
                img {
                    height: 150px;
                    width: 150px;
                    margin-bottom: 20px;
                }
            }
        }
        &::v-deep .input_container {
            margin-bottom: 20px;
            label {
                width:100px;
                display: inline-block;
            }
            input {
                height: 35px;
                width: 300px;
                border-radius: 20px;
                padding: 5px 15px;
            }
            textarea:focus, input:focus{
                outline: none;
            }
        }
        &::v-deep .button_container {
            button {
                padding: 0.6em 1em;
                border-radius: 20px;
                margin: 0 105px;
                width: 75px;
                /* float: right; */
            }
            &:after{
                clear: both;
                content: "";
                display: block;
            }
        }
    }
</style>