<?php

namespace Contracts;

interface ProfileInterface 
{
    public function update($userId, $name, $links, $about_text, $birthday);
}