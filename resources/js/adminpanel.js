import {FatherClass} from "./father";




$(document).ready(() => {new AdminPanel('main')});




/*  Class for initializing data.  */
class AdminPanelInit extends FatherClass{
    constructor(elem) {
        super(elem);

        this.category = this.find('#category');

        this.apartment = this.find('.apartment');
        this.apartment__city = this.find('input[name="apartment__city"]');
        this.apartment__district = this.find('input[name="apartment__district"]');
        this.apartment__price_from = this.find('input[name="apartment__price_from"]');
        this.apartment__price_to = this.find('input[name="apartment__price_to"]');
        this.apartment__rooms_all = this.find('input[name="all"]');
        this.apartment__rooms_one = this.find('input[name="one"]');
        this.apartment__rooms_two = this.find('input[name="two"]');
        this.apartment__rooms_three = this.find('input[name="three"]');
        this.apartment__rooms_four = this.find('input[name="four"]');
        this.apartment__rooms_five = this.find('input[name="five"]');
        this.apartment__form = this.apartment.find('form');
        this.apartment__submit = this.apartment.find('.submit');

        this.rooms = this.find('.rooms');
        this.rooms__city = this.find('input[name="rooms__city"]');
        this.rooms__district = this.find('input[name="rooms__district"]');
        this.rooms__price_from = this.find('input[name="rooms__price_from"]');
        this.rooms__price_to = this.find('input[name="rooms__price_to"]');
        this.rooms__form = this.rooms.find('form');
        this.rooms__submit = this.rooms.find('.submit');
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
    }

    events(){
        this.category.on('change', () => {this.process.toggle_category()});

        this.apartment__rooms_all.on('change', this.process.toggle_rooms_checkboxes.bind(this));
        this.apartment__rooms_one.on('change', this.process.toggle_rooms_checkboxes.bind(this));
        this.apartment__rooms_two.on('change', this.process.toggle_rooms_checkboxes.bind(this));
        this.apartment__rooms_three.on('change', this.process.toggle_rooms_checkboxes.bind(this));
        this.apartment__rooms_four.on('change', this.process.toggle_rooms_checkboxes.bind(this));
        this.apartment__rooms_five.on('change', this.process.toggle_rooms_checkboxes.bind(this));

        this.apartment__submit.on('click', () => {this.server.test(this.apartment__form)});
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
        if(+category_value === 0){this.apartment.addClass('flex');}
        if(+category_value === 1){this.rooms.addClass('flex');}
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

    testing(){

    };
}




/*  Secondary class for communication with the server.  */
class Server extends AdminPanelInit{
    constructor(main) {
        super(main);
    }


    test(form){
        console.log(this.values(form));
    }
}
