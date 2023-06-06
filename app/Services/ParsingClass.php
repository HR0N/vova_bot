<?php



namespace App\Services;


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

    public function __construct()
    {
        $this->botClass = new TgBotClass();
        $this->pq = \phpQuery::class;
        $this->old_ads = [];
    }

    public function getParsed($url, $sSelector){
        $page = file_get_contents($url);
        $this->pq->load_str($page);
        return $this->pq->query($sSelector)[0]->textContent;
    }

    public function check_ad($group, $new_ad){
        if(str_contains(json_encode($this->old_ads), json_encode($new_ad[0]))){
            $vnikuda = 'nu ok =\<br>';
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
            $this->botClass->sendMessage($group->group_id, $message);
        }
        echo $new_ad[1].'<br>';
    }

    public function parse(){
        $sSelector1 = 'div.listing-grid-container';
        $groups = TgGroups::all();
        $count = 1;


        foreach ($groups as $group){
            $url = file_get_contents($group->request_url);
            $doc = \phpQuery::newDocument($url);
            $orders =  $doc->find($sSelector1)->find('div.css-1sw7q4x');
            $this->old_ads = json_decode($group->ads);
//            $result = [];
            echo 'start<br>';
            foreach ($orders as $key => $val){
                $count++;
                $title = pq($val)->find('h6.css-16v5mdi.er34gjf0')->text();
                $price = str_replace('do negocjacji', ' - do negocjacji', explode('.css', pq($val)->find('p.css-10b0gli.er34gjf0')->text())[0]);
                $check = $title.' - '.$price;
                $date = pq($val)->find('p.css-veheph.er34gjf0')->text();
                $area = pq($val)->find('span.css-643j0o')->text();
                $link = pq($val)->find('a.css-rc5s2u')->attr('href');
                if(!str_contains($link, 'otodom.pl')){$link = "https://www.olx.pl".$link;}
                $array = [$check, $title, $price, $date, $area, $link];

                $this->check_ad($group, $array);

                sleep(.2);
//                if($count > 20){break;}
            }
            \phpQuery::unloadDocuments();


            $data['ads'] = json_encode($this->old_ads);

            $base = TgGroups::find($group->id);
            $res = $base->update($data);
            echo '<pre>';
            echo var_dump($res);
            echo '</pre>';
        }
    }
}
