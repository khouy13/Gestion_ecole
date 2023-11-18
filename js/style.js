
console.log(screen.width);
window.onscroll = function () { myFunction() };
var nav = document.querySelector('.navbar');
var li = document.querySelectorAll('.navbar ul li a');
var style = document.querySelector('style');
var css_hover = '.nav-item a:hover { color: var(--main-color);font-weight: normal;} .navbar{box-shadow: 0px 1px 0px rgba(0, 0, 0, .1);}';

function myFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        nav.classList.add("bg-white");
        nav.classList.remove("bleu-back");
        style.innerHTML = css_hover;
    }
    else {
        nav.classList.remove("bg-white");
        nav.classList.add("bleu-back");
        style.innerHTML = '';
    }
}

//password hidden seen

let $eyes = document.querySelector('#changeVisibility i');
let $password = document.querySelector('#passwordEdit');
if ($eyes != null) {
    $eyes.addEventListener('click', (e) => {
        // password is hidden
        if (e.currentTarget.classList.value == "bi bi-eye") {
            e.currentTarget.classList.value = "bi bi-eye-slash";
            $password.setAttribute('type', 'text');
        }
        else {
            e.currentTarget.classList.value = "bi bi-eye";
            $password.setAttribute('type', 'password');
        }

    })
}

// messsanger

var messageBody = document.querySelector('#messageBody');
if (messageBody != null) {
    messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
}
function setFocusToTextBox() {

    let add = document.getElementById("addMessage");
    if (add != null) {
        add.focus();
    }
}
setFocusToTextBox();

//module

var rter1 = document.querySelector('.rter1');
var rter2 = document.querySelector('.rter2');
var lessons = document.querySelector('.lesson-block');
var nv = document.querySelector('.nv-block');

if (rter1 != null && rter2 != null) {
    rter1.addEventListener("click", () => {
        rter1.classList.add("active-router");
        lessons.classList.remove("disabled-block");
        rter2.classList.remove("active-router");
        nv.classList.add("disabled-block");
    });

    rter2.addEventListener("click",    ()=> {
        rter2.classList.add("active-router");
        nv.classList.remove("disabled-block");
        rter1.classList.remove("active-router");
        lessons.classList.add("disabled-block");
    });
    }

// messsanger

var messageBody = document.querySelector('#messageBody');
if (messageBody != null) {
    messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
}
function setFocusToTextBox() {

    let add = document.getElementById("addMessage");
    if (add != null) {
        add.focus();
    }
}
setFocusToTextBox();


// screen messanger


let div_profiles = document.querySelector('.profiles');
let div_messanger = document.querySelector('.conversation');
let is_displayed = document.querySelector('#messageBody') != null;
console.log(div_messanger);
if ($(window).width() <= 768) {
    document.querySelector('#rja3').classList.remove('d-none')
    if (is_displayed) {
        div_profiles.classList.add('d-none');
        div_messanger.classList.remove('d-none');
        

    } else {
        div_profiles.classList.remove('d-none');
        div_messanger.classList.add('d-none');
    }
} else {
    document.querySelector('#rja3').classList.add('d-none')
}

$(window).resize(function () {
    let width = ($(window).width());
    if ($(window).width() <= 768) {
        document.querySelector('#rja3').classList.remove('d-none')
        if (is_displayed) {
            div_profiles.classList.add('d-none');
            //div_messanger.classList.remove('col-md-6');
            div_messanger.classList.remove('d-none');

        } else {
            div_profiles.classList.remove('d-none');
            div_messanger.classList.add('d-none');
        }
    } else {
        div_profiles.classList.remove('d-none');
        div_messanger.classList.remove('d-none');
        document.querySelector('#rja3').classList.add('d-none')
    }
})

