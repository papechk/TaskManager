<?php
/** @noinspection ALL */
/**
 * Laravel IDE Helper - Stub file for facades and helpers
 * This file provides IDE autocomplete support for Laravel
 * @phpstan-ignore-file
 */

namespace {
    if (false) {
        /**
         * @see \Illuminate\View\Factory
         * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
         */
        function view($view = null, $data = [], $mergeData = []) {
            exit;
        }

        /**
         * @see \Illuminate\Routing\Redirector
         * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
         */
        function redirect($to = null, $status = 302, $headers = [], $secure = null) {
            exit;
        }

        /**
         * @see \Illuminate\Session\SessionManager
         * @return \Illuminate\Session\SessionManager|\Illuminate\Session\Store
         */
        function session($key = null, $default = null) {
            exit;
        }

        /**
         * @see \Illuminate\Foundation\Application
         */
        function app($abstract = null, array $parameters = []) {
            exit;
        }

        /**
         * @see \Illuminate\Config\Repository
         */
        function config($key = null, $default = null) {
            exit;
        }

        /**
         * @see \Illuminate\Http\Request
         */
        function request($key = null, $default = null) {
            exit;
        }

        /**
         * @see \Illuminate\Auth\AuthManager
         */
        function auth($guard = null) {
            exit;
        }

        /**
         * @see \Illuminate\Routing\UrlGenerator
         */
        function route($name, $parameters = [], $absolute = true) {
            exit;
        }

        /**
         * @see \Illuminate\Routing\UrlGenerator
         */
        function url($path = null, $parameters = [], $secure = null) {
            exit;
        }

        /**
         * @see \Illuminate\Foundation\helpers.php
         */
        function old($key = null, $default = null) {
            exit;
        }

        /**
         * @see \Illuminate\Foundation\helpers.php
         */
        function csrf_token() {
            exit;
        }

        /**
         * @see \Illuminate\Foundation\helpers.php
         */
        function csrf_field() {
            exit;
        }

        /**
         * @see \Illuminate\Foundation\helpers.php
         */
        function method_field($method) {
            exit;
        }

        /**
         * @see \Illuminate\Foundation\helpers.php
         */
        function abort($code, $message = '', array $headers = []) {
            exit;
        }

        /**
         * @see \Illuminate\Foundation\helpers.php
         */
        function back($status = 302, $headers = [], $fallback = false) {
            exit;
        }

        /**
         * @see \Illuminate\Foundation\helpers.php
         */
        function bcrypt($value, $options = []) {
            exit;
        }

        /**
         * @see \Illuminate\Foundation\helpers.php
         */
        function response($content = '', $status = 200, array $headers = []) {
            exit;
        }
    }
}

namespace Illuminate\Support\Facades {
    /**
     * @method static \Illuminate\Contracts\Auth\Guard|\Illuminate\Contracts\Auth\StatefulGuard guard(string|null $name = null)
     * @method static int|string|null id()
     * @method static \Illuminate\Contracts\Auth\Authenticatable|null user()
     * @method static bool check()
     * @method static bool guest()
     * @method static bool attempt(array $credentials = [], bool $remember = false)
     * @method static void login(\Illuminate\Contracts\Auth\Authenticatable $user, bool $remember = false)
     * @method static void logout()
     */
    class Auth {}

    /**
     * @method static bool allows(string $ability, array|mixed $arguments = [])
     * @method static bool denies(string $ability, array|mixed $arguments = [])
     * @method static bool check(string $ability, array|mixed $arguments = [])
     * @method static \Illuminate\Auth\Access\Gate define(string $ability, callable|string $callback)
     */
    class Gate {}

    /**
     * @method static \Illuminate\Database\Eloquent\Builder where($column, $operator = null, $value = null, $boolean = 'and')
     * @method static \Illuminate\Database\Eloquent\Builder orWhere($column, $operator = null, $value = null)
     */
    class DB {}

    /**
     * @method static void to(string|array $users)
     * @method static void send(\Illuminate\Mail\Mailable $mailable)
     */
    class Mail {}
}

namespace Illuminate\Database\Eloquent {
    /**
     * @method static \Illuminate\Database\Eloquent\Builder where($column, $operator = null, $value = null, $boolean = 'and')
     * @method static \Illuminate\Database\Eloquent\Builder orWhere($column, $operator = null, $value = null)
     * @method static \Illuminate\Database\Eloquent\Collection all($columns = ['*'])
     * @method static \Illuminate\Database\Eloquent\Model|null find($id, $columns = ['*'])
     * @method static \Illuminate\Database\Eloquent\Model findOrFail($id, $columns = ['*'])
     * @method static \Illuminate\Database\Eloquent\Model create(array $attributes = [])
     * @method static bool update(array $attributes = [], array $options = [])
     * @method static bool delete()
     * @method static \Illuminate\Pagination\LengthAwarePaginator paginate($perPage = 15, $columns = ['*'], $pageName = 'page', $page = null)
     * @method static \Illuminate\Database\Eloquent\Builder orderBy($column, $direction = 'asc')
     * @method static \Illuminate\Database\Eloquent\Builder orderByRaw($sql, $bindings = [])
     * @method static \Illuminate\Database\Eloquent\Collection get($columns = ['*'])
     * @method static \Illuminate\Database\Eloquent\Model first($columns = ['*'])
     * @method static \Illuminate\Database\Eloquent\Model load($relations)
     */
    class Model {}
}

namespace Illuminate\Foundation\Bus {
    if (false) {
        trait Dispatchable {
            /**
             * @param mixed ...$arguments
             * @return \Illuminate\Foundation\Bus\PendingDispatch
             */
            public static function dispatch(...$arguments) {
                exit;
            }
        }
    }
}
