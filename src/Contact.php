<?php

namespace ffRunKey\Contacts;

use Flarum\Formatter\Formatter;
use Flarum\User\User;
use Flarum\Database\AbstractModel;
use Flarum\Database\ScopeVisibilityTrait;
use Flarum\Foundation\EventGeneratorTrait;
use Carbon\Carbon;

class Contact extends AbstractModel
{
    //use EventGeneratorTrait;
	//use ScopeVisibilityTrait;
	
	/**
     * {@inheritdoc}
     */
    protected $table = 'contacts';
	
	protected $dates = ['created_at', 'edited_at', 'hidden_at'];
	
	public static function build(User $user,$name,$primary_address,$phone_mobile,$work_qq,$work_company,$department)
    {
        $contact = new static();
		
		$contact->user_id = $user->id;
		$contact->modified_user_id = $user->id;
		$contact->name = $name;
		$contact->primary_address = $primary_address;
		$contact->phone_mobile = $phone_mobile;
		$contact->work_qq = $work_qq;
		$contact->work_company = $work_company;
		$contact->department = $department;
		$contact->created_at = Carbon::now();
				
		return $contact;
	}
	
}
