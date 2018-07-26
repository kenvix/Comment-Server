<?php
// +----------------------------------------------------------------------
// 文章控制器
// +----------------------------------------------------------------------
// Written by Kenvix <i@kenvix.com>
// Copyright (c) 2018 kenvix.com All rights reserved.
// +----------------------------------------------------------------------

class PostController extends BaseController {

    /**
     * 添加文章
     * @throws Exception
     */
    public function Add() {
        $title = $this->getTitle();
        if(empty($title)) msg('文章标题不能为空',110);
        $title = str_replace(['\\', '/', '?', '&', '#', '"', '\'', ':', '<', '>', '*', '|'], '' , $title);
        if(empty($title)) msg('无效的文章标题',110);
        $model = new PostModel();
        if(!empty($model->getPostID($title))) msg('该文章已经存在', 111);
        ///-----检测文章是否存在-----//
        if(VerifyArticleExistence) {
            $curl = new wcurl(BlogUrl . BlogArticlePrefix . urlencode($title) . BlogArticleSuffix);
            $curl->set(CURLOPT_FOLLOWLOCATION, true);
            $curl->set(CURLOPT_NOBODY, true);
            $curl->exec();
            $code = $curl->getInfo(CURLINFO_HTTP_CODE);
            if(empty($code))  msg('网络请求出错',118);
            if($code != 200) msg('无法验证文章，对端返回HTTP码：' . $code, 115);
        }
        if($model->add($title) && Controller == __CLASS__ ) msg('添加文章成功');
        msg('添加文章失败，未知错误', 119);
    }
}
