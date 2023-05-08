<template>
    <div class="container-fluid items">
        <div class="row">
            <div class="col"></div>
            <div class="col-6">
                <PersonalAccountItem
                    :label="'Personal data'"
                    :src="'user'"
                    :user="this.user"
                />
                <PersonalAccountItem
                    :label="'Contacts'"
                    :src="'contacts'"
                    :user="this.user"
                />

                <PersonalAccountItem
                    :label="'Favorites'"
                    :src="'favorites'"
                    :user="this.user"
                    :favorites="this.favProds"
                />
                <Orders/>
            </div>
            <div class="col"></div>
        </div>
    </div>
</template>

<script>
import PersonalAccountItem from "./PersonalAccountItem.vue";
import Orders from "./Orders.vue";
export default {
    components: {
        PersonalAccountItem,
        Orders
    },

    data() {
        return {
            user: [],
            favProds: {}
        }
    },

    created() {
        this.getUser()


    },




    methods: {
        async getUser() {
            axios.get('/get_user_by_id').then((response) => {
                this.user = response.data
            })
                .then((response) => {
                    for (const key in this.user.favorite_products) {
                        this.getFavProds(this.user.favorite_products[key].product_id, this.user.favorite_products[key].id)
                    }
                    console.log(this.favProds)
                })
        },

        async getFavProds(productId, favId) {
            axios.get('/get_product_by_id', {
                    params: {
                        productId: productId
                    }
                }
            )
                .then((response) => {
                    this.favProds[favId] = response.data
                })
                .catch(err => console.log(err))
        }
    }
}
</script>

<style scoped>
.items {
    margin-top: 50px;
}

.orders label {
    font-size: 12px;
    color: grey;
}
</style>
