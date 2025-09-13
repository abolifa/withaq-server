<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\LetterOfCredit;
use Illuminate\Auth\Access\HandlesAuthorization;

class LetterOfCreditPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:LetterOfCredit');
    }

    public function view(AuthUser $authUser, LetterOfCredit $letterOfCredit): bool
    {
        return $authUser->can('View:LetterOfCredit');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:LetterOfCredit');
    }

    public function update(AuthUser $authUser, LetterOfCredit $letterOfCredit): bool
    {
        return $authUser->can('Update:LetterOfCredit');
    }

    public function delete(AuthUser $authUser, LetterOfCredit $letterOfCredit): bool
    {
        return $authUser->can('Delete:LetterOfCredit');
    }

    public function restore(AuthUser $authUser, LetterOfCredit $letterOfCredit): bool
    {
        return $authUser->can('Restore:LetterOfCredit');
    }

    public function forceDelete(AuthUser $authUser, LetterOfCredit $letterOfCredit): bool
    {
        return $authUser->can('ForceDelete:LetterOfCredit');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:LetterOfCredit');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:LetterOfCredit');
    }

    public function replicate(AuthUser $authUser, LetterOfCredit $letterOfCredit): bool
    {
        return $authUser->can('Replicate:LetterOfCredit');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:LetterOfCredit');
    }

}