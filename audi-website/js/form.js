"use strict"

document.addEventListener('DOMContentLoaded', function(){
    const form = document.getElementById('form');
    form.addEventListener('submit', formSend);

    async function formSend(e){
        e.preventDefault();

        let error = formValidate(form);

        let formData = new FormData(form);

        if(error===0){
            form.classList.add('_sending');
            let response = await fetch('sendmail.php',{
                method:'POST',
                body:formData
            });
            if(restonse.ok){
                let result = await restonse.json();
                alert(result.message);
                formPreview.innerHTML = '';
                form.reset();
                form.classList.remove('_sending');
            } else{
                alert("Помилка");
                form.classList.remove('_sending');
            }
        } else {
            alert('Заповніть обовязкові поля');
        }
    }

    function formValidate(form){
        let error = 0;
        let formReq = document.querySelectorAll('._req');

        for(let Catalog = 0; Catalog < formReq.length; Catalog++){
          const input = formReq[Catalog];
          formRemoveError(input);

          if(input.classList.contains('_email')){
            if(emailTest(input)){
                formAddError(input);
                error++;
            }
          } else if(input.getAttribute("type") ==="checkbox" && input.checked === false){
            formAddError(input);
            error++;
          } else{
              if(input.value === ''){
                  formAddError(input);
                  error++;
              }
          }
        }
        return error;
    } 
    function formAddError(input){
        input.parentElement.classList.add('_error');
        input.classList.add('_error')
    }
    function formRemoveError(input){
        input.parentElement.classList.remove('_error');
        input.classList.remove('_error'); 
    }
    //Функція теста email
    function emailTest(input) {
        return !/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,8})+$/.test(input.value);
    }
});