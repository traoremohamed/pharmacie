<?php

namespace Spatie\Permission\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class UnauthorizedException extends HttpException
{
    private $requiredRoles = [];

    private $requiredPermissions = [];

    public static function forRoles(array $roles): self
    {
        $message = 'Cette action n\'est pas disponible pour votre profile . Veuillez contactez l\'administrateur systeme';

        if (config('permission.display_permission_in_exception')) {
            $permStr = implode(', ', $roles);
            $message = 'L\'utilisateur n\'a pas le bon profiles. Les profiles nécessaires sont '.$permStr. 'Veuillez contactez l\'administrateur systeme' ;
        }

        $exception = new static(403, $message, null, []);
        $exception->requiredRoles = $roles;

        return $exception;
    }

    public static function forPermissions(array $permissions): self
    {
        $message = 'L\'utilisateur n\'a pas les bonnes autorisations. Veuillez contactez l\'administrateur systeme';

        if (config('permission.display_permission_in_exception')) {
            $permStr = implode(', ', $permissions);
            $message = 'L\'utilisateur n\'a pas les bonnes autorisations. Les autorisations nécessaires sont '.$permStr. 'Veuillez contactez l\'administrateur systeme' ;
        }

        $exception = new static(403, $message, null, []);
        $exception->requiredPermissions = $permissions;

        return $exception;
    }

    public static function forRolesOrPermissions(array $rolesOrPermissions): self
    {
        $message = 'L\'utilisateur ne dispose d\'aucun des droits d\'accès nécessaires. Veuillez contactez l\'administrateur systeme';

        if (config('permission.display_permission_in_exception') && config('permission.display_role_in_exception')) {
            $permStr = implode(', ', $rolesOrPermissions);
            $message = 'L\'utilisateur n\'a pas les bonnes autorisations. Les autorisations nécessaires sont '.$permStr. 'Veuillez contactez l\'administrateur systeme' ;
        }

        $exception = new static(403, $message, null, []);
        $exception->requiredPermissions = $rolesOrPermissions;

        return $exception;
    }

    public static function notLoggedIn(): self
    {
        return new static(403, 'L\'utilisateur n\'est pas connecté.', null, []);
    }

    public function getRequiredRoles(): array
    {
        return $this->requiredRoles;
    }

    public function getRequiredPermissions(): array
    {
        return $this->requiredPermissions;
    }
}
