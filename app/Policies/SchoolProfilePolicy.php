<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\SchoolProfile;
use Illuminate\Auth\Access\HandlesAuthorization;

class SchoolProfilePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:SchoolProfile');
    }

    public function view(AuthUser $authUser, SchoolProfile $schoolProfile): bool
    {
        return $authUser->can('View:SchoolProfile');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:SchoolProfile');
    }

    public function update(AuthUser $authUser, SchoolProfile $schoolProfile): bool
    {
        return $authUser->can('Update:SchoolProfile');
    }

    public function delete(AuthUser $authUser, SchoolProfile $schoolProfile): bool
    {
        return $authUser->can('Delete:SchoolProfile');
    }

    public function restore(AuthUser $authUser, SchoolProfile $schoolProfile): bool
    {
        return $authUser->can('Restore:SchoolProfile');
    }

    public function forceDelete(AuthUser $authUser, SchoolProfile $schoolProfile): bool
    {
        return $authUser->can('ForceDelete:SchoolProfile');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:SchoolProfile');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:SchoolProfile');
    }

    public function replicate(AuthUser $authUser, SchoolProfile $schoolProfile): bool
    {
        return $authUser->can('Replicate:SchoolProfile');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:SchoolProfile');
    }

}