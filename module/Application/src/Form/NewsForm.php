<?php
namespace Application\Form;

use Components\Form\AbstractBaseForm;
use Laminas\Form\Element\File;
use Laminas\Form\Element\Text;
use Laminas\Form\Element\Textarea;

class NewsForm extends AbstractBaseForm
{
    public function init()
    {
        parent::init();
        
        $this->add([
            'name' => 'TITLE',
            'type' => Text::class,
            'attributes' => [
                'class' => 'form-control',
                'id' => 'TITLE',
                'placeholder' => '',
            ],
            'options' => [
                'label' => 'Title',
            ],
        ],['priority' => 100]);
        
        $this->add([
            'name' => 'BODY',
            'type' => Textarea::class,
            'attributes' => [
                'class' => 'form-control',
                'id' => 'BODY',
                'placeholder' => '',
            ],
            'options' => [
                'label' => 'Body',
            ],
        ],['priority' => 100]);
        
        $this->add([
            'name' => 'DISCLAIMER',
            'type' => Textarea::class,
            'attributes' => [
                'class' => 'form-control',
                'id' => 'DISCLAIMER',
                'placeholder' => '',
            ],
            'options' => [
                'label' => 'DISCLAIMER',
            ],
        ],['priority' => 100]);
        
        $this->add([
            'name' => 'IMAGE',
            'type' => File::class,
            'attributes' => [
                'class' => 'form-control',
                'id' => 'IMAGE',
                'placeholder' => '',
            ],
            'options' => [
                'label' => 'IMAGE',
            ],
        ],['priority' => 100]);
    }

}