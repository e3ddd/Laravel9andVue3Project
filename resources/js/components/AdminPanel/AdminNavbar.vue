<template>
    <div class="container-fluid index__btns">
        <div class="col-sm-auto">
            <a href="/home"><img src="" alt="Logo"></a>
        </div>
        <div class="col-lg-auto d-flex justify-content-center">
            <div class="nav__item">
                <a href="/admin">Categories and Product Attributes</a>
            </div>
            <div class="nav__item">
                <a href="/admin/products">Products</a>
            </div>
        </div>
    </div>
</template>

<script>
export default {


}
</script>

<style scoped>
.index__btns {
    height: 100px;
    background: #f8f7f7;
}

.nav__item {
    margin-top: 10px;
    margin-left: 50px;
}

.nav__item a{
    text-decoration: none;
    color: #df4949;
    font-size: 20px;
}

.nav__item a:hover{
    text-decoration: underline;
    color: #661515;
    transition: 0.5s;
}

</style>
