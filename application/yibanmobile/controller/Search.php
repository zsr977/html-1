<?php
namespace app\yibanmobile\controller;

use app\yibanmobile\model\User;
use think\Controller;
use think\Request;

class Search extends Controller

{
    //个人网站入口
    public function index()
    {
        $APPID = "ee8d6cedb7f2353c";
        $APPSECRET = "0126ea746b3c1561b80c4c3d97aa71be";
        $CALLBACK = "http://f.yiban.cn/iapp141913";
        $api=new Api();
        $yb_id=$api->index($APPID, $APPSECRET, $CALLBACK);
        $user=new User();
        if ($user -> emptySchool($yb_id)){
            session('yb_id',$yb_id);
            return redirect('Search/account');
        }else {
            return view();
        }
    }
    //绑定账号信息
    public function account()
    {
        return view();
    }
    //新增或修改账号信息
    public function save()
    {
        $request = Request::instance();
        if ($request -> isPost()){
            $param=$request->param();
            $school_id=$param['school_id'];
            $school_password=$param['school_password'];
            if (!empty($school_id)&&!empty($school_password)){
                $user=new User();
                $user->saveUser($school_id, $school_password);
                //TODO
            }else {
                return $this->error('不能提交空字符串');
            }
        }else {
            return $this->error('提交方式有误');
        }
        
    }
    
}
