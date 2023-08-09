<template>
    <div class="container-fluid d-flex justify-content-between">
        <div class="row">
            <div class="col">
                <ShareNetwork network="facebook"
                              :url="'https://dsdotsen.com.ua/' + $store.getters.getCurrentPainting.slug"
                              :title="$store.getters.getCurrentPainting.name"
                              :description="$store.getters.getCurrentPainting.description"
                              quote=""
                              hashtags=""
                >
                    <img src="../../../images/facebook.png" alt="facebook icon" width="35" height="35">
                </ShareNetwork>
            </div>
            <div class="col">
                <ShareNetwork
                    network="twitter"
                    :url="'https://dsdotse.com.ua/' + $store.getters.getCurrentPainting.slug"
                    :title="$store.getters.getCurrentPainting.name"
                    :description="$store.getters.getCurrentPainting.description"
                    quote=""
                    hashtags=""
                >
                    <img src="../../../images/twitter.png" alt="twitter icon" width="35" height="35">
                </ShareNetwork>
            </div>
            <div class="col">
                <ShareNetwork
                    network="telegram"
                    :url="'https://dsdotsen.com.ua/' + $store.getters.getCurrentPainting.slug"
                    :title="$store.getters.getCurrentPainting.name"
                    :description="$store.getters.getCurrentPainting.description"
                    quote=""
                    hashtags=""
                >
                    <img src="../../../images/telegram.png" alt="telegram icon" width="35" height="35">
                </ShareNetwork>
            </div>
            <div class="col">
                <ShareNetwork
                    network="whatsapp"
                    :url="'https://dsdotsen.com.ua/' + $store.getters.getCurrentPainting.slug"
                    :title="$store.getters.getCurrentPainting.name"
                    :description="$store.getters.getCurrentPainting.description"
                    quote="test"
                    hashtags=""
                >
                    <img src="../../../images/whatsapp.png" alt="whatsapp icon" width="35" height="35">
                </ShareNetwork>
            </div>
            <div class="col">
                <ShareNetwork
                    network="viber"
                    :url="'https://dsdotsen.com.ua/' + $store.getters.getCurrentPainting.slug"
                    :title="$store.getters.getCurrentPainting.name"
                    :description="$store.getters.getCurrentPainting.description"
                    quote="test"
                    hashtags=""
                >
                    <img src="../../../images/viber.png" alt="viber icon" width="35" height="35">
                </ShareNetwork>
            </div>
        </div>
    </div>
</template>

<script>
export default {

}
</script>

<style lang="scss" scoped>

</style>
