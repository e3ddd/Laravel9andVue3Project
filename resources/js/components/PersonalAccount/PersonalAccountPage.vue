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
            user: []
        }
    },

    mounted() {
            this.getUser()
        },

    methods: {
        async getUser() {
            const response = await axios.get('/get_user').then(response => this.user = response.data)
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
