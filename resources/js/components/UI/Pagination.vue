<template>
    <div class="paginator">
        <button class="hlpbtn" @click="changePage(page - 1)">&lt;</button>
        <div
            v-for="pageNumber in this.$store.getters.getTotalValue"
            :key="pageNumber"
            class="page"
            :class="{
                    'current_page': page === pageNumber
             }"
            @click="changePage(pageNumber)"
        >
            {{pageNumber}}
        </div>
        <button class="hlpbtn" @click="changePage(page + 1)">&gt;</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            page: 1,
            paintings: []
        }
    },

    methods: {
        changePage(pageNumber) {
            if(pageNumber < 1) pageNumber = 1
            if(pageNumber > this.$store.getters.getTotalValue) pageNumber = this.$store.getters.getTotalValue
            this.$emit('update', this.paintings)
            this.page = pageNumber
            this.$store.dispatch('getPaintings', this.page)
        },
    }
}
</script>

<style scoped>
.paginator {
    display: flex;
    justify-content: center;
    text-align: center;
    margin-top: 15px;
}

.page {
    border: 1px solid black;
    border-radius: 5px;
    padding: 7px;
    margin: 3px;
}

.current_page {
    border: none;
    border-radius: 5px;
    background: #43846b;
    color: white;
}

.hlpbtn {
    margin: 3px;
    border: none;
    background: #43846b;
    color: white;
    box-shadow: 2px 2px 5px grey;
}
</style>
