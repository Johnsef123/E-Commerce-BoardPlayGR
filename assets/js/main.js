//change the visibility of the passwords
function changePasswordVisibility() {
    var x = document.getElementById("password_field");
    var y = document.getElementById("confirm_password");

    if (x !== null) {
        if (x.type === "password") {
            x.type = "text";
        }
        else {
            x.type = "password";
        }
    }


    if (y !== null) {
        if (y.type === "password") {
            y.type = "text";
        }
        else {
            y.type = "password";
        }
    }



}

//scroll button function
document.addEventListener("DOMContentLoaded", function () {
    const btn = document.getElementById("top-btn");

    if (btn!==null) {
        window.addEventListener("scroll", function () {
            if (window.scrollY > 200) {
                btn.style.display = "block";
            } else {
                btn.style.display = "none";
            }
        });

        btn.addEventListener("click", function () {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        });
    }

});


//save scroll position for when returning to the page
//get the add to cart forms
const cartForms = document.querySelectorAll(".addToCart-btn-container");

//save the scroll position only when adding a product
cartForms.forEach(form => {

    form.addEventListener("submit", () => {

        sessionStorage.setItem(
            "productsScrollPosition",
            window.scrollY
        );

    });

});

//restore on page load
window.addEventListener("load", () => {

    const scrollPosition = sessionStorage.getItem(
        "productsScrollPosition"
    );

    if (scrollPosition) {

        window.scrollTo({
            top: parseInt(scrollPosition),
            behavior: "instant"
        });

        sessionStorage.removeItem(
            "productsScrollPosition"
        );
    }

});




document.querySelectorAll(".plus-btn").forEach(button => {
    button.addEventListener("click", async function () {
        const container = this.parentElement;
        const input = container.querySelector(".quantity-input-field");
        input.value = parseInt(input.value) + 1;
        await updateQuantity(input);

        location.reload();
    });
});

document.querySelectorAll(".minus-btn").forEach(button => {
    button.addEventListener("click", async function () {
        const container = this.parentElement;
        const input = container.querySelector(".quantity-input-field");
        if (input.value >= 1) {

            input.value = parseInt(input.value) - 1;
            await updateQuantity(input);

            location.reload();
        }
    });
});

async function updateQuantity(input) {
    const cart_item_id = input.dataset.cartItemId;
    const quantity = input.value;
    await fetch("../actions/update-quantity.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },

        body: JSON.stringify({
            cart_item_id: cart_item_id,
            quantity: quantity
        })
    });
}







console.log("file is running");