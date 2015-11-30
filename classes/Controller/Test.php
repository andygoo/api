<?php

class Controller_Test extends Controller_Api {

    public function action_zz() {
		$args = trim($_GET['q']);
		
		$args = explode(' ', $args);
		$args = array_map('trim', $args);
		$args = array_filter($args);
		
		$func = $args[0];
		unset($args[0]);
		$ret = call_user_func_array($func, $args);
		
		$this->response['data'] = $ret;
	}
	
	
	
    public function action_zz3() {
		$str = trim($_GET['q']);
		
		exec("Rscript D:/ws/f.R {$str} 2>&1", $output, $ret);
		
		
		$this->response['data'] = $output;
	}
	
	
	
    public function action_zz2() {
		$str = '';
		$content = trim($_GET['q']);
		$ret_json = CURL::get('http://rmbz.net/Api/AiTalk.aspx?key=rmbznet&word='.$content);
		$ret_array = json_decode($ret_json, true);
		if (isset($ret_array['result']) && $ret_array['result']==1) {
			$str = $ret_array['content'];
		}
		  
		$this->response['data'] = $str;
	}
	
	
	
    public function action_list() {
        $ret = array(
            array(
                'id' => '1',
                'title' => '仅108元，享原价138元百泉湾温泉旅游度假区度假门票一张，包括温泉门票、水中滑梯、儿童乐园、健身房、台球厅、乒乓球室、影视厅、佤族表演、游泳馆！融合了江南园林的精致和北方园林的大气，提供了精致、生态、养生的温泉沐浴及高端温泉SPA专属空间！',
                'price' => '价格： ¥1',
                'addr' => '郭守敬大道高速公路下道口北侧',
                'pic' => 'http://www.xingtai123.com/pay/static/team/2011/1230/13252284337273_index_new.jpg' 
            ),
            array(
                'id' => '2',
                'title' => '仅108元，享原价138元百泉湾温泉旅游度假区度假门票一张，包括温泉门票、水中滑梯、儿童乐园、健身房、台球厅、乒乓球室、影视厅、佤族表演、游泳馆！融合了江南园林的精致和北方园林的大气，提供了精致、生态、养生的温泉沐浴及高端温泉SPA专属空间！',
                'price' => '价格： ¥1',
                'addr' => '郭守敬大道高速公路下道口北侧',
                'pic' => 'http://www.xingtai123.com/pay/static/team/2011/1230/13252299857296_index_new.jpg' 
            ),
            array(
                'id' => '3',
                'title' => '仅108元，享原价138元百泉湾温泉旅游度假区度假门票一张，包括温泉门票、水中滑梯、儿童乐园、健身房、台球厅、乒乓球室、影视厅、佤族表演、游泳馆！融合了江南园林的精致和北方园林的大气，提供了精致、生态、养生的温泉沐浴及高端温泉SPA专属空间！',
                'price' => '价格： ¥1',
                'addr' => '郭守敬大道高速公路下道口北侧',
                'pic' => 'http://www.xingtai123.com/pay/static/team/2011/1230/13252316489932_index_new.jpg' 
            ),
            array(
                'id' => '4',
                'title' => '仅108元，享原价138元百泉湾温泉旅游度假区度假门票一张，包括温泉门票、水中滑梯、儿童乐园、健身房、台球厅、乒乓球室、影视厅、佤族表演、游泳馆！融合了江南园林的精致和北方园林的大气，提供了精致、生态、养生的温泉沐浴及高端温泉SPA专属空间！',
                'price' => '价格： ¥1',
                'addr' => '郭守敬大道高速公路下道口北侧',
                'pic' => 'http://www.xingtai123.com/pay/static/team/2011/1230/13252368986069_index_new.jpg' 
            ),
            array(
                'id' => '5',
                'title' => '仅108元，享原价138元百泉湾温泉旅游度假区度假门票一张，包括温泉门票、水中滑梯、儿童乐园、健身房、台球厅、乒乓球室、影视厅、佤族表演、游泳馆！融合了江南园林的精致和北方园林的大气，提供了精致、生态、养生的温泉沐浴及高端温泉SPA专属空间！',
                'price' => '价格： ¥1',
                'addr' => '郭守敬大道高速公路下道口北侧',
                'pic' => 'http://www.xingtai123.com/pay/static/team/2012/0221/13297586954685_index_new.jpg' 
            ),
        );
        $this->response['data'] = $ret;
    }

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

