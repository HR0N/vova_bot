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
        this.apartment__city = this.find('select[name="apartment__city"]');
        this.apartment__district = this.find('select[name="apartment__district"]');
        this.apartment__price1 = this.apartment.find('input[name="price1"]');
        this.apartment__price2 = this.apartment.find('input[name="price2"]');
        this.apartment__rooms_all = this.find('input[name="all"]');
        this.apartment__rooms_one = this.find('input[name="r1"]');
        this.apartment__rooms_two = this.find('input[name="r2"]');
        this.apartment__rooms_three = this.find('input[name="r3"]');
        this.apartment__rooms_four = this.find('input[name="r4"]');
        this.apartment__rooms_five = this.find('input[name="r5"]');
        this.apartment__form = this.apartment.find('form');
        this.apartment__submit = this.apartment.find('.submit');

        this.rooms = this.find('.rooms');
        this.rooms__city = this.find('select[name="rooms__city"]');
        this.rooms__district = this.find('select[name="rooms__district"]');
        this.rooms__price1 = this.rooms.find('input[name="price1"]');
        this.rooms__price2 = this.rooms.find('input[name="price2"]');
        this.rooms__form = this.rooms.find('form');
        this.rooms__submit = this.rooms.find('.submit');

        this.request_urls = {
            'district': '&search[district_id]=',
            'price1': '&search[filter_float_price:from]=',
            'price2': '&search[filter_float_price:to]=',
            'rooms1': '&search[filter_enum_rooms][0]=one',
            'rooms2': '&search[filter_enum_rooms][1]=two',
            'rooms3': '&search[filter_enum_rooms][2]=three',
            'rooms4': '&search[filter_enum_rooms][3]=four',
            'rooms5': '&search[filter_enum_number_of_rooms_string][4]=pyatikomnatnye',  /* UA format */
            'rent_apartment': `https://www.olx.pl/nieruchomosci/mieszkania/wynajem/warszawa/?`,
            'rent_rooms': `https://www.olx.pl/nieruchomosci/stancje-pokoje/warszawa/?`,
        };

        this.current_group = null;
        this.modal_update = this.find('.modal_update');
    }
}




/*  Main control class.  */
class AdminPanel extends AdminPanelInit{
    constructor(elem) {
        super(elem);

        this.process = new Processing(elem, this);
        this.server = new Server(elem, this);


        this.onload();
        this.events();
    }

    onload(){
        this.process.toggle_category();
        this.server.get_groups_data(this.process.render_groups.bind(this));
        setTimeout(() => {
            console.log(this.groups_data);}, 500);
    }

    events(){
        this.groups.on('change', this.process.on_group_change.bind(this));
        this.groups.on('change', () => {this.process.fill_forms()});
        this.category.on('change', () => {this.process.toggle_category()});

        this.apartment__rooms_all.on('change', this.process.toggle_rooms_checkboxes.bind(this));
        this.apartment__rooms_one.on('change', this.process.toggle_rooms_checkboxes.bind(this));
        this.apartment__rooms_two.on('change', this.process.toggle_rooms_checkboxes.bind(this));
        this.apartment__rooms_three.on('change', this.process.toggle_rooms_checkboxes.bind(this));
        this.apartment__rooms_four.on('change', this.process.toggle_rooms_checkboxes.bind(this));
        this.apartment__rooms_five.on('change', this.process.toggle_rooms_checkboxes.bind(this));

        this.apartment__submit.on('click', () => {this.process.apartment_submit()});
        this.rooms__submit.on('click', () => {this.process.rooms_submit()});

        this.modal_update.on('click', () => {this.modal_update.addClass('filters_hide')});
    }
}




/*  Secondary class for control functions.  */
class Processing extends AdminPanelInit{
    constructor(elem, that) {
        super(elem);
        this.that = that;

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
        this.process.set_current_group_by_id();
    }

    apartment_submit(){
        const form_data = this.that.values(this.that.apartment__form);
        let data = {
            'rent_type': this.that.category.val(),
            'city': form_data.apartment__city,
            'district': `${form_data.apartment__district}`,
            'price': JSON.stringify([form_data.price1, form_data.price2]),
            'rooms': JSON.stringify([form_data.all, form_data.r1, form_data.r2, form_data.r3, form_data.r4, form_data.r5]),
            'request_url': this.that.request_urls.rent_apartment+`${this.that.request_urls.district}${form_data.apartment__district}`
                +`${form_data.price1 && this.that.request_urls.price1}${form_data.price1}${form_data.price2 && this.that.request_urls.price2}${form_data.price2}`
                +`${form_data.r1 ? this.that.request_urls.rooms1:''}${form_data.r2 ? this.that.request_urls.rooms2:''}${form_data.r3 ? this.that.request_urls.rooms3:''}${form_data.r4 ? this.that.request_urls.rooms4:''}${form_data.r5 ? this.that.request_urls.rooms5:''}`,
        };

        const url = `${location.origin}/TgGroupsUpdate/${this.that.groups.val()}`;
        this.that.server.update_group_data(url, data, this.show_message.bind(this));
    }

    rooms_submit(){
        const form_data = this.that.values(this.that.rooms__form);
        let data = {
            'rent_type': this.that.category.val(),
            'city': form_data.rooms__city,
            'district': `${form_data.rooms__district}`,
            'price': JSON.stringify([form_data.price1, form_data.price2]),
            'rooms': '',
            'request_url': this.that.request_urls.rent_rooms+`${+form_data.rooms__district !== 0 ? this.that.request_urls.district:''}${+form_data.rooms__district !== 0 ?form_data.rooms__district:''}`
                +`${form_data.price1 && this.that.request_urls.price1}${form_data.price1}${form_data.price2 && this.that.request_urls.price2}${form_data.price2}`
                +`${form_data.r1 ? this.that.request_urls.rooms1:''}${form_data.r2 ? this.that.request_urls.rooms2:''}${form_data.r3 ? this.that.request_urls.rooms3:''}${form_data.r4 ? this.that.request_urls.rooms4:''}${form_data.r5 ? this.that.request_urls.rooms5:''}`,
        };

        const url = `${location.origin}/TgGroupsUpdate/${this.that.groups.val()}`;
        this.that.server.update_group_data(url, data, this.show_message.bind(this));

    }

    fill_apartment_form(){
        const district_options = this.that.apartment__district.find('option');
        district_options.map((k, v)=>{
            $(v).val() === this.that.current_group.district ? $(v).attr('selected', true) : $(v).attr('selected', false);
        });
        this.that.apartment__price1.val(JSON.parse(this.that.current_group.price)[0]);
        this.that.apartment__price2.val(JSON.parse(this.that.current_group.price)[1]);

        const data_rooms =  JSON.parse(this.that.current_group.rooms);
        const this_rooms = this.that.el.find('.section__apartment_rooms input');
        data_rooms.map((v, k)=>{
            $(this_rooms[k]).prop('checked', v);
        });
    }

    fill_rooms_form(){
        const district_options = this.that.rooms__district.find('option');
        district_options.map((k, v)=>{
            $(v).val() === this.that.current_group.district ? $(v).attr('selected', true) : $(v).attr('selected', false);
        });
        this.that.rooms__price1.val(JSON.parse(this.that.current_group.price)[0]);
        this.that.rooms__price2.val(JSON.parse(this.that.current_group.price)[1]);
    }

    fill_forms(){
        const rent_type_option = this.that.category.find('option');
        rent_type_option.map((k, v)=>{
            $(v).val() === this.that.current_group.rent_type ? $(v).attr('selected', true) : $(v).attr('selected', false);
        });
        if(this.that.current_group.rent_type === 'apartment'){
            this.fill_apartment_form();
        }else if(this.that.current_group.rent_type === 'rooms'){
            this.fill_rooms_form();
        }
        this.toggle_category();
    }

    set_current_group_by_id(){
        this.that.groups_data.map((v, k)=>{
            if(+v.id === +this.that.groups.val()) this.that.current_group =  v;
        });
    }

    show_message(){
        this.that.modal_update.removeClass('filters_hide');
        setTimeout(() => {this.that.modal_update.addClass('filters_hide');}, 4100);
    }



    testing(){
    }
}




/*  Secondary class for communication with the server.  */
class Server extends AdminPanelInit{
    constructor(main, that) {
        super(main);
        this.that = that;
    }


    get_groups_data(success = () => {}, error = () => {}){
        return this.get(`${location.origin}/TgGroupsIndex`, success, error);
    }

    update_group_data(url, data, success =()=>{}, error =()=>{}){
        $.post(url, data)
            .fail(e => {console.log(e);})
            .done(e => {console.log(e); success()});
    }

}
