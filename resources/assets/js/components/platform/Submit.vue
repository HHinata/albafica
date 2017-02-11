<template>
    <div class="container">
        <div class="row">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>CODE</h2>
                        </div>
                        <div class="body">
                            <h2 class="card-inside-title">Basic Example</h2>
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
            solution:{
                pid:1,
                lang:'g++',
                code:'',
                cid:0
            }
        };
    },
    mounted:function()
    {
        var query = this.$route.query;
        this.solution.pid = (query.pid==undefined)?1:query.pidv;
        this.solution.cid = (query.cid==undefined)?0:query.cid;
    },
    methods:
    {
        submit:function()
        {
            var _this = this;
            axios.post('/plat/submit', this.solution).then(function(res){
                console.log(res);
            });
        }
    }
}
</script>
