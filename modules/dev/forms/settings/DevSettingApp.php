<?php

class DevSettingApp extends Form {

    public $name = '';
    public $dir = 'app';
    public $host = 'http://localhost';
    public $mode = 'dev';
    
    public function __construct() {
        parent::__construct();
        
        $this->attributes = Setting::get('app');
    }
    
    public function save() {
        Setting::set('app', $this->attributes);
        return true;
    }

    public function getForm() {
        return array (
            'title' => 'Application Setting',
            'layout' => array (
                'name' => '2-cols',
                'data' => array (
                    'col1' => array (
                        'size' => '200',
                        'sizetype' => 'px',
                        'type' => 'menu',
                        'name' => 'col1',
                        'file' => 'application.modules.dev.menus.Setting',
                        'icon' => 'fa-sliders',
                        'title' => 'Main Setting',
                        'menuOptions' => array (),
                    ),
                    'col2' => array (
                        'size' => '',
                        'sizetype' => '',
                        'type' => 'mainform',
                    ),
                ),
            ),
        );
    }

    public function getFields() {
        return array (
            array (
                'linkBar' => array (
                    array (
                        'label' => 'Save Setting',
                        'buttonType' => 'success',
                        'icon' => 'floppy-o',
                        'options' => array (
                            'ng-click' => 'form.submit(this)',
                        ),
                        'type' => 'LinkButton',
                    ),
                ),
                'title' => '<i class=\\"fa fa-home\\"></i> {{form.title}}',
                'showSectionTab' => 'No',
                'showOptionsBar' => 'No',
                'type' => 'ActionBar',
            ),
            array (
                'showBorder' => 'Yes',
                'column1' => array (
                    array (
                        'label' => 'Application Name',
                        'name' => 'name',
                        'type' => 'TextField',
                    ),
                    array (
                        'label' => 'Mode',
                        'name' => 'mode',
                        'list' => array (
                            'dev' => 'Development',
                            'prod' => 'Production',
                            '---' => '---',
                            'plansys' => 'Plansys Development',
                        ),
                        'type' => 'DropDownList',
                    ),
                    array (
                        'type' => 'Text',
                        'value' => '<column-placeholder></column-placeholder>',
                    ),
                ),
                'column2' => array (
                    array (
                        'label' => 'Host',
                        'name' => 'host',
                        'type' => 'TextField',
                    ),
                    array (
                        'label' => 'Main Dir',
                        'name' => 'dir',
                        'type' => 'TextField',
                    ),
                    array (
                        'type' => 'Text',
                        'value' => '<column-placeholder></column-placeholder>',
                    ),
                ),
                'w1' => '50%',
                'w2' => '50%',
                'type' => 'ColumnField',
            ),
            array (
                'type' => 'Text',
                'value' => '<hr/>',
            ),
        );
    }

}