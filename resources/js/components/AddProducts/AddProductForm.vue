<template>
    <div class="add_product">
        <div class="inputs">
            <h4>Add Product</h4>
            <div class="input">
                <label>User</label>
            <add-input
                v-model="this.email"
                :name="'name'"
                :type="'email'"
                :placeholder="'Enter user e-mail'"
            />
            </div>

            <div class="input">
                <label>Product</label>
            <add-input
                v-model="this.name"
                :name="'product'"
                :type="'text'"
                :placeholder="'Enter product name'"
            />
            </div>

         <div class="input">
           <label>Price</label>
            <add-input
                v-model="this.price"
                :name="'price'"
                :type="'text'"
                :placeholder="'Enter product price'"
            />
         </div>

         <div class="input">
           <label>Description</label>
            <add-input
                v-model="this.description"
                :name="'description'"
                :type="'text'"
                :placeholder="'Enter about product'"
            />
           </div>
            <action-btn
                class="btn"
                :method="addProduct"
            >
              Add
            </action-btn>
        </div>
    </div>
</template>

<script>
import ActionBtn from "../UserList/ActionBtn.vue";
import AddInput from "../MyInput.vue";
export default {
    components: {
        ActionBtn,
        AddInput
    },

    data() {
        return {
                email: '',
                name: '',
                price: '',
                description: '',
        }
    },

    methods: {
        async addProduct() {
            try{
                const response = await axios.post('/add_product/', {
                    email: this.email,
                    name: this.name,
                    price: this.price,
                    description: this.description,
                })
                    .then(function (response) {

                    })
                    .catch(function (error) {
                        console.log(error);
                    })
            }catch (e){

            }finally {
                alert('Your product added !')
                this.email = ''
                this.name = ''
                this.price = ''
                this.description = ''
            }
        }
    }
}
</script>

<style scoped>

label {
    margin-top: 10px;
}

.inputs {
    position: relative;
    justify-content: center;
    align-items: center;
    text-align: center;
    margin: 20px;
    padding: 50px;
    border-radius: 10px;
    border: 2px solid silver;
    box-shadow: 3px 3px 3px lightgray;
}

.btn {
    width: 50%;
    margin-top: 40px;
    padding: 6px;
}
</style>
