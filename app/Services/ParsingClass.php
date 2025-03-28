<?php



namespace App\Services;


use App\Models\ErrorsCheck;
use App\Models\TgGroups;
use Telegram\Bot\Exceptions\TelegramResponseException;
use Telegram\Bot\Exceptions\TelegramSDKException;
require_once __DIR__ . './../../app/parsing/phpQuery-0.9.5.386-onefile/phpQuery-onefile.php';

class ParsingClass {

    /**
     * @var string
     */
    public $botClass;
    public $pq;
    public $old_ads;
    public $current_path;

    public function __construct()
    {
        $this->botClass         = new TgBotClass();
        $this->pq               = \phpQuery::class;
        $this->old_ads          = [];
        $this->current_path     = str_contains($_SERVER['REQUEST_URI'], 'test');
    }

    public function getParsed($url, $sSelector){
        $page = file_get_contents($url);
        $this->pq->load_str($page);
        return $this->pq->query($sSelector)[0]->textContent;
    }

    public function check_ad($group, $new_ad){
        if(str_contains(json_encode($this->old_ads), json_encode($new_ad[0]))){
            echo '<pre>';
            echo var_dump($group->request_url);
            echo '</pre>';
            echo "<br><br>CHECK THIS ITERATION";
            $vnikuda = 'nu ok =\<br>';
            echo '<pre>';
//            echo var_dump($new_ad).'</br>';
            echo var_dump('title: ' .$new_ad[1]).'</br>';
            echo var_dump('price: ' .$new_ad[2]).'</br>';
            echo var_dump('link: '  .$new_ad[5]).'</br>';
            echo var_dump('date: '  .$new_ad[3]).'</br>';
            echo '</pre>';
        }else{
            $this->add_ad($group, $new_ad);
        }
    }

    public function add_ad($group, $new_ad){
        array_unshift($this->old_ads, $new_ad);   // add to begin
        if(count($this->old_ads) > 400){
            array_pop($this->old_ads);            // remove from end
        }

        $inline[] = ['text'=>'Відкрити у браузері', 'url'=>$new_ad[5]];
        $inline = array_chunk($inline, 2);
        $reply_markup = ['inline_keyboard'=>$inline];
        $inline_keyboard = json_encode($reply_markup);
        unset($inline);

        if(strlen($new_ad[1]) > 0){
            $message = "🏚️ <b>$new_ad[1]</b> \n\n$new_ad[2] \n<a href='$new_ad[5]'>$new_ad[3]</a>";
            if(!$this->current_path){    // если роут не тестовый - отправляем на каналы сообщения
                $this->botClass->sendMessage($group->group_id, $message); //todo ОТПРАВКА СООБЩЕНИЙ
            }
        }
//        echo $new_ad[1].'<br>';
    }

    public function parse(){
        $sSelector1 = 'div.listing-grid-container';
        $groups = TgGroups::all();
        $count = 1;

        echo 'start<br>';


        foreach ($groups as $group){
//            echo "$group->request_url".'<br>';
            $url = file_get_contents($group->request_url);
            $doc = \phpQuery::newDocument($url);
            $orders =  $doc->find($sSelector1)->find('div.css-qfzx1y');
            $this->old_ads = json_decode($group->ads);
//            $result = [];
            foreach ($orders as $key => $val){
                $count++;
                $title = pq($val)->find('a.css-1tqlkj0 h4.css-1g61gc2')->text();
//                $price = str_replace('do negocjacji', ' - do negocjacji', explode('.css', pq($val)->find('p.css-tyui9s.er34gjf0')->text())[0]);
                $price = explode(' zł', pq($val)->find('p[data-testid="ad-price"]')->text())[0] .' zł';
                $check = $title.' - '.$price;
//                $date = pq($val)->find('p.css-veheph.er34gjf0')->text();
                $date = pq($val)->find('p.css-vbz67q')->text();
                $area = pq($val)->find('span.css-643j0o')->text();
//                $link = pq($val)->find('a.css-rc5s2u')->attr('href');
                $link = pq($val)->find('div.css-u2ayx9 a')->attr('href');
                if(!str_contains($link, 'otodom.pl')){$link = "https://www.olx.pl".$link;}
                $array = [$check, $title, $price, $date, $area, $link];

                $this->check_end_send_error_notice($array);
                $this->check_ad($group, $array);    // ДЛЯ ТЕСТА

                sleep(.2);
//                if($count > 2){break;}  // ДЛЯ ТЕСТА
            }
            \phpQuery::unloadDocuments();


            $data['ads'] = json_encode($this->old_ads);

            $base = TgGroups::find($group->id);
            $res = $base->update($data);    //  СОХРАНЕНИЕ ДАННЫХ
//            echo '<pre>';         remove
//            echo var_dump($res);          remove
//            echo '</pre>';            remove
        }
    }

    public function check_end_send_error_notice($data, $message = "⚠️ Another Error!\nProject: vova_bot"){
        if($this->current_path) {return;}    // если это тестовый роут - прекращаем работу функции
        $was_error = ErrorsCheck::first()->was_mistake;
        if(!strlen($data[1]) > 0 || !strlen($data[2]) > 0 || !strlen($data[3]) > 0 || !strlen($data[5]) > 0){
            if(!$was_error){
                ErrorsCheck::first()->update(['was_mistake' => true]);
                $this->botClass->sendErrorNotice($message);
            }
        }else if($was_error){
            ErrorsCheck::first()->update(['was_mistake' => false]);
        }
    }
    public function check_end_send_error_notice2($message = '⚠️ Another Error in project: vova_bot'){
        $was_error = ErrorsCheck::first()->was_mistake;
        $this->botClass->sendErrorNotice(strval($was_error));
    }

    public function test(){
        echo $this->current_path;
    }

}
