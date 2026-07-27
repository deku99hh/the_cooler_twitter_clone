<?php

namespace Contracts;

interface NotificationsControllerInterface 
{
    public function index();

    public function notificateFollowersForPost($author_id);

    public function notificateAuthorForLike($post_id);

    public function notificateAuthorForComments($post_id);
}