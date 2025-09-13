<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Incoming;
use Illuminate\Auth\Access\HandlesAuthorization;

class IncomingPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Incoming');
    }

    public function view(AuthUser $authUser, Incoming $incoming): bool
    {
        return $authUser->can('View:Incoming');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Incoming');
    }

    public function update(AuthUser $authUser, Incoming $incoming): bool
    {
        return $authUser->can('Update:Incoming');
    }

    public function delete(AuthUser $authUser, Incoming $incoming): bool
    {
        return $authUser->can('Delete:Incoming');
    }

    public function restore(AuthUser $authUser, Incoming $incoming): bool
    {
        return $authUser->can('Restore:Incoming');
    }

    public function forceDelete(AuthUser $authUser, Incoming $incoming): bool
    {
        return $authUser->can('ForceDelete:Incoming');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Incoming');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Incoming');
    }

    public function replicate(AuthUser $authUser, Incoming $incoming): bool
    {
        return $authUser->can('Replicate:Incoming');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Incoming');
    }

}