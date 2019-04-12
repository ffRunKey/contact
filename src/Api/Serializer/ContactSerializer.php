<?php

namespace Dev\Contacts\Api\Serializer;

use Flarum\Api\Serializer\AbstractSerializer;

class ContactSerializer extends AbstractSerializer
{
    /**
     * {@inheritdoc}
     */
    protected $type = 'contact';

    /**
     * {@inheritdoc}
     */
    protected function getDefaultAttributes($contact)
    {
        $attributes = [
            'id' => $contact->id,
            'name' => $contact->name,
			'primary_address' => $contact->primary_address,
			'phone_mobile' => $contact->phone_mobile,
			'work_company' => $contact->work_company,
			'work_qq' => $contact->work_qq,
			'department' => $contact->department,
        ];

        return $attributes;
    }
}
