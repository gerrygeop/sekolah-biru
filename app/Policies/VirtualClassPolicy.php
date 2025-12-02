<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\VirtualClass;
use Illuminate\Auth\Access\HandlesAuthorization;

class VirtualClassPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:VirtualClass');
    }

    public function view(AuthUser $authUser, VirtualClass $virtualClass): bool
    {
        return $authUser->can('View:VirtualClass');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:VirtualClass');
    }

    public function update(AuthUser $authUser, VirtualClass $virtualClass): bool
    {
        return $authUser->can('Update:VirtualClass');
    }

    public function delete(AuthUser $authUser, VirtualClass $virtualClass): bool
    {
        return $authUser->can('Delete:VirtualClass');
    }

    public function restore(AuthUser $authUser, VirtualClass $virtualClass): bool
    {
        return $authUser->can('Restore:VirtualClass');
    }

    public function forceDelete(AuthUser $authUser, VirtualClass $virtualClass): bool
    {
        return $authUser->can('ForceDelete:VirtualClass');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:VirtualClass');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:VirtualClass');
    }

    public function replicate(AuthUser $authUser, VirtualClass $virtualClass): bool
    {
        return $authUser->can('Replicate:VirtualClass');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:VirtualClass');
    }

}