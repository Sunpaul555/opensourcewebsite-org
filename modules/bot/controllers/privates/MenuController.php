<?php

namespace app\modules\bot\controllers\privates;

use app\modules\bot\components\Controller;
use app\modules\bot\components\helpers\Emoji;
use Yii;

/**
 * Class MenuController
 *
 * @package app\modules\bot\controllers\privates
 */
class MenuController extends Controller
{
    /**
     * @return array
     */
    public function actionIndex()
    {
        $this->getState()->setName(null);

        $globalUser = $this->getUser();

        return $this->getResponseBuilder()
            ->editMessageTextOrSendMessage(
                $this->render('index', [
                    'user' => $globalUser,
                ]),
                [
                    [
                        [
                            'callback_data' => TelegramController::createRoute(),
                            'text' => Yii::t('bot', 'Telegram'),
                        ],
                    ],
                    [
                        [
                            'callback_data' => SCeController::createRoute(),
                            'text' => Yii::t('bot', 'Currency Exchange'),
                            'visible' => $globalUser->getCurrencyExchangeOrders()->exists(),
                        ],
                    ],
                    [
                        [
                            'callback_data' => SAdController::createRoute(),
                            'text' => Yii::t('bot', 'Ads'),
                            'visible' => YII_ENV_DEV,
                        ],
                    ],
                    [
                        [
                            'callback_data' => SJobController::createRoute(),
                            'text' => Yii::t('bot', 'Jobs'),
                            'visible' => YII_ENV_DEV,
                        ],
                    ],
                    [
                        [
                            'callback_data' => ServicesController::createRoute(),
                            'text' => Yii::t('bot', 'Development'),
                        ],
                    ],
                    [
                        [
                            'callback_data' => StartController::createRoute(),
                            'text' => Emoji::GREETING,
                        ],
                        [
                            'callback_data' => MyAccountController::createRoute(),
                            'text' => Yii::t('bot', 'Account'),
                        ],
                        [
                            'callback_data' => LanguageController::createRoute(),
                            'text' => Emoji::LANGUAGE . ' ' . strtoupper(Yii::$app->language),
                        ],
                    ],
                ]
            )
            ->build();
    }
}
