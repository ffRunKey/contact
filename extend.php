<?php

namespace ffRunKey\Contacts;

use Flarum\Extend;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\View\Factory;
use Flarum\Foundation\Application;
use Flarum\Extend\Compat;
use Flarum\Http\RouteCollection;
use Flarum\Http\RouteHandlerFactory;
use Flarum\Forum\Controller as Controllers;
use Illuminate\Support\Facades\Facade;

return [

	(new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js'),
		
	function (Dispatcher $events, Factory $views) {
        $events->subscribe(Listener\SaveContactToDatabase::class);
		$events->subscribe(Listener\AddUserContactAttribute::class);
    }
];
