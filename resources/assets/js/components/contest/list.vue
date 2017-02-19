<template>
    <div class="container-fluid">
        <div class="row">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                CONTEST TABLES
                                <small>Basic example without any additional modification classes</small>
                            </h2>
                        </div>
                        <div class="body table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>TITLE</th>
                                        <th>STATUS</th>
                                        <th>START TIME</th>
                                        <th>END TIME</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="contest in contests">
                                        <th scope="row">{{ contest.id }}</th>
                                        <td><router-link :to="{ path: 'detail/' + contest.id }">{{ contest.title }}</router-link></td>
                                        <td>
                                            <span v-if='Date.parse(new Date())/1000<contest.start_time'>Pending</span>
                                            <span v-else-if='Date.parse(new Date())/1000>contest.end_time'>Ended</span>
                                            <span v-else>Running</span>
                                        </td>
                                        <td>{{ contest.start_time | time }}</td>
                                        <td>{{ contest.end_time | time}}</td>
                                    </tr>
                                </tbody>
                            </table>
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
            contests:[]
        };
    },
    mounted:function(){
        this.__construct();
    },
    methods:
    {
        __construct:function()
        {
            var _this = this;
            axios.get('/i/contest/list').then(function(res){
                _this.contests = res.data;
            });
        }
    }
}
</script>
