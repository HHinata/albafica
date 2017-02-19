<template>
    <div class="container-fluid">
        <div class="row">
            <div class="row clearfix">
                <div v-show="hint" class="alert alert-dismissible" :class="hint.state" role="alert" >
                    <button type="button" class="close" @click="hint=false"><span aria-hidden="true">&times;</span></button>
                    {{ hint.msg }}
                </div>
                <div class="card">
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-sm-12">

                                <div class="form-group">
                                    <b>Title</b>
                                    <div class="form-line">
                                        <input type="text"  v-model='problem.title' class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <b>Description</b>
                                    <div class="form-line">
                                        <textarea rows="5" class="form-control no-resize" v-model='problem.description' placeholder="Please type what you want..."></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <b>Input</b>
                                    <div class="form-line">
                                        <textarea rows="2" class="form-control no-resize" v-model='problem.input' placeholder="Please type what you want..."></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <b>Output</b>
                                    <div class="form-line">
                                        <textarea rows="2" class="form-control no-resize" v-model='problem.output' placeholder="Please type what you want..."></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <b>Sample Input</b>
                                    <div class="form-line">
                                        <textarea rows="2" class="form-control no-resize" v-model='problem.sample_input' placeholder="Please type what you want..."></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <b>Sample Output</b>
                                    <div class="form-line">
                                        <textarea rows="2" class="form-control no-resize" v-model='problem.sample_output' placeholder="Please type what you want..."></textarea>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary btn-lg m-l-15 waves-effect" v-on:click="submit">submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    data: function () {
        return {
            id: 0,
            problem: {},
            hint: false
        };
    },
    mounted:function(){
        var q = this.$route.query;
        this.id = q.id?q.id:0;
        this.__construct();
    },
    methods:
    {
        __construct:function()
        {
            var _this = this;
            axios.get('/problem/'+this.id).then(function(res){
                _this.problem = res.data;
            });
        },
        submit: function(){
            var _this = this;
            var url = '/problem' + (_this.id?'/'+_this.id:'')

            axios.put(url, this.contest)
            .then (function (res) {
                _this.hint = {state: "alert-success", msg: "数据添加成功"}
            }).catch(function (error) {
                _this.hint = {state: "alert-danger", msg: "数据添加失败,请检查数据合法性"}
            });
        }
    }
}
</script>
