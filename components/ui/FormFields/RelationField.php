<?php

/**
 * Class DropDownList
 * @author rizky
 */
class RelationField extends FormField {

    /**
     * @return array me-return array property DropDown.
     */
    public function getFieldProperties() {
        return array (
            array (
                'label' => 'Field Name',
                'name' => 'name',
                'options' => array (
                    'ng-model' => 'active.name',
                    'ng-change' => 'changeActiveName()',
                    'ps-list' => 'modelFieldList',
                ),
                'list' => array (),
                'searchable' => 'Yes',
                'showOther' => 'Yes',
                'type' => 'DropDownList',
            ),
            array (
                'label' => 'Model Class',
                'name' => 'modelClass',
                'options' => array (
                    'ng-model' => 'active.modelClass',
                    'ng-change' => 'generateRelationField();save();',
                ),
                'listExpr' => 'RelationField::listModel()',
                'searchable' => 'Yes',
                'type' => 'DropDownList',
            ),
            array (
                'label' => 'ID Field',
                'name' => 'idField',
                'options' => array (
                    'ng-model' => 'active.idField',
                    'ng-change' => 'save();',
                    'ps-list' => 'relationFieldList',
                ),
                'list' => array (),
                'searchable' => 'Yes',
                'showOther' => 'Yes',
                'otherLabel' => 'Custom',
                'type' => 'DropDownList',
            ),
            array (
                'label' => 'Label Field',
                'name' => 'labelField',
                'options' => array (
                    'ng-model' => 'active.labelField',
                    'ng-change' => 'save();',
                    'ps-list' => 'relationFieldList',
                ),
                'list' => array (),
                'searchable' => 'Yes',
                'showOther' => 'Yes',
                'otherLabel' => 'Custom',
                'type' => 'DropDownList',
            ),
            array (
                'label' => 'SQL Condition',
                'fieldname' => 'condition',
                'language' => 'sql',
                'options' => array (
                    'ng-model' => 'active.condition',
                    'ng-change' => 'save()',
                    'ng-delay' => '500',
                ),
                'desc' => 'SQL Template: select * from table [condition]<br/>

Example: inner join p_user_role p on p_user.id = p.user_id {and p.role_id = [model.satker_id]} {where [search]}',
                'type' => 'ExpressionField',
            ),
            array (
                'value' => '<hr/>',
                'type' => 'Text',
            ),
            array (
                'label' => 'Include Empty',
                'name' => 'includeEmpty',
                'options' => array (
                    'ng-model' => 'active.includeEmpty',
                    'ng-change' => 'save();',
                ),
                'listExpr' => 'array(\\\'Yes\\\',\\\'No\\\')',
                'fieldWidth' => '4',
                'type' => 'DropDownList',
            ),
            array (
                'label' => 'Empty Value',
                'name' => 'emptyValue',
                'options' => array (
                    'ng-model' => 'active.emptyValue',
                    'ng-change' => 'save()',
                    'ng-show' => 'active.includeEmpty == \\\'Yes\\\'',
                    'ng-delay' => '500',
                ),
                'type' => 'TextField',
            ),
            array (
                'label' => 'Empty Label',
                'name' => 'emptyLabel',
                'options' => array (
                    'ng-model' => 'active.emptyLabel',
                    'ng-change' => 'save()',
                    'ng-show' => 'active.includeEmpty == \\\'Yes\\\'',
                    'ng-delay' => '500',
                ),
                'type' => 'TextField',
            ),
            array (
                'value' => '<hr/>',
                'type' => 'Text',
            ),
            array (
                'label' => 'Label',
                'name' => 'label',
                'options' => array (
                    'ng-model' => 'active.label',
                    'ng-change' => 'save()',
                    'ng-delay' => 500,
                ),
                'type' => 'TextField',
            ),
            array (
                'label' => 'Layout',
                'name' => 'layout',
                'options' => array (
                    'ng-model' => 'active.layout',
                    'ng-change' => 'save();',
                ),
                'listExpr' => 'array(\\\'Horizontal\\\',\\\'Vertical\\\')',
                'fieldWidth' => '6',
                'type' => 'DropDownList',
            ),
            array (
                'label' => 'Searchable',
                'name' => 'searchable',
                'options' => array (
                    'ng-model' => 'active.searchable',
                    'ng-change' => 'save()',
                ),
                'listExpr' => 'array(\\"Yes\\",\\"No\\")',
                'fieldWidth' => '4',
                'type' => 'DropDownList',
            ),
            array (
                'value' => '<hr/>',
                'type' => 'Text',
            ),
            array (
                'totalColumns' => '4',
                'column1' => array (
                    array (
                        'value' => '<column-placeholder></column-placeholder>',
                        'type' => 'Text',
                    ),
                ),
                'column2' => array (
                    array (
                        'label' => 'Label Width',
                        'name' => 'labelWidth',
                        'layout' => 'Vertical',
                        'labelWidth' => '12',
                        'fieldWidth' => '11',
                        'options' => array (
                            'ng-model' => 'active.labelWidth',
                            'ng-change' => 'save()',
                            'ng-delay' => 500,
                            'ng-disabled' => 'active.layout == \\\'Vertical\\\'',
                        ),
                        'type' => 'TextField',
                    ),
                    array (
                        'value' => '<column-placeholder></column-placeholder>',
                        'type' => 'Text',
                    ),
                ),
                'column3' => array (
                    array (
                        'label' => 'Field Width',
                        'name' => 'fieldWidth',
                        'layout' => 'Vertical',
                        'labelWidth' => '12',
                        'fieldWidth' => '11',
                        'options' => array (
                            'ng-model' => 'active.fieldWidth',
                            'ng-change' => 'save()',
                            'ng-delay' => 500,
                        ),
                        'type' => 'TextField',
                    ),
                    array (
                        'value' => '<column-placeholder></column-placeholder>',
                        'type' => 'Text',
                    ),
                ),
                'type' => 'ColumnField',
            ),
            array (
                'label' => 'Options',
                'fieldname' => 'options',
                'type' => 'KeyValueGrid',
            ),
            array (
                'label' => 'Label Options',
                'fieldname' => 'labelOptions',
                'type' => 'KeyValueGrid',
            ),
            array (
                'label' => 'Field Options',
                'fieldname' => 'fieldOptions',
                'type' => 'KeyValueGrid',
            ),
        );
    }

    /** @var string $label */
    public $label = '';

    /** @var string $name */
    public $name = '';
    public $condition = '';

    /** @var string $value digunakan pada function checked */
    public $value = '';

    /** @var array $options */
    public $options = array();

    /** @var array $fieldOptions */
    public $fieldOptions = array();

    /** @var array $labelOptions */
    public $labelOptions = array();

    /** @var string $list */
    public $list = '';

    /** @var string $listExpr digunakan pada function processExpr */
    public $listExpr = '';
    public $includeEmpty = 'No';
    public $emptyValue = '';
    public $emptyLabel = '-- NONE --';

    /** @var string $layout */
    public $layout = 'Horizontal';

    /** @var integer $labelWidth */
    public $labelWidth = 4;

    /** @var integer $fieldWidth */
    public $fieldWidth = 8;

    /** @var string $searchable */
    public $searchable = 'No';

    /** @var string $showOther */
    public $showOther = 'No';

    /** @var string $otherLabel */
    public $otherLabel = 'Lainnya';
    public $modelClass = '';
    public $idField = '';
    public $labelField = '';
    public $watchParams = array();

    /** @var string $toolbarName */
    public static $toolbarName = "Relation Field";

    /** @var string $category */
    public static $category = "User Interface";

    /** @var string $toolbarIcon */
    public static $toolbarIcon = "fa fa-link";

    /**
     * @return array me-return array javascript yang di-include
     */
    public function includeJS() {
        return array('relation-field.js');
    }

    public function actionDgrInit() {
        $postdata = file_get_contents("php://input");
        $post = CJSON::decode($postdata);
        extract($post);

        $return = array();
        foreach ($post as $alias=>$fields) {
            $return[$alias] = array();
            foreach ($fields as $column=>$field) {
                Yii::import($alias);
                $class = array_pop(explode(".", $alias));
                $table = $class::model()->tableName();

                $ids = implode(", ", $field);
                $sql = "select * from {$table} where {$column} IN ({$ids})";

                $return[$alias][$column] = array();

                $result = Yii::app()->db->createCommand($sql)->queryAll();
                foreach ($result as $i=>$r) {
                    $return[$alias][$column][$result[$i][$column]] = $result[$i];
                }
            }
        }
        echo json_encode($return);
    }

    public function actionDgrSearch() {
        $postdata = file_get_contents("php://input");
        $post = CJSON::decode($postdata);
        extract($post);
        
        $fb = FormBuilder::load($m);
        $field = $fb->findField(array('name' => $f));
        
        foreach($field['columns'] as $column) {
            if ($c == $column['name']) {
                $this->modelClass = $column['relModelClass'];
                $this->idField = $column['relIdField'];
                $this->labelField = $column['relLabelField'];
                $this->condition = @$column['relCondition'];
            }
        }
        $this->builder = $fb;

        $params = array();
        foreach ($rf as $k => $v) {
            $params['row.' . $k] = $v;
        }
        foreach ($mf as $k => $v) {
            $params['model.' . $k] = $v;
        }
        
        
        echo json_encode($this->query(@$s, $params));
    }
    
    public function actionSearch() {
        $postdata = file_get_contents("php://input");
        $post = CJSON::decode($postdata);
        extract($post);

        $fb = FormBuilder::load($m);
        $field = $fb->findField(array('name' => $f));
        $this->attributes = $field;
        $this->builder = $fb;

        if (isset($mf['id']) > 0) {
            $this->model->findByPk($mf['id']);
        }

        $params = array();
        foreach ($mf as $k => $v) {
            $params['model.' . $k] = $v;
        }

        echo json_encode($this->query($s, $params));
    }

    public function generateCondition($search = '', &$jsparams = array()) {
        preg_match_all("/\[(.*?)\]/", $this->condition, $blocks);
        preg_match_all("/\{(.*?)\}/", $this->labelField, $fields);
        $sql = $this->condition;

        if ($search != '') {
            if (count($fields[1]) == 0) {
                $fields[1] = [$this->labelField];
            }

            if (count($blocks[1]) == 0) {
                $blocks[1] = ['search'];
                $sql = "where [search]";
            }
        }

        ## generate parameters
        $params = array();
        foreach ($blocks[1] as $k => $block) {
            $cond = '';

            ## usage: "where [search]", [search] = search term
            if (strpos($block, 'search') !== false) {
                if ($search != '') {
                    if (strpos($this->labelField, '{') !== false) {
                        $sqlcond = "CONCAT(" . implode(",", $fields[1]) . ")" . ' like ' . "[{$block}]";
                    } else {
                        $sqlcond = $this->labelField . ' like ' . "[{$block}]";
                    }
                    $sql = str_replace("[search]", $sqlcond, $sql);
                    $params[$block] = "%{$search}%";
                } else {
                    $params[$block] = null;
                }
            }

            ## usage: "where user_id = {$model->id}",  $model = current form activerecord
            else if (strpos($block, '$model') !== false) {
                preg_match("/\\\$model->[\w_]+/", $block, $modelVar);
                foreach ($modelVar as $v) {
                    $val = $this->evaluate("\"{$v}\"", true);
                    if ($val == '') {
                        $cond = '';
                    } else {
                        $cond = $val;
                    }
                }
                $params[$block] = $cond;
            }

            ## usage: "where user_id = {model.id}", model = current angularjs model value
            else if (strpos($block, '.') !== false) {
                $cond = @$jsparams[$block];
                $this->watchParams[] = $block;
                $params[$block] = $cond;
            }
        }

        ## remove empty-valued conditional curly braces
        preg_match_all("/\{(.*?)\}/", $sql, $curlies);
        foreach ($curlies[0] as $c => $curly) {
            foreach ($params as $k => $p) {
                if (strpos($curly, '[' . $k . ']') !== false) {
                    if (!$p) {
                        $sql = str_replace($curly, '', $sql);
                        unset($params[$k]);
                    } else {
                        $sql = str_replace($curly, $curlies[1][$c], $sql);
                    }
                }
            }
        }

        ## assemble parameters
        $i = 0;
        $returnParams = array();
        foreach ($params as $k => $p) {
            $returnParams[':param_' . $i] = $p;
            $sql = str_replace('[' . $k . ']', ':param_' . $i, $sql);
            $i++;
        }

        return array(
            'sql' => $sql,
            'params' => $returnParams
        );
    }

    public function query($search = '', $params = array()) {
        Yii::import($this->modelClass);
        $class = array_pop(explode(".", $this->modelClass));
        $model = new $class;
        $table = $model->tableName();
        $list = array();

        $condition = $this->generateCondition($search, $params);
        $limit = ($search == '' ? 'limit 30' : 'limit 100');
        $sql = "select t.* from {$table} t {$condition['sql']} {$limit}";

        $rawlist = Yii::app()->db->createCommand($sql)->queryAll(true, $condition['params']);

        foreach ($rawlist as $k => $i) {
            $included = true;
            if ($included) {
                $field = array_keys($i);

                if (in_array($this->idField, $field)) {
                    $value = $i[$this->idField];
                } else {
                    $value = $this->evaluate("\"" . str_replace("{", "{\$", $this->idField) . "\"", true, $i);
                }

                if (in_array($this->labelField, $field)) {
                    $label = $i[$this->labelField];
                } else {
                    $label = $this->evaluate("\"" . str_replace("{", "{\$", $this->labelField) . "\"", true, $i);
                }

                $list[] = array(
                    'value' => $value,
                    'label' => $label
                );
            }
        }

        if ($this->includeEmpty == 'Yes') {
            if (count($list) > 0) {
                array_unshift($list, array(
                    'value' => '---',
                    'label' => '---'
                ));
            }
            array_unshift($list, array(
                'value' => $this->emptyValue,
                'label' => $this->emptyLabel
            ));
        }

        $this->list = $list;
        return $list;
    }

    public function actionListField() {
        if (!@$_GET['class']) {
            echo json_encode(array());
            die();
        }

        $class = $_GET['class'];

        Yii::import($class);
        $class = array_pop(explode(".", $class));
        $model = new $class;
        $data = array();
        if (is_subclass_of($model, 'ActiveRecord')) {
            $formType = "ActiveRecord";
            $data = $class::model()->attributesList;
            unset($data['Relations']);
            unset($data['Properties']);
        } else if (is_subclass_of($model, 'FormField')) {
            $formType = "FormField";
            $mf = new $class;
            $data = $mf->attributes;
            unset($data['type']);
        } else if (is_subclass_of($model, 'Form')) {
            $formType = "Form";
            $mf = new $class;
            $data = $mf->attributes;
            unset($data['type']);
        }

        echo json_encode($data);
    }

    public static function listModel() {

        $devDir = Yii::getPathOfAlias("application.models");
        $appDir = Yii::getPathOfAlias("app.models");

        $devItems = glob($devDir . DIRECTORY_SEPARATOR . "*");
        $appItems = glob($appDir . DIRECTORY_SEPARATOR . "*");

        $items = array();
        foreach ($appItems as $k => $m) {
            $m = str_replace($appDir . DIRECTORY_SEPARATOR, "", $m);
            $m = str_replace('.php', "", $m);

            $items['Application']['app.models.' . $m] = $m;
        }


        foreach ($devItems as $k => $m) {
            $m = str_replace($devDir . DIRECTORY_SEPARATOR, "", $m);
            $m = str_replace('.php', "", $m);

            $items['Plansys']['application.models.' . $m] = $m;
        }

        return $items;
    }

    /**
     * checked
     * Fungsi ini untuk mengecek value dari field
     * @param string $value
     * @return boolean me-return true atau false
     */
    public function checked($value) {
        if ($this->value == $value)
            return true;
        else
            return false;
    }

    /**
     * getLayoutClass
     * Fungsi ini akan mengecek nilai property $layout untuk menentukan nama Class Layout
     * @return string me-return string Class layout yang digunakan
     */
    public function getLayoutClass() {
        return ($this->layout == 'Vertical' ? 'form-vertical' : '');
    }

    /**
     * @return string me-return string Class error jika terdapat error pada satu atau banyak attribute.
     */
    public function getErrorClass() {
        return (count($this->errors) > 0 ? 'has-error has-feedback' : '');
    }

    /**
     * getlabelClass
     * Fungsi ini akan mengecek $layout untuk menentukan layout yang digunakan
     * dan meload option label dari property $labelOptions
     * @return string me-return string Class label
     */
    public function getlabelClass() {
        if ($this->layout == 'Vertical') {
            $class = "control-label col-sm-12";
        } else {
            $class = "control-label col-sm-{$this->labelWidth}";
        }

        $class .= @$this->labelOptions['class'];
        return $class;
    }

    /**
     * getFieldColClass
     * Fungsi ini untuk menetukan width field
     * @return string me-return string class
     */
    public function getFieldColClass() {
        return "col-sm-" . $this->fieldWidth;
    }

    /**
     * @return string me-return string class
     */
    public function getFieldClass() {
        return "btn-group btn-block";
    }

    /**
     * render
     * Fungsi ini untuk me-render field dan atributnya
     * @return mixed me-return sebuah field DropDownList dari hasil render
     */
    public function render() {
        $this->addClass('form-group form-group-sm', 'options');
        $this->addClass($this->layoutClass, 'options');
        $this->addClass($this->errorClass, 'options');

        $this->addClass('btn dropdown-toggle btn-sm btn-block btn-dropdown-field', 'fieldOptions');
        $btn_class = ['btn-primary', 'btn-default', 'btn-success', 'btn-danger', 'btn-warning'];
        if (!in_array($this->fieldOptions['class'], $btn_class)) {
            $this->addClass('btn-default', 'fieldOptions');
        }

        $this->setDefaultOption('ng-model', "model.{$this->originalName}", $this->options);

        $this->query();
        return $this->renderInternal('template_render.php');
    }

}