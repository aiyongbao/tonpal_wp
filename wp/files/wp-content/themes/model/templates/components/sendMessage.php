<?php
$data = get_post();
$type_title = $data->post_name;
?>

<div class="send-mewssage">
    <input type="text" class="form-control mb-3" id="name" name="name" placeholder="Your Name">
    <input type="email" class="form-control mb-3" id="email" name="mail" placeholder="Your Email">
    <input type="text" class="form-control mb-3" id="phone" name="phone" placeholder="Your Phone">
    <textarea name="message" id="message" class="form-control mb-3" placeholder="Your Message"></textarea>
    <input type="hidden" id="organization_id" value="a5168987-eeac-11e6-b0b5-6c92bf2bf11d">

    <input type="hidden" id="product_title" value="<?php echo ifEmptyText($type_title,'Home');?>">
    <button type="submit" value="send" class="btn btn-primary send-message-btn" id="customer_submit_button">SEND MESSAGE</button>
</div>