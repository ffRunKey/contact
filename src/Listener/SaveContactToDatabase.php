<?php

/*
 * This file is part of Flarum.
 *
 * (c) Toby Zerner <toby.zerner@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ffRunKey\Contacts\Listener;

use Flarum\User\Event\Saving;
use Flarum\User\AssertPermissionTrait;
use Illuminate\Contracts\Events\Dispatcher;
use ffRunKey\Contacts\Contact;
use Carbon\Carbon;

class SaveContactToDatabase
{
    use AssertPermissionTrait;

    /**
     * @param Dispatcher $events
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen(Saving::class, [$this, 'whenSaving']);
    }

    /**
     * @param Saving $event
     */
    public function whenSaving(Saving $event)
    {
        $attributes = array_get($event->data, 'attributes', []);
		if (array_key_exists('contactData', $attributes)) {
			
			/***
			 * 需要对 contactData 数据检验
			 */
			
			$user = $event->user;
            $actor = $event->actor;
			
			$contact = $user->contact()->where('user_id', $actor->id)->first();
			//var_dump($attributes['contactData']);
			if($contact)
			{
				$contact->name = $attributes['contactData']['name'];
				$contact->primary_address = $attributes['contactData']['primary_address'];
				$contact->phone_mobile = $attributes['contactData']['phone_mobile'];
				$contact->work_qq = $attributes['contactData']['work_qq'];
				$contact->work_company = $attributes['contactData']['work_company'];
				$contact->department = $attributes['contactData']['department'];
				$contact->edited_at = Carbon::now();
				$contact->save();
			}else{
				$contact = Contact::build($actor,
                  $attributes['contactData']['name'],
			      $attributes['contactData']['primary_address'],
				  $attributes['contactData']['phone_mobile'],				  
				  $attributes['contactData']['work_qq'],
				  $attributes['contactData']['work_company'],
				  $attributes['contactData']['department']
				);
				$contact->save();  
			}
			
		}
    }
}
