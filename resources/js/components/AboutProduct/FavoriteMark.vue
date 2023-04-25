<template>
<div class="row favorite" @click="this.saveFavoriteProduct(); this.onUpdateFavoriteCount();">
    <div class="col-4" v-if="this.favorite == false">
        <img src="../../heart.png" width="20" height="20">
    </div>

    <div class="col-4" v-if="this.favorite == true">
        <img src="../../heart(1).png" width="20" height="20">
    </div>

    <div class="col">
        <small>{{this.count}}</small>
    </div>
</div>
</template>

<script>
export default {
    data() {
        return {
            favorite: false,
            count: 0
        }
    },

    props: {
        product_id: Number
    },

    created() {
        this.getFavoriteCount()
        this.checkFavorite()
    },

    methods: {
        onUpdateFavoriteCount()
        {
            if(!this.favorite){
                ++this.count
            }else{
                if(this.count > 0){
                    --this.count
                }
            }
        },

        async getFavoriteCount() {
            const response = await axios.post('/get_favorite_count', {
                product_id: this.product_id
            })
                .then((response) => {
                    this.count = response.data
                })
        },


        async checkFavorite() {
            const response = await axios.post('/check_favorite', {
                product_id: this.product_id
            })
                .then((response) => {
                    if(response.data === 1){
                        this.favorite = true
                    }else{
                        this.favorite = false
                    }
                })
                .catch(err => console.log(err))
        },

        async saveFavoriteProduct() {
            const response = await axios.post('/save_to_favorite', {
                product_id: this.product_id
            })
                .then((response) => {

                    if(response.data === 1){
                        this.favorite = true
                    }else{
                        this.favorite = false
                    }
                })
                .catch(err => console.log(err))
        }
    }
}
</script>

<style scoped>

.favorite {
    margin-top: 15px;
}

.favorite:hover {
    cursor: pointer;
}

</style>
