<template>
    <div class="col">
        <div class="row comments" v-for="comment in this.comments">
            <div class="col comment">
                <div class="row">
                    {{comment.user.name}}
                </div>
                <div class="row">
                    {{comment.user.email}}
                </div>
                <div class="row">
                    <div class="col-4 p-1" v-for="image in comment.images">
                        <img :src="'/storage/comment_images/' + image.comment_id + '_' + image.hash_id" alt="commentImg">
                    </div>
                </div>
                <div class="row">
                    <div class="col-1 p-0 rating" v-for="star in comment.rating">
                        <img src="../../star2.png" alt="star" width="15" height="15">
                    </div>
                </div>
            </div>
            <div class="row comment_text">
                {{comment.comment_text}}
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        product_id: Number,
    },

    data() {
        return {
            comments: []
        }
    },

    mounted() {
        this.getComments()
    },

    methods: {
        async getComments() {
            axios.get('/get_comments_by_product_id', {
                params: {
                    productId: this.product_id
                }
            })
                .then((response) => {
                    this.comments = response.data.data
                })
                .catch(err => console.log(err))
        }

    }
}
</script>

<style scoped>
.comments {
    border: 2px solid silver;
    box-shadow: 1px 1px 1px black;
    padding: 10px;
    margin-top: 30px;
    width: 30%;
}

.comment {
    margin-left: 10px;
 }

.comment_text {
    height: 50px;
    padding: 5px;
    width: 95%;
    border: 1px solid silver;
    margin-left: 10px;
}

.rating {
    margin-right: -10px;
}
</style>
