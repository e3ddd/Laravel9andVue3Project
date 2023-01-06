<template>
    <div class="edit_form" v-if="show" @click="show = false">
        <div @click.stop class="edit_form_item">
            <label for="input">Edit your e-mail:</label>
            <my-input
                v-model="requestEmail"
                :name="'email'"
                :type="'email'"
            />

            <action-btn
                :method="editUser"
            >
                Edit
            </action-btn>
        </div>
    </div>
    <action-btn
      :method="showDialog"
    >
        Edit
    </action-btn>
</template>

<script>
import MyInput from "../MyInput.vue";
import ActionBtn from "./ActionBtn.vue";
export default {

    components: {
        ActionBtn,
        MyInput
    },

    data() {
        return {
            show: false,
            requestEmail: this.email
        }
    },
    props: {
        id: Number,
        email: String,
    },

    mounted() {
    },

    methods: {
        showDialog() {
            this.show = true
        },

        async editUser() {
            try {
                const response = await axios.get('/users/' + this.id + '/edit', {
                    params: {
                        id: this.id,
                        email: this.requestEmail
                    }
                })
                    .then(function (response) {
                        console.log(response)
                    alert('Your e-mail edited !')

                })
                    .catch(function (error) {
                        console.log(error);
                    });
            }catch (e){
                console.log(e)
            }finally {
                this.show = false
            }
        }
    }
}
</script>

<style scoped>
label {
    margin-right: 10px;
}

.edit_form {
    top: 0;
    bottom: 0;
    right: 0;
    left: 0;
    background: rgba(0,0,0,0.5);
    position: fixed;
    display: flex;
}

.edit_form_item {
    padding: 15px;
    margin: auto;
    background: white;
    border-radius: 12px;
    min-height: 50px;
    min-width: 300px;
}
</style>
