import Modal from 'flarum/components/Modal';
import Button from 'flarum/components/Button';
import Badge from 'flarum/components/Badge';
import Group from 'flarum/models/Group';
import ItemList from 'flarum/utils/ItemList';

/**
 * The `EditGroupModal` component shows a modal dialog which allows the user
 * to create or edit a group.
 */
export default class AddContactModal extends Modal {
  init() {
	
	this.contact = app.session.user.contact();
	
	this.realname = m.prop(this.contact.name() || '');
	this.work_company = m.prop(this.contact.work_company() || '');
	this.primary_address = m.prop(this.contact.primary_address() || '');
	this.phone_mobile = m.prop(this.contact.phone_mobile() || '');		
	this.department = m.prop(this.contact.department() || '');
	this.work_qq = m.prop(this.contact.work_qq() || '');
	
  }

  className() {
    return 'EditGroupModal Modal--small';
  }

  title() {
    return [
       '联系方式'
    ];
  }

  content() {
    return (
      <div className="Modal-body">
        <div className="Form">
          {this.fields().toArray()}
        </div>
      </div>
    );
  }

  fields() {
    const items = new ItemList();

    items.add('name', <div className="Form-group">
      <label>真实姓名</label>
      <div className="EditGroupModal-name-input">
        <input className="FormControl" value={this.realname()} oninput={m.withAttr('value', this.realname)}/>
      </div>
    </div>, 30);

    items.add('company', <div className="Form-group">
      <label>公司名称</label>
      <input className="FormControl" value={this.work_company()} oninput={m.withAttr('value', this.work_company)}/>
    </div>, 20);
	
	items.add('department', <div className="Form-group">
      <label>部门</label>
      <input className="FormControl" value={this.department()} oninput={m.withAttr('value', this.department)}/>
    </div>, 20);

    items.add('primary_address', <div className="Form-group">
      <label>地址</label>      
      <input className="FormControl" value={this.primary_address()} oninput={m.withAttr('value', this.primary_address)}/>
    </div>, 10);
	
	items.add('phone_mobile', <div className="Form-group">
      <label>手机</label>      
      <input className="FormControl" value={this.phone_mobile()} oninput={m.withAttr('value', this.phone_mobile)}/>
    </div>, 10);
	
	items.add('work_qq', <div className="Form-group">
      <label>QQ</label>      
      <input className="FormControl" value={this.work_qq()} oninput={m.withAttr('value', this.work_qq)}/>
    </div>, 10);

    items.add('submit', <div className="Form-group">
      {Button.component({
        type: 'submit',
        className: 'Button Button--primary EditGroupModal-save',
        loading: this.loading,
        children: '保存'
      })}
    </div>, -10);

    return items;
  }

  onsubmit(e) {
    e.preventDefault();

    this.loading = true;
	const contact = {};
	contact['name']=this.realname();
	contact['primary_address']=this.primary_address();
	contact['phone_mobile']=this.phone_mobile();
	contact['work_company']=this.work_company();
	contact['work_qq']=this.work_qq();
	contact['department']=this.department();
	
	app.session.user.save({contactData: contact})
      .then(() => this.success = true)
      .catch(() => {})
	  
      .then(this.hide.bind(this),this.loaded.bind(this));
    
  }

}
