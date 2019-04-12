import { extend } from 'flarum/extend';
import app from 'flarum/app';
import Model from 'flarum/Model';
import LinkButton from 'flarum/components/LinkButton';
import Button from 'flarum/components/Button';
import SettingsPage from 'flarum/components/SettingsPage';
import AddContactModal from './components/AddContactModal';
import User from 'flarum/models/User';
import Contact from '../common/models/Contact';

app.initializers.add('ffrunkey-contacts', function() {
	
  app.store.models.contact = Contact;
  User.prototype.contact = Model.hasOne('contact');
  
  extend(SettingsPage.prototype, 'accountItems', function(items) {    	
    items.add('addcontact',
      Button.component({
        children: '联系方式',
        className: 'Button',
        onclick: () => app.modal.show(new AddContactModal())
      })
    );    
  });
});

import contactsCompat from './compat';
import { compat } from '@flarum/core/forum';

Object.assign(compat, contactsCompat);
