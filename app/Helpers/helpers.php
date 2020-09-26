<?php


// 递归无线树状结构
function getChild($data,$parent_id=null,$order=0){
    $arr = [];
    foreach($data as $v){
        if($v['parent_id']==$parent_id){
            $v['level'] = $order;
            $rs = getChild($data,$v['id'],$order+1);
            if(!empty($rs)){
                $v['children'] = $rs;
            }
            $arr[] = $v;
        }
    }
    return $arr;
}