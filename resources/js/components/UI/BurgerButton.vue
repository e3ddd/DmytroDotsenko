<template>
    <div id="nav-icon1"
         :class="{open: this.active}"
         @click="this.openMenu">
        <span></span>
        <span></span>
        <span></span>
    </div>
</template>

<script>
export default {
    data() {
        return {
            active: false,
        }
    },

    methods: {
        openMenu() {
            this.active = !this.active
            this.$emit('open', this.active)
        }
    }
}
</script>

<style scoped>
#nav-icon1 {
    margin: 50px 0px 50px 87%;
    width: 60px;
    height: 45px;
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
    -webkit-transition: .5s ease-in-out;
    -moz-transition: .5s ease-in-out;
    -o-transition: .5s ease-in-out;
    transition: .5s ease-in-out;
    cursor: pointer;
}

#nav-icon1 span, #nav-icon3 span, #nav-icon4 span {
    display: block;
    position: absolute;
    height: 4px;
    width: 100%;
    background: black;
    border-radius: 9px;
    opacity: 1;
    left: 0;
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
    -webkit-transition: .25s ease-in-out;
    -moz-transition: .25s ease-in-out;
    -o-transition: .25s ease-in-out;
    transition: .25s ease-in-out;
}

#nav-icon1 span:nth-child(1) {
    top: 0px;
}

#nav-icon1 span:nth-child(2) {
    top: 18px;
}

#nav-icon1 span:nth-child(3) {
    top: 36px;
}

#nav-icon1.open span:nth-child(1) {
    top: 18px;
    -webkit-transform: rotate(135deg);
    -moz-transform: rotate(135deg);
    -o-transform: rotate(135deg);
    transform: rotate(135deg);
}

#nav-icon1.open span:nth-child(2) {
    opacity: 0;
    left: -60px;
}

#nav-icon1.open span:nth-child(3) {
    top: 18px;
    -webkit-transform: rotate(-135deg);
    -moz-transform: rotate(-135deg);
    -o-transform: rotate(-135deg);
    transform: rotate(-135deg);
}
</style>
