<?php  
namespace frontend\components;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;

class TagsCloudWidget extends Widget
{
	public $tags;

	public function init()
	{
		parent::init();
	}

	public function run()
	{
		$tagString="";
		$fontStyle=array("6"=>"danger",
			"5"=>"info",
			"4"=>"warning",
			"3"=>"primary",
			"2"=>"success",
			);

		foreach ($this->tags as $tag => $weight) {
			$tagString.='<a href="'.Url::to(['post/index','PostSearch[tags]'=>$tag]).'">'.' <h'.$weight.' style="display:inline-block;"><span class="label label-'
					.$fontStyle[$weight].'">'.$tag.'</span></h'.$weight.'></a>';
		}

		return $tagString;
	}
}
