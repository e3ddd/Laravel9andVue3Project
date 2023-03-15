<template>

    <form action="" @submit.prevent enctype="multipart/form-data">

        <label for="subCat">Subcategory</label>
        <input type="file" name="subCat" id="subCat" @change="onFileUpdate">
        <button @click="this.sendRequest">Submit</button>
    </form>

</template>

<script>
export default {
    data() {
        return {
                dimensionType: '',
                value: '',
            file: null
        }
    },

    methods: {
        onFileUpdate(e) {
            this.file = e.target.files[0]
        },

        sendRequest() {
            let fd = new FormData();
            fd.append('file', this.file, this.file.name)
            const response = axios.get('/test', {
                params: {
                    fd
                }
            },{
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then(response => console.log(response))
                .catch(err => console.log(err))
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
