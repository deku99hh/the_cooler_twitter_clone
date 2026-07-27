<?php

use Core\Container;

Container::bind(
    Contracts\FollowsInterface::class, 
    Models\follows::class
);

Container::bind(
    Contracts\UserInterface::class, 
    Models\user::class
);
Container::bind(
    Contracts\CommentsInterface::class, 
    Models\comments::class
);
Container::bind(
    Contracts\LikesInterface::class, 
    Models\likes::class
);
Container::bind(
    Contracts\NotificationsInterface::class, 
    Models\notifications::class
);
Container::bind(
    Contracts\PostsInterface::class, 
    Models\posts::class
);
Container::bind(
    Contracts\ProfileInterface::class, 
    Models\profile::class
);
Container::bind(
    Contracts\SearchInterface::class, 
    Models\search::class
);
Container::bind(
    Contracts\StarsInterface::class, 
    Models\stars::class
);
Container::bind(
    Contracts\ValInterface::class, 
    Models\val::class
);

Container::bind(
    Contracts\NotificationsControllerInterface::class, 
    Controllers\NotificationsController::class
);

Container::bind(
    Contracts\AuthServiceInterface::class, 
    Services\AuthService::class
);
