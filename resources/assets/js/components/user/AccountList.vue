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
                                        <th>NAME</th>
                                        <th>EAMIL</th>
                                        <th>CREATE TIME</th>
                                        <th>UPDATE TIME</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="account in accounts">
                                        <th scope="row">{{ account.id }}</th>
                                        <td>{{ account.name }}</td>
                                        <td>{{ account.email }}</td>
                                        <td>{{ account.created_at }}</td>
                                        <td>{{ account.updated_at }}</td>
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
    data(){
        return {
            accounts:[]
        };
    },
    mounted:function(){
        this.getAccounts();
    },
    methods:
    {
        getAccounts:function()
        {
            var _this = this;
            axios.get('/user').then(function(res){
                console.log(res);
                _this.accounts = res.data;
            });
        }
    }
}
</script>
