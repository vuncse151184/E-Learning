function Validator(options){
  
    var formElement = document.querySelector(options.form)

    if(formElement){
        options.rules.forEach(rule => {
            var inputElement = formElement.querySelector(rule.selector)
            var errorElement = inputElement.parentElement.querySelector('.form-message')
           
            if(inputElement){
                inputElement.onblur= function(){
                    var errorMessage = rule.test(inputElement.value)
                    if(errorMessage){
                        errorElement.innerText = errorMessage;
                        inputElement.parentElement.classList.add('invalid')
                    }
                    else{
                        errorElement.innerText="";
                        inputElement.parentElement.classList.remove('invalid')
                    }                                 
                }

                inputElement.oninput= function(){
                    errorElement.innerText="";
                    inputElement.parentElement.classList.remove('invalid')
                }
            }
        });
    }
  //  console.log(option)
}

Validator.isRequired = function (selector){
    return {
        selector: selector,
        test: function (value){
            return value.trim() ? "" : "Please enter this field"
            
        }
    }
}

Validator.isEmail = function (selector){
    return {
        selector: selector,
        test: function (value){
            var regex =/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            return regex.test(value) ? "" : "Invalid email"
           
        }
    }  
}

Validator.minLength = function (selector,min){
   
    return {
        selector: selector,
        test: function (value){
            return value.length >= min ? "" : "Password length must be at least 6 characters"
           
        }
    }  
}
Validator.isPhoneNum = function (selector){
   
    return {
        selector: selector,
        test: function (value){
            return value.length == 10 ? "" : "Phone number's length must be 10 digits"
           
        }
    }  
}
Validator.isConfirmed = function(selector,confirmvalue){
    return{
        selector:selector,
        test: function(value){
            return value === confirmvalue()? "" : "Confirm password does not match"
        }
    }
}


Validator.validDate = function(selector){
    return{
        selector:selector,
        test: function(value){
            console.log(value)
            let currentDate = new Date().toJSON().slice(0,10)
            console.log(currentDate)
            return value < currentDate? "": "Invalid birthday"
        }
    }
}