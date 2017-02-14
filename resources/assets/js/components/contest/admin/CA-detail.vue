<template>
    <div class="container">
        <div class="row">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                {{ contest.title }}
                            </h2>
                        </div>

                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <b>Title</b>
                                        <div class="form-line">
                                            <input type="text"  v-model='contest.title' class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <b>Description</b>
                                        <div class="form-line">
                                            <textarea rows="5" class="form-control no-resize" v-model='contest.description' placeholder="Please type what you want..."></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <b>Start Time</b>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">date_range</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control datetime" id='start-time' placeholder="Ex: 30/07/2016 23:59">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <b>End Time</b>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">date_range</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control datetime" id='end-time'  placeholder="Ex: 30/07/2016 23:59">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <b>Problem List</b>
                                    <div class="form-group demo-tagsinput-area">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id='problem-list' data-role="tagsinput">
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
            id:0,
            contest:{}
        };
    },
    mounted:function(){
        var query = this.$route.query;
        if(query.id)    this.id = query.id;
        this.getContest();
    },
    methods:
    {
        getContest:function()
        {
            var _this = this;
            axios.get('/contest/'+this.id).then(function(res){
                _this.contest = res.data;
                $('#start-time').val(_this.contest.start_time);
                $('#end-time').val(_this.contest.end_time);
                $('#problem-list').val(_this.contest.problem_list);
            });
        },
        submit:function()
        {
            this.contest.start_time = $('#start-time').val();
            this.contest.end_time = $('#end-time').val();
            this.contest.problem_list = $('#problem-list').val();
            var _this = this;
            axios.put('/contest/'+this.id, this.contest).then(function(res){
                console.log(res.data);
            });
        }
    }
}
</script>
