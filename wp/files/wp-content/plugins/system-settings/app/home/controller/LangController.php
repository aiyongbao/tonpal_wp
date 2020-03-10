<?php

namespace app\home\controller;

use library\controller\BaseController;

class LangController extends BaseController
{
    public function Index()
    {

        $lang = $_REQUEST['lang'];
        if(empty($lang))
        {
            $lang = $_SESSION['lang'];
        }

        global $wpdb;
        switch ($lang) {
            case 'fr':
                $lang = 'fr';
                $wpdb->set_prefix('wp_fr_');
                break;
            default:
                $lang = '';
                break;
        }

        $_SESSION['lang'] = $lang;
    }
}
