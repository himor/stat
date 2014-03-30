/**
 * Created by himor on 3/29/14.
 */

$(function(){

    $('.unhide').on('click', function(){
        var $this = $(this),
            $id   = $this.attr('id');
        $this.remove();
        $('#token_' + $id).show();
    });

});