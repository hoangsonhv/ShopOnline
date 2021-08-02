function cartUpdate(event){
    event.preventDefault();
    let urlUpdateCart = $('.update_cart_url').data('url');
    let id = $(this).data('id');
//    alert(id);
    let quatity = $(this).parents('tr').find('input.quatity').val();
    $.ajax({
        type: GET,
        url: urlUpdateCart,
        data: {id: id,quatity: quatity},
        success: function(data){
            if(data.code === 200){
                $.('wrapper').html(data.shopping_cart);
                alert('Cập nhật thành công !');
            }
        },
        error: function(){
        }
    });
    $(function(){
            $(document).on('click','.cart_update',cartUpdate);
        })
}
