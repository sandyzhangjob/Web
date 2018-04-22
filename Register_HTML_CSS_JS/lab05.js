// JavaScript source code

function formValidation() {
  return validateFirstName() && validateLastName() && validatePassword() && validatePhoneNumber() && validateEducationStatus();
}


function GetParentAndEraseChildCode(parentID) {
  var errorDiv = document.getElementById(parentID);
  while (errorDiv.firstChild) {
    errorDiv.removeChild(errorDiv.firstChild);
  }
  return errorDiv;
}

function AlertBelowParent(parent, mes) {
  var element = document.createElement("p");
  var text = document.createTextNode(mes);
  element.appendChild(text);
  parent.appendChild(element);
}

function validateFirstName() {
  var al = 0, other = 0;
  var FirstName = document.getElementById("FirstName").value.trim();
  var errorDiv = GetParentAndEraseChildCode("error1");
  for (var i = 0; i < FirstName.length; i++) {
    if (FirstName[i].toLowerCase() >= 'a' && FirstName[i].toLowerCase() <= 'z'){
      al++;
    }
    else if (FirstName[i] == '\'' || FirstName[i] == '-') {
      other++;
    }
    else {
      AlertBelowParent(errorDiv, "First name only accecpt (a-z), (A-Z), (-), (')");
      return false;
    }
  }
  if (al == 0) {
    AlertBelowParent(errorDiv, "Must have at least 1 alphabetic character (a-z) (A-Z)");
    return false;
  }
  return true;
}

function validateLastName() {
  var al = 0, other = 0;
  var LastName = document.querySelector("#LastName").value.trim();
  var errorDiv = GetParentAndEraseChildCode("error2");
  for (var i = 0; i < LastName.length; i++) {
    if (LastName[i].toLowerCase() >= 'a' && LastName[i].toLowerCase() <= 'z') {
      al++;
    }
    else if (LastName[i] == '\'' || LastName[i] == '-') {
      other++;
    }
    else {
      AlertBelowParent(errorDiv, "Last name only accecpt (a-z), (A-Z), (-), (')");
      return false;
    }
  }
  if (al == 0) {
    AlertBelowParent(errorDiv, "Must have at least 1 alphabetic character (a-z) (A-Z)");
    return false;
  }
  return true;
}

function validatePassword() {
  var password = document.querySelector("#password").value;
  var upper = 0, lower = 0, num = 0;
  var errorDiv = GetParentAndEraseChildCode("error3");
  if (password.length < 8) {
    AlertBelowParent(errorDiv, "At least 8 characters long");
    return false;
  }
  for (var i = 0; i < password.length; i++) {
    if (password[i] >= 'a' && password[i] <= 'z') { lower++; }
    else if (password[i] >= 'A' && password[i] <= 'Z') { upper++; }
    else if (password[i] >= 0 && password[i] <= 9) { num++; }
  }
  if (lower == 0 || upper == 0) {
    AlertBelowParent(errorDiv, "Password must contain both upper and lower case characters");
    return false;
  }
  if (num < 1) {
    AlertBelowParent(errorDiv, "Password must at least one number");
    return false;
  }
  return true;
}

function validateRePassword() {
  var password = document.querySelector("#password").value;
  var RePassword = document.querySelector("#RePassword").value;
  var errorDiv = GetParentAndEraseChildCode("error4");
  if (password.length != RePassword.length) {
    AlertBelowParent(errorDiv, "Password and repeat password are no identical");
    return false;
  }
  for (var i = 0; i < password.length; i++) {
    if (password[i] != RePassword[i]) {
      AlertBelowParent(errorDiv, "Password and repeat password are no identical");
      return false;
    }
  }
  return true;
}

function validatePhoneNumber() {
  var PhoneNumber = document.querySelector("#PhoneNumber").value.trim();
  var num = 0, allnum = 0;
  var errorDiv = GetParentAndEraseChildCode("error5");
  for (var i = 0; i < PhoneNumber.length; i++) {
    if (isNaN(PhoneNumber[i]) && PhoneNumber[i] != "-") {
      AlertBelowParent(errorDiv, "Phone Number must be all numbers");
      return false;
    }
    if (i < 3 && PhoneNumber[i] == 0) { num++; }
    if (i >=3 && PhoneNumber[i] != '-' && PhoneNumber[i] == 0) { allnum++; }
  }
  if (num == 3) {
    AlertBelowParent(errorDiv, "The phone number area code (first 3 numbers in 999) can't be all zeros (0)'s");
    return false;
  }
  if (allnum == 7) {
    AlertBelowParent(errorDiv, "The phone number can't be all zeros (0)'s");
    return false;
  }
  return true;
}

function validateEducationStatus() {
  var EducationStatus = document.form.EducationStatus;
  var num = 0;
  var errorDiv = GetParentAndEraseChildCode("error6");
  for (var i = 0; i < EducationStatus.length; i++) {
    if (EducationStatus[i].checked) {
      num++;
    }
  }
  if (num == 0) {
    AlertBelowParent(errorDiv, "Must select one of Education Status");
    return false;
  }
  return true;
}