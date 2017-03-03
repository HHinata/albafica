<template>
<div>
    <el-menu theme="dark" class="el-menu-demo" mode="horizontal" :router="true">
        <el-row>
            <el-col :span="12" :offset="4">
                <el-menu-item index="/">Index</el-menu-item>
                <el-menu-item index="/problem">Problem</el-menu-item>
                <el-menu-item index="/contest">Contest</el-menu-item>
                <el-menu-item index="/status">Status</el-menu-item>
                <el-menu-item index="/rank">Rank</el-menu-item>
                <el-menu-item index="/faq">F.A.Q</el-menu-item>
            </el-col>
            <el-col v-if="info.name" :span="4">
                <el-submenu index="2">
                    <template slot="title">{{ info.name }}</template>
                    <el-menu-item index="/profile">Profile</el-menu-item>
                    <el-menu-item index="/" @click='logout'>Logout</el-menu-item>
                </el-submenu>
            </el-col>
            <el-col v-else :span="4">
                <el-menu-item index="/login">Login</el-menu-item>
                <el-menu-item index="/register">Register</el-menu-item>
            </el-col>

        </el-row>
    </el-menu>
    <el-row>
        <el-col :span="16" :offset="4" style='margin-top: 50px; min-height: 700px'>
            <router-view v-on:login='login'></router-view>
        </el-col>
    </el-row>
    <footer>
        <el-row type='flex' align='middle' style="min-height:100px; vertical-align:middle">
            <el-col :span="8" :offset="4" style="">
                <a href="/#/">
                    <img src="http://okeyqynvd.bkt.clouddn.com/footer-logo.png"/>
                </a>
            </el-col>
            <el-col :span="4" style="">
                <dl>
                    <li><a href="/#/">Home</a></li>
                    <li><a href="/#/problem">ProblemSet</a></li>
                    <li><a href="/#/contest">Contest</a></li>
                    <li><a href="/#/rank">Rank</a></li>
                </dl>
            </el-col>
            <el-col :span="4" style="">
                <dl>
                    <li><a href="http://skyfire-lee.github.io/">Blog</a></li>
                </dl>
            </el-col>
        </el-row>
    </footer>
</div>
</template>

<script>
    export default {
        data: function () {
            return {
                info: {}
            };
        },
        mounted() {
            var _this = this;
            axios.get('info')
            .then(function(res) {
                _this.info = res.data;
            })
            .catch(function (error) {
            });
        },
        methods: {
            'login': function(msg) {
                if( msg ) {
                    var _this = this;
                    axios.get('info')
                    .then(function(res) {
                        _this.info = res.data;
                    })
                    .catch(function (error) {
                    });
                }
            },
            'logout': function() {
                var _this = this;
                axios.post('/logout')
                .then(function(res) {
                    _this.info = {};
                    _this.$message({
                        message: '账号退出成功',
                        type: 'success'
                    });
                })
                .catch(function (error) {
                });
            }
        }
    }
</script>

<style>
footer{
    background:#324157;
    color:#bfcbd9;
    margin-top:50px
}

footer .el-col{
    margin-top: 50px;
    margin-bottom: 20px;
    min-height: 100px;
}

li a{
    color: #d4d4d4;
    text-decoration: none;
}

li a:hover{
    text-decoration: none;
}
</style>
