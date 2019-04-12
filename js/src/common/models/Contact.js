import Model from 'flarum/Model';
import mixin from 'flarum/utils/mixin';
import computed from 'flarum/utils/computed';
import { getPlainContent } from 'flarum/utils/string';
import ItemList from 'flarum/utils/ItemList';
import Badge from 'flarum/components/Badge';

export default class Contact extends mixin(Model, {

  name: Model.attribute('name'),
  work_company: Model.attribute('work_company'),
  primary_address: Model.attribute('primary_address'),
  phone_mobile: Model.attribute('phone_mobile'), 
  mail: Model.attribute('mail'),
  work_qq: Model.attribute('work_qq'),
  department: Model.attribute('department'),
  
}) {}
