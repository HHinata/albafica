<template>
<div class="phone-viewport">


<md-button class="md-raised">Default</md-button>
<md-button class="md-raised md-primary">Primary</md-button>
<md-button class="md-raised md-accent">Accent</md-button>
<md-button class="md-raised md-warn">Warn</md-button>
<md-button class="md-raised md-primary" disabled>Disabled</md-button>
<md-button class="md-raised md-dense">Dense</md-button>
</div>
</template>

<script>
import axios from 'axios'
export default {
    data: function () {
        return {
            contests:[]
        };
    },
    mounted:function(){
        this.__construct();
    },
    methods:
    {
        __construct:function()
        {
            var _this = this;
            axios.get('/i/contest/list').then(function(res){
                _this.contests = res.data;
            });
        }
    }
}
</script>
