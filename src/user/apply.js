const submit = document.querySelector('.contact-submit');
const names = document.querySelector("input[name='name']");
const kana = document.querySelector("input[name='katakana']");
const tel = document.querySelector("input[name='Tel']");
const mail = document.querySelector("input[name='mail']");
const university = document.querySelector("input[name='university']");
const faculty = document.querySelector("input[name='faculty']");
const graduate = document.querySelector("input[name='graduate']");
const home = document.querySelector("input[name='home']");
const nameError = document.querySelector('.name');
const kanaError = document.querySelector('.kana');
const telError = document.querySelector('.tel');
const mailError = document.querySelector('.mail');
const universityError = document.querySelector('.university');
const facultyError = document.querySelector('.faculty');
const graduateError = document.querySelector('.graduate');
const homeError = document.querySelector('.home');
const form = document.querySelector('.form');
submit.addEventListener('click',function(){
  if(names.value== ''){
    nameError.style.display = 'block';  }
  if(kana.value == ''){
    kanaError.style.display = 'block';
  }
  if(tel.value == ''){
    telError.style.display = 'block';
  }
  if(mail.value == ''){
    mailError.style.display = 'block';
  }
  if(university.value == ''){
    universityError.style.display = 'block';
  }
  if(graduate.value== ''){
    graduateError.style.display = 'block';
  }
  if(faculty.value== ''){
    facultyError.style.display = 'block';
  }
  if(home.value == ''){
    homeError.style.display = 'block';
  }
  if(names.value !== '' && kana.value !== '' && tel.value !== '' && mail.value !== '' && university.value !== '' && graduate.value !== '' && faculty.value !== '' && home.value !== ''){
      form.submit();
  }
})