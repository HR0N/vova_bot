export class FatherClass{
    constructor(elem) {
        this.el = $(elem);

        $.ajaxSetup({
            headers:
                { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });
    }

    find(sSelector){
        return this.el.find(sSelector);
    }

    #fetch_field(data, field){
        field && field.map((k, v)=>{
            if($(v).attr('type') !== 'checkbox' && $(v).attr('type') !== 'radio'){
                data[$(v).attr('name')] = $(v).val();
            }else{
                data[$(v).attr('name')] = $(v).prop('checked');
            }
        });
    }

    values(form){  // inputs must have name
        let data = {};
        let input = $(form).find('input');
        let textarea = $(form).find('textarea');
        let select = $(form).find('select');

        this.#fetch_field(data, input);
        this.#fetch_field(data, textarea);
        this.#fetch_field(data, select);

        return data;
    }

    get(url, success = () => {}, error = () => {}){
        $.get(url)
            .done(response => success(response))
            .fail(err => error(err));
    }

    post(url, success = () => {}, error = () => {}){
        $.post(url)
            .done(response => success(response))
            .fail(err => error(err));
    }

}
