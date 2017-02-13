<template>
    <div class="container">
        <div class="row">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <b>Description</b>
                                        <div class="form-line">
                                            <textarea rows="5" class="form-control no-resize" v-model='problem.description' placeholder="Please type what you want..."></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <b>Input</b>
                                        <div class="form-line">
                                            <textarea rows="2" class="form-control no-resize" v-model='problem.input' placeholder="Please type what you want..."></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <b>Output</b>
                                        <div class="form-line">
                                            <textarea rows="2" class="form-control no-resize" v-model='problem.output' placeholder="Please type what you want..."></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <b>Sample Input</b>
                                        <div class="form-line">
                                            <textarea rows="2" class="form-control no-resize" v-model='problem.sample_input' placeholder="Please type what you want..."></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <b>Sample Output</b>
                                        <div class="form-line">
                                            <textarea rows="2" class="form-control no-resize" v-model='problem.sample_output' placeholder="Please type what you want..."></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <router-link type="button" class="btn btn-primary btn-lg m-l-15 waves-effect" :to="{ path: 'submit?pid=' + id }">SUBMIT</router-link>
                                </div>
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
    data(){
        return {
            id:0,
            problem:{}
        };
    },
    mounted:function(){
        var q = this.$route.query;
        this.id = q.id?q.id:0;
        this.getProblem();
    },
    methods:
    {
        getProblem:function()
        {
            var _this = this;
            axios.get('/problem/'+this.id).then(function(res){
                _this.problem = res.data;
            });
        }
    }
}
</script>
