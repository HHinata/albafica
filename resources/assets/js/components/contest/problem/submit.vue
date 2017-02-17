<template>
<div class="body table-responsive">
    <div v-show="hint" class="alert alert-dismissible" :class="hint.state" role="alert" >
        <button type="button" class="close" @click="hint=false"><span aria-hidden="true">&times;</span></button>
        {{ hint.msg }}
    </div>
    <div class="row clearfix">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <div class="form-line">
                    <input type="text"  v-model='solution.pid' class="form-control">
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <div class="form-line">
                    <input type="text"  v-model='solution.lang' class="form-control">
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <div class="form-line">
                    <textarea rows="20" class="form-control no-resize" v-model='solution.code' placeholder="Please type what you want..."></textarea>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <button type="button" class="btn btn-primary btn-lg m-l-15 waves-effect" v-on:click="submit">submit</button>
        </div>
    </div>
    </div>
</div>
</template>

<script>
import axios from 'axios'
export default {
    data: function(){
        return {
            solution:{
                pid:1,
                lang:'g++',
                code:'',
                cid:0
            },
            hint: false
        };
    },
    mounted:function()
    {
        var q = this.$route.query;
        this.solution.pid = (q.pid)?q.pid:0;
        this.solution.cid = (q.cid)?q.cid:1;
    },
    methods:
    {
        submit:function()
        {
            var _this = this;
            axios.post('/i/contest/submit', this.solution).then(function(res){
                location.href = "#/contest/status/list?id="+_this.cid;
            }).catch(function (error) {
                _this.hint = {state: "alert-danger", msg: "数据添加失败,请检查数据合法性"}
            });
        }
    }
}
</script>
