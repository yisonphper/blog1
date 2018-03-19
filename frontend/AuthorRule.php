<?php 
namespace app\rbac;

use yii\rbac\Rule;

/**
 * 检查 authorID 是否和通过参数传进来的 user 参数相符
 */
class AuthorRule extends Rule
{
    public $name = 'isAuthor';

    /**
     * @param string|integer $user 用户 ID.
     * @param Item $item 该规则相关的角色或者权限
     * @param array $params 传给 ManagerInterface::checkAccess() 的参数
     * @return boolean 代表该规则相关的角色或者权限是否被允许
     */
    public function execute($user, $item, $params)
    {
        return isset($params['post']) ? $params['post']->createdBy == $user : false;
    }

    $auth = Yii::$app->authManager;

    // 添加规则
    $rule = new \app\rbac\AuthorRule;
    $auth->add($rule);

    // 添加 "updateOwnPost" 权限并与规则关联
    $updateOwnPost = $auth->createPermission('updateOwnPost');
    $updateOwnPost->description = '修改自己的文章';
    $updateOwnPost->ruleName = $rule->name;
    $auth->add($updateOwnPost);

    // "updateOwnPost" 权限将由 "updatePost" 权限使用
    $auth->addChild($updateOwnPost, $updatePost);

    // 允许 "author" 更新自己的帖子
    $auth->addChild($author, $updateOwnPost);
}