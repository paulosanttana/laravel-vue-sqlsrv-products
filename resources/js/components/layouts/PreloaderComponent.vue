<template>
    <div class="preloader" v-show="preloader">
        <img src="/image/loading5.gif" alt="Preloader...">
    </div>
</template>

<script>
export default {
    computed: {
        preloader () {
            return this.$store.state.preloader.loading
        }
    }
}
</script>

<style scoped>
.preloader{
    background: #000;
    position: absolute;
    z-index: 9999;
    opacity: .2;
    width: 100%;
    height: 100%;
    margin: 0;
    text-align: center;
    padding: 5% 0;
}
.preloader img{
    max-width: 230px;
}
</style>