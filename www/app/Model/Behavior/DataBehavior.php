<?php
/**
 * Behavior for binding management.
 *
 * Behavior to simplify manipulating a model's bindings when doing a find operation
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Model.Behavior
 * @since         CakePHP(tm) v 1.2.0.5669
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('ModelBehavior', 'Model');

/**
 * Behavior to allow for dynamic and atomic manipulation of a Model's associations
 * used for a find call. Most useful for limiting the amount of associations and
 * data returned.
 *
 * @package       Cake.Model.Behavior
 * @link http://book.cakephp.org/2.0/en/core-libraries/behaviors/containable.html
 */
class DataBehavior extends ModelBehavior {

    public function afterFind(Model $Model, $results, $primary = false)
    {
        foreach($results as $nb => $node)
        {
            foreach(array('to_data','from_data','databuilding_id') as $direction){
                if(isset($results[$nb][$Model->name][$direction])){
                    $results[$nb][$Model->name][$direction.'_lvl'] = $this->toLvl($results[$nb][$Model->name][$direction]);
                    $results[$nb][$Model->name][$direction.'_type'] = $this->toType($results[$nb][$Model->name][$direction]);
                }
            }
        }
        return $results;
    }

    private function toLvl($data_id){
        $data_id /= 100;
        return ($data_id - floor($data_id)) *100;
    }

    private function toType($data_id){
        $data_id /= 100;
        return floor($data_id);
    }

}
