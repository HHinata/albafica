<template>
    <el-row>
        <el-col :span="3" v-for="item in team.data">
            <el-card :body-style="{ padding: '0px' }">
                <img src="http://element.eleme.io/static/hamburger.50e4091.png" class="image">
                <div style="padding: 14px;">
                    <span>{{item.name}}</span>
                    <div class="clearfix">
                        <time class="time">{{item.desc}}</time>
                    </div>
                </div>
            </el-card>
        </el-col>
        <el-col :span="24">
        <el-pagination layout="prev, pager, next"  @current-change="handleCurrentChange" :total="team.total" :page-size="team.per_page">
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
            this.updateTeam(1);
        },
        methods: {
            handleCurrentChange: function (val) {
                this.updateTeam(val);
            },
            updateTeam: function (val) {
                var _this = this;
                axios.get('team', { params: { page: val }})
                    .then(function(res) {
                        _this.team = res.data;
                    });
            },
            handleClick: function (index, rows) {
                window.location.hash = '/team/'+rows[index].id;

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