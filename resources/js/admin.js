const { Alert } = require("bootstrap");

require("./bootstrap");

// CONFIG PASSWORD VALIDATION
const btn = document.getElementById("register-button");

if (btn) {
    btn.addEventListener("click", function(e) {
        const password = document.getElementById("password").value;
        const pswConfirm = document.getElementById("password-confirm").value;

        if (password != pswConfirm) {
            alert("Password doesn't match");
            e.preventDefault();
        }
    });
}

// TYPE CLIENT VALIDATION
const btnType = document.getElementById("sub-btn");

if (btnType) {
    btnType.addEventListener("click", function(e) {
        const check = document.querySelectorAll("input[id^=type]");
        const checked = [];
        check.forEach(input => {
            if (input.checked) {
                checked.push(input);
            }
        });
        if (checked.length == 0) {
            alert("Seleziona almeno una tipologia");
            e.preventDefault();
        }
    });
}

// Delete confirmation message
const deleteDish = document.querySelectorAll(".delete-form");
deleteDish.forEach(form => {
    form.addEventListener("submit", function(e) {
        const resp = confirm("Sei sicuro di voler cancellare?");
        if (!resp) {
            e.preventDefault();
        }
    });
});
