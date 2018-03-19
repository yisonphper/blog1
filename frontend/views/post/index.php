<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\db\ActiveRecord;
use yii\widgets\ListView;
use frontend\components\TagsCloudWidget;
use frontend\components\RctReplyWidget;
use common\models\Post;
use yii\caching\DbDependency;

$this->title = '首页';
?>


<div class="container">
    
    <div class="row">

        <div class="col-md-9">

        <ol class="breadcrumb">
        <li><a href="<?= Yii::$app->homeUrl; ?>">首页</a></li>
        <li>文章列表</li>
        </ol>

        
        <?= ListView::widget([
                'id'=>'postList',
                'dataProvider'=>$dataProvider,
                'itemView'=>'_listitem',//子视图，显示一篇文章的标题等内容，
                'layout'=>'{items} {pager}',
                'pager'=>[
                        'maxButtonCount'=>10,
                        'nextPageLabel'=>Yii::t('app','下一页'),
                        'prevPageLabel'=>Yii::t('app','上一页'),
                ],
        ])?>
        </div>


        <div  class="col-md-3">
            <div class="searchbox">
                <ul class="list-group">
                    <li class="list-group-item">
                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span> 查找文章
                    
                    <?php 
                    //使用数据缓存
                    /*
                    $data = Yii::$app->cache->get('postcount');

                    $dependency = new DbDependency(['sql'=>'select count(id) from post']);

                    if($data === false){
                        $data = Post::find()->count();
                        Yii::$app->cache->set('postcount',$data,60,$dependency);
                    }
                    echo $data;
                    */

                    ?>
                    

                    </li>
                    <li class="list-group-item">
                    <form class="form-inline" action="<?= Url::to(['post/index']) ?>" id="w0" method="get" >
                        <div class="form-group">
                        <input type="text" class="form-control" name="PostSearch[title]" id="w0input" placeholder="按标题"> 
                        </div>               
                        <button type="submit" class="btn btn-default" >搜索</button>                       
                    </form>
                    </li>
                </ul>
            </div>

            <div class="tagcloudbox">
                <ul class="list-group">
                    <li class="list-group-item">
                    <span class="glyphicon glyphicon-tags" aria-hidden="true"></span> 标签云
                    </li>
                    <li class="list-group-item">
                    <?= TagsCloudWidget::widget(['tags'=>$tags]) ?>
                    </li>
                </ul>
            </div>

            <div class="commentbox">
                <ul class="list-group">
                    <li class="list-group-item">
                    <span class="glyphicon glyphicon-comment" aria-hidden="true"></span> 最新回复
                    </li>
                    <li class="list-group-item">
                    <?= RctReplyWidget::widget(['recentComments'=>$recentComments]) ?>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</div>