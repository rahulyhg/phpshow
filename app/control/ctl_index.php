<?php
namespace app\control;

/**
 * Created by PhpStorm.
 * User: pengyongsheng
 * Date: 2018/8/20
 * Time: 下午4:35
 */
class ctl_index extends \control
{
    public function index()
    {
        \tpl::display();
    }
}