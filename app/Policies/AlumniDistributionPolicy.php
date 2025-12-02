<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\AlumniDistribution;
use Illuminate\Auth\Access\HandlesAuthorization;

class AlumniDistributionPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:AlumniDistribution');
    }

    public function view(AuthUser $authUser, AlumniDistribution $alumniDistribution): bool
    {
        return $authUser->can('View:AlumniDistribution');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:AlumniDistribution');
    }

    public function update(AuthUser $authUser, AlumniDistribution $alumniDistribution): bool
    {
        return $authUser->can('Update:AlumniDistribution');
    }

    public function delete(AuthUser $authUser, AlumniDistribution $alumniDistribution): bool
    {
        return $authUser->can('Delete:AlumniDistribution');
    }

    public function restore(AuthUser $authUser, AlumniDistribution $alumniDistribution): bool
    {
        return $authUser->can('Restore:AlumniDistribution');
    }

    public function forceDelete(AuthUser $authUser, AlumniDistribution $alumniDistribution): bool
    {
        return $authUser->can('ForceDelete:AlumniDistribution');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:AlumniDistribution');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:AlumniDistribution');
    }

    public function replicate(AuthUser $authUser, AlumniDistribution $alumniDistribution): bool
    {
        return $authUser->can('Replicate:AlumniDistribution');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:AlumniDistribution');
    }

}