<template>
    <div class="tbl">
    <stat-table
        :dates="this.dates"
    />
    </div>
</template>

<script>
import StatTable from "./ProductsViewStatistic/StatTable.vue";
export default {
    components: {
        StatTable
    },

    data() {
        return {
            dates: [],
            id: window.location.search.split("=")[1]
        }
    },

    mounted() {
    this.getDates()
        },

    methods: {
        async getDates() {
            const response = await axios.get('/view_statistic', {
                params: {
                    user: this.id,
                    get: true,
                }
            })
                .then((response) => {
                    console.log(response)
                    this.dates = response.data
                })
        }
    }

}
</script>

<style scoped>
.tbl {
    padding: 50px;
    margin: 50px;
    border: 2px solid silver;
    box-shadow: 3px 3px 3px lightgray;
}
</style>
