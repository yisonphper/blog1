<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // 添加 "createPost" 权限
        $createPost = $auth->createPermission('createPost');
        $createPost->description = '新增文章';
        $auth->add($createPost);

        // 添加 "updatePost" 权限
        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description = '修改文章';
        $auth->add($updatePost);

        // 添加 "deletePost" 权限
        $deletePost = $auth->createPermission('deletePost');
        $deletePost->description = '删除文章';
        $auth->add($deletePost);
        
        // 添加 "approveComment" 权限
        $approveComment = $auth->createPermission('approveComment');
        $approveComment->description = '审核评论';
        $auth->add($approveComment);

         // 添加 "updatePost" 权限
        $updateComment = $auth->createPermission('updateComment');
        $updateComment->description = '修改评论';
        $auth->add($updateComment);

        // 添加 "deletePost" 权限
        $deleteComment = $auth->createPermission('deleteComment');
        $deleteComment->description = '删除评论';
        $auth->add($deleteComment);


        // 添加 "postadmin" 角色并赋予 "updatePost" “deletePost” “createPost”
        $postAdmin = $auth->createRole('postAdmin');
        $postAdmin->description = '文章管理员';
        $auth->add($postAdmin);
        $auth->addChild($postAdmin, $updatePost);
        $auth->addChild($postAdmin, $createPost);
        $auth->addChild($postAdmin, $deletePost);
        
        
        // 添加 "commentAuditor" 角色并赋予  “approveComment”
        $commentAuditor = $auth->createRole('commentAuditor');
        $commentAuditor->description = '评论审核员';
        $auth->add($commentAuditor);
        $auth->addChild($commentAuditor, $approveComment);
        $auth->addChild($commentAuditor, $updateComment);
        $auth->addChild($commentAuditor, $deleteComment);

        // 添加 "admin" 角色并赋予所有其他角色拥有的权限
        $admin = $auth->createRole('admin');
        $admin->description = '系统管理员';
        $auth->add($admin);
        $auth->addChild($admin, $postAdmin);
        $auth->addChild($admin, $commentAuditor);

        // 添加 "author" 角色并赋予 “createPost”
        $postAdmin = $auth->createRole('author');
        $postAdmin->description = '作者';
        $auth->add($postAdmin);
        $auth->addChild($postAdmin, $createPost);
    }
}