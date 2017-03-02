<template>
    <el-row :gutter="20" class="tac">
        <el-col :span="3">
            <img :src="info.avatar" width="100%" style="border-radius: 50%"/>
        </el-col>
        <el-col :span="21">
            <h1>{{info.name}}</h1><small>{{info.desc}}</small>
        </el-col>
    </el-row>
</template>
<script>
    export default {
        data: function () {
            return {
                info:{}
            };
        },
        mounted: function () {
            this.__construct();
        },
        methods: {
            __construct: function() {
                var _this = this;
                axios.get('info')
                    .then(function (res) {
                        _this.info = res.data;
                        console.log(res.data);
                    });
            }
        }
    }
</script>