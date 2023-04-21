<template>
    <div class="row item">
        <div class="col-5 image" v-if="src === 'user'">
            <img alt="icon" src="../../user.png" width="30" height="30"/>
        </div>

        <div class="col-5 image" v-if="src === 'contacts'">
            <img alt="icon" src="../../contact-mail.png" width="30" height="30"/>
        </div>
        <div class="col-6 label">
            <span>{{label}}</span>
        </div>
        <div class="col-1 arrow" @click="showContent">
            <span>&#9660;</span>
        </div>
        <div class="row pt-4" v-if="this.show === true">
            <div class="row" v-if="src === 'user'">
                <div class="col">
                    <div class="row">Name:</div>
                    <div class="row">{{user.name}}</div>
                </div>
                <div class="col">
                    <div class="row">Surname:</div>
                    <div class="row">{{user.surname}}</div>
                </div>
            </div>

            <div class="row" v-if="src === 'contacts'">
                <div class="col">
                    <div class="row">Email:</div>
                    <div class="row">{{user.email}}</div>
                </div>
                <div class="col">
                    <div class="row">Phone number:</div>
                    <div class="row">{{user.phone_number}}</div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    props: {
        src: String,
        label: String,
        user: [Object, Array]
    },

    data() {
      return {
          show: false
      }
    },

    methods: {
        showContent() {
            this.show = !this.show
        }
    }
}
</script>

<style scoped>
.item {
    border: 3px solid #f8f7f7;
    padding: 10px;
    margin-top: 30px;
}

.item .label {
    font-size: 18px;
}

.arrow span {
    cursor: pointer;
}

</style>
