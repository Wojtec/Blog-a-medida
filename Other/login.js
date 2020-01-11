window.onload = function(){
// **************** Login Modal *********************
// Login btn for open modal window
const loginBtn = document.getElementById('login-btn');
loginBtn.addEventListener('click',function(){
    const logModal = document.getElementById('login-modal');
    logModal.style.display = "block";
})
// Close btn in modal window
const close = document.getElementById('close');
close.addEventListener('click',function(){
    const logModal = document.getElementById('login-modal');
    logModal.style.display = "none";
})


// ************* Register Modal **********************
// Register btn
const registerBtn = document.getElementById('register');
registerBtn.addEventListener('click',function(){
    const logModal = document.getElementById('login-modal');
    logModal.style.display = "none";
    const regModal = document.getElementById('register-modal');
    regModal.style.display = "block";
})
// close register btn X
const closeReg = document.getElementById('close-reg');
closeReg.addEventListener('click',function(){
    const regModal = document.getElementById('register-modal');
    regModal.style.display = "none";
})


}
