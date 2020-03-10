<?php
namespace app\admin\controller;

use library\controller\RestController;

class CategoryController extends RestController{

    protected $delCategorys = [];

    public function __construct()
    {

    }

    //根据父级删除子集
    public function deleteCategory($request)
    {
        $id = $request['id'];

        $this->delCategorys[] = $id;
        $mid = $request['mid'];

        $this->movePostsByCid($id,$mid);
        $taxonomy_ids     = get_term_children( $id,'category' );
        foreach($taxonomy_ids as $key => $value)
        {
            $this->delCategorys[] = $value;
            $this->movePostsByCid($id,$mid);
        }

        foreach($this->delCategorys as $value)
        {
            wp_delete_term($value,'category');
        }

        return $this->success("操作成功");
    }

    //根据分类id删除或移动下面的文章
    public function movePostsByCid($cid,$mid = null)
    {
        $query_args = [
            "order" => "desc",
            "orderby" => "date",
            "post_status" => ["public"],
            "date_query" => [],
            'post_type' => 'post',
            'tax_query' => [
                [
                    'taxonomy' => 'category',
                    'field' => 'term_id',
                    'terms' => [$cid],
                    'include_children' => 0
                ]
            ],
            
        ];

        $posts_query  = new \WP_Query();
        $query_result = $posts_query->query( $query_args );
        //移动到指定分类
        foreach($query_result as $key => $value)
        {
            if(!empty( $mid ))
            {
                
                $param = [intval($mid)];

                $taxonomies = wp_list_filter( get_object_taxonomies( 'post', 'objects' ), array( 'show_in_rest' => true ) );
                
                foreach ( $taxonomies as $taxonomy ) {
                   
                    $result = wp_set_object_terms( $value->ID, $param, $taxonomy->name );
                    if ( is_wp_error( $result ) ) {
                        return $result;
                    }
                }
            }
            else{

                //移到回收站
                $result   = wp_trash_post( $value->ID );
            }
        }
    }
}