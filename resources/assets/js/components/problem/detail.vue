<template>
    <div class="container">
        <div class="row">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                {{ problem.title }}
                            </h2>
                        </div>
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
                                    <router-link type="button" class="btn btn-primary btn-lg m-l-15 waves-effect" :to="{ path: 'submit?pid=' + id }">SUBMIT</router-link>
                                </div>
                                <button @click='hello'>Hello</button>
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
        var query = this.$route.query;
        this.id = query.id;
        this.__construct();
    },
    methods:
    {
        __construct:function()
        {
            var _this = this;
            axios.get('/i/problem/detail/'+this.id).then(function(res){
                _this.problem = res.data;
            });
        }
    }
}
</script>
