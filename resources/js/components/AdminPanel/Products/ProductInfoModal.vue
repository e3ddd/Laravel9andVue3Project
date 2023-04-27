<template>
<div class="product_info" v-if="show" @click="show = false">
    <div class="product" @click.stop>
        <div class="row">
            <div class="col" v-if="images.length !== 0">
                <div class="row">
                    <img :src="'/storage/images/' + images[0].product_id + '_' +images[0].hash_id">
                </div>
                <div class="row">
                        <div class="col-auto"  v-for="image in images">
                            <img :src="'/storage/images/' + 'SMALL_' + image.product_id + '_' + image.hash_id">
                        </div>
                </div>
            </div>
            <div class="col default_attrs">
                <div v-for="(item, key) in this.product">
                    <div class="row attr">
                        <div class="col attr_item">
                            <label>{{key}}: </label>
                            {{item}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
                <div class="col attr_item">
                    <div v-for="(attribute,key) in this.attributes">
                        <label>{{key}}</label> : <span>{{attribute.value}} <span v-if="attribute.type !== 'string' && attribute.type !== 'numer'">{{attribute.type}}</span></span>
                    </div>
                </div>
    </div>
</div>
    <admin-panel-but
        :func="showDialog"
    >
        Info
    </admin-panel-but>
</template>

<script>
import AdminPanelBut from "../AdminPanelBut.vue";
export default {
    components: {
        AdminPanelBut
    },
    props: {
        productId: Number,
        subcategoryId: Number,
        images: Array
    },

    data() {
        return {
            show: false,
            product: [],
            attributes: []
        }
    },

    methods: {
        showDialog() {
            this.show = true
            this.getProductAttrs()
            this.getProductAttributes()
        },

        async getProductAttrs() {
            const response = await axios.get('/get_product_by_id', {
                    params: {
                        productId: this.productId
                    }
            })
                .then((response) => {
                    this.product = response.data
                })
                .catch(err => console.log(err))
        },

        async getProductAttributes() {
            const response = await axios.get('/admin/get_converted_attributes', {
                params: {
                    productId: this.productId,
                    subcategoryId: this.subcategoryId
                }
            })
                .then((response) => {
                    this.attributes = response.data
                })
                .catch(err => console.log(err))
        }

    }
}
</script>

<style scoped>
.product_info {
    overflow-y: scroll;
    top: 0;
    bottom: 0;
    right: 0;
    left: 0;
    background: rgba(0,0,0,0.5);
    position: fixed;
    display: flex;
}

.product {
    padding: 15px;
    margin: auto;
    background: white;
    border-radius: 12px;
    min-height: 50px;
    width: 50%;
}

.default_attrs .attr .attr_item label:first-letter {
    text-transform: uppercase;
}

.default_attrs .attr .attr_item label{
    font-weight: bold;
}

.attr_item label:first-letter {
    text-transform: uppercase;
}

.attr_item label{
    font-weight: bold;
}
</style>
