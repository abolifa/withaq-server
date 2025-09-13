<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Outgoing;
use Illuminate\Auth\Access\HandlesAuthorization;

class OutgoingPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Outgoing');
    }

    public function view(AuthUser $authUser, Outgoing $outgoing): bool
    {
        return $authUser->can('View:Outgoing');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Outgoing');
    }

    public function update(AuthUser $authUser, Outgoing $outgoing): bool
    {
        return $authUser->can('Update:Outgoing');
    }

    public function delete(AuthUser $authUser, Outgoing $outgoing): bool
    {
        return $authUser->can('Delete:Outgoing');
    }

    public function restore(AuthUser $authUser, Outgoing $outgoing): bool
    {
        return $authUser->can('Restore:Outgoing');
    }

    public function forceDelete(AuthUser $authUser, Outgoing $outgoing): bool
    {
        return $authUser->can('ForceDelete:Outgoing');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Outgoing');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Outgoing');
    }

    public function replicate(AuthUser $authUser, Outgoing $outgoing): bool
    {
        return $authUser->can('Replicate:Outgoing');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Outgoing');
    }

}