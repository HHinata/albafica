<template>
    <div>
        <el-row :gutter="20">
            <el-col :span="24">
                <h3>Title</h3>
                <p>{{team.name}}</p>
            </el-col>
            <el-col :span="24">
                <h3>Desc</h3>
                <p>{{team.desc}}</p>
            </el-col>
            <el-col>
                <button @click="apply">Apply</button>
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
