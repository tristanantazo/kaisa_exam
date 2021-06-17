<template>
  <div class="form_container">
      <div class="wrapper">
        <div class="input_wrapper">
            <base-input-component label="First name" v-model="form.first_name"/>
            <base-input-component label="Last name" v-model="form.last_name"/>
            <base-input-component label="Email" v-model="form.email"/>
            <base-input-component type="password" label="Password" v-model="form.password"/>
        </div>
        <div class="photos_container">
            <div class="photos_wrapper">
                <img src="" alt="" :ref="'input_1_preview'" >
                <input type="file" :ref="'input_1'" @input="handleFilesUpload('input_1', 'photo_1')">
            </div>
            <div class="photos_wrapper">
                <img src="" alt="" :ref="'input_2_preview'" >
                <input type="file" :ref="'input_2'" @input="handleFilesUpload('input_2', 'photo_2')">
            </div>
            <div class="photos_wrapper">
                <img src="" alt="" :ref="'input_3_preview'" >
                <input type="file" :ref="'input_3'" @input="handleFilesUpload('input_3', 'photo_3')">
            </div>
        </div>
      </div>
    <base-button-component label="Add" :onClick="submitNewAccount"/>          
  </div>
</template>

<script>
import BaseInputComponent from './BaseComponents/BaseInputComponent.vue'
import BaseButtonComponent from './BaseComponents/BaseButtonComponent.vue'
export default {
    components: {
        BaseInputComponent,
        BaseButtonComponent,
    },
    data: function() {
        return {
            form: {
                first_name: '',
                last_name: '',
                email: '',
                password: '',
                photos: {
                    photo_1: '',
                    photo_2: '',
                    photo_3: '',
                }
            }
        }
    },
    methods: {
        handleFilesUpload (input_dom, section) {
            // uploadedFiles is the input file reference
            const uploadedFiles = this.$refs[input_dom].files
            // preview is for image preview
            const preview = this.$refs[input_dom+'_preview'];
            // reader api for upload image
            const reader = new FileReader();
            const vm = this;
            reader.addEventListener("load", function () {
                // convert image file to base64 string
                preview.src = reader.result;
                vm.form.photos[section] = reader.result;
            }, false);
            reader.fileName = uploadedFiles[0].name
            reader.readAsDataURL(uploadedFiles[0])
        },

        submitNewAccount(){
            const form = this.form;
            axios.post('/api/user/', {
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