<?php

class Controller_Reply extends Controller_Api {

	public $words = array(
		//'你好 ',
		'在干嘛 ',
		'我是你附近人，你在附近哪儿',
		'哦你哪儿人',
		'我老家河北的 ',
		'恩我叫赵雅欣',
		'你叫什么做么工作你',
		'恩我还没有找到工作刚来',
		'哦，你多大了有女朋友么',
		'恩之前男朋友分手才来两天',
		'你过年回家么',
		'哦，我过年不回家了认识你挺高兴的天冷多穿点',
		'恩，来也不认识谁挺陌生你多大',
		'哦我23了现在是单身看你挺不错的我们交个朋友啊,没有别的意思感觉在网上认识一个人不容易。',
		'恩，感觉你人不错你照片发一张我看看我照片QQ头像就我 ',
		'我性格比较直你别多想话多了你烦我么要是烦就删除',
		'我在想问你一个问题你可能是接受可能不接受嘻嘻',
		'恩，你别介意我性格直有什么说什么了',
		'你会不会背着你女朋友约陌生女孩其实这个话真的不能问你可我好奇',
		'其实男女都喜欢激情从而给自己释放放压力说真的性也是一种生活时间长了都想 ',
		'恩其实就想找个倾诉的对象约会，是看我们的缘分 ',
		'是的你感觉咋样如果两个人在一起谈得来也是要对上眼那就发展一下你看可以么',
		'我不是你想的那样女孩乱七八糟的乱搞我是看上你人不错只是想和你 ',
		'咋样要是可以的话你看看有没有时间我找你去玩',
		'恩就当交个新朋友感觉要是好就发展下去',
		'好的你看你几点忙完',
		'你看看你想约你就留你电话不想约就不用留了别耽误你宝贵时间了',
		'咋们来点诚意我找你去我电话现在欠费帮我充50话费在去13800001111',
		'如果你真的想和我约咱两就直接点咋们是成年人你说是吧',
		'我真心想和你交个朋友你别在忽悠我这样就没有什么意思  ',
		'恩你能好好说话么',
		'是啊毕竟我是一个人在也是挺寂寞的',
		'我电话现在都欠费了也没有钱交我现在在网吧上的网我电话13800001111',
		'希望你我能做个好朋友彼此真诚点不要那么无聊',
		'说真的晚上你能出来我找你去',
		'希望我们是真心的我不是你想的那样贱的人，',
		'你给我充50块钱话费好么谢谢你了，我真的没有骗你在要不你打我电话试试13800001111',
		'话我都说到这儿了都不好意思在说了谁骗你不得好死都你生出来的',
		'我就是心理不舒服才这样说的把你当做朋友',
		'给我充么我给你打电话我找你去骗你都是你养的我赵雅欣',
		'你真的想让我找你去就充50块我电话通了你打我电话不接你电话我是王八蛋 ',
		'你老这么说没有意思 我就求你帮个忙哥哥',
		'你自己想好你想让我找你就充值一下我们联系 ',
		'不要以为我骗你50块钱在，',
		'你想我给你机会就交 我是刚刚来钱交房租了',
		'不想帮忙就算了我也是要脸的人别看我现在没有钱没有工作',
		'你也不要这么说了我不想说了在',
		'别墨迹你是男人么让你充话费我俩电话里说13800001111',
		'谢谢了，我下了充了给我打电话我找你去,',
		'拜拜，',
		'......',
	);

    public function action_index() {
		$q = Arr::get($_GET, 'q');
		$uid = Arr::get($_GET, 'uid');
		if (empty($q) || empty($uid)) {
			$this->response['data'] = '....';
		} else {
			$this->redis = new Redis();
			$redis_config = Kohana::config('redis.default');
			$this->redis->connect($redis_config['host'], $redis_config['port']);
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

