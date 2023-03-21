<template>
    <div class="container-fluid index__btns">
        <div class="row">
            <div class="col-4">
                <logo/>
            </div>
            <div class="col-4">
                <div class="row">
                    <div class="col-6 reg_log">
                        <reg-and-log-links
                            :user-email="this.userEmail"
                        />
                    </div>
                    <div class="col-6 search">
                        <search-input/>
                    </div>
                </div>
            </div>

            <div class="col-3">

            </div>
        </div>
    </div>
</template>

<script>
import Logo from "./Logo.vue";
import RegAndLogLinks from "./RegAndLogLinks.vue";
import SearchInput from "./SearchInput.vue";
export default {
    components: {
        Logo,
        RegAndLogLinks,
        SearchInput
    },

    data() {
        return {
            showSelectMenu: false,
            userEmail: '',
            search: ''
        }
    },
    created() {
        this.getUser()
    },


    methods: {
        async getUser(){
            const response = await axios.get('/get_user')
                .then((response) => {
                    this.userEmail = response.data.email
                })
        },

        showSelectMenuFunc() {
            this.showSelectMenu = !this.showSelectMenu;
        },

    }
}
</script>

<style scoped>

.index__btns {
    height: 100px;
    background: #f8f7f7;
}


.search {
    margin-top: 30px;
}


.reg_log {
    margin-top: 15px;
}



</style>
