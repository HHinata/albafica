<template>
    <el-row :gutter="20">
        <el-col :span="3" v-for="item in team.data" style="margin-bottom: 20px">
            <el-card :body-style="{ padding: '0', height: '200px' }">
                <img :src="item.avatar" class="image" style="height: 100px">
                <div style="padding: 14px;">
                    <span>
                        <div @click="enter(item.id)">{{item.name}}</div>
                    </span>
                    <div class="clearfix">
                        <time class="time">{{item.desc}}</time>
                    </div>
                    <div @click="apply(item.id)">Apply</div>
                </div>
            </el-card>
        </el-col>
        <el-col :span="24" style="text-align: center">
        <el-pagination layout="prev, pager, next"  @current-change="pageSwitch" :total="team.total"
                       :page-size="team.per_page">
        </el-pagination>
        </el-col>
    </el-row>

</template>

<script>
    export default {
        data: function () {
            return {
                team: {
                    data: []
                }
            };
        },
        mounted() {
            this.update(1);
        },
        methods: {
            pageSwitch: function (val) {
                this.update(val);
            },
            update: function (val) {
                var _this = this;
                axios.get('team', { params: { page: val }})
                    .then(function(res) {
                        _this.team = res.data;
                    });
            },
            enter: function (id) {
                var _this = this;
                axios.get('/team/verify', { params: { id: id}})
                    .then(function (res) {
                        window.location.hash = '/team/'+id;
                    }).catch(function (error) {
                        _this.$message({
                            message: '你并不属于该团队',
                            type: 'error'
                        });
                    });
            },
            apply: function (id) {
                var _this = this;
                axios.post('/team/apply', {id: id})
                    .then(function (res) {
                        window.location.hash = '/team/'+id;
                    }).catch(function (error) {
                    _this.$message({
                        message: '你并不属于该团队',
                        type: 'error'
                    });
                });
            }
        }
    }
</script>
<style>
    .time {
        font-size: 13px;
        color: #999;
    }

    .bottom {
        margin-top: 13px;
        line-height: 12px;
    }

    .image {
        width: 100%;
        display: block;
    }

    .clearfix:before,
    .clearfix:after {
        display: table;
        content: "";
    }

    .clearfix:after {
        clear: both
    }
</style>