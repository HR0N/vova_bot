<?php



namespace App\Services;


use App\Models\TgGroups;
use Telegram\Bot\Exceptions\TelegramResponseException;
use Telegram\Bot\Exceptions\TelegramSDKException;
use PhpQuery\PhpQuery;

class ParsingClass {

    /**
     * @var string
     */
    public $pq;

    public function __construct()
    {
        /*  composer require phpquery/phpquery - https://packagist.org/packages/phpquery/phpquery */
        $this->pq = new phpQuery;
    }

    public function getParsed($url, $sSelector){
        $page = file_get_contents($url);
        $this->pq->load_str($page);
        return $this->pq->query($sSelector)[0]->textContent;
    }

    public function apartment_rent(){
        $city = 'kiev/';
        $district = '&search[district_id]=';
        $price1 = '&search[filter_float_price:from]=';
        $price2 = '&search[filter_float_price:to]=';
        $floor1 = '&search[filter_float_floor:from]=';
        $floor2 = '&search[filter_float_floor:to]=';
        $total_area1 = '&search[filter_float_total_area:from]=';
        $total_area2 = '&search[filter_float_total_area:to]=';
        $kitchen1 = '&search[filter_float_kitchen_area:from]=';
        $kitchen2 = '&search[filter_float_kitchen_area:to]=';
        $furnish1 = '&search[filter_enum_furnish][0]=yes';
        $furnish2 = '&search[filter_enum_furnish][1]=no';
        $rooms1 = '&search[filter_enum_number_of_rooms_string][0]=odnokomnatnye';
        $rooms2 = '&search[filter_enum_number_of_rooms_string][1]=dvuhkomnatnye';
        $rooms3 = '&search[filter_enum_number_of_rooms_string][2]=trehkomnatnye';
        $rooms4 = '&search[filter_enum_number_of_rooms_string][3]=chetyrehkomnatnye';
        $rooms5 = '&search[filter_enum_number_of_rooms_string][4]=pyatikomnatnye';
        $url_apartment_rent = "https://www.olx.ua/d/uk/nedvizhimost/kvartiry/dolgosrochnaya-arenda-kvartir/$city?";
        $url_room_rent = "https://www.olx.ua/d/uk/nedvizhimost/komnaty/dolgosrochnaya-arenda-komnat/$city?";
        $url = $url_apartment_rent.$rooms1.$rooms3;
        $sSelector = 'div.listing-grid-container';
        echo file_get_contents($url);
    }
}
