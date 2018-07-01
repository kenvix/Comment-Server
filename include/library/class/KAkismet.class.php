<?php
// +----------------------------------------------------------------------
// Akismet 类
// 依赖 TijsVerkoyen\Akismet
// +----------------------------------------------------------------------
// Written by Kenvix <i@kenvix.com>
// Copyright (c) 2018 kenvix.com All rights reserved.
// +----------------------------------------------------------------------

use TijsVerkoyen\Akismet\Akismet;

class KAksimet extends Akismet {
    public function __construct() {
        parent::__construct(AkismetAPIKey, BlogUrl);

    }
}