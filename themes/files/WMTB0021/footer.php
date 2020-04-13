<?php #wp_footer(); ?>

<!-- footer -->

<script src="<?php echo get_template_directory_uri()?>/assets/plugins/jQuery/jquery.min.js"></script>
<!-- Bootstrap JS -->
<script src="<?php echo get_template_directory_uri()?>/assets/plugins/bootstrap/bootstrap.min.js"></script>
<!-- slick slider -->
<script src="<?php echo get_template_directory_uri()?>/assets/plugins/slick/slick.min.js"></script>
<!-- aos -->
<script src="<?php echo get_template_directory_uri()?>/assets/plugins/aos/aos.js"></script>
<!-- venobox popup -->
<script src="<?php echo get_template_directory_uri()?>/assets/plugins/venobox/venobox.min.js"></script>
<!-- filter -->
<script src="<?php echo get_template_directory_uri()?>/assets/plugins/filterizr/jquery.filterizr.min.js"></script>

<!-- Main Script -->
<script src="<?php echo get_template_directory_uri()?>/assets/js/script.js"></script>
<script>
    $('#customer_submit_button').on('click', function() {

        $("#customer_submit_button").text("Sending...");
        var aop_param = {};
        aop_param.post_name = $("#product_title").val();
        aop_param.name = $("#name").val();
        aop_param.email = $("#email").val();
        aop_param.phone = $("#phone").val();
        aop_param.message = $("#message").val();
        if(location.href.indexOf('?')>-1){
            aop_param.reference = location.href.split('?')[0];
        }else{
            aop_param.reference = location.href;
        }
        $.ajax({
            url:"/wp-json/portal/v1/inquiry",
            type:'POST',
            data: aop_param,
            success : function(res){
                if(res.code == 0) {
                    alert(res.msg);
                    $("#customer_submit_button").text("SEND MESSAGE");
                    return ;
                }
                alert(res.msg);
                $("#name").val('');
                $("#email").val('');
                $("#phone").val('');
                $("#message").val('');
                $("#customer_submit_button").text("SEND MESSAGE");
                // location.reload();
            },
            error: function(res, textStatus, errorThrown){
                $("#name").val('');
                $("#email").val('');
                $("#phone").val('');
                $("#message").val('');
                $("#customer_submit_button").text("SEND MESSAGE");
                alert('连接失败，请检查是否存在特殊代理');
            }
        });
        return false;
    });
    $('#link-item>div').click(() => {
        $('#link-item ul li').toggle('500');
    })
</script>

