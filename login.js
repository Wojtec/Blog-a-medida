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
// Register btn
const registerBtn = document.getElementById('register');
registerBtn.addEventListener('click',function(){
    const logModal = document.getElementById('login-modal');
    logModal.style.display = "none";
    const regModal = document.getElementById('register-modal');
    regModal.style.display = "block";
})

const closeReg = document.getElementById('colse-reg');

closeReg.addEventListener('click',function(){
    


})