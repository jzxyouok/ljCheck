<?php
namespace Admin\Controller;
use Think\Controller;
class EmptyController extends BaseController {
    function   _empty(){

        header( "HTTP/1.0  404  Not Found" );

        $this->display( 'Public:404' );

    }
    function  index(){

        header( "HTTP/1.0  404  Not Found" );

        $this->display( 'Public:404' );

    }

}