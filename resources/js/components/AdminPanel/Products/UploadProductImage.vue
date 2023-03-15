<template>
    <div class="row create-product-form">
        <div class="col-md-auto" v-for="image in imagesCount">
            <img :src="this.files[image - 1].url" alt="" class="image" :id="image - 1" @click="deleteImage">
        </div>
        <div class="col-md-auto add_image">
                <label for="upload_image" class="upload_image_button">+</label>
                <input type="file" name="photo" id="upload_image" @input="getImages" @change="onFileChange"/>
        </div>
    </div>
</template>

<script>

export default {


    props: {
        productId: Number,
    },

    data() {
        return {
            files: [],
            imagesCount: 0
        }
    },

    methods: {
        getImages() {
            this.$emit('getImages', this.files)
        },

        deleteImage(event) {
            this.imagesCount--
            if(this.imagesCount == 0){
                this.imagesCount = 0
            }
            this.files = this.files.filter(item => item.id != event.target.id)

            this.$emit('deleteImage', event.target.id)
        },

        onFileChange(event) {
            let files = event.target.files || event.dataTransfer.files;
            if (!files.length)
                return;
            if(files[0].type == 'image/png' || files[0].type == 'image/jpeg'){
                this.files.push({id: this.imagesCount, file: files[0], url: URL.createObjectURL(files[0])})
                this.imagesCount++
            }else{
                alert('Bad image format ! Must be png or jpeg !')
            }
        },
    }
}
</script>

<style scoped>
.image {
    width: 117px;
    height: 140px;
    margin-top: 10px;
}

.upload_image_button {
    cursor: pointer;
    color: #df4949;
    border: 2px solid #df4949;
    box-shadow: 2px 2px 1px silver;
    padding: 50px;
    margin-top: 10px;
    margin-bottom: 10px;
    font-size: 24px;
}

.upload_image_button:hover {
    background: #f5f0f0;
    transition: 0.5s;
}

#upload_image {
    opacity: 0;
    position: absolute;
    z-index: -1;
}
</style>
