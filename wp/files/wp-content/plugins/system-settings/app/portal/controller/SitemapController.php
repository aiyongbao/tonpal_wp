<?php

namespace app\portal\controller;

use library\controller\BaseController;
use library\Db;

/**
 * sitemap生成
 * User: Frank <belief_dfy@163.com>
 */
class SitemapController extends BaseController
{
    //设置排序规则
    public function route_init()
    {
        add_filter('query_vars', function ($public_query_vars) {
            $public_query_vars[] = 'xml_sitemap';
            $public_query_vars[] = 'abbr';
            $public_query_vars[] = 'page';
            return $public_query_vars;
        });

        //设置语种
        $abbr = ['en'];
        $langs = Db::name('language')->where('status', 1)->select();
        foreach ($langs as $lang) {
            $abbr[] = $lang['abbr'];
        }

        foreach ($abbr as $lang) {
            $match = $lang == 'en' ? '' : '^' . $lang . '/';
            $abbr =  $lang == 'en' ? '' : $lang;

            add_rewrite_rule($match . 'sitemap(-+([a-zA-Z0-9_-]+))?\.xml$', 'index.php?abbr=' . $abbr . '&xml_sitemap=params=$matches[2]');
            add_rewrite_rule($match . 'sitemap/page.xml$', 'index.php?abbr=' . $abbr . '&xml_sitemap=params=page');
            add_rewrite_rule($match . 'sitemap/product-list.xml$', 'index.php?abbr=' . $abbr . '&xml_sitemap=params=product-list');
            add_rewrite_rule($match . 'sitemap/product-detail.xml$', 'index.php?abbr=' . $abbr . '&xml_sitemap=params=product-detail');
            add_rewrite_rule($match . 'sitemap/news-detail.xml$', 'index.php?abbr=' . $abbr . '&xml_sitemap=params=news-detail');
            add_rewrite_rule($match . 'sitemap/tag.xml$', 'index.php?abbr=' . $abbr . '&xml_sitemap=params=tag');
            add_rewrite_rule($match . 'sitemap/detail.xml$', 'index.php?abbr=' . $abbr . '&xml_sitemap=params=detail');
            add_rewrite_rule($match . 'sitemap/ai-product-detail.xml$', 'index.php?abbr=' . $abbr . '&xml_sitemap=params=ai-product-detail');
            add_rewrite_rule($match . 'sitemap/ai-news-detail.xml$', 'index.php?abbr=' . $abbr . '&xml_sitemap=params=ai-news-detail');
        }

        add_filter('request', function ($query_vars) {
            //获取sitemap参数
            $param = $query_vars['xml_sitemap'];
            $abbr = $query_vars['abbr'];
            if (isset($param)) {
                $result = explode('=', $param);
                //读取sitemap参
                $type = isset($result[1]) ? $result[1] : '';
                $this->fetch($type, $abbr);
            }
            return $query_vars;
        });
    }

    //生成sitemap
    public function fetch($type, $abbr = '')
    {
        header("Content-type: text/xml");
        $dom = new \DOMDocument('1.0', 'utf-8');
        $urlset = $dom->createElement('urlset');
        $urlset->setAttribute("xmlns", "http://www.sitemaps.org/schemas/sitemap/0.9");
        $urlset->setAttribute("xmlns:xhtml", "http://www.w3.org/1999/xhtml");
        $urlset->setAttribute("xmlns:image", "http://www.google.com/schemas/sitemap-image/1.1");
        $dom->appendChild($urlset);

        $host = "https://" . $_SERVER['HTTP_HOST'];

        $abbr = empty($abbr) ? '' : '/' . $abbr;

        switch ($type) {
            case "":
                $sitemap = [
                    ['loc' => "{$host}{$abbr}/sitemap/page.xml"],
                    ['loc' => "{$host}{$abbr}/sitemap/product-list.xml"],
                    ['loc' => "{$host}{$abbr}/sitemap/product-detail.xml"],
                    ['loc' => "{$host}{$abbr}/sitemap/news-detail.xml"],
                    ['loc' => "{$host}{$abbr}/sitemap/tag.xml"],
                    ['loc' => "{$host}{$abbr}/sitemap/detail.xml"],
                    ['loc' => "{$host}{$abbr}/sitemap/ai-news-detail.xml"],
                    ['loc' => "{$host}{$abbr}/sitemap/ai-product-detail.xml"],
                    ['loc' => "{$host}{$abbr}/sitemap/ai-review.xml"],
                    ['loc' => "{$host}{$abbr}/sitemap/ai-faq.xml"]
                ];
                break;

            case "page":

                $sitemap = [
                    ['loc' => "{$host}{$abbr}"],
                    ['loc' => "{$host}{$abbr}/news"],
                    ['loc' => "{$host}{$abbr}/info-news"],
                    ['loc' => "{$host}{$abbr}/info-product"]
                ];

                //新闻二级
                $category = get_category_by_slug("news");
                $lists = $this->get_sub_data($category->term_id);
                foreach ($lists as $value) {
                    $slug = get_category_link($value->term_id);
                    $sitemap[]['loc'] =  "{$host}{$abbr}" . $slug;
                }

                //自定义列表

                $exclude = [];

                $exclude_arr = [
                    "product",
                    "news",
                    "info-news",
                    "info-product"
                ];

                $exclude = $this->get_categories($exclude_arr);

                add_action('pre_get_terms', function ($query) use ($exclude) {
                    $query->query_vars['exclude'] = $exclude;
                    return $query;
                });

                $lists = get_terms();
                foreach ($lists as $value) {
                    $sitemap[]['loc'] =  "{$host}{$abbr}/list/" . $value->slug;
                }
                break;

            case 'product-list':
                $sitemap = [["loc" => "{$host}{$abbr}/product"]];

                $term_id = get_category_by_slug("product")->term_id;
                $lists = $this->get_sub_data($term_id);
                foreach ($lists as $value) {
                    $slug = get_category_link($value->term_id);
                    $sitemap[]['loc'] =  "{$host}{$abbr}" . $slug;
                }
                break;
            case 'product-detail':
                $category = get_category_by_slug("product");
                $slug = "product";
            case 'ai-news-detail':
                if (!isset($category)) {
                    $category = get_category_by_slug("info-news");
                    $slug = "info-news";
                }

            case 'ai-product-detail':
                if (!isset($category)) {
                    $category = get_category_by_slug("info-product");
                    $slug = "info-product";
                }
            case 'news-detail':
                //查询全部的产品详情列表
                if (!isset($category)) {
                    $category = get_category_by_slug("news");
                    $slug = "news";
                }

                $categories = $this->get_categories([$slug]);

                //print_r($categories);

                $data = [];

                foreach ($categories as $c) {
                    $item = get_posts([
                        'numberposts' => 500,
                        'category' => $c,
                        'post_type'        => 'post'
                    ]);

                    foreach ($item as $obj) {
                        array_push($data, $obj);
                    }
                }

                $sitemap = [];
                foreach ($data as $post) {
                    $cache = ['loc' => "{$host}{$abbr}" . get_permalink($post->ID)];
                    if (!empty(get_post_meta($post->ID, 'thumbnail', true))) {
                        $cache['image'] = "https:" . get_post_meta($post->ID, 'thumbnail', true);
                    }
                    $sitemap[] = $cache;
                }

                break;

            case 'tag':
                $sitemap = [];
                $lists = $this->get_sub_data('', 'post_tag');
                foreach ($lists as $value) {
                    $slug = get_category_link($value->term_id);
                    $sitemap[]['loc'] =  "{$host}{$abbr}" . $slug;
                }
            default:
                break;
            case 'detail':
                $sitemap = [];

                //查询全部的产品详情列表

                $exclude = [];

                $exclude_arr = [
                    "product",
                    "news",
                    "info-news",
                    "info-product"
                ];

                $exclude = $this->get_categories($exclude_arr);
                $data = get_posts([
                    'category__not_in' => $exclude
                ]);

                $sitemap = [];
                foreach ($data as $post) {
                    $cache = ['loc' => "{$host}{$abbr}" . get_permalink($post->ID)];
                    if (!empty(get_post_meta($post->ID, 'thumbnail', true))) {
                        $cache['image'] = get_post_meta($post->ID, 'thumbnail', true);
                    }
                    $sitemap[] = $cache;
                }

                //自定义单页面

                $exclude_slug = [
                    "aboutus",
                    "picturewell",
                    "showcase",
                    "video",
                    "showcase",
                    "contactus"
                ];

                $pages = get_pages();

                foreach ($pages as $key => $page) {
                    $sitemap[] = [
                        'loc' => "{$host}{$abbr}/" . $page->post_name
                    ];
                }

                break;
        }

        if (!empty($sitemap)) {
            foreach ($sitemap as $key => $value) {
                $url = $dom->createElement('url');
                $urlset->appendChild($url);

                $loc = $dom->createElement('loc');
                $url->appendChild($loc);
                $url_text = $dom->createTextNode($value['loc']);
                $loc->appendChild($url_text);

                if (!empty($value['image'])) {
                    $image = $dom->createElement('image:image');
                    $url->appendChild($image);
                    $image_loc = $dom->createElement('image:loc');
                    $image->appendChild($image_loc);
                    $image_url = $dom->createTextNode($value['image']);
                    $image_loc->appendChild($image_url);
                }
            }
        }



        $xmlString = $dom->saveXML();
        echo $xmlString;
        exit();
    }

    //获取分类下的全部子类
    public function get_sub_data($term_id, $taxonomy = 'category')
    {
        static $lists = [];
        $data = get_categories(['parent' => $term_id, 'taxonomy' => $taxonomy]);

        foreach ($data as $value) {
            array_push($lists, $value);
            $this->get_sub_data($value->term_id, $taxonomy);
        }

        return $lists;
    }

    //根据别名获取分类id
    public function get_categories($slugs = [])
    {
        $exclude = [];
        foreach ($slugs as $slug) {
            $term_id = get_category_by_slug($slug)->term_id;
            if (!empty($term_id)) {
                $children = get_term_children($term_id, 'category');
                array_push($children, $term_id);
                $exclude = array_merge($exclude, $children);
            }
        }
        return $exclude;
    }
}
