<template>
    <div class="col-md-auto add_product">
        <div class="inputs">
            <h4>Add Product</h4>
            <div class="input">
                <label>User</label>
            <add-input
                v-model="this.product.email"
                :name="'name'"
                :type="'email'"
                :placeholder="'Enter user e-mail'"
            />
            </div>

            <div class="input">
                <label>Product</label>
            <add-input
                v-model="this.product.name"
                :name="'product'"
                :type="'text'"
                :placeholder="'Enter product name'"
            />
            </div>

         <div class="input">
           <label>Price</label>
            <add-input
                v-model="this.product.price"
                :name="'price'"
                :type="'text'"
                :placeholder="'Enter product price'"
            />
         </div>

         <div class="input">
           <label>Description</label>
            <add-input
                v-model="this.product.description"
                :name="'description'"
                :type="'text'"
                :placeholder="'Enter about product'"
            />
           </div>
            <error-message
                :err="this.err"
            />
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
import ErrorMessage from "../ErrorMessage.vue";
export default {
    components: {
        ActionBtn,
        AddInput,
        ErrorMessage
    },

    data() {
        return {
            err: '',
            product: {
                email: '',
                name: '',
                price: '',
                description: '',
            }
        }
    },

    methods: {
        async addProduct() {
                const response = await axios.post('/add_product/', {
                    email: this.product.email,
                    name: this.product.name,
                    price: +this.product.price,
                    description: this.product.description,
                })
                    .then((response) => {
                        console.log(response)
                    })
                    .catch((error) => {
                        console.log(error)
                        this.err = error.response.data.message
                        setTimeout(() => {
                            this.err = ''
                        }, 3000)
                    })
                    .finally(() => {
                        if(this.err.length === 0){
                            alert('Your product added !')
                        }
                    })

        }
    }
}
</script>

<style scoped>

label {
    margin-top: 10px;
}

.inputs {
    height: 100%;
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
