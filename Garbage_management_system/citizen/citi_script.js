document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('profile_icon').onclick = () => {
        console.log('Profile icon clicked');
        document.querySelector('.address_edit').classList.toggle('hidden');
        document.querySelector('.body').classList.toggle('blur');
    };
    document.getElementById('edit_add').onclick = () => {
        document.querySelector('.address_edit').classList.toggle('hidden');
        // document.querySelector('.body').classList.toggle('blur');
    };
    document.getElementById('cart_icon').onclick = () => {
        // console.log('cart icon clicked');
        document.querySelector('.body').classList.toggle('blur');
        document.querySelector('#cart-details').classList.toggle('hidden');
    };
    document.getElementById('go-to-cart').onclick = () => {
        // console.log('cart icon clicked');
        document.querySelector('.body').classList.toggle('blur');
        document.querySelector('#cart-details').classList.toggle('hidden');
    };
});

window.addEventListener('DOMContentLoaded', function() {
    let user = document.querySelector('#user-content');
    user.style.display = 'none';
    document.getElementById('profile_icon').addEventListener("click", function () {
        // document.querySelector('.body').classList.toggle('blur');
        if (user.style.display === 'none') {
            user.style.display = 'block';
        } else {
            user.style.display = 'none';
        }
    });
    let item = document.querySelector('.address_edit');
    item.style.display = 'none';
    document.getElementById('edit_add').addEventListener("click", function () {
        if (item.style.display === 'none') {
            item.style.display = 'block';
        }
        else {
            item.style.display = 'none';
        }
    });
    // includeHash();
});

function showPage(pageId) {
    let pages = document.querySelectorAll('.body-item');
    pages.forEach(page => page.classList.remove('active'));
    document.getElementById(pageId).classList.add('active');
}
function activeMenu(menuId) {
    let menus = document.querySelectorAll('.menu-item');
    menus.forEach(menu => menu.classList.remove('active'));
    document.getElementById(menuId).classList.add('active');
}
// let toggle = document.querySelector('.toggle');
// let menu = document.querySelector('.menu');
// let main = document.querySelector('.main');
// toggle.onclick = function(){
//     menu.classList.toggle('active');
//     main.classList.toggle('active');
// }

function showDriverDetails(detailId) {
    let details = document.querySelectorAll('.detail');
    details.forEach(detail => detail.classList.remove('active'));
    document.getElementById(detailId).classList.add('active');
    // details.forEach(detail => detail.style.display = 'none');
    // document.getElementById(detailId).style.display = 'block';
}
// function showOrderDetails(detailId) {
//     let details = document.querySelectorAll('.order-detail');
//     details.forEach(detail => detail.classList.remove('active'));
//     document.getElementById(detailId).classList.add('active');
// }
function selectedBox(boxId) {
    let boxes = document.querySelectorAll('.box');
    boxes.forEach(box => box.classList.remove('active'));
    document.getElementById(boxId).classList.add('active');
}
function Un_selectBox() {
    let boxes = document.querySelectorAll('.box');
    boxes.forEach(box => box.classList.remove('active'));
}

window.onload = function() {
    let hash = window.location.hash;

    if (hash === "#dustbin") {
        showPage('dustbin');
        activeMenu('d-2');
    }
    else if (hash === "#complain") {
        showPage('newComplain');
        activeMenu('c-1');
    }
     else {
        showPage('dashboard'); 
        activeMenu('1');
    }
}

function removeHash() {
    let hash = window.location.hash;

    if (hash === '#Order' || hash === '#product') {
        window.location.hash = '';
    } else {

    }

}
// document.getElementById('3').onclick = () =>{
//     document.getElementById('complain-sub-menu').classList.toggle('active');
// }
function toggleSubMenu(submenuId) {
    document.getElementById(submenuId).classList.toggle('active');
}



