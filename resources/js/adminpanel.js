import {FatherClass} from "./father";




$(document).ready(() => {new AdminPanel('main')});




/*  Class for initializing data.  */
class AdminPanelInit extends FatherClass{
    constructor(elem) {
        super(elem);

        this.groups_data = null;

        this.groups = this.find('#groups');
        this.category = this.find('#category');

        this.apartment = this.find('.apartment');
        this.apartment__city = this.find('input[name="apartment__city"]');
        this.apartment__district = this.find('input[name="apartment__district"]');
        this.apartment__price_from = this.find('input[name="price1"]');
        this.apartment__price_to = this.find('input[name="price2"]');
        this.apartment__rooms_all = this.find('input[name="all"]');
        this.apartment__rooms_one = this.find('input[name="r1"]');
        this.apartment__rooms_two = this.find('input[name="r2"]');
        this.apartment__rooms_three = this.find('input[name="r3"]');
        this.apartment__rooms_four = this.find('input[name="r4"]');
        this.apartment__rooms_five = this.find('input[name="r5"]');
        this.apartment__form = this.apartment.find('form');
        this.apartment__submit = this.apartment.find('.submit');

        this.rooms = this.find('.rooms');
        this.rooms__city = this.find('input[name="rooms__city"]');
        this.rooms__district = this.find('input[name="rooms__district"]');
        this.rooms__price_from = this.find('input[name="price1"]');
        this.rooms__price_to = this.find('input[name="price2"]');
        this.rooms__form = this.rooms.find('form');
        this.rooms__submit = this.rooms.find('.submit');

        this.request_urls = {
            'district': '&search[district_id]=',
            'price1': '&search[filter_float_price:from]=',
            'price2': '&search[filter_float_price:to]=',
            'rooms1': '&search[filter_enum_number_of_rooms_string][0]=odnokomnatnye',
            'rooms2': '&search[filter_enum_number_of_rooms_string][1]=dvuhkomnatnye',
            'rooms3': '&search[filter_enum_number_of_rooms_string][2]=trehkomnatnye',
            'rooms4': '&search[filter_enum_number_of_rooms_string][3]=chetyrehkomnatnye',
            'rooms5': '&search[filter_enum_number_of_rooms_string][4]=pyatikomnatnye',
        };
    }
}




/*  Main control class.  */
class AdminPanel extends AdminPanelInit{
    constructor(elem) {
        super(elem);

        this.process = new Processing(elem);
        this.server = new Server(elem);


        this.onload();
        this.events();
    }

    onload(){
        this.process.toggle_category();
        this.server.get_groups_data(this.process.render_groups.bind(this));
    }

    events(){
        this.groups.on('change', this.process.on_group_change.bind(this));
        this.category.on('change', () => {this.process.toggle_category()});

        this.apartment__rooms_all.on('change', this.process.toggle_rooms_checkboxes.bind(this));
        this.apartment__rooms_one.on('change', this.process.toggle_rooms_checkboxes.bind(this));
        this.apartment__rooms_two.on('change', this.process.toggle_rooms_checkboxes.bind(this));
        this.apartment__rooms_three.on('change', this.process.toggle_rooms_checkboxes.bind(this));
        this.apartment__rooms_four.on('change', this.process.toggle_rooms_checkboxes.bind(this));
        this.apartment__rooms_five.on('change', this.process.toggle_rooms_checkboxes.bind(this));

        this.apartment__submit.on('click', this.process.apartment_submit.bind(this));
        this.rooms__submit.on('click', this.process.rooms_submit.bind(this));

    }
}




/*  Secondary class for control functions.  */
class Processing extends AdminPanelInit{
    constructor(elem) {
        super(elem);

        this.testing();
    }

    toggle_category(){
        const category_value = this.category.val();
        this.apartment.removeClass('flex');
        this.rooms.removeClass('flex');
        if(category_value === 'apartment'){this.apartment.addClass('flex');}
        if(category_value === 'rooms'){this.rooms.addClass('flex');}
    }

    toggle_rooms_checkboxes(e){
        if($(e.target).attr('name') === 'all' && $(e.target).prop('checked')){
            this.apartment__rooms_one.prop('checked', false);
            this.apartment__rooms_two.prop('checked', false);
            this.apartment__rooms_three.prop('checked', false);
            this.apartment__rooms_four.prop('checked', false);
            this.apartment__rooms_five.prop('checked', false);
        }else if($(e.target).attr('name') !== 'all' && $(e.target).prop('checked')){
            this.apartment__rooms_all.prop('checked', false);
        }
    }

    render_groups(data){
        data.map((v, k)=>{
            this.groups.append(`<option value='${v.id}' data-group-id='${v.group_id}'>${v.group_title}</option>`);
        });
        this.groups_data = data;
    }

    on_group_change(){
        if(this.groups.val() === null){
            this.apartment.addClass('filters_hide');
            this.rooms.addClass('filters_hide');
        }else{
            this.apartment.removeClass('filters_hide');
            this.rooms.removeClass('filters_hide');
        }
    }

    apartment_submit(){
        const form_data = this.values(this.apartment__form);
        let data = {
            'rent_type': this.category.val(),
            'city': form_data.apartment__city,
            'district': `${this.request_urls.district}${form_data.apartment__district}`,
            'price': `${form_data.price1 && this.request_urls.price1}${form_data.price1}${form_data.price2 && this.request_urls.price2}${form_data.price2}`,
            'rooms': `${form_data.r1 ? this.request_urls.rooms1:''}${form_data.r2 ? this.request_urls.rooms2:''}${form_data.r3 ? this.request_urls.rooms3:''}${form_data.r4 ? this.request_urls.rooms4:''}${form_data.r5 ? this.request_urls.rooms5:''}`,
        };
        data.request_url = data.district + data.price + data.rooms;

        const url = `${location.origin}/TgGroupsUpdate/${this.groups.val()}`;
        this.server.update_group_data(url, data);
    }

    rooms_submit(){
        const form_data = this.values(this.rooms__form);
        let data = {
            'rent_type': this.category.val(),
            'city': form_data.rooms__city,
            'district': `${this.request_urls.district}${form_data.rooms__district}`,
            'price': `${form_data.price1 && this.request_urls.price1}${form_data.price1}${form_data.price2 && this.request_urls.price2}${form_data.price2}`,
            'rooms': ``,
        };
        data.request_url = data.district + data.price;

        const url = `${location.origin}/TgGroupsUpdate/${this.groups.val()}`;
        this.server.update_group_data(url, data);

    }




    testing(){}
}




/*  Secondary class for communication with the server.  */
class Server extends AdminPanelInit{
    constructor(main) {
        super(main);
    }


    get_groups_data(success = () => {}, error = () => {}){
        return this.get(`${location.origin}/TgGroupsIndex`, success, error);
    }

    update_group_data(url, data){
        $.post(url, data)
            .fail(e => {console.log(e);})
            .done(e => {console.log(e);});
    }

}
