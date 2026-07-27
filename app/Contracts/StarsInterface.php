<?php

namespace Contracts;

interface StarsInterface 
{
    public function toggle_star($stars_data);

    public function getPostsWithMyStars($stars_data);
}