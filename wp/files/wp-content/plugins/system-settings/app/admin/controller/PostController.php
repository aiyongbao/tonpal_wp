<?php
namespace app\admin\controller;
use library\controller\RestController;

class PostController extends RestController{

    public function Index()
    {
        //增加插入post的额外扩展参数
        add_action("rest_after_insert_post",function($post,$request,$bool){

            $thumbnail = $request['thumbnail']; 

            if(empty($thumbnail))
            {
                return $this->error("缩略图不能为空");
            }
            

            $photos = $request['photos'];
            //存入postmeta属性


            $photos = json_decode($photos,true);

            register_meta('post', 'thumbnail' ,array(
                'type'      => 'string', // Validate and sanitize the meta value as a string.
                    // Default: 'string'.  
                    // In 4.7 one of 'string', 'boolean', 'integer', 'number' must be used as 'type'. 
                'description'    => 'A meta key associated with a string meta value.', // Shown in the schema for the meta key.
                'single'        => true, // Return a single value of the type. Default: false.
                'show_in_rest'    => true, // Show in the WP REST API response. Default: false.
            ));

            register_meta('post', 'photos' ,array(
                'type'      => 'string', // Validate and sanitize the meta value as a string.
                    // Default: 'string'.  
                    // In 4.7 one of 'string', 'boolean', 'integer', 'number' must be used as 'type'. 
                'description'    => 'A meta key associated with a string meta value.', // Shown in the schema for the meta key.
                'show_in_rest'    => true, // Show in the WP REST API response. Default: false.
            ));

            delete_post_meta($post->ID,'photos');
            add_post_meta( $post->ID, 'thumbnail', $thumbnail );
            foreach($photos as $key => $value)
            {
                add_post_meta( $post->ID, 'photos', $value );
            }

        },10,3);
    }

}