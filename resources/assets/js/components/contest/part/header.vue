<template>
<div>
<div class="header">
    <h2>
        Title:{{ contest.title }}
        <small>Description:{{ contest.description }} {{contest.start_time|time}}-{{contest.end_time|time}}</small>
    </h2>
</div>
<div class="body">
    <time-bar :start_time='contest.start_time'
              :end_time='contest.end_time'>
              </time-bar>
    <nav-btn-group :cid="cid"></nav-btn-group>
</div>
</div>
</template>

<script>
import axios from 'axios'
import navBtnGroup from './nav-btn-group'
import timeBar from './time-bar'
export default {
    data(){
        return {
            contest:{}
        };
    },
    props:['cid'],
    components:{navBtnGroup, timeBar},
    watch:{
        cid:function()
        {
            var _this = this;
            axios.get('/i/contest/detail/'+this.cid)
            .then(function(res){
                _this.contest = res.data;
            });
        }
    }
}
</script>
