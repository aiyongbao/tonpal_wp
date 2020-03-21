<?php
global $wp;
$data = get_post();
$type_title = $data->post_name;
$page_url = home_url(add_query_arg(array(),$wp->request));
?>

<div class="send-mewssage">
    <input type="text" class="form-control mb-3" id="name" name="name" placeholder="Your Name">
    <input type="email" class="form-control mb-3" id="email" name="mail" placeholder="Your Email">
    <input type="text" class="form-control mb-3" id="phone" name="phone" placeholder="Your Phone">
    <textarea name="message" id="message" class="form-control mb-3" placeholder="Your Message"></textarea>
    <input type="hidden" id="reference" value="<?php echo $page_url;?>">

    <input type="hidden" id="product_title" value="<?php echo $type_title;?>">
    <button type="submit" value="send" class="btn btn-primary send-message-btn" id="customer_submit_button">SEND MESSAGE</button>
</div>