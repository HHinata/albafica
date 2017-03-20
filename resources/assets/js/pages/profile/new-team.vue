<template>
    <div>
        <el-row :gutter="20">
            <el-col :span="24">
                <h1>New Team</h1>
            </el-col>
            <el-col :span="24">
                <h3>Name</h3>
                <el-input v-model="team.name" placeholder="请输入内容"></el-input>
            </el-col>
            <el-col :span="24">
                <h3>Desc</h3>
                <el-input v-model="team.desc" placeholder="请输入内容"></el-input>
            </el-col>
            <el-col :span="24">
                <el-button type="primary" @click="submit">添加团队</el-button>
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
        methods: {
            submit: function () {
                var _this = this;
                axios.put("team", _this.team)
                    .then(function (res) {
                        _this.$message({
                            message: '恭喜你，团队添加成功',
                            type: 'success'
                        });
                    });
            }
        }
    }
</script>
