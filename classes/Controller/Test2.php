<?php

class Controller_Test2 extends Controller_Api {

    public function action_detail() {
        $ret = array( 
            'title' => '仅108元，享原价138元百泉湾温泉旅游度假区度假门票一张，包括温泉门票、水中滑梯、儿童乐园、健身房、台球厅、乒乓球室、影视厅、佤族表演、游泳馆！融合了江南园林的精致和北方园林的大气，提供了精致、生态、养生的温泉沐浴及高端温泉SPA专属空间！',
            'price' => '&Auml;<a href=\'test\'>Test</a><b>Wörmann</b>&nbsp;>"d"价\'asa\'格： ¥1',
            'pic' => 'http://www.jiesc.net/test.jpg',
            'addr' => '郭守敬大道高速公路下道口北侧',
            'tel' => '0319-3172668',
            'desc' => '仅108元，享原价138元百泉湾温泉旅游度假区度假门票一张，包括温泉门票、水中滑梯、儿童乐园、健身房、台球厅、乒乓球室、影视厅、佤族表演、游泳馆！融合了江南园林的精致和北方园林的大气，提供了精致、生态、养生的温泉沐浴及高端温泉SPA专属空间！' 
        );
        $this->response['data'] = $ret;
    }
}
