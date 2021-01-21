<?php
namespace Application\Model;

use Components\Model\AbstractBaseModel;
use Laminas\Filter\StringTrim;
use Laminas\Filter\StripTags;
use Laminas\InputFilter\InputFilter;

class NewsModel extends AbstractBaseModel
{
    public $TITLE;
    public $BODY;
    public $DISCLAIMER;
    public $IMAGE;
    
    public function __construct($adapter = NULL) 
    {
        parent::__construct($adapter);
        $this->setTableName('news');
    }
    
    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            
            foreach ($this->public_attributes as $var) {
                $inputFilter->add([
                    'name' => $var,
                    'required' => $this->required,
                    'filters' => [
                        ['name' => StripTags::class],
                        ['name' => StringTrim::class],
                    ],
                ]);
            }
            
            $inputFilter->add([
                'name' => 'IMAGE',
                'required' => FALSE,
                'filters' => [
                    [
                        'name' => 'FileRenameUpload',
                        'options' => [
                            'target' => './public/img/image.jpg',
                            'useUploadName' => FALSE,
                            'useUploadExtension' => FALSE,
                            'overwrite' => TRUE,
                            'randomize' => FALSE,
                        ],
                    ],
                ],
                'validators' => [
                    [
                        'name'    => 'FileMimeType',
                        'options' => [
                            'mimeType' => [
                                'image/gif',
                                'image/jpeg',
                                'image/png',
                            ],
                        ],
                    ],
                ],
            ]);
            
            $this->inputFilter = $inputFilter;
        }
        return $this->inputFilter;
    }
}