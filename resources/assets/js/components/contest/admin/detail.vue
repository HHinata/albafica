<template>
    <div class="container">
        <div class="row">

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <div v-show="hint" class="alert alert-dismissible" :class="hint.state" role="alert" >
                        <button type="button" class="close" @click="hint=false"><span aria-hidden="true">&times;</span></button>
                        {{ hint.msg }}
                    </div>
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
                                <div class="col-md-3">
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
                                <div class="col-md-3">
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
                                <div class="col-md-3">
                                    <b>Search Problem</b>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" v-model='search_id' placeholder="Problem ID">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-primary btn-lg m-l-15 waves-effect" @click='add'>Add</button>
                                </div>
                                <div class="col-sm-12">
                                    <b>Problem List</b>
                                    <table class="table table-condensed table-bordered">
                                        <tbody>
                                            <tr v-for="(value, key) in contest.problemset">
                                                <th scope="row">{{ value.id }}</th>
                                                <td>{{ value.platform }}</td>
                                                <td>{{ value.sign }}</td>
                                                <td><span class="glyphicon glyphicon-minus" @click="remove(key)"></span></td>
                                            </tr>
                                        </tbody>
                                    </table>
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
    data: function(){
        return {
            id: 0,
            contest: {},
            search_id: '',
            hint: false
        };
    },
    mounted:function(){
        var q = this.$route.query;
        if(q.id)    this.id = q.id;
        this.__construct();
    },
    methods:
    {
        __construct:function () {
            var _this = this;
            if(_this.id == 0)   return;
            axios.get('/contest/'+this.id).then(function(res){
                _this.contest = res.data;
                $('#start-time').val(_this.contest.start_time);
                $('#end-time').val(_this.contest.end_time);
            });
        },
        submit: function () {
            this.contest.start_time = $('#start-time').val();
            this.contest.end_time = $('#end-time').val();

            var _this = this;
            var url = '/contest' + (_this.id?'/'+_this.id:'')

            axios.put(url, this.contest)
            .then (function (res) {
                _this.hint = {state: "alert-success", msg: "数据添加成功"}
            }).catch(function (error) {
                _this.hint = {state: "alert-danger", msg: "数据添加失败,请检查数据合法性"}
            });
        },
        add: function () {
            var _this = this;
            axios.get('/problem/'+this.search_id).then(function(res){
                if(res.data.id == _this.search_id) {
                  _this.contest.problemset.push(res.data);
                }
            });
        },
        remove: function (index) {
            this.contest.problemset.splice(index, 1);
        }
    }
}
</script>
