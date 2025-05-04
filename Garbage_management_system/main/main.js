// function handleFormSubmit(event) {
//     event.preventDefault(); // Prevent the form from submitting immediately
    
//     // Get form elements
//     const form = document.getElementById('citi_reg_form');
//     const name = document.getElementById('citi_name').value;
//     const dob = document.getElementById('citi_birth').value;
//     const phone = document.getElementById('citi_phone').value;
//     const email = document.getElementById('citi_email').value;
//     const password = document.getElementById('citi_password').value;
//     const confirmPass = document.getElementById('citi_confirmPass').value;
//     const house = document.getElementById('citi_house').value;
//     const locality = document.getElementById('citi_locality').value;
//     const city = document.getElementById('citi_city').value;
//     const pincode = document.getElementById('citi_pincode').value;
//     const state = document.getElementById('citi_state').value;

//     // Simple validation to check if fields are filled
//     if (!name || !dob || !phone || !email || !password || !confirmPass || !house || !locality || !city || !pincode || !state) {
//         alert("Please fill all the required fields!");
//         return;
//     }

//     // Check if passwords match
//     if (password !== confirmPass) {
//         alert("Passwords do not match!");
//         return;
//     }

//     // Submit the form if everything is valid
//     form.submit();
    
//     // Now show the login page (you can implement this after successful form submission)
//     showCitizen('citi_log', 'main-content');
// }

function showAboutFocused() {
    const aboutSection = document.getElementById("about-section");
    const mainContent = document.getElementById("main-content");

    // Apply focus styles
    aboutSection.classList.add("focused");
    mainContent.classList.add("blur");

    // Scroll to about section smoothly
    aboutSection.scrollIntoView({ behavior: "smooth" });
}

function resetFromAbout() {
    const aboutSection = document.getElementById("about-section");
    const mainContent = document.getElementById("main-content");

    // Remove focus and blur
    aboutSection.classList.remove("focused");
    mainContent.classList.remove("blur");
}


function showCitizen(formId, bodyId){
    //making all the form unvisible by default
    //for login forms
    const logClassName = document.querySelectorAll(".login");
    logClassName.forEach(form => form.classList.add("unvisible"));
    //for registration forms
    const regClassName = document.querySelectorAll(".register");
    regClassName.forEach(form => form.classList.add("unvisible"));

    const loginForm = document.getElementById(formId);
    const mainContent = document.getElementById(bodyId);
    loginForm.classList.remove("unvisible");
    mainContent.classList.add("blur");
}
function closeForm(formId, bodyId){
    const loginForm = document.getElementById(formId);
    const mainContent = document.getElementById(bodyId);
    loginForm.classList.add("unvisible");
    mainContent.classList.remove("blur");
    removeHash();
}

// let currentStep = 0; 
// function showFieldset() {
//     const steps = document.querySelectorAll(".step");
//     const nexts = document.querySelectorAll(".next");
//     const prevs = document.querySelectorAll(".prev");
    
//     steps[currentStep].classList.add("active");
//     nexts.forEach(next => {
//         next.onclick = () => {
//             if (currentStep < steps.length - 1) {
//                 steps[currentStep].classList.remove("active");
//                 currentStep++;
//                 steps[currentStep].classList.add("active");
//             }
//         }
//     });
//     prevs.forEach(prev => {
//         prev.onclick = () => {
//             if (currentStep > 0) {
//                 steps[currentStep].classList.remove("active");
//                 currentStep--;
//                 steps[currentStep].classList.add("active");
//             }
//         }
    
//     })
// }
// showFieldset();

function checkPasswordMatch(pass, conpass, mess){
    const password = document.getElementById(pass).value;
    const confirmPass = document.getElementById(conpass).value;
    const message = document.getElementById(mess);
    if(confirmPass === ""){
        message.textContent = "";
    }
    else if(password === confirmPass){
        message.textContent = "Password Matched.";
        message.style.color = "green";
    }
    else{
        message.textContent = "Password not Matched.";
        message.style.color = "rgb(189, 21, 12)";    
    }
}

function removeHash() {
    let hash = window.location.hash;
    
    if (hash === '#citi_log' || hash === '#citi_reg' || hash === '#driver_log' || hash === '#driver_reg') {
        window.location.hash = '';
    } else {
        
    }
}

window.onload = function () {
    let hash = window.location.hash;
if (hash === "#citi_log") {
    showCitizen('citi_log', 'main-content');
    // activeMenu('3');
} else if (hash === "#citi_reg") {
    showCitizen('citi_reg', 'main-content');
    // activeMenu('2');
}  else if (hash === "#driver_log") {
    showCitizen('driver_log', 'main-content');
    // activeMenu('2');
}  else if (hash === "#drive_reg") {
    showCitizen('driver_reg', 'main-content');
    // activeMenu('2');
}  else if (hash === "#admin") {
    showCitizen('admin_log', 'main-content');
    // activeMenu('2');
}  else {

}
}