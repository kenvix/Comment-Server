<?php
// +----------------------------------------------------------------------
// 快捷设置读取类
// +----------------------------------------------------------------------
// Written by Kenvix <i@kenvix.com>
// Copyright (c) 2018 kenvix.com All rights reserved.
// +----------------------------------------------------------------------

class Option {
    public static function getTrustedDomain() {
        if(!empty($return)) return $return;
        $domains = explode(' ', TrustedDomain);
        static $return  = [];
        foreach($domains as $v) {
            if(strpos($v, ':') === false) {
                $return[] = $v . ':80';
                $return[] = $v . ':443';
            }
            $return[] = $v;
        }
        return $return;
    }
}
