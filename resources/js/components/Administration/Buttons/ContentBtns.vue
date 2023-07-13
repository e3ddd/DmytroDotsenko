<template>
    <div class="row">
        <div class="col">
            <a :href="'#/edit'"><img src="../../../images/edit-btn.png" width="20" alt="edit"></a>
        </div>
        <div class="col">
            <a :href="'#/delete'"><img src="../../../images/delete-btn.png" width="20" alt="delete"></a>
        </div>
        <div class="col">
            <a :href="'#/view'"><img src="../../../images/view-btn.png" width="20" alt="view"></a>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        painting_id: Number,
    }
}
</script>

<style scoped>

</style>
