<?php
global $wp; // Class_Reference/WP 类实例

$theme_vars = json_config_array('header','vars',1);
$data = get_post();
$type_title = $data->post_name;

$message_title = ifEmptyText($theme_vars['sendMessageTitle']['value']);
$message_btn = ifEmptyText($theme_vars['sendMessageBtn']['value']);
$placeholder_name = ifEmptyText($theme_vars['sendMessagePlaName']['value']);
$placeholder_email = ifEmptyText($theme_vars['sendMessagePlaEmail']['value']);
$placeholder_phone = ifEmptyText($theme_vars['sendMessagePlaPhone']['value']);
$placeholder_content = ifEmptyText($theme_vars['sendMessagePlaContent']['value']);
?>

<section class="inquiry-form-wrap ct-inquiry-form mt50" id="myform">
    <h4 class="inquiry-form-title" style="text-transform:uppercase"><?php echo $message_title ?></h4>
    <form id="contact-form" role="form">
        <section class="inquiry-form">
            <div class="inquiry-form-ico">
                <img src="//q.zvk9.com/Model15/assets/images/inq03.png"
                     alt="Send Inquiry Now">
            </div>
            <ul>
                <li class="form-item">
                    <input id="name" type="text" name="name" class="form-input form-input-name"
                           placeholder="<?php echo $placeholder_name ?>">
                </li>
                <li class="form-item">
                    <input id="email" type="email" name="email" class="form-input form-input-email"
                           placeholder="<?php echo $placeholder_email ?>">
                </li>
                <li class="form-item">
                    <input id="phone" type="tel" name="phone" class="form-input form-input-phone"
                           placeholder="<?php echo $placeholder_phone ?>">
                </li>
                <li class="form-item">
                    <textarea id="message" name="message" class="form-text form-input-massage"
                              placeholder="<?php echo $placeholder_content ?>"></textarea>
                </li>
            </ul>
            <div class="form-btn-wrapx">

                <input type="hidden" name="product_title" value="<?php echo $type_title;?>">
                <div class="alert-success hidden" id="MessageSent">
                    We have received your message, we will contact you very soon.
                </div>
                <div class="alert-danger hidden" id="MessageNotSent">
                    Oops! Something went wrong please refresh the page and try again.
                </div>
                <input type="submit" id="customer_submit_button" value="<?php echo $message_btn;?>"
                       class="wpcf7-form-control wpcf7-submit form-btn-submitx"/>
            </div>
        </section>
    </form>
</section>