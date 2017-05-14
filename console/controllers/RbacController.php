<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager; // authManager组件

        // add "createPost" permission
        $createPost = $auth->createPermission('createPost');
        $createPost->description = '创建文章';
        $auth->add($createPost);

        // add "updatePost" permission
        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description = '修改文章';
        $auth->add($updatePost);

        $deletePost = $auth->createPermission('deletePost');
        $deletePost->description = '删除文章';
        $auth->add($deletePost);

        $approveComment = $auth->createPermission('approveComment');
        $approveComment->description = '审核评论';
        $auth->add($approveComment);

        // add "author" role and give this role the "createPost" permission
        $postAdmin = $auth->createRole('postAdmin');
        $postAdmin->description = '文章管理员';
        $auth->add($postAdmin);
        $auth->addChild($postAdmin, $createPost);
        $auth->addChild($postAdmin, $updatePost);
        $auth->addChild($postAdmin, $deletePost);

        $postOperator = $auth->createRole('postOperator');
        $postOperator->description = '文章操作员';
        $auth->add($postOperator);
        $auth->addChild($postOperator, $deletePost);

        $commentAuditor = $auth->createRole('commentAuditor');
        $commentAuditor->description = '评论审核员';
        $auth->add($commentAuditor);
        $auth->addChild($commentAuditor, $approveComment);

        // add "admin" role and give this role the "updatePost" permission
        // as well as the permissions of the "author" role
        $admin = $auth->createRole('admin');
        $admin->description = '系统管理员';
        $auth->add($admin);
        $auth->addChild($admin, $postAdmin);
        $auth->addChild($admin, $commentAuditor);

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        $auth->assign($admin, 1);
        $auth->assign($postAdmin, 2);
        $auth->assign($commentAuditor, 3);
        $auth->assign($postOperator, 4);
    }
}
