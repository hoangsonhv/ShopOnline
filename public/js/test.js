$(function(){
    $(".form-group a").click(function(){
        let $this = $(this);

        if($this.hasClass('active')){
            $this.parents('.form-group').find('input').attr('type','password')_
            $this.removeClass('active');
        }else{
            $this.parents('.form-group').find('input').attr('type','text')_
            $this.addClass('active')
        }
    });
});
