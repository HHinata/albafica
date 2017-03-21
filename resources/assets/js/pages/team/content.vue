<template>
    <div>
        <el-row :gutter="20">
            <el-col :span="24">
                <el-col :span="3">
                    <img :src="team.avatar" width="100%" style="border-radius: 50%"/>
                </el-col>
                <el-col :span="21">
                    <h1>{{team.name}} </span></h1><small>{{team.desc}}</small>
                </el-col>
            </el-col>
            <el-col :span="24" style="margin-top: 50px">
                <el-tabs type="border-card">
                    <el-tab-pane label="动态">动态</el-tab-pane>
                    <el-tab-pane label="用户">排名</el-tab-pane>
                    <el-tab-pane label="排名">角色</el-tab-pane>
                </el-tabs>
            </el-col>
        </el-row>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                team: {
                    name: '',
                    desc: '',
                }
            }
        },
        mounted: function() {
            this.id = this.$route.params.id;
            var _this = this;
            axios.get("team/show", {params: {id: this.id}})
                .then(function (res) {
                    _this.team = res.data;
                });
        },
        methods: {
            apply: function () {
                axios.get("team/apply", {params: {id: this.id}})
                    .then(function (res) {
                        _this.team = res.data;
                    });
            }
        }
    }
</script>
