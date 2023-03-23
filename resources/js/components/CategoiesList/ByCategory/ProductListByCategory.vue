<template>
    <div class="container">
        <div class="row">
            <links
                :category="category"
            />
        </div>
        <div class="row">
            <div class="col-3 d-flex justify-content-center" v-for="product in products">
                 <list-item
                     :product="product"
                     :user="this.user"
                 />
            </div>
        </div>
    </div>

</template>

<script>
import ListItem from "../ListItem.vue";
import Links from "./Links.vue";
export default {
    components: {
        Links,
        ListItem
    },

    props: {
        category: String,
        products: Array,
        user: String,
    },

    data() {
      return {
          user: ''
      }
    },

    mounted() {
      this.getUser()
    },

    methods: {
        async getUser() {
            const response = await axios.get('/get_user').then((response) => {
                this.user = response.data.email
                console.log(this.user)
            })
        }
    }
}
</script>

<style scoped>

</style>
