<?php
/**
 * BootstrapGridView class file modified on Yii-Bootstrap's TDGridView.
 * @author Lei Xiao <ailaohuyou.lei@gmail.com>
 * @copyright Copyright &copy; lei's work 2014 - 
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package bootstrap.widgets
 */

Yii::import('zii.widgets.grid.CGridView');
// Yii::import('bootstrap.widgets.TbDataColumn');

/**
 * Just Bootstrap grid view extend from Zii grid view.
 */
class BootstrapGridView extends CGridView
{

  /**
   * @var string bootstrap table classes, see here:http://getbootstrap.com/css/#tables
   */
  public $tableClasses = 'table table-striped table-bordered table-hover table-condensed';
  /**
   * @var string the CSS class name for the pager container. Defaults to 'pagination'.
   */
  public $pagerCssClass = 'pagination-div';

  public $pager=array(
    'class'=>'CLinkPager',

    'header' => '',
    'firstPageLabel' => '&lt;&lt; First',
    'nextPageLabel' => 'Next &gt;',
    'prevPageLabel' => '&lt; Prev',
    'lastPageLabel' => 'Last &gt;&gt;',
    'htmlOptions' => array('class' => 'pagination pagination-xs'),
    'selectedPageCssClass' => 'active'

  );

  public $cssFile = false;

  public $summaryCssClass='summary pull-right';

  /**
   * Initializes the widget.
   */
  public function init()
  {
    parent::init();

    $classes = array('table');
    $this->itemsCssClass = $this->tableClasses;
  }

  /**
   * Creates column objects and initializes them.
   */
  protected function initColumns()
  {
    foreach ($this->columns as $i => $column)
    {
      if (is_array($column) && !isset($column['class']))
        $this->columns[$i]['class'] = 'bootstrap.widgets.BootstrapDataColumn';
    }

    parent::initColumns();
  }

  /**
   * Creates a column based on a shortcut column specification string.
   * @param mixed $text the column specification string
   * @return \TbDataColumn|\CDataColumn the column instance
   * @throws CException if the column format is incorrect
   */
  protected function createDataColumn($text)
  {
    if (!preg_match('/^([\w\.]+)(:(\w*))?(:(.*))?$/', $text, $matches))
      throw new CException(Yii::t('zii', 'The column must be specified in the format of "Name:Type:Label", where "Type" and "Label" are optional.'));

    $column = new BootstrapDataColumn($this);
    $column->name = $matches[1];

    if (isset($matches[3]) && $matches[3] !== '')
      $column->type = $matches[3];

    if (isset($matches[5]))
      $column->header = $matches[5];

    return $column;
  }
}
