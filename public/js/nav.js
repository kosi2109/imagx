const burger = document.getElementById('burger');
const navlink = document.querySelector('.leftNav')
const line1 = document.querySelector('.line1')
const line2 = document.querySelector('.line2')
const line3 = document.querySelector('.line3')

burger.addEventListener('click',function(){
    navlink.classList.toggle('open');
    line1.classList.toggle('open');
    line2.classList.toggle('open');
    line3.classList.toggle('open');
})