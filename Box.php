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
 *     'boxTools'=>[
 *         ['badge'=>'red', 'text'=>'3', 'tooltip'=>'3 new messages'],
 *         ['button'=>'collapse', 'icon'=>'minus', 'tooltip'=>'Collapse'],
 *     ],
 *     'overlay' => 'refresh', // avaliable spinner, cog, gear, circle-o-notch
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
    public $boxTools = [];
    public $variant;
    public $solid = false;
    public $body;
    public $footer;
    public $overlay;
    public $spinOverlayIcon = true;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        Html::addCssClass($this->options, ['widget' => 'box']);
        if ($this->solid) {
            Html::addCssClass($this->options, 'box-solid');
            if ($this->variant === null) {
                Html::addCssClass($this->options, 'box-default');
            }
        }
        if ($this->variant !== null) {
            Html::addCssClass($this->options, 'box-' . $this->variant);
        }

        echo Html::beginTag('div', $this->options);
        // header
        if ($this->header || !empty($this->boxTools)) {
            echo '<div class="box-header with-border">';
            echo Html::tag('h3', $this->header, ['class' => 'box-title']);
        }
        // box-tools
        if (!empty($this->boxTools)) {
            echo Html::beginTag('div', ['class' => 'box-tools pull-right']);
            foreach ($this->boxTools as $toolbox) {
                if (is_array($toolbox)) {
                    $tag = 'span';
                    if (($widget = ArrayHelper::getValue($toolbox, 'button')) !== null) {
                        $tag = 'button';
                        $toolbox['options']['data-widget'] = $widget;
                        Html::addCssClass($toolbox['options'], 'btn btn-box-tool');
                    } elseif (($label = ArrayHelper::getValue($toolbox, 'label')) !== null) {
                        Html::addCssClass($toolbox['options'], 'label label-' . $label);
                    } elseif (($badge = ArrayHelper::getValue($toolbox, 'badge')) !== null) {
                        Html::addCssClass($toolbox['options'], 'badge bg-' . $badge);
                    }
                    $tag = ArrayHelper::getValue($toolbox, 'tag', $tag);
                    $options = ArrayHelper::getValue($toolbox, 'options', []);
                    $text = ArrayHelper::getValue($toolbox, 'text', '');
                    $icon = ArrayHelper::getValue($toolbox, 'icon');
                    if ($icon !== null) {
                        $text .= ' ' . FA::icon($icon);
                    }
                    if (($tooltip = ArrayHelper::getValue($toolbox, 'tooltip')) !== null) {
                        $options['data-toggle'] = 'tooltip';
                        $options['title'] = $tooltip;
                    }
                    echo Html::tag($tag, $text, $options);
                } else {
                    echo $toolbox;
                }
            }
            echo '</div>';
        }
        if ($this->header || !empty($this->boxTools)) {
            echo '</div>';
        }

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
        echo '</div>';
        if ($this->footer) {
            echo Html::tag('div', $this->footer, ['class' => 'box-footer']);
        }
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