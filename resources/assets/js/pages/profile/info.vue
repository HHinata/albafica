<template>
    <div>
        <el-row :gutter="20">
            <el-col :span="3">
                <img :src="info.avatar" width="100%" style="border-radius: 50%"/>
            </el-col>
            <el-col :span="21">
                <h1>{{info.name}}</h1><small>{{info.info}}</small>
            </el-col>
        </el-row>
        <hr>
        <el-row :gutter="20">
            <el-col :span="8" class="info"><h3>Accepted</h3><small>{{info.solved}}</small></el-col>
            <el-col :span="8" class="info"><h3>Submited</h3><small>{{info.solved}}</small></el-col>
            <el-col :span="8" class="info"><h3>Posted</h3><small>{{info.solved}}</small></el-col>
        </el-row>
    </div>
</template>
<script>
    export default {
        data: function () {
            return {
                info:{}
            };
        },
        mounted: function () {
            var _this = this;
            axios.get('user/info')
                .then(function (res) {
                    _this.info = res.data;
                    console.log(res.data);
                });
        }
    }
</script>

<style>
    .info{
        text-align: center;
        line-height: 20px;
        vertical-align: middle;
    }
</style>