<?php
/**
 * BootstrapDataColumn class file modified on Yii-Bootstrap's TDDataColumn
 * @author Lei Xiao <ailaohuyou.lei@gmail.com>
 * @copyright Copyright &copy; lei's work 2014 - 
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package bootstrap.widgets
 */

Yii::import('zii.widgets.grid.CDataColumn');

/**
 * Bootstrap grid data column.
 */
class BootstrapDataColumn extends CDataColumn
{
  /**
   * Renders the header cell content.
   * This method will render a link that can trigger the sorting if the column is sortable.
   */
  protected function renderHeaderCellContent()
  {
    if ($this->grid->enableSorting && $this->sortable && $this->name !== null)
    {
      $sort = $this->grid->dataProvider->getSort();
      $label = isset($this->header) ? $this->header : $sort->resolveLabel($this->name);

      if ($sort->resolveAttribute($this->name) !== false)
        $label .= '<span class="caret"></span>';
      $direction = $sort->getDirection($this->name);
      
      if($direction === true) {
        $class = 'sort-link dropup';
      } else {
        $class = 'sort-link';
      }
      echo $sort->link($this->name, $label, array('class'=>$class));
    }
    else
    {
      if ($this->name !== null && $this->header === null)
      {
        if ($this->grid->dataProvider instanceof CActiveDataProvider)
          echo CHtml::encode($this->grid->dataProvider->model->getAttributeLabel($this->name));
        else
          echo CHtml::encode($this->name);
      }
      else
        parent::renderHeaderCellContent();
    }
  }

  /**
   * Renders the filter cell.
   */
  public function renderFilterCell()
  {
    echo '<td><div class="filter-container">';
    $this->renderFilterCellContent();
    echo '</div></td>';
  }
}
