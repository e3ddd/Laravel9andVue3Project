<template>
    <div class="create-product-form">
        <form @submit.prevent>
            <div class="row">
                <label for="select">Select category:</label>
                <select class="select" v-model="this.categoryName">
                    <option v-for="category in this.categories.filter(item => item.parent_id == null)">{{category.id}}, {{category.name}}</option>
                </select>
            </div>

            <div class="row" v-if="this.categoryName !== ''">
                <label for="select">Select subcategory: </label>
                <select @change="getAttr" class="select" v-model="this.subcategoryName">
                    <option v-for="category in this.categories.filter(item => item.parent_id == this.categoryName.match('^\\d+')[0])">{{category.name}}</option>
                </select>
            </div>
                <div class="inputs"
                     v-for="(attribute, key) in this.attributes"
                     :key="attribute.id"
                >
                    <div class="row item">
                        <div class="col-2 label">
                            <label>{{attribute.name}}:</label>
                        </div>
                        <div class="col-7 input">
                            <input type="text" v-model="this.attributes[key].name">
                        </div>
                        <div class="col-2 btns">
                            <button @click="up" :id="key">&#8593;</button>
                            <button @click="down" :id="key">&#8595;</button>
                        </div>
                    </div>
                </div>

        </form>
    </div>
</template>

<script>
import AdminPanelBut from "../AdminPanelBut.vue";

export default {
    components: {
        AdminPanelBut
    },

    data() {
        return {
            product: [],
            attributes: [],
            categories: [],
            categoryName: '',
            subcategoryName: ''
        }
    },

    created() {
        this.getCategories()
    },

    methods: {
        up(event) {
                const prevIndex = Number(event.target.id) - 1
                const prevObj = this.attributes[prevIndex]
            if(prevIndex >= 0){
                this.attributes[prevIndex] = this.attributes[event.target.id]
                this.attributes[event.target.id] = prevObj
            }
        },

        down(event) {
            const nextIndex = Number(event.target.id) + 1
            const nextObj = this.attributes[nextIndex]
            if(nextIndex <= this.attributes.length - 1){
                this.attributes[nextIndex] = this.attributes[event.target.id]
                this.attributes[event.target.id] = nextObj
            }
        },

        async getCategories() {
            const response = await axios.get('/get_all_categories')
                .then((response) => {
                    this.categories = response.data
                })
        },

        async getAttr() {
            const response = await axios.get('/get_attributes', {
                params: {
                    subcategoryName: this.subcategoryName
                }
            })
                .then((response) => {
                    this.attributes = response.data
                })
                .catch((err) => {
                    console.log(err);
                })
        },

       async submit() {

        }
    }
}
</script>

<style scoped>
.select {
    width: 75%;
    margin-left: 30px;
}

.create-product-form {
    border: 2px solid silver;
    padding: 10px;
}

.item {
    text-align: center;
    margin-top: 10px;
}

.input {
    display: flex;
    justify-content: center;
    margin-top: 15px;
    margin-bottom: 15px;
    margin-left: 25px;
}

.label {
    margin-top: 15px;
}

.label :first-letter {
    text-transform: uppercase;
}

.btns button {
    margin-right: 3px;
    margin-top: 5px;
    background: #df4949;
    border: none;
    border-radius: 5px;
    color: white;
}
</style>
