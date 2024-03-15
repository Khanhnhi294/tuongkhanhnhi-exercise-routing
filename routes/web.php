<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//Mission 1
Route::get('users', function () {
    global $users;
    $usersName = [];
    foreach ($users as $user) {
        $usersName[] = $user['name'];
    };
    $userList = implode(', ', $usersName);
    return 'The users are: ' . $userList;
});
//Mission 2
Route::get('/api/users', function () {
    global $users;
    return $users;
});

//Mission 3 & Mission 4
Route::get('/api/users/{name}', function ($name) {
    global $users;

    $eachUser = array_filter($users, function ($user) use ($name) {
        return $user['name'] === $name;
    });
    if (empty($eachUser)) {
        return 'Can not find the user with name ' . $name;
    }

    return array_values($eachUser);
});
//Mission 5
Route::prefix('user')->group(function () {
    Route::get('users', function () {
        global $users;
        $usersName = [];
        foreach ($users as $user) {
            $usersName[] = $user['name'];
        };
        $userList = implode(', ', $usersName);
        return 'The users are: ' . $userList;
    });
    Route::get('/api/users', function () {
        global $users;
        return $users;
    });
    Route::get('/api/users/{name}', function ($name) {
        global $users;

        $eachUser = array_filter($users, function ($user) use ($name) {
            return $user['name'] === $name;
        });
        if (empty($eachUser)) {
            return 'Can not find the user with name ' . $name;
        }

        return array_values($eachUser);
    });
      Route::any('{any}', function () {
        return 'You can not get a user like this';
    })->where('any', '.*');
});

Route::get('/{userIndex?}/post/{postIndex?}', function ($userIndex = null, $postIndex = null) {
        global $users;
        foreach ($users as $index => $user) {
            if ($userIndex ==  $index) {
                if ($userIndex == $index) {
                    if (isset($user['posts'][$postIndex])) {
                        return $user['posts'][$postIndex];
                    } else {
                        return 'Cannot find the post with id ' . $postIndex . ' for user ' . $userIndex;
                    }
                }
            }
        }
    })->where(['userIndex' => '[0-9]+', 'postIndex' => '[0-9]+']);
    Route::fallback(function () {
        return "You cannot get a user like this !";
    });
