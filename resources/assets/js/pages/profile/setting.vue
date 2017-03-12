<template>
    <div>
        <el-form label-position="right" label-width="80px">
            <el-row>
                <el-col :span="20">
                    <el-form-item label="用户名">
                        <el-input v-model="info.name" :disabled="true"></el-input>
                    </el-form-item>
                    <el-form-item label="邮箱">
                        <el-input v-model="info.email"></el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="4" style="text-align: center">
                    <img :src="info.avatar" @click="upclick" width="100px" style="border-radius: 50%"/>
                    <input type="file" @change='upload' style='display: none !important;'>
                </el-col>
            </el-row>

            <el-form-item label="我的签名">
                <el-input v-model="info.info"
                          type="textarea"
                          :rows="2"
                          placeholder="请输入内容"></el-input>
            </el-form-item>
            <el-form-item label="性别">
                <el-radio-group v-model="info.sex">
                    <el-radio :label="0">男生</el-radio>
                    <el-radio :label="1">女生</el-radio>
                </el-radio-group>
            </el-form-item>
            <el-form-item label="出生日期">
                <el-date-picker
                        v-model="info.birthday"
                        type="date"
                        placeholder="选择日期">
                </el-date-picker>
            </el-form-item>
            <el-form-item label="所在地">
                <el-input v-model="info.city"></el-input>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="submitForm">立即创建</el-button>
            </el-form-item>
        </el-form>
    </div>
</template>

<script>
    import Uploader from 'qiniu-web-uploader'
    export default {
        data: function () {
            return {
                info: {
                    name: '',
                    email: '',
                    info: '',
                    sex: '',
                    birthday: '',
                    city: '',
                    avatar: ''
                }
            };
        },
        mounted: function () {
            var _this = this;
            axios.get('info')
                .then(function (res) {
                    _this.info = res.data;
                    _this.info.birthday = new Date(parseInt(_this.info.birthday) * 1000);
                });
        },
        methods: {
            submitForm: function () {
                var _this = this;
                axios.post("user", _this.info)
                    .then(function (res) {
                        _this.$message({
                            message: '恭喜你，信息更新成功',
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
                    _this.info.avatar = 'http://'+uptoken.domain+'/'+uploader.imgRes.key;
                });
                    uploader.upload().then(imgRes => {
                        console.log(imgRes);
                });
                });
            },
        }
    }
</script>

