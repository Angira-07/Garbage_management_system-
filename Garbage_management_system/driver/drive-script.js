
function showPage(pageId, menuId) {
    let pages = document.querySelectorAll('.body-item');
    pages.forEach(page => page.classList.remove('active'));
    document.getElementById(pageId).classList.add('active');

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


window.onload = function () {
    const hash = window.location.hash;

    if (hash === "#driver") {
        showPage('driver', '3');
    } else if (hash === "#citizen") {
        showPage('citizen', '2');
    } else if (hash === "#dustbin") {
        showPage('dustbin', '4');
    } else {
        showPage('dashboard', '1');
    }
}

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
});