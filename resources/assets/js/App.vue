<template>
<div>
    <el-menu theme="dark" class="el-menu-demo" mode="horizontal" :router="true">
        <el-row>
            <el-col :span="12" :offset="4">
                <el-menu-item index="">Index</el-menu-item>
                <el-menu-item index="problem">Problem</el-menu-item>
                <el-menu-item index="contest">Contest</el-menu-item>
                <el-menu-item index="rank">Rank</el-menu-item>
                <el-menu-item index="faq">F.A.Q</el-menu-item>
            </el-col>
            <el-col :span="4">
                <el-menu-item index="login">Login</el-menu-item>
                <el-menu-item index="register">Register</el-menu-item>
            </el-col>
        </el-row>
    </el-menu>
    <el-row>
        <el-col :span="16" :offset="4">
            <router-view></router-view>
        </el-col>
    </el-row>
</div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
