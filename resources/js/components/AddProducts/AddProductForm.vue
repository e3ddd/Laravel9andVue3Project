<template>
    <div class="col">
        <form action="" @submit.prevent>
        <label class="d-flex justify-content-center" for="selects"><h4>Product categories</h4></label>
        <div class="selects">
            <div class="row select">
                <h6>Choose category</h6>
                <select @change="category" v-model="this.product.category">
                    <option selected disabled>{{this.product.category}}</option>
                    <option v-for="category in this.categories">{{category.name}}</option>
                </select>
            </div>
              <div class="row select">
                  <h6>Choose subcategory</h6>
                  <select v-model="this.product.subcategory">
                      <option selected disabled>{{this.product.subcategory}}</option>
                      <option v-for="subcategory in this.subcategories">{{subcategory.name}}</option>
                  </select>
              </div>
            </div>
        <label class="d-flex justify-content-center" for="inputs"><h4>Main product characters</h4></label>
        <div class="inputs">
            <div class="row input">
                <h6>Product name</h6>
                <my-input
                    :type="'text'"
                    :model-value="this.product.name"
                    :name="'productName'"
                    :placeholder="'Name...'"
                />
            </div>
            <div class="row input">
                <h6>Producer</h6>
                <my-input
                    :type="'text'"
                    :model-value="this.product.producer"
                    :name="'producer'"
                    :placeholder="'Producer...'"
                />
            </div>
            <div class="row input">
                <h6>Product price</h6>
                <my-input
                    :type="'text'"
                    :model-value="this.product.price"
                    :name="'productPrice'"
                    :placeholder="'Price...'"
                />
            </div>
        </div>
        <size
            :subcategory="this.product.subcategory"
        />
        </form>
    </div>
</template>

<script>
import ActionBtn from "../UserList/ActionBtn.vue";
import MyInput from "../MyInput.vue";
import ErrorMessage from "../ErrorMessage.vue";
import Size from "./ProductSize/Size.vue";
export default {
    components: {
        ActionBtn,
        MyInput,
        ErrorMessage,
        Size
    },

    data() {
        return {
            err: '',
            categories: [],
            subcategories: [],
            product: {
                category: 'Choose category',
                subcategory: 'Choose subcategory',
                name: '',
                producer: '',
                price: '',
            }
        }
    },

    created() {
        this.getCategories()
    },



    methods: {
        async getCategories()
        {
          const response = axios.post('/get_categories')
              .then((response) => {
                  this.categories = response.data
                  response.data.map((item) => {
                      this.subcategories.push(item.subcategory)
                  })
              })
        },

        category(event) {
            this.product.subcategory = 'Choose subcategory'
            const categories = JSON.parse(JSON.stringify(this.categories))
            const subcategories = categories.filter((item) => item.name === event.target.value)
            subcategories.map(item => this.subcategories = item.subcategory)
        },
    }
}
</script>

<style scoped>

.inputs {
    padding-left: 20px;
}

.input {
    margin-top: 10px;
}

.selects {
    padding-left: 20px;
    padding-bottom: 20px;
}
.selects select {
    height: 35px;
}
.select {
    margin-top: 10px;
}

.size {
    padding: 20px;
    margin-bottom: 50px;
}

.dimensions input {
    margin-top: 10px;
}
</style>
