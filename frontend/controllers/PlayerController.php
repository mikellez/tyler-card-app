<?php

namespace frontend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;

class PlayerController extends ActiveController
{
    public $modelClass = 'app\models\Player';

    public function actions(): array 
    {
        $actions = parent::actions();
		unset($actions['index']);

        return $actions;
    }

	public function actionIndex() {
		$request = Yii::$app->request;

        $cards = [];
        $cardType = ['S', 'H', 'D', 'C'];
        $noOfPlayers = $request->get('noplayers');

        if($noOfPlayers<=0) {
			return ['success'=>false, 'message'=>'Invalid no of players!', 'data'=>[]];
        }

        $players = [];

        $cardNum = [1=>'A', 10=>'X', 11=>'J', 12=>'Q', 13=>'K'];

        // generate 52 cards
        for($i=1;$i<=13;$i++) {
            $card = $i;

            if(isset($cardNum[$i])) $card = $cardNum[$i];

            for($j=0;$j<count($cardType);$j++) {
                $cards[] = $card.'-'.$cardType[$j];
            }
        }

        $noOfCards = count($cards);

        // shuffle with random cards
        shuffle($cards);

        // assign cards to players
        // execute until cards runs out
        while(!empty($cards)) {
            for($j=0;$j<$noOfPlayers;$j++) {
                // remove one card from deck
                $card = array_shift($cards);
                $players[$j]['key'] = $j;
                $players[$j]['name'] = $j+1;
                $players[$j]['cards'][] = $card ?? 'No Card';
            }
        }

		return ['success'=>true, 'message'=>'', 'data'=>$players];
	}
}