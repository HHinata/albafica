<template>
<div class="progress">
    <div class="progress-bar" role="progressbar"
        aria-valuemin="0" aria-valuemax="100" v-bind:style="style">
        {{ now_time | time }}
    </div>
</div>
</template>

<script>
import axios from 'axios'
export default {
    data: function () {
        return {
            now_time:0,
            style: {
                width:0
            }
        };
    },
    props:['start_time', 'end_time'],
    mounted:function () {
        this.__construct();
    },
    methods: {
        __construct: function () {
            var _this = this;
            setInterval(function () {
                _this.now_time = Date.parse(new Date())/1000;
                _this.style.width = (_this.now_time-_this.start_time)/(_this.end_time-_this.start_time)*100+"%";
            },1000);
        }
    }
}
</script>
