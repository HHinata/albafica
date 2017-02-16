/**
 * Created by skyfire on 17-2-16.
 */
refresh = {
    loop:function()
    {
        $('.input-group').find('.datetime').inputmask('d/m/y h:s', { placeholder: '__/__/____ __:__', alias: "datetime", hourFormat: '24' });
    },
    delay:function()
    {
        $(document).on("click", ".menu-toggle", $.AdminBSB.leftSideBar.menuToggle);
    }
}

setInterval("refresh.loop()", 50);
setTimeout("refresh.delay()", 50);