<?php

namespace App\Service;

use App\Entity\Admin;
use App\Entity\Roles;
use App\Entity\User;
use App\Repository\AdminRepository;
use App\Repository\UserRepository;

class AdminService
{
    public function __construct(private AdminRepository $admin, private UserRepository $userR){}

public function makeAdmin(User $user)
{
    array_push($user->getRoles(), Roles::ADM);
    $admin = new Admin($user);
    $this->userR->delete($user);
    $this->admin->save($admin);
}


}