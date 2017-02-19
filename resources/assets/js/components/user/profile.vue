<template>
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        General settings
                        <small>The default media displays a media object (images, video, audio) to the left or right of a content block.</small>
                    </h2>
                </div>
                <div class="body">
                    <div class="media">
                        <div class="media-left">
                            <a href="javascript:void(0);">
                                <input type="file" @change='upload' style='display: none !important;'>
                                <img class="media-object" @click='upclick' :src="user.avatar" width="64" height="64">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">{{user.name}}</h4>
                            {{user.desc}}
                        </div>
                    </div>
                    <label for="name">Name</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" class="form-control" v-model='user.name' placeholder="Enter your Name">
                        </div>
                    </div>
                    <label for="email_address">Email Address</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" class="form-control" v-model='user.email' placeholder="Enter your email address">
                        </div>
                    </div>
                    <label for="description">Description</label>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <textarea name="desc" cols="30" rows="5" class="form-control no-resize" v-model='user.desc' required="" aria-required="true"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn bg-blue waves-effect waves-light" @click='update'>UPDATE</button>
                    </div>
                </div>
            </div>
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
            src: 'http://placehold.it/64x64',
            user: {},
        };
    },
    mounted:function () {
        this.__construct();
    },
    methods:
    {
        __construct: function () {
            var _this = this;
            axios.get('/info').then(function(res){
                _this.user = res.data;
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
                    _this.user.avatar = 'http://'+uptoken.domain+'/'+uploader.imgRes.key;
                });
                uploader.upload().then(imgRes => {
                    console.log(imgRes);
                });
            });
        },
        update: function () {
            var _this = this;
            axios.put('/user/'+this.user.id, this.user)
            .then(function(res){
                console.log(res);
            });
        }
    }
}
</script>
