<?php
// +----------------------------------------------------------------------
// 基模型
// +----------------------------------------------------------------------
// 帮助文档：https://github.com/auraphp/Aura.SqlQuery/tree/3.x/docs
// +----------------------------------------------------------------------
// Written by Kenvix <i@kenvix.com>
// Copyright (c) 2018 kenvix.com All rights reserved.
// +----------------------------------------------------------------------

class BaseModel extends PDO {
    protected static $builder;
    protected static $instance;
    protected static $type;

    /**
     * BaseModel constructor.
     *
     * @throws Exception
     */
    public function __construct()  {
        parent::__construct(DSN, DBUser, DBPassword);
    }

    /**
     * @param int $limit
     * @param int $begin
     * @return string
     */
    public function buildLimit($limit, $begin = null) {
        if(!is_null($limit)) {
            if(is_null($begin))
                $begin = 0;
            return " LIMIT $begin,$limit ";
        }
        return '';
    }
}
