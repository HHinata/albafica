<template>
    <div class="container">
        <div class="row">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                ACCOUNT TABLES
                                <small>Basic example without any additional modification classes</small>
                            </h2>
                        </div>
                        <div class="body table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>PLATFORM</th>
                                        <th>SIGN</th>
                                        <th>TITLE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="problem in problems">
                                        <th scope="row">{{ problem.id }}</th>
                                        <td>{{ problem.platform }}</td>
                                        <td>{{ problem.sign }}</td>
                                        <td><router-link :to="{ path: 'detail', query:{id:problem.id}}">
                                        {{ problem.title }}
                                        </router-link></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="body table-responsive">
                            <div class="col-sm-12">
                                <router-link type="button" class="btn btn-primary btn-lg m-l-15 waves-effect"
                                :to="{ path: 'grab'}">
                                Grab</router-link>
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
            problems:[]
        };
    },
    mounted:function(){
        this.getProblems();
    },
    methods:
    {
        getProblems:function()
        {
            var _this = this;
            axios.get('/problem').then(function(res){
                _this.problems = res.data;
            });
        }
    }
}
</script>
