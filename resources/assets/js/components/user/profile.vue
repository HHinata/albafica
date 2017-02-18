<template>
<div class="container">
    <div class="row">
        <div class="row clearfix">
            <input id="J_file" type="file" @change='upload'>
        </div>
    </div>
</div>
</template>

<script>
import axios from 'axios'
import Uploader from 'qiniu-web-uploader'

export default {
    data: function () {
        return {
            accounts: [],
            file: {}
        };
    },
    mounted:function () {
        this.__construct();
    },
    methods:
    {
        __construct: function () {
            var _this = this;
            axios.get('/user').then(function(res){
                _this.accounts = res.data;
            });
        },
        upload: function(event) {
            axios.get('/token').then(function(res){
                let uptoken = res.data;
                let file = event.target.files[0];
                let uploader = new Uploader(file, uptoken);
                uploader.on('progress', e => {
                    console.log(uploader.percent); //加载进度
                    console.log(uploader.offset); //字节
                });
                uploader.on('complete', e => {
                    console.log(uploader.imgRes); //文件
                });
                uploader.upload().then(imgRes => {
                    console.log(imgRes);
                });
            });
        }
    }
}
</script>
