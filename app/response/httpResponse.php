<?php

namespace response;

//用于显示响应信息
class httpResponse
{
    const JSON="json";
    const JSON_HEADER = 'Content-Type:text/json;charset=utf-8';
    // protected $StatusCode = 200

    /**
     * 根据不同的格式把数据转换成响应的格式输出
     * @param $code 状态码
     * @param $message  提示信息
     * @param array $data   返回的数据
     * @param string $type  返回数据的格式（json.xml,array）
     * @return array|string
     */
    public function response($code, $message, $data=array(), $type=self::JSON){
        //当传入的返回码不是数字时，return 空
        if(!is_numeric($code)){
            return '';
        }
        //当url后有format格式参数传过来时，使用传过来的参数进行处理
        //没有传值过来就用函数 $type参数决定
        $type=isset($_GET['format'])?$_GET['format']:$type;
        //组装一下数据
        $result=array(
            'code'=>$code,
            'message'=>$message,
            'data'=>$data,
        );
        //根据 $type 进行分发
        if($type=="json"){
           	$this->jsonToEncode($code,$message,$data);
        }elseif($type=="xml"){
           	$this->xmlToEncode($code,$message,$data);
        }else{
            //直接返回数组格式
            return $result;
        }
    }

    /**
     * 产生json格式数据
     * @param $code
     * @param $message
     * @param array $data
     */
    protected function jsonToEncode($code, $message, $data=array()){
    	header(self::JSON_HEADER);
        $data=[
            'code'=>$code,
            'message'=>$message,
            'data'=>$data
        ];
        echo json_encode($data);
        exit;
    }

    /***
     * 产生xml格式数据
     * @param $code
     * @param $message
     * @param array $data
     */
    public static function xmlToEncode($code,$message,$data=array()){
        $result=[
            'code'=>$code,
            'message'=>$message,
            'data'=>$data
        ];
        header("Content-Type:text/xml");
        $xml="<?xml version='1.0' encoding='UTF-8' ?>";
        $xml.="<root>";
        $xml.=self::xmlEncode($result);
        $xml.="</root>";
        echo $xml;
    }

    /**
     * 把传入的数组数据，格式化成xml格式数据
     * @param $data
     * @return string
     */
    protected function xmlEncode($data){
        $xml=$attr="";
        foreach($data as $key=>$value){
            //当数据为 索引型数组，就把下标以节点属性的形式组装起来 <item id={下标}>{value}</item>
            if(is_numeric($key)){
                $attr="id='{$key}'";
                $key="item";
            }
            $xml.="<{$key} {$attr}>";
            //递归遍历，当$value是数组时就再次调用本函数
            $xml.=is_array($value)?self::xmlEncode($value):$value;
            $xml.="</{$key}>";
        }
        return $xml;
    }
}
