<?php
$category_product_list = get_term_children(get_category_by_slug('product')->term_id,'category');
print_r($category_product_list);
?>

    <div class="side-tit-bar">
        <h2 class="side-tit">{{ volt_Sidebar_Menu_upper }}</h2>
    </div>
    <ul class="side-cate">
<!--        {% if product_category is defined and product_category is not empty %}-->
<!--        {% for product_category_single in product_category %}-->
<!--        {% if product_category_single["product_category"] is defined %}-->
<!--        <li>-->
<!--            <a href="/{{ product_category_single['url'] }}" onclick="javascript: location.href = '/{{ product_category_single['url'] }}';">{{ product_category_single["category_name"] }}</a>-->
<!--            <ul class="sub-menu">-->
<!--                {% for product_category_single_sub in product_category_single["product_category"] %}-->
<!--                <li><a href="/{{ product_category_single_sub["url"] }}">{{ product_category_single_sub["category_name"] }}</a></li>-->
<!--                {% endfor %}-->
<!--            </ul>-->
<!--        </li>-->
<!--        {% else %}-->
<!--        <li><a href="/{{ product_category_single["url"] }}" title="{{ product_category_single["category_name"] }}">{{ product_category_single["category_name"] }}</a></li>-->
<!--        {% endif %}-->
<!--        {% endfor %}-->
<!--        {% endif %}-->
    </ul>
