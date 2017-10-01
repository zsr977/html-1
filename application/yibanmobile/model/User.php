<?php 
namespace app\yibanmobile\model;

use think\Model;

class User extends Model
{
    /*
     * 判断学号教务系统密码是否为空
     * $yb_id => 易班id
     */
    public function emptySchool($yb_id)
    {
        $data=$this -> getOne($yb_id);
        if (!empty($data -> school_id)&&!empty($data -> school_password))
        {
            session('school_id',$data -> school_id);
            session('school_password',$data -> school_password);
            return false;
        }else {
            return true;
        }
    }
    
    /*
     * 通过易班id查找用户
     * $yb_id => 易班id
     */
    public function getOne($yb_id)
    {
        return $this -> where('yb_id='.$yb_id)->find();
    }
    
    /*
     * 保存用户信息
     * $yb_id => 易班id
     */
    public function saveUser($school_id,$school_password)
    {
        $yb_id=session('yb_id');
        //TODO
    }
}
?>