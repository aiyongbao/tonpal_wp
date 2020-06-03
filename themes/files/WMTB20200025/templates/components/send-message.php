<?php
global $wp; // Class_Reference/WP 类实例

$theme_vars = json_config_array('header', 'vars', 1);
$data = get_post();
$type_title = $data->post_name;

$message_title = ifEmptyText($theme_vars['sendMessageTitle']['value']);
$message_btn = ifEmptyText($theme_vars['sendMessageBtn']['value']);
$placeholder_name = ifEmptyText($theme_vars['sendMessagePlaName']['value']);
$placeholder_email = ifEmptyText($theme_vars['sendMessagePlaEmail']['value']);
$placeholder_phone = ifEmptyText($theme_vars['sendMessagePlaPhone']['value']);
$placeholder_content = ifEmptyText($theme_vars['sendMessagePlaContent']['value']);

$contacts_desc = ifEmptyText(get_query_var('contactsDesc'));
?>

<div class="send-message">
    <div class="send-message-header">
        <div class="send-message-header-title"><?php echo  $message_title ?></div>
    </div>
    <div class="blog-grid  col-2 gutter-lg">
        <div class="send-message-content">
            <div class="send-message-content-div">
                <input type="text" class="form-control" name="name" id="name" placeholder="*<?php echo ucfirst($placeholder_name) ?>">
            </div>
            <div class="send-message-content-div">
                <input type="email input-email" id="email" class="form-control" name="email" placeholder="*<?php echo ucfirst($placeholder_email) ?>">
            </div>
            <div class="send-message-content-div">
                <input type="tel" class="form-control" id="phone" name='phone' placeholder="*<?php echo ucfirst($placeholder_phone) ?>">
            </div>
        </div>
        <div class="row">
            <div class="send-message-content-div" style="height: 100px;width: 100%;">
                <textarea class="form-control send-message-textarea" rows="3" id="message" placeholder="*<?php echo ucfirst($placeholder_content) ?>" id="message"></textarea>
            </div>
        </div>
        <input type="hidden" id="organization_id" value="{{ organization_id }}">
        <!-- {% if product_title is not defined %}
        {% set product_title = '' %}
        {% endif %} -->
        <input type="hidden" id="product_title" value="{{ product_title }}">
        <div class="form-group text-left bt-certificate">
            <button class="btn btn-lg btn-dark bt-width send-message-btn" id="customer_submit_button"><?php echo  $message_btn ?></button>
        </div>
    </div>

</div>