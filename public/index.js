const mainContainer = document.querySelectorAll('.main');
const loginBtn = document.querySelector('.login-btn'); 
let wrapper = document.querySelector('.wrapper');
wrapper.classList.add('hide');
loginBtn.addEventListener('click', ()=>{
    wrapper.classList.toggle('hide');
    mainContainer.forEach((cont)=>{
        cont.classList.toggle('hide');
    });
});
