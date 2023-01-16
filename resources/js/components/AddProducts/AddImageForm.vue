<template>
    <div class="col-md-auto add_images">
        <div class="inputs">
            <h4>Add Image</h4>
            <label for="inputProduct" class="p-1">Product ID</label>
            <add-input
                v-model="this.id"
                :name="'productId'"
                :type="'text'"
                :placeholder="'Enter product id'"
            />


            <label for="file" >Select image to upload:</label>
           <div class="file__div">
            <input class="file" type="file" name="file" @change="onFileUpload">
               <error-message
                   :err="this.err"
               />
            </div>
            <action-btn
                class="btn"
                :method="addProductImage"
            >
                Upload Image
            </action-btn>
        </div>
    </div>
</template>

<script>
    import ActionBtn from "../UserList/ActionBtn.vue";
    import AddInput from "../MyInput.vue";
    import ErrorMessage from "../ErrorMessage.vue";
    export default {
        components: {
            ActionBtn,
            AddInput,
            ErrorMessage
        },
        data() {
            return {
                id: '',
                file: null,
                err: ''
            }
        },

        methods: {
            onFileUpload(event) {
                this.file = event.target.files[0]
            },

           async addProductImage() {

               const fd = new FormData();
                   fd.append('productId', this.id)
                   try
                       {
                        fd.append('file', this.file, this.file.name)
                       }
                       catch(e)
                   {
                       this.err = 'File required !'
                   }
               const response = await axios.post('/add_image/', fd,{
                       headers: {
                           'Content-Type': 'multipart/form-data'
                       }
                   })
                   .then((response) => {

                   })

                   .catch((error) => {
                           this.err = error.response.data.message
                           setTimeout(() => {
                               this.err = ''
                           }, 3000)
                       })
                       .finally(() => {
                           if(this.err.length === 0){
                               alert('Your product image added !')
                           }
                       })
            }
        }
}
</script>

<style scoped>

label {
    margin-top: 10px;
}

.inputs {
    justify-content: center;
    align-items: center;
    text-align: center;
    margin: 20px;
    padding: 50px;
    border-radius: 10px;
    border: 2px solid silver;
    box-shadow: 3px 3px 3px lightgray;
}

.file {
    margin-top: 5px;

    padding: 10px;
}

.file__div {
    padding-bottom: 70px;
}

.btn {
    padding: 6px;
    width: 50%;
}
</style>
