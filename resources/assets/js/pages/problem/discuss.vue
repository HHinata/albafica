<template>
<div>
    <comments ctype="App\Models\Problem" :cid="this.pid" :open="true" :single="true"></comments>
</div>
</template>

<script>
    import comments from '../../components/comments.vue'
    export default {
        components:{comments},
        data: function () {
            return {
                comment: ""
            };
        },
        props: ['pid'],
    }
</script>
