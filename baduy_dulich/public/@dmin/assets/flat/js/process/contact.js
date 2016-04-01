var classDisabled = 'disabled';
var classHidden = 'hidden';

$(document).ready(function(){
    $("._delete").click(function(){
        var $self = $(this);
        var id = $self.data('id');
        if(!id) return false;

        if(confirm('Bạn có chắc muốn xóa')){
            if($self.hasClass(classDisabled)) return false;
            $self.addClass(classDisabled);

            Helper.request({ url: 'contact/delete', type: 'POST', data: { id: id } }).done(function (response) {
                if(response.type){
                    $self.parents('._row').remove();
                }else{
                    alert(response.message);
                    $self.removeClass(classDisabled);
                }
            });
        }
    });
});

var Helper = {
    request: function(initData){
        return $.ajax({
            url: initData.url,
            type: initData.type == undefined ? 'GET' : initData.type,
            data: initData.data == undefined ? {} : initData.data
        });
    }
};