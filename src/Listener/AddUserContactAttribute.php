<?php

namespace ffRunKey\Contacts\Listener;

use Flarum\Api\Event\Serializing;
use Illuminate\Contracts\Events\Dispatcher;
use Flarum\Api\Event\WillGetData;
use Flarum\Event\GetApiRelationship;
use Flarum\Event\GetModelRelationship;
use Flarum\User\User;
use Flarum\Api\Serializer\UserSerializer;
use Flarum\Api\Serializer\BasicUserSerializer;
use ffRunKey\Contacts\Contact;
use ffRunKey\Contacts\Api\Serializer\ContactSerializer;

class AddUserContactAttribute
{
    /**
     * @param Dispatcher $events
     */
    public function subscribe(Dispatcher $events)
    {
        //$events->listen(Serializing::class, [$this, 'addAttributes']);
		$events->listen(GetModelRelationship::class, [$this, 'getModelRelationship']);
		$events->listen(WillGetData::class, [$this, 'includeContactRelationship']);
		$events->listen(GetApiRelationship::class, [$this, 'getApiRelationship']);
    }

    /**
     * @param Serializing $event
     */
    public function addAttributes(Serializing $event)
    {
    }
	
	public function getModelRelationship(GetModelRelationship $event)
    {
		if ($event->isRelationship(User::class, 'contact')) {
            return $event->model->belongsTo(Contact::class,'id','user_id');
        }
	}
	
	public function getApiRelationship(GetApiRelationship $event)
    {
		if ($event->isRelationship(UserSerializer::class, 'contact')) {
            return $event->serializer->hasOne($event->model, ContactSerializer::class,'contact');
        }
	}
	
	public function includeContactRelationship(WillGetData $event)
    {
        if ($event->controller->serializer === UserSerializer::class) {
            $event->addInclude(['contact']);
        }
    }
}
