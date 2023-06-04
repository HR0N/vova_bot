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
    public $pq;

    public function __construct()
    {
        $this->pq = \phpQuery::class;
    }

    public function getParsed($url, $sSelector){
        $page = file_get_contents($url);
        $this->pq->load_str($page);
        return $this->pq->query($sSelector)[0]->textContent;
    }

    public function parse(){
        $sSelector1 = 'div.listing-grid-container';
        $groups = TgGroups::all();
        $count = 1;
        foreach ($groups as $group){
            $url = file_get_contents($group->request_url);
            $doc = \phpQuery::newDocument($url);
            $orders =  $doc->find($sSelector1)->find('div.css-1sw7q4x');
            foreach ($orders as $key => $val){
                $count++;
                echo '<pre>';
                echo pq($val)->find('h6.css-16v5mdi.er34gjf0')->text();
                echo '</br>'.explode('.css', pq($val)->find('p.css-10b0gli.er34gjf0')->text())[0];
                echo '</br>--------------------------------------------------------------------------------------------</br>';
                echo '</pre>';
//                \phpQuery::unloadDocuments();
            }
        }
        echo '</br>'.$count;
    }
}
