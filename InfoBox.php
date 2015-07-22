<?php

namespace dee\adminlte;

use yii\helpers\ArrayHelper;
use rmrevin\yii\fontawesome\FA;

/**
 * Description of InfoBox
 *
 * For example:
 *
 * ```php
 * InfoBox::begin([
 *     'color'=>'aqua',
 *     'icon'=>envelope-o,
 * ]);
 *    echo '<span class="info-box-text">Messages</span>';
 *    echo '<span class="info-box-number">14</span>';
 * InfoBox::end();
 * ```
 *
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @since 1.0
 */
class InfoBox extends Widget
{
    const COLORED_ICON = 1;
    const COLORED_ALL = 2;

    public $color = 'red';
    public $icon;
    public $type = self::COLORED_ICON;
    public $contents = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        Html::addCssClass($this->options, ['widget' => 'info-box']);
        $iconOptions = ['class' => 'info-box-icon'];
        if ($this->type === self::COLORED_ICON) {
            Html::addCssClass($iconOptions, 'bg-' . $this->color);
        } else {
            Html::addCssClass($this->options, 'bg-' . $this->color);
        }
        echo Html::beginTag('div', $this->options);
        echo Html::tag('span', FA::icon($this->icon), $iconOptions);
        echo '<div class="info-box-content">';
        if (!empty($this->contents)) {
            foreach ($this->contents as $content) {
                if (is_array($content)) {
                    $type = ArrayHelper::getValue($content, 'type', 'text');
                    $text = ArrayHelper::getValue($content, 'text', '');
                    if (in_array($type, ['text', 'number'])) {
                        echo Html::tag('span', $text, ['class' => 'info-box-' . $type]);
                    } elseif ($type == 'progress') {
                        $value = ArrayHelper::getValue($content, 'value', $text);
                        echo '<div class="progress">';
                        echo Html::tag('div', '', ['class' => 'progress-bar', 'style' => ['width' => $value . '%']]);
                        echo '</div>';
                    }  else {
                        echo Html::tag('span', $text, ['class' => $type]);
                    }
                }  else {
                    echo $content;
                }
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        AdminlteAsset::register($this->getView());
        echo '</div></div>';
    }
}