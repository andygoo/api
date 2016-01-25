<?php

class Controller_Reply extends Controller_Api {

	public $words = array('1111', '22222222', '33333333333');

    public function action_index() {
		$q = Arr::get($_GET, 'q');
		$uid = Arr::get($_GET, 'uid');
		if (empty($q) || empty($uid)) {
			$this->response['data'] = '....';
		} else {
			$this->redis = new Redis();
			$this->redis->connect('192.168.1.106', '6379');
			$aa = $this->redis->get('w_' . $uid);
			if (empty($aa)) {
				$idx = $this->redis->get($uid);
				$idx = intval($idx);
				if (isset($this->words[$idx])) {
					$reply = $this->words[$idx];
					$time = ceil(strlen($reply) * 0.1) + rand(2, 10);
					$time = min($time, 29);
					$this->redis->setex('w_' . $uid, $time, 1);
					//$this->redis->set($uid, ++$idx);
					$this->redis->setex($uid, 600, ++$idx);
					sleep($time);
					$this->response['data'] = $reply;
				}
			}
		}
	}
}

