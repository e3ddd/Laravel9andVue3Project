<template>
    <form @submit.prevent>
        <div class="col">
            <div class="row">
                <input type="search" name="search" v-model="this.search" @keyup.delete="checkInput" @input="searchProduct" placeholder="Search product...">
            </div>
            <div class="row products" v-for="product in this.products" v-if="this.products !== []">
                <div class="col p-1">
                    <div class="row">
                        <div class="col-4">
                            <img :src="'/storage/images/SMALL_' + product.image[0].product_id + '_' + product.image[0].hash_id"/>
                        </div>
                        <div class="col-8">
                            <a :href="'/about_product/' + product.id">{{product.name}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
export default {

    data() {
      return {
          products: [],
          search: ''
      }
    },

    methods: {
        checkInput()
        {
            if(this.search == ''){
                this.products = []
            }
        },

        searchProduct() {
            if(this.products !== []){
                this.products = []
            }
            axios.get('/search_product', {
                params: {
                    search: this.search
                }
            })
                .then((response) => {
                    this.products = response.data
                })
        }
    }
}
</script>

<style scoped>
.products {
    z-index: 2;
    position: relative;
    background: white;
}
</style>
