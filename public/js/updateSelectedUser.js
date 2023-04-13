const userItemComponents = document.querySelectorAll(".dir_item");
console.log(userItemComponents);

const updateSelectedUserUI = (data) => {
    const {
        name,
        address,
        email,
        phone_number,
        marital_status,
        spouse,
        birthday,
        imageURL,
    } = data;

    const nameNode = document.querySelector(".selected_name");
    const addressNode = document.querySelector(".selected_address");
    const emailNode = document.querySelector(".selected_email");
    const phoneNode = document.querySelector(".selected_phone");
    const mStatusNode = document.querySelector(".selected_marital_status");
    const spouseNode = document.querySelector(".selected_spouse");
    const birthdayNode = document.querySelector(".selected_birthday");
    const imageNode = document.querySelector(".selected_profile");

    nameNode.textContent = name;
    addressNode.textContent = address;
    emailNode.textContent = email;
    phoneNode.textContent = phone_number;
    mStatusNode.textContent = marital_status;
    spouseNode.textContent = spouse;
    birthdayNode.textContent = birthday;
    imageNode.textContent = imageURL;
};

userItemComponents.forEach((user) => {
    user.addEventListener("click", async () => {
        const userSlug = user.getAttribute("data-user-slug");
        const response = await fetch(`/users/${userSlug}`);
        const data = await response.json();
        console.log(data);
        updateSelectedUserUI(data);
    });
});
