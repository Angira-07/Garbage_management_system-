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
}
function selectedBox(boxId) {
    let boxes = document.querySelectorAll('.box');
    boxes.forEach(box => box.classList.remove('active'));
    document.getElementById(boxId).classList.add('active');
}
function Un_selectBox() {
    let boxes = document.querySelectorAll('.box');
    boxes.forEach(box => box.classList.remove('active'));
}

function removeHash() {
    let hash = window.location.hash;
    
    if (hash === '#verified' || hash === '#blocked') {
        window.location.hash = '';
    } else {
        
    }
}


window.onload = function () {
    let hash = window.location.hash;
    let searchParams = new URLSearchParams(window.location.search);
    
    if (hash === "#driver") {
        showPage('driver');
        activeMenu('3');
    } else if (hash === "#citizen") {
        showPage('citizen');
        activeMenu('2');
    } else if (hash === "#dustbin") {
        showPage('dustbin');
        activeMenu('4');
    } else if (hash === "#blocked") {
        showPage('driver');
        activeMenu('3');
        showDriverDetails('blocked');
        selectedBox('blo')
    } else if (hash === "#verified") {
        showPage('driver');
        activeMenu('3');
        showDriverDetails('verified');
        selectedBox('veri')
    } else if (hash === "#productDetails") {
        showPage('dustbin');
        activeMenu('4');
        showDustbinDetails('dustbinProducts');
        selectedBox('dustbin_add');
    } else if (hash === "#Order") {
        showPage('dustbin');
        activeMenu('4');
        showDustbinDetails('dustbinOrder');
        selectedBox('dustbin_request');
    } else if (searchParams.has('edit')) {
        showPage('dustbin');
        activeMenu('4');
        showDustbinDetails('dustbinProducts');
        selectedBox('dustbin_add'); 
        // document.querySelector('.body').classList.toggle('blur');
    } else {
        showPage('dashboard');
        activeMenu('1');
    }
}

function showDustbinDetails(detailId) {
    let details = document.querySelectorAll('.detail');
    details.forEach(detail => detail.classList.remove('active'));
    document.getElementById(detailId).classList.add('active');
}

//add product
function showFileName(){
    const fileName = document.getElementById('file-name');
    const fileUpload = document.getElementById('file-upload');

    if((fileUpload.files.length > 0)){
        fileName.textContent = fileUpload.files[0].name;
    }
} 
function showProductForm(){
    const add = document.getElementById('add-product-icon');
    const form = document.getElementById('addProduct');
    
    add.onclick = () =>{
        form.classList.toggle('show-form');
    }
}
showProductForm();

// document.querySelector('#requestEditProduct').onclick = () =>{
//     document.querySelector('#edit_product').style.display = 'block';
//     document.getElementById('dustbin').classList.add('blur');
//     window.location.href = 'http://localhost/Garbage_Management_System/admin/dashboard.php#productDetails';
// };
document.querySelector('#edit-close-product-icon').onclick = () =>{
    document.querySelector('#edit_product').style.display = 'none';
    // document.getElementById('dustbin').classList.remove('blur');
    window.location.href = 'http://localhost/Garbage_Management_System/admin/dashboard.php#productDetails';
};

// function showProductEditForm(){
//     const edit = document.getElementById('editiProductBtn');
//     const close = document.getElementById('add-product-icon');
//     const form = document.getElementById('edit_product');
    
//     edit.onclick = () =>{
//         form.classList.toggle('visible '); //shortly toggle makes things easier
//         //if show-form exist then toggle will remove it and 
//         // if not exist the added
//     }
// }
// showProductEditForm();

// function openForm(complainID){
//     document.getElementById('complainUpdate').style.display = 'block';
//     document.getElementById('com_id').value = complainID;
// }

function toggleSubMenu(submenuId) {
    document.getElementById(submenuId).classList.toggle('active');
}