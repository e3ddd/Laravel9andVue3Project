<template>
    <div class="admin_panel">

     <div class="user_list">
         <search-user
             :show="this.show"
             :get="getUsers"
             @update="onUpdate"
             @search="onSearch"
         />
         <div class="loading" v-if="show">
             Loading...
         </div>
         <div class="user_item" v-for="user in users">
             <user-data
                    :id="user.id"
                    :email="user.email"
                    :password="user.password"
                    :del="this.delete"
               />
         </div>
         <paginator
             v-model:total="total"
             :get="getUsers"
             @update="onUpdate"
         />
     </div>
    </div>

</template>

<script>
import UserData from "./UserList/UserData.vue";
import Math from "lodash";
import ActionBtn from "./UserList/ActionBtn.vue";
import Paginator from "./UserList/Paginator.vue";
import SearchUser from "./UserList/SearchUser.vue";
export default {
    components: {
        ActionBtn,
        UserData,
        Paginator,
        SearchUser,
    },
    data() {
        return {
            show: false,
            users: [],
            limit: 10,
            total: '',
            search: '',
        }
    },

    mounted() {
        this.getUsers(this.page)
    },

    methods: {

        onUpdate() {
            this.users = []
        },

        onSearch(search) {
          this.search = search
        },


        async getUsers(page) {
            try {
                this.show = true
                const response = await axios.get('/users/all?page=' + page, {
                    params: {
                     search: this.search
                    }
                });
                this.total = Math.ceil(response.data.total / this.limit)
                response.data.data.map((item) => {
                    this.users.push(item)
                })
            } catch (error) {
                console.error(error);
            }finally {
                this.show = false
            }
        },


        async delete(id) {
            this.users = this.users.filter((user) => user.id !== id)
                const response = await axios.get('/users/' + id + '/delete', {
                    params: {
                        id: id
                    }
                })
                    .then((response) => {
                        console.log(response);
                     })
                    .catch((error) => {
                        console.error(error);
                    })
        },
    }
}
</script>

<style scoped>

.admin_panel {
    display: flex;
    justify-content: center;

}

.user_list {
    width: 100%;
    padding: 10px;
    margin: 20px;
    background: #f6f9f4;
    border-radius: 10px;
    box-shadow: 2px 2px 1px lightgray;
}
</style>
