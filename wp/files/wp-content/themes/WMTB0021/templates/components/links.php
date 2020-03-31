<?php

$theme_vars = json_config_array('footer', 'vars',1);
$link = ifEmptyArray($theme_vars['links']['value']);

?>
<?php if ($link !== []) : ?>
    <div id="link-item">
        <div>Links<span></span></div>
        <ul>
            <?php foreach ( $link as $item ) { ?>
                <li><a href="<?php echo $item['link']?>"><?php echo $item['name'] ?></a></li>
            <?php } ?>
        </ul>
    </div>
<?php endif; ?>