<?php

namespace app\portal\controller;

use library\controller\BaseController;

/**
 * 多语言控制器
 * User: Frank <belief_dfy@163.com>
 */
class LangController extends BaseController
{
    /**
     * 切换语种
     * @author frank <belief_dfy@163.com>
     */
    public function Index($lang)
    {
        global $wpdb;
        $match = "zh|zh-cn|zu|yo|yi|cy|vi|uz|ur|uk|tr|th|te|ta|tg|sv|sw|su|es|so|sl|sk|si|st|sr|ru|ro|pa|pt|pl|fa|no|ne|my|mn|mr|mi|mt|ml|ms|mg|lt|lv|la|lo|ko|km|kk|kn|jw|ja|it|ga|id|ig|is|hu|hi|iw|ha|ht|gu|el|de|ka|gl|fr|fi|tl|et|eo|nl|da|cs|hr|ny|ca|bg|bs|bn|be|eu|az|hy|ar|sq|af";
        $match_arr = explode("|", $match);

        $prefix = "wp_";

        if (in_array($lang, $match_arr)) {
            //不存在新建语种数据库
            // $sync = new SyncController();
            // $sync->init($lang);
            $prefix = 'wp_' . $lang . '_';
        }

        $wpdb->set_prefix($prefix);
    }
}
