<template>
    <div class="col-md-auto add_product">
        <div class="inputs">
            <h4>Add Product</h4>
            <div class="row category__input">
                <label>Category</label>
                <select @change="category" v-model="this.product.category">
                    <option selected disabled>{{this.product.category}}</option>
                    <option v-for="category in this.categories">{{category.name}}</option>
                </select>
            </div>

            <div class="row subcategory__input">
                <label>Subcategory</label>
                <select v-model="this.product.subcategory">
                    <option selected disabled>{{this.product.subcategory}}</option>
                    <option v-for="subcategory in this.subcategories">{{subcategory.name}}</option>
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
            subcategories: [],
            product: {
                category: 'Choose category',
                subcategory: 'Choose subcategory',
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
                  console.log(response)
              })
        },

        async addProduct() {
                const response = await axios.post('/add_product/', {
                    category: this.product.category,
                    subcategory: this.product.subcategory,
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
        },

        category(event) {
            const categories = JSON.parse(JSON.stringify(this.categories))
            const subcategories = categories.filter((item) => item.name === event.target.value)
            subcategories.map(item => this.subcategories = item.subcategory)
        },
    }
}
</script>

<style scoped>

.category__input select{
    padding: 5px;
    display: flex;
    justify-content: left;
}


.subcategory__input select{
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
