function createUsernameCookie(username) {
    const expirationDate = new Date();
    expirationDate.setHours(expirationDate.getHours() + 1);
    document.cookie = `username=${username}; expires=${expirationDate.toUTCString()}`;
}


// Function to validate the username
function validate_username() {
    let username = document.getElementById("username").value;

    let isValid = true;
    if (
      username.length >= 5 &&
      username.length <= 40 &&
      /^[a-zA-Z0-9!@#$%^*()\-_+\[\]{}:'|`~<.>/?]+$/.test(username) &&
      !/\s|,|;|=|&/.test(username)
    ) {
      console.log(`The username ${username} is acceptable.`);
      createUsernameCookie(username);
      
     
  
    } else if (isValid) {
    let s= '';
  
      if (username.length < 5) {
        s+=("\n" +"Username must be 5 characters or longer.");
        isValid = false;
      }
      if (username.length > 40) {
        s+=("\n" +"Username cannot exceed 40 characters.");
        isValid = false;
      }
      if (/\s/.test(username)) {
        s+="\n" +"Username cannot contain spaces.";
        isValid = false;
      }
      if (/,/.test(username)) {
        s+=("\n" +"Username cannot contain commas.");
        isValid = false;
      }
      if (/;/.test(username)) {
        s+=("\n" +"Username cannot contain semicolons.");
        isValid = false;
  
      }
      if (/=/.test(username)) {
        s+=("\n" +"Username cannot contain =.");
        isValid = false;
      }
      if (/&/.test(username)) {
        s+=("\n" +"Username cannot contain &.");
        isValid = false;
      }
      if(isValid===false)
      {alert(s);
        console.log(s);
      }

      if (isValid) {
        alert("Username can only use characters from the following string:aabcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^*()-_+[]{}:'|`~<.>/?");
        console.log("Username can only use characters from the following string:aabcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^*()-_+[]{}:'|`~<.>/?");
        }
  
    }
  } 


// Event listener for pressing Submit button
document.getElementById("submit-button").addEventListener("click", function () {
  validate_username();
  
});

 //Event listener for pressing Enter 
document.getElementById("username").addEventListener("keyup", function (event) {
  if (event.key === "Enter") {
      validate_username();
  }
});


const storedUsername = get_username();
const usernameInput = document.getElementById("username");

if (storedUsername) {
  usernameInput.value = storedUsername;
}