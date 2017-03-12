<template>
    <el-row :gutter="20" class="tac">
        <el-col :span="4">
            <el-menu mode="vertical" default-active="1" class="el-menu-vertical-demo" :router="true">
                <el-menu-item-group v-for="(menu, name) in menus" :title="name">
                    <el-menu-item v-for="(v, k) in menu" :index="v.href"><i :class="v.icon"></i>{{ v.name }}</el-menu-item>
                </el-menu-item-group>
            </el-menu>
        </el-col>
        <el-col :span="20">
            <router-view></router-view>
        </el-col>
    </el-row>
</template>
<script>
    export default {
        data: function () {
            return {
                menus:[]
            };
        },
        mounted: function () {
            var _this = this;
            axios.get('menu')
                .then(function (res) {
                    _this.menus = res.data;
                });
        }
    }
</script>