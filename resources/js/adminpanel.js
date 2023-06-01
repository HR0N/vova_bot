import {FatherClass} from "./father";

class Adminpanel extends FatherClass{
    constructor(elem) {
        super(elem);


        this.events();
    }

    events(){
    }
}


$(document).ready(() => {new Adminpanel('main')});
