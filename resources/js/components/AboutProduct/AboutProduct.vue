<template>
    <div class="container product">
        <div class="row back_link">
            <h6>
                <span>Back to
                <a :href="'/products/' + this.categoryName">{{this.categoryName}}</a> >>
                <a :href="'/products/' + this.categoryName + '/' + this.subcategoryName">{{this.subcategoryName}}</a>
            </span>
            </h6>
        </div>
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
            productName: window.location.href,
            productId: '',
            product: [],
            categoryId: '',
            categoryName: '',
            subcategoryId: '',
            subcategoryName: '',
            productAttributes: []
        }
    },

    created() {
        this.rightName()
        this.getProduct()
    },

    mounted() {
        this.getProductAttributes()
        this.getSubcategoryName()
    },

    methods: {
        rightName(){
            let productName = this.productName.split('/')[4]
            let tmp = productName.split('%20')
            this.productName = tmp.join(' ')

        },

        async getSubcategoryName() {
            const response = await axios.get('/get_category_name_by_id', {
                params: {
                    category_id: this.subcategoryId
                }
            })
                .then((response) => {
                        this.subcategoryName = response.data.name
                        this.categoryId = response.data.parent_id
                })
                .catch(err => console.log(err))

            await this.getCategoryName()
        },

        async getCategoryName()
        {
            const response = await axios.get('/get_category_name_by_id', {
                params: {
                    category_id: this.categoryId
                }
            })
                .then(response => this.categoryName = response.data.name)
                .catch(err => console.log(err))
        },

        async getProduct() {
            const response = await axios.get('/admin/get_product_by_name', {
                params: {
                    productName: this.productName
                }
            })
                .then((response) => {
                        this.productId = response.data.id
                        this.product = response.data
                        this.subcategoryId = response.data.subcategory_id
                    }
                )
                .catch(err => console.log(err))
        },

        async getProductAttributes() {
            const response = await axios.get('/admin/get_converted_attributes', {
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
.back_link a {
    text-transform: uppercase;
    text-decoration: none;
    color: black;
}

.back_link a:hover {
    transition: 0.5s;
    color: #df4949;
    text-decoration: underline;
}

.product {
    margin-top: 50px;
}
</style>
