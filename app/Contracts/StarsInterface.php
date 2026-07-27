<?php

namespace Contracts;

interface StarsInterface 
{
    public function toggleStar($stars_data);

    public function getPostsWithMyStars($stars_data);
}