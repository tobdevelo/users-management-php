<?php

declare(strict_types=1);

final class WebRoutes
{
    /**
     * @return array<string, array<string, string>>
     */
    public static function routes(): array
    {
        return array(
            'home' => array(
                'method' => 'GET',
                'action' => 'home',
            ),
            'users.create' => array(
                'method' => 'GET',
                'action' => 'create',
            ),
            'users.store' => array(
                'method' => 'POST',
                'action' => 'store',
            ),
            'users.index' => array(
                'method' => 'GET',
                'action' => 'index',
            ),
            'users.show' => array(
                'method' => 'GET',
                'action' => 'show',
            ),
            'users.edit' => array(
                'method' => 'GET',
                'action' => 'edit',
            ),
            'users.update' => array(
                'method' => 'POST',
                'action' => 'update',
            ),
            'users.delete' => array(
                'method' => 'POST',
                'action' => 'delete',
            ),
            'noticias.create' => array(
                'method' => 'GET',
                'action' => 'noticias.create',
            ),
            'noticias.store' => array(
                'method' => 'POST',
                'action' => 'noticias.store',
            ),
            'noticias.index' => array(
                'method' => 'GET',
                'action' => 'noticias.index',
            ),
            'noticias.show' => array(
                'method' => 'GET',
                'action' => 'noticias.show',
            ),
            'noticias.edit' => array(
                'method' => 'GET',
                'action' => 'noticias.edit',
            ),
            'noticias.update' => array(
                'method' => 'POST',
                'action' => 'noticias.update',
            ),
            'noticias.delete' => array(
                'method' => 'POST',
                'action' => 'noticias.delete',
            ),
            'auth.login' => array(
                'method' => 'GET',
                'action' => 'login',
            ),
            'auth.authenticate' => array(
                'method' => 'POST',
                'action' => 'authenticate',
            ),
            'auth.logout' => array(
                'method' => 'GET',
                'action' => 'logout',
            ),
            'auth.forgot' => array(
                'method' => 'GET',
                'action' => 'forgot',
            ),
            'auth.forgot.send' => array(
                'method' => 'POST',
                'action' => 'forgot.send',
            ),
        );
    }
}