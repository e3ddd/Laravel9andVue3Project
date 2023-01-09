<template>
    <div class="row">
        <div class="col field">E-mail: <b>{{email}}</b></div>
        <div class="col field">Password:  <b>{{password}}</b></div>
        <div class="col btn-group">
            <edit-user
                :id="id"
                :email="email"
            />
            <action-btn
                :id="id"
                :method="del"
            >
                Delete
            </action-btn>
            <redirect-btn
                :action="'/users/products_list' "
                :id="id"
                :value="'Product'"
            />

        </div>
    </div>


</template>

<script>
import RedirectBtn from "./RedirectBtn.vue";
import ActionBtn from "./ActionBtn.vue";
import EditUser from "./EditUser.vue";
export default {
    components: {
        RedirectBtn,
        ActionBtn,
        EditUser
    },

    data() {
        return {

        }
    },

    props: {
        id: Number,
        email: String,
        password: String,
        showEdit: Boolean,
        del: Function,
    },

    methods: {

    }

}
</script>

<style scoped>

</style>
