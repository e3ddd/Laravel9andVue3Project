<template>
    <div class="container product">
        <div class="row">
            <div class="col p-3">
                <h4>{{this.product.name}}</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
              <images
                :images="this.product.image"
              />
            </div>
            <div class="col-lg-6">
                <product
                    :product="this.product"
                    :attributes="this.productAttributes"
                />
            </div>
        </div>
    </div>
</template>

<script>
import Images from "./Images.vue";
import Product from "./Product.vue";
export default {
    components: {
        Images,
        Product,
    },

    data() {
        return {
            productId: window.location.href,
            product: [],
            subcategoryId: '',
            productAttributes: []
        }
    },

    created() {
        this.rightId()
        this.getProduct()
    },

    mounted() {
        this.getProductAttributes()
    },

    methods: {
        rightId(){
            this.productId = this.productId.split('/')[4]
        },

        getProduct() {
            const response = axios.get('/admin/get_product_by_id', {
                params: {
                    productId: this.productId
                }
            })
                .then((response) => {
                        this.product = response.data
                        this.subcategoryId = response.data.subcategory_id
                    }
                )
                .catch(err => console.log(err))
        },

        getProductAttributes() {
            const response = axios.get('/admin/get_converted_attributes', {
                params: {
                    subcategoryId: this.product.subcategory_id,
                    productId: this.productId
                }
            })
                .then(response => this.productAttributes = response.data)
        }
    }
}
</script>

<style scoped>
.product {
    margin-top: 50px;
}
</style>
