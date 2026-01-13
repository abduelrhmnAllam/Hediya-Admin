<?php

namespace App\Listeners;

use Spatie\Permission\Events\RoleAssigned;
use Spatie\Permission\Events\RoleRemoved;
use Spatie\Permission\Events\PermissionAssigned;
use Spatie\Permission\Events\PermissionRemoved;

class LogAdminAuthorizationChanges
{
    public function handle($event): void
    {
        $actor = auth()->user();

        if (! $actor) {
            return;
        }

        if ($event instanceof RoleAssigned) {
            activity('authorization')
                ->causedBy($actor)
                ->performedOn($event->model)
                ->withProperties([
                    'role' => $event->role->name,
                ])
                ->log('role_assigned');
        }

        if ($event instanceof RoleRemoved) {
            activity('authorization')
                ->causedBy($actor)
                ->performedOn($event->model)
                ->withProperties([
                    'role' => $event->role->name,
                ])
                ->log('role_removed');
        }

        if ($event instanceof PermissionAssigned) {
            activity('authorization')
                ->causedBy($actor)
                ->performedOn($event->model)
                ->withProperties([
                    'permission' => $event->permission->name,
                ])
                ->log('permission_assigned');
        }

        if ($event instanceof PermissionRemoved) {
            activity('authorization')
                ->causedBy($actor)
                ->performedOn($event->model)
                ->withProperties([
                    'permission' => $event->permission->name,
                ])
                ->log('permission_removed');
        }
    }
}
