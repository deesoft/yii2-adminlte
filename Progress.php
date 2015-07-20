<?php

namespace dee\adminlte;

/**
 * Description of Progress
 *
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @since 1.0
 */
class Progress extends Widget
{
    const SIZE_NORMAL = '';
    const SIZE_SM = 'progress-sm';
    const SIZE_XS = 'progress-xs';
    const SIZE_XXS = 'progress-xxs';

    public $value;
    public $text;
    public $type;
    public $vertical;
    public $striped;
    public $size;

    public function run()
    {
        AdminlteAsset::register($this->getView());
        Html::addCssClass($this->options, ['widget' => 'progress']);
        if ($this->vertical) {
            Html::addCssClass($this->options, 'vertical');
        }
        if (!empty($this->size)) {
            Html::addCssClass($this->options, $this->size);
        }
        $barOptions = ['class' => 'progress-bar'];
        if (!empty($this->type)) {
            Html::addCssClass($barOptions, 'progress-bar-' . $this->type);
        }
        if ($this->striped) {
            Html::addCssClass($barOptions, 'progress-bar-striped');
        }
        $barOptions['style']['width']=  $this->value.'%';
        if(empty($this->text)){
            $text = '';
        }  else {
            $text = Html::tag('span', $text, ['class'=>'sr-only']);
        }

        return Html::tag('div', Html::tag('div', $text, $barOptions), $this->options);
    }
}