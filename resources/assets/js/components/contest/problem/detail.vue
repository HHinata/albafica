<template>
    <div class="container">
        <div class="row">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <header-part :cid='id'></header-part>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-md-12">
                                    <p class="align-left">
                                        <b>Description</b>
                                    </p>
                                    <div class="align-left" v-html="problem.description">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-md-6">
                                    <p class="align-left">
                                        <b>Input</b>
                                    </p>
                                    <div class="align-left" v-html="problem.input">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <p class="align-left">
                                        <b>OutPut</b>
                                    </p>
                                    <div class="align-left" v-html="problem.output">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-md-6">
                                    <p class="align-left">
                                        <b>Sample Input</b>
                                    </p>
                                    <div class="align-left" v-html="problem.sample_input">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <p class="align-left">
                                        <b>Sample OutPut</b>
                                    </p>
                                    <div class="align-left" v-html="problem.sample_output">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <router-link type="button" class="btn btn-primary btn-lg m-l-15 waves-effect" :to="{ path: 'submit', query:{cid:id,pid:pid} }">SUBMIT</router-link>
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
import headerPart from '../part/header'
export default {
    data(){
        return {
            id:1,
            pid:0,
            problem:{},
            contest:{}
        };
    },
    components:{headerPart},
    mounted:function(){
        var q = this.$route.query;
        this.id = q.id?q.id:1;
        this.pid = q.pid?q.pid:0;
        this.__construct();
    },
    methods:
    {
        __construct:function()
        {
            var _this = this;
            axios.get('/i/contest/problem/'+this.id+'/'+this.pid).then(function(res){
                _this.problem = res.data;
            });
        }
    }
}
</script>
