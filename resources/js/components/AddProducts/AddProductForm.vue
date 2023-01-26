<template>
    <div class="col-md-auto add_product">
        <div class="inputs">
            <h4>Add Product</h4>
            <div class="category__input">
                <label>Category</label>
                <select v-model="this.product.category">
                    <option selected disabled>{{this.product.category}}</option>
                    <option v-for="category in this.categories">{{category.name}}</option>
                </select>
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
            categories: [],
            product: {
                category: 'Choose category',
                email: '',
                name: '',
                price: '',
                description: '',
            }
        }
    },

    created() {
      this.getUser()
        this.getCategories()
    },

    methods: {
        async getUser(){
            const response = axios.post('/get_user')
                .then((response) => {
                    this.product.email = response.data.email
                })
        },

        async getCategories()
        {
          const response = axios.post('get_categories')
              .then((response) => {
                  this.categories = response.data
              })
        },

        async addProduct() {
                const response = await axios.post('/add_product/', {
                    category: this.product.category,
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
.category__input label{
    margin-right: 10px;
    margin-bottom: 10px;
}

.category__input {
    padding: 5px;
    display: flex;
    justify-content: left;
}

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
