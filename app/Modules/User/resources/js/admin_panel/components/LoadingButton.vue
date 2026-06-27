<template>
    <span>
        <i class="fa fa-spinner fa-pulse fa-1x fa-fw" v-if="loadingDisplay"></i>
    </span>
</template>

<script>
    export default {
        props: {
            loadingDisplay: false
        }
    }
</script>
