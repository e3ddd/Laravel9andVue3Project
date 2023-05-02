<template>
    <div class="comment_modal" v-if="show" @click="this.showDialog">
        <div @click.stop class="comment_modal_item">
            <div class="row stars">
                <StarRate
                    :grade="1"
                    :rating="this.rating"
                    :rate_text="'Bad'"
                    @rate-product="onUpdateRating"
                    @clear-rate="onClearRating"
                />
                <StarRate
                    :grade="2"
                    :rating="this.rating"
                    :rate_text="'So-so'"
                    @rate-product="onUpdateRating"
                    @clear-rate="onClearRating"
                />
                <StarRate
                    :grade="3"
                    :rating="this.rating"
                    :rate_text="'Normal'"
                    @rate-product="onUpdateRating"
                    @clear-rate="onClearRating"
                />
                <StarRate
                    :grade="4"
                    :rating="this.rating"
                    :rate_text="'Good'"
                    @rate-product="onUpdateRating"
                    @clear-rate="onClearRating"
                />
                <StarRate
                :grade="5"
                :rating="this.rating"
                :rate_text="'Excellent'"
                @rate-product="onUpdateRating"
                @clear-rate="onClearRating"
                />
            </div>
            <div class="row">
                <UploadImage
                    :product-id="product_id"
                    @get-images="this.onUpdateImages"
                />
            </div>
            <div class="row comment_text">
                <div class="col">
                    <div class="row">
                        <small>Comment:</small>
                    </div>
                    <div class="row comment_item">
                        <textarea
                            v-model="this.comment_text"
                        />
                    </div>
                </div>
            </div>
            <div class="row feedback_btn">
                <button @click="this.sendFeedBack">
                    Send feedback
                </button>
            </div>
        </div>
    </div>
    <button class="leave_btn" @click="this.showDialog">
        LEAVE FEEDBACK
    </button>

</template>

<script>
import UploadImage from "../AdminPanel/Products/UploadImage.vue";
import StarRate from "./StarRate.vue";
export default {
    components: {
        StarRate,
        UploadImage
    },

    data() {
        return {
            show: false,
            comment_text: '',
            images: [],
            rating: 0
        }
    },

    props: {
        product_id: Number
    },

    methods: {
        showDialog() {
            this.show = !this.show
            this.rating = 0
        },

        onUpdateRating(rate) {
            this.rating = rate
        },

        onClearRating(rate) {
            this.rating -= rate
        },

        onUpdateImages(images) {
            this.images = images
        },

        async sendFeedBack() {
            const fd = new FormData();
            this.images.map((item) => {
                fd.append('images[]', item.file, item.file.name)
            })
            fd.append('productId', this.product_id)
            fd.append('rate', this.rating)
            fd.append('comment', this.comment_text)
            const response = await axios.post('/send_feedback', fd,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then((response) => {
                    console.log(response)
                    alert('Your comment has been sent !')
                    this.show = false
                })
                .catch(err => console.log(err))
        }

    }
}
</script>

<style scoped>
.comment_modal {
    top: 0;
    bottom: 0;
    right: 0;
    left: 0;
    z-index: 2;
    background: rgba(0,0,0,0.5);
    position: fixed;
    display: flex;
}

.comment_modal_item {
    padding: 30px;
    margin: auto;
    background: white;
    border-radius: 12px;
    min-height: 50px;
    min-width: 300px;
}

.feedback_btn {
    margin-top: 10px;
    width: 50%;
    height: 30px;
}

.feedback_btn button {
    background: none;
    border: 1px solid #028bad;
    color: #028bad;
}

.feedback_btn button:hover {
    color: white;
    background: #003542;
    transition: 0.5s;
}

.comment_item textarea {
    width: 100%;
    height: 100px;
}

.leave_btn {
    background: none;
    border: 1px solid #028bad;
    color: #028bad;
    padding: 5px;
    border-radius: 5px;
    box-shadow: 2px 2px 2px black;
}

.leave_btn:hover {
    transition: 0.5s;
    background: #003542;
    color: white;
}
</style>
