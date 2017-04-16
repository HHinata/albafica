<template>
    <div>
        <comments ctype="App\Models\Contest" :cid="this.cid" :open="true" :single="true"></comments>
    </div>
</template>

<script>
    import comments from '../../components/comments.vue'
    export default {
        components: { comments },
        data: function () {
            return {
                comment: "",
            };
        },
        props: ['cid']
    }
</script>
