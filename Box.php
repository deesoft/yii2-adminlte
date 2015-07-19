<?php

namespace dee\adminlte;

use yii\helpers\ArrayHelper;
use rmrevin\yii\fontawesome\FA;

/**
 * Description of Box
 *
 * For example:
 *
 * ```php
 * Box::begin([
 *     'header'=>'Primary Solid Box',
 *     'solid'=>true,
 *     'variant'=>'primary',
 *     'toolboxs'=>[
 *         ['icon'=>'times','options'=>['data-widget'=>'remove','data-togle'=>'tooltip']],
 *     ],
 * ]);
 *     echo "Body of box\n";
 * Box::end();
 * ```
 *
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @since 1.0
 */
class Box extends Widget
{
    public $header;
    public $toolboxs = [];
    public $variant;
    public $solid = false;
    public $body;
    public $footer;
    public $overlay;
    public $spinOverlayIcon = true;
    protected $widgets = [
        'remove' => [
            'options' => [
                'data-widget' => 'remove',
                'data-toggle' => 'tooltip',
                'title' => 'Remove',
            ],
            'icon' => 'times'
        ],
        'collapse' => [
            'options' => [
                'data-widget' => 'collapse',
                'data-toggle' => 'tooltip',
                'title' => 'Collapse',
            ],
            'icon' => 'minus'
        ],
    ];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        Html::addCssClass($this->options, ['widget' => 'box']);
        if ($this->solid) {
            Html::addCssClass($this->options, 'box-solid');
        }
        if ($this->variant !== null) {
            Html::addCssClass($this->options, 'box-' . $this->variant);
        }

        echo Html::beginTag('div', $this->options);
        // header
        echo '<div class="box-header with-border">';
        echo Html::tag('h3', $this->header, ['class' => 'box-title']);

        // box-tools
        if (!empty($this->toolboxs)) {
            echo Html::beginTag('div', ['class' => 'box-tools pull-right']);
            foreach ($this->toolboxs as $toolbox) {
                if (is_array($toolbox)) {
                    $type = ArrayHelper::getValue($toolbox, 'type', 'button');
                    if (($widget = ArrayHelper::getValue($toolbox, 'widget')) !== null && isset($this->widgets[$widget])) {
                        $toolbox = ArrayHelper::merge($this->widgets[$widget], $toolbox);
                    }
                    $options = ArrayHelper::getValue($toolbox, 'options', []);
                    $text = ArrayHelper::getValue($toolbox, 'text', '');
                    $icon = ArrayHelper::getValue($toolbox, 'icon');
                    if ($icon !== null) {
                        $text .= FA::icon($icon);
                    }
                    echo Html::tag($type, $text, $options);
                } else {
                    echo $toolbox;
                }
            }
            echo '</div>';
        }
        echo '</div>';

        // body
        echo '<div class="box-body">';
        echo $this->body;
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        AdminlteAsset::register($this->getView());
        if ($this->footer) {
            echo Html::tag('div', $this->footer, ['class' => 'box-footer']);
        }
        echo '</div>';
        if ($this->overlay) {
            $icon = FA::icon($this->overlay);
            if ($this->spinOverlayIcon) {
                $icon->spin();
            }
            echo Html::tag('div', $icon, ['class' => 'overlay']);
        }
        echo '</div>';
    }
}