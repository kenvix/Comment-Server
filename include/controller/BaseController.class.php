<?php
// +----------------------------------------------------------------------
// 基控制器
// +----------------------------------------------------------------------
// Written by Kenvix <i@kenvix.com>
// Copyright (c) 2018 kenvix.com All rights reserved.
// +----------------------------------------------------------------------

class BaseController {
    /**
     * 写CORS头。包括验证跨域请求，若通过则写Access-Control-Allow-Origin头
     */
    protected function writeCORSHeader() {
        if(!empty($_SERVER['HTTP_ORIGIN'])) {
            $data = parse_url($_SERVER['HTTP_ORIGIN']);
            if(!empty($data['host'])) {
                $data['host'] = strtolower($data['host']);
                if((empty($data['port']) && in_array($data['host'], Option::getTrustedDomain())) || (!empty($data['port']) && in_array($data['host'] . ':' . $data['port'], Option::getTrustedDomain()))) {
                    header('Access-Control-Allow-Origin:' . $_SERVER['HTTP_ORIGIN']);
                    if($_SERVER['REQUEST_METHOD'] == 'OPTIONS') die;
                }
            }
        }
    }

    /**
     * 获取文章标题
     * @return bool|mixed|string
     */
    protected function getTitle() {
        $title = I('request.title');
        if(empty($title)) {
            $url = I('request.purl');
            if(empty($url)) return false;
            $data = parse_url($url);
            if(strpos($data['path'], '/') === 0) $data['path'] = substr($data['path'], 1);
            $path = $data['path'];
            if(!empty($data['query'])) $path .= '?' . $data['query'];
            if(stripos($path, BlogArticlePrefix) === 0)
                $title = substr($path, strlen(BlogArticlePrefix));
            if(stripos($title, BlogArticleSuffix) === strlen($title) - strlen(BlogArticleSuffix))
                $title = substr($title, 0, stripos($title, BlogArticleSuffix));
        }
        return $title;
    }
}
