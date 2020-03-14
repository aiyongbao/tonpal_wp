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

        $("#customer_submit_button").attr("disabled","disabled");

        var aop_param = {};

        aop_param.product_title = $("#product_title").val();
        aop_param.contact_name = $("#name").val();
        aop_param.contact_email = $("#email").val();
        aop_param.contact_subject = $("#phone").val();
        aop_param.contact_comment = $("#message").val();
        aop_param.organization_id = $("#organization_id").val();
        if(location.href.indexOf('?')>-1){
            aop_param.reference = location.href.split('?')[0];
        }else{
            aop_param.reference = location.href;
        }
        $.ajax({
            url:"//tonpal.aiyongbao.com/action/savemessage",
            dataType: 'jsonp',
            type:'GET',
            data: aop_param,
            success : function(rsp){
                alert('Sent successfully');
                $("#customer_submit_button").removeAttr("disabled");
                location.reload();
            },
            error: function(rsp, textStatus, errorThrown){
                $("#customer_submit_button").removeAttr("disabled");
                alert('error');
            }
        });
        return false;
    });
</script>

