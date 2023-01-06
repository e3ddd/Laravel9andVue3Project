<template>
    <div class="search_field">
        <input type="text" placeholder="Search..." v-model="this.search">
        <button class="hlpbtn" @click="searchUser">Search</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            search: '',
            users: []
        }
    },

    props: {
        get: Function
    },

    methods: {
        async searchUser() {
            this.$emit('update', this.users)
            this.$emit('search', this.search)
            this.get()
        },
    }
}
</script>

<style scoped>
.search_field {
    margin-bottom: 20px;
}

.hlpbtn {
    margin: 3px;
    border: none;
    background: #ff3838;
    color: white;
    box-shadow: 2px 2px 5px grey;
}
</style>
