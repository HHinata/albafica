<template>
    <el-form label-position="right" label-width="80px">
        <el-row :gutter="20">
            <el-col :span="20">
                <el-form-item label="团队名称">
                    <el-input v-model="team.name"></el-input>
                </el-form-item>
                <el-form-item label="团队描述">
                    <el-input v-model="team.desc"></el-input>
                </el-form-item>
            </el-col>
            <el-col :span="4" style="text-align: center">
                <img :src="team.avatar" @click="upclick" width="100px" style="border-radius: 50%"/>
                <input type="file" @change='upload' style='display: none !important;'>
            </el-col>
            <el-col :span="24">
                <el-button type="primary" @click="submit">添加团队</el-button>
            </el-col>
        </el-row>
    </el-form>
</template>

<script>
    import Uploader from 'qiniu-web-uploader'
    export default {
        data () {
            return {
                team: {
                    name: '',
                    desc: '',
                    avatar: 'http://okeyqynvd.bkt.clouddn.com/avatar-1487383952.png'
                }
            }
        },
        methods: {
            submit: function () {
                var _this = this;
                axios.put("team", _this.team)
                    .then(function (res) {
                        _this.$message({
                            message: '恭喜你，团队添加成功',
                            type: 'success'
                        });
                    });
            },
            upclick: function (event) {
                this.$el.querySelector('input[type=file]').click();
            },
            upload: function(event) {
                var _this = this;
                axios.get('/token').then(function(res){
                    let uptoken = res.data;
                    let file = event.target.files[0];
                    let uploader = new Uploader(file, uptoken);
                    uploader.on('progress', e => {
                        console.log(uploader.percent); //加载进度
                    console.log(uploader.offset); //字节
                });
                    uploader.on('complete', e => {
                        _this.team.avatar = 'http://'+uptoken.domain+'/'+uploader.imgRes.key;
                });
                    uploader.upload().then(imgRes => {
                        console.log(imgRes);
                });
                });
            },
        }
    }
</script>
