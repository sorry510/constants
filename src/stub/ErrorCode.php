<?php

declare (strict_types = 1);

namespace App\Constants;

class ErrorCode
{
    /**
     * @Message("操作成功")
     */
    const SUCCESS = 200;

    /**
     * @Message("操作失败")
     */
    const ERROR = 400;

    /**
     * @Message("未登录")
     */
    const NO_LOGIN = 401;

    /**
     * @Message("你的账号已被封禁，请联系系统管理员！")
     */
    const USER_FREEZE = 402;

    /**
     * @Message("没有权限")
     */
    const NO_AUTH = 403;
}
