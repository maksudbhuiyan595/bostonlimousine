<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\MainPage;
use Illuminate\Auth\Access\HandlesAuthorization;

class MainPagePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:MainPage');
    }

    public function view(AuthUser $authUser, MainPage $mainPage): bool
    {
        return $authUser->can('View:MainPage');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:MainPage');
    }

    public function update(AuthUser $authUser, MainPage $mainPage): bool
    {
        return $authUser->can('Update:MainPage');
    }

    public function delete(AuthUser $authUser, MainPage $mainPage): bool
    {
        return $authUser->can('Delete:MainPage');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:MainPage');
    }

    public function restore(AuthUser $authUser, MainPage $mainPage): bool
    {
        return $authUser->can('Restore:MainPage');
    }

    public function forceDelete(AuthUser $authUser, MainPage $mainPage): bool
    {
        return $authUser->can('ForceDelete:MainPage');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:MainPage');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:MainPage');
    }

    public function replicate(AuthUser $authUser, MainPage $mainPage): bool
    {
        return $authUser->can('Replicate:MainPage');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:MainPage');
    }

}