<template>
    <div class="container body" @mouseleave="() => {
        this.show_prev = false
        this.show_next = false
    }" @mousemove="mouseCord">
        <div class="paintings">
            <div v-for="(painting, key) in paintings">
                <div class="painting" :id="'painting_' + key">
                    <div class="row">
                        <router-link :to="{
                            name: 'painting_page',
                            params: {
                                painting_slug: painting.slug
                            }
                        }">
                            <img :src="'/storage/images/' + painting.images[0].painting_id + '_' + painting.images[0].hash_id" :alt="painting.name_en">
                        </router-link>
                    </div>
                    <div class="row pt-3">
                        <div class="col name">
                            <h5>{{painting['name_' + $store.getters.getLanguage] }}</h5>
                        </div>
                    </div>
                    <div class="row pt-2">
                        <div class="col parameters">
                            <h6>{{painting['style_' + $store.getters.getLanguage]}}, {{painting['material_' + $store.getters.getLanguage]}}, {{painting.height}}x{{painting.long}}cm</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col year">
                            <h6>{{painting.year}}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-btns" v-if="show_btns">
            <div class="prev" @click="prev" v-if="this.show_prev">&#60;</div>
            <div class="next" @click="next" v-if="this.show_next">&#62;</div>
        </div>
    </div>
</template>

<script>

import { mapGetters } from 'vuex'
export default {
    data: () => ({
        painting: {
            alias: 'painting_',
            key: 0,
        } ,
        offset: 0,
        show_next: false,
        show_prev: false,
        show_btns: '',
    }),

    mounted() {
        this.$store.dispatch('getAllPaintings');
    },

    watch: {
        paintings(newValue, oldValue){
            const slider = document.querySelector('.paintings');

            slider.style.left = 0 + 'px'
            setTimeout(() => {
              let width = 0;
              for (const paintingKey in newValue) {
                  const painting = document.getElementById('painting_' + paintingKey);
                  width += painting.offsetWidth
              }

              if(window.screen.width > width){
                  this.show_btns = false
              }else{
                  this.show_btns = true
              }
            }, 100)
        }
    },

    computed: {
        ...mapGetters({
            paintings: 'getAllPaintings',
        })
    },

    methods: {
        mouseCord(e){
            if(window.innerWidth / 2 > e.clientX){
                this.show_next = false
                this.show_prev = true
            }

            if(window.innerWidth / 2 < e.clientX){
                this.show_prev = false
                this.show_next = true
            }
        },

        next() {
            const animation = [
                { opacity: 0 }
            ];

            const timing = { duration: 500 };

            const painting = document.getElementById(this.painting.alias + this.painting.key);
            const slider = document.querySelector('.paintings');
            if(this.painting.key === --Object.entries(this.$store.getters.getAllPaintings).length){
                return;
            }

            this.offset -= painting.offsetWidth
            painting.animate(animation, timing);
            slider.style.left = this.offset + 'px';
            ++this.painting.key

        },

        prev() {
            --this.painting.key
            const painting = document.getElementById(this.painting.alias + this.painting.key);
            const slider = document.querySelector('.paintings');
            if(painting === null){
                this.painting.key = 0;
                this.offset = 0
                slider.style.left = this.offset + 'px';
                return;
            }

            this.offset += painting.offsetWidth
            slider.style.left = this.offset + 'px';
        }

    }
}
</script>

<style scoped>
.body {
    margin-top: 7%;
}

.prev {
    user-select: none;
    cursor:pointer;
    font-weight: lighter;
    font-size: 30px;
    top: 43%;
    left: 30px;
    color: white;
    padding: 10px 20px 10px 20px;
    position: absolute;
    background: #000;
    z-index: 99
}

.next {
    user-select: none;
    cursor:pointer;
    font-weight: lighter;
    font-size: 30px;
    top: 43%;
    right: 30px;
    color: white;
    padding: 10px 20px 10px 20px;
    position: absolute;
    background: #000;
    z-index: 99
}

.paintings {
    transition: all ease 0.5s;
    display: flex;
    width: 100%;
    position: relative;
    left: 20px;
}


.paintings .painting {
    width: 100%;
    padding-right: 20px;
    margin-bottom: 10px;
}
.painting img {
    height: 40vh;
    object-fit: cover;
}

@keyframes ani {
    0% {opacity: 1;}
    100% {opacity: 0;}
}
</style>
